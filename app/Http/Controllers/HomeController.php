<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(10);
        $comment = comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        return view('home.userpage', compact('product', 'comment','reply'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if($usertype == '1'){
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $total_revenue = DB::table('orders')->sum('price');
            $total_delivered = Order::where('delivery_status','delivered')->count();
            $total_processing = Order::where('delivery_status','processing')->count();

            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        } else {
            $product = Product::paginate(10);
            $comment = comment::orderby('id', 'desc')->get();
            $reply = Reply::all();
            return view('home.userpage', compact('product', 'comment', 'reply'));
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
            $user = Auth::user();
            $user_id = $user->id;
            $product = Product::find($id);

            $product_exist_id = cart::where('product_id', '=',  $id)->where('user_id', '=', $user_id)->get('id')->first();

            if($product_exist_id != null){
                $cart = cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if($product->discount_price != null){
                    $cart->price = $product->discount_price * $cart->quantity;
                } else{
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();
                Alert::success('Product Added Successfully', 'We have added product to the cart');
                return redirect()->back();
            } else{
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
                // return redirect()->back()->with('message', 'Product Added Successfully');
                Alert::success('Product Added Successfully', 'We have added product to the cart');
                // success is a design , so it also can be : warning, info
                return redirect()->back();
            }

            
        } else{
            return redirect('login');
        }

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

    public function add_comment(Request $request)
    {
        if (Auth::id())
        {
            $comment = new Comment;
            $comment->name=Auth::user()->name;
            $comment->user_id=Auth::user()->id;
            $comment->comment=$request->comment;

            $comment->save();
            return redirect()->back();
        } 
        else
        {
            return redirect('login');
        }
    }

    public function add_reply(Request $request)
    {
        if(Auth::id())
        {
            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();

            return redirect()->back();
        } 
        else 
        {
            return redirect('login');
        }
    }

    public function product_search(Request $request)
    {
        $comment = comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        $search_text = $request->search;
        $product = product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "$search_text")->paginate(10);
        return view('home.userpage', compact('product', 'comment', 'reply'));

    }

    public function search_product(Request $request)
    {
        $comment = comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        $search_text = $request->search;
        $product = product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "$search_text")->paginate(10);
        return view('home.all_product', compact('product', 'comment', 'reply'));

    }

    public function products()
    {
        $product = Product::paginate(10);
        $comment = comment::orderby('id', 'desc')->get();
        $reply = Reply::all();

        return view('home.all_product', compact('product', 'comment', 'reply'));
    }
}
