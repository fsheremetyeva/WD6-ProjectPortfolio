<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use App\Order;
use Illuminate\Http\Request;

use Session;
use Auth;
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

    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        // check that there is at least one item in the shopping cart
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }
    public function getRemoveItemFromWishList($id) {
        $this->getRemoveItemFromCart($id, 'wish-list');
        return redirect()->route('product.shoppingCart');
    }
    public function getRemoveItem($id, $type = 'cart') {
        $this->getRemoveItemFromCart($id, $type);
        return redirect()->route('product.shoppingCart');
    }
    public function getRemoveItemFromCart($id, $type = 'cart') {
        $oldCart = Session::has($type) ? Session::get($type) : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        // check that there is at least one item in the shopping cart
        if (count($cart->items) > 0) {
            Session::put($type, $cart);
        } else {
            Session::forget($type);
        }
    }

        public function addToWishList($id) {
            $this->getRemoveItemFromCart($id);
            $product = Product::find($id);
            $oldWishList = Session::has('wish-list') ? Session::get('wish-list') : null;
            $wishList = new Cart($oldWishList);
            $wishList->add($product, $product->id);

            // check that there is at least one item in the shopping cart
            if (count($wishList->items) > 0) {
                Session::put('wish-list', $wishList);
            } else {
                Session::forget('wish-list');
            }

            return redirect()->route('product.shoppingCart');
        }
        public function moveToCart(Request $request, $id) {
            $this->getRemoveItemFromCart($id, 'wish-list');
            $product = Product::find($id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product, $product->id);
            $request->session()->put('cart', $cart);
            return redirect()->route('product.shoppingCart');
        }

    public function getCart() {
      $oldList = Session::get('wish-list');
      $wishList = new Cart($oldList);

        // if no items, don't return anything
        if (!Session::has('cart')) {
            return view('shop.shopping-cart', [
                'wishListProducts' => $wishList->items,
                'wishListTotalPrice' => $wishList->totalPrice
            ]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'wishListProducts' => $wishList->items,
            'wishListTotalPrice' => $wishList->totalPrice
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
      $charge = Charge::create([
          "amount" => $cart->totalPrice * 100,
          "currency" => "usd",
          "source" => $request->input('stripeToken'),
          "description" => "Test Charge"
        ]);
      $order = new Order();
      $order->cart = serialize($cart);
      $order->address = $request->input('address');
      $order->name = $request->input('name');
      $order->payment_id = $charge->id;

      Auth::user()->orders()->save($order);

      }catch(\Exception $e){
        return redirect()->route('checkout')->with('error', $e->getMessage());
      }

      Session::forget('cart');
      return redirect()->route('product.index')->with('success', 'Successfully purchased products!');

    }

}
