<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use Illuminate\Http\Request;

use Session;
use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::all();
        return view('shop.index', ['products' => $products]);
    }

    public function getAddToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        // this dumps cart data to the screen
//        dd($request->session()->get('cart'));
        return redirect()->route('product.index');
    }

    public function getCart() {
        // if no items, don't return anything
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice
        ]);
    }

    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }
    public function postCheckout(Request $request){
      if (!Session::has('cart')) {
          return redirect()->route('shop.shoppingCart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);

      Stripe::setApiKey('sk_test_CQnMLMgwlhtJoVmXl0EJPyIy');
      try{
        Charge::create([
          "amount" => $cart->totalPrice * 100,
          "currency" => "usd",
          "source" => $request->input('stripeToken'),
          "description" => "Test Charge"
        ]);
      }catch(\Exception $e){
        return redirect()->route('checkout')->with('error', $e->getMessage());
      }

      Session::forget('cart');
      return redirect()->route('product.index')->with('success', 'Successfully purchased products!');

    }

}
