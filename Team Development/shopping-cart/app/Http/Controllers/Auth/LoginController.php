<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // redirect user to Google oAuth
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    
    // get user info returned by Google
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {

//            var_dump($e);
             return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();

        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
            
            // check for old url, if exists redirect to it
            if (Session::has('oldUrl')) {
                $oldUrl = Session::get('oldUrl');

                // clear oldUrl key
                Session::forget('oldUrl');

                return redirect()->to($oldUrl);
            }
          
            return redirect()->route('user.profile');
        } else {
            var_dump($user);
            // create a new user
            $newUser = new User;
            $newUser->email = $user->email;
            $newUser->password = 'null';
            $newUser->save();

            auth()->login($newUser, true);
            
            // check for old url, if exists redirect to it
            if (Session::has('oldUrl')) {
              $oldUrl = Session::get('oldUrl');

              // clear oldUrl key
              Session::forget('oldUrl');

              return redirect()->to($oldUrl);
            }

            return redirect()->route('user.profile');
        }
        return redirect()->to('/home');
    }
}
