<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Session;

class UserController extends Controller
{
    public function getSignup(){

      return view('user.signup');

    }

    public function postSignup(Request $request){

      $this->validate($request, [
        'email' => 'email|required|unique:users',
        'password' => 'required|min:4'
      ]);

      $user = new User([
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password'))
      ]);
      $user->save();

      Auth::login($user);
        
      // check for old url, if exists redirect to it
      if (Session::has('oldUrl')) {
        $oldUrl = Session::get('oldUrl');

        // clear oldUrl key
        Session::forget('oldUrl');

        return redirect()->to($oldUrl);
      }

      return redirect()->route('user.profile');
    }

    public function getSignin(){

      return view('user.signin');
    }

    public function postSignin(Request $request){

      $this->validate($request, [
        'email' => 'email|required',
        'password' => 'required|min:4'
      ]);

      if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
        
        // check for old url, if exists redirect to it
        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            
            // clear oldUrl key
            Session::forget('oldUrl');
            
            return redirect()->to($oldUrl);
        }
          
        return redirect()->route('user.profile');
      }
      return redirect()->back();
    }

    public function getProfile(){

      return view('user.profile');
    }

    public function getLogout(){
      Auth::logout();
      return redirect()->route('user.signin');
    }
}
