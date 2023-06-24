<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(10);

        return view('home.userpage', compact('product'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if($usertype == '1'){
            return view('admin.home');
        } else {
            $product = Product::paginate(10);

            return view('home.userpage', compact('product'));
        }
    }

    public function detail_product($id) 
    {
        $product = Product::find($id);
        return view('home.detail_product', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        if(Auth::id()){
            // until here
            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->product_title = $product->title;
            if($product->discount_price != null){
                $cart->price = $product->discount_price * $request->quantity;
            } else{
                $cart->price = $product->price * $request->quantity;
            }
            $cart->quantity = $request->quantity;
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->user_id = $user->id;
            $cart->save();
        } else{
            return redirect('login');
        }

        return redirect()->back();
    }

    public function show_cart()
    {
        if(Auth::id()){
            $id = Auth::user()->id;
            $cart  = Cart::where('user_id','=',$id)->get();
            return view('home.show_cart', compact('cart'));
        } else {
            return redirect('login');
        }
    }

    public function remove_product($id)
    {
        $product = Cart::find($id);
        $product->delete();

        return redirect()->back()->with('message', 'Product in Cart Successfully Removed');
    }

    public function cash_order()
    {
        $userid = Auth::user()->id;
        $data = Cart::where('user_id','=', $userid)->get();
        foreach($data as $d)
        {
            $order = new Order;
            $order->name = $d->name;
            $order->email = $d->email;
            $order->phone = $d->phone;
            $order->address = $d->address;
            $order->user_id = $d->user_id;
            $order->product_title = $d->product_title;
            $order->price = $d->price;
            $order->quantity = $d->quantity;
            $order->image = $d->image;
            $order->product_id = $d->product_id;

            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $d->id;
            $delete_cart = Cart::find($cart_id);
            $delete_cart->delete();
        }

        return redirect()->back()->with('message', 'We have Received your Order. We will connect with you soon...');
    }

    public function stripe($total_price)
    {
        return view('home.stripe', compact('total_price'));
    }

    public function stripePost(Request $request, $total_price)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $total_price,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thank for payment" 
        ]);

        $userid = Auth::user()->id;
        $data = Cart::where('user_id','=', $userid)->get();
        foreach($data as $d)
        {
            $order = new Order;
            $order->name = $d->name;
            $order->email = $d->email;
            $order->phone = $d->phone;
            $order->address = $d->address;
            $order->user_id = $d->user_id;
            $order->product_title = $d->product_title;
            $order->price = $d->price;
            $order->quantity = $d->quantity;
            $order->image = $d->image;
            $order->product_id = $d->product_id;

            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $d->id;
            $delete_cart = Cart::find($cart_id);
            $delete_cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }


}
