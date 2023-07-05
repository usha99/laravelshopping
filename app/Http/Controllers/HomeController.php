<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Carts;
use App\Models\Order;
use Stripe;
use Session;

// use Stripe;

class HomeController extends Controller
{
    //

    public function index()
    {
        $product = product::paginate(3);
        return view('home.userpage', compact('product'));
    }
    public function redirect()
    {
        $userType = Auth::user()->usertype;
        if ($userType == '1') {
            $total_product = product::all()->count();
            $total_order = order::all()->count();
            $total_user = user::all()->count();

            $order = order::all();
            $total_revenue = 0;
            foreach ($order as $order) {
                $total_revenue = $total_revenue + $order->price;
            }
            $order_delivered = order::where('delivery_status', '=', 'delivered')->get()->count();
            $order_process = order::where('delivery_status', '=', 'processing')->get()->count();
            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'order_delivered', 'order_process'));
        } else {
            $product = product::paginate(3);
            return view('home.userpage', compact('product'));
        }
    }

    public function product_details($id)
    {

        $product = product::find($id);
        return view('home.product_details', compact('product'));

    }
    public function add_cart(Request $request, $id)
    {

        if (Auth::id()) {
            // return redirect()->back();

            $user = Auth::user(); // get logged in user data 
            $user_id = $user->id;
            // dd($user);
            $product = product::find($id);

            $product_exist_id = product::where('product_id', '=', $id)->where('user_id', '=', $user_id)->get('id')->first();
            if ($product_exist_id != null) {

                $cart = carts::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;

                } else {
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->save();
                return redirect()->back()->with('message', ' Product Added to Cart Successfully');

            } else {
                $cart = new carts();
                $cart->name = $user->name; // adding logged in user's name into carts table
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id; // adding user's column id into user_id column into carts table
                // adding product table data into carts table
                $cart->product_title = $product->title;
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;

                } else {
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;

                $cart->save();
                return redirect()->back()->with('message', ' Product Added to Cart Successfully');

            }

        } else {
            return redirect('login');
        }

    }

    public function show_cart()
    {
        // return view('home.cart_page');
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = carts::where('user_id', '=', $id)->get();
            return view('home.show_cart', compact('cart'));
        } else {
            return redirect('login');
        }

    }

    public function remove_product($id)
    {
        $cart = carts::find($id);

        $cart->delete();
        return redirect()->back()->with('deletemessage', 'Product removed from cart Successfully');

    }
    public function product_cod()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $data = carts::where('user_id', '=', $user_id)->get();

        foreach ($data as $data) {
            $order = new order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart = carts::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('message', 'Product Orderd Successfully');
        // return  json_encode($data);
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }
    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from "
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $data = carts::where('user_id', '=', $user_id)->get();

        foreach ($data as $data) {
            $order = new order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart = carts::find($cart_id);
            $cart->delete();

        }

        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function show_order()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;
            $order = order::where('user_id', '=', $user_id)->get();
            return view('home.show_orders', compact('order'));
        } else {
            return redirect('login');
        }
    }
    // public function cancel_order($id){
    //     $order = order::find($id);

    //     $order->delivery_status="You Cancelled this order";
    //     $order->save();
    //     return redirect()->back()->with('deletemessage','Order Cancelled Successfully');

    // }
    public function cancel_order($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'You canceled the order';

        $order->save();
        return redirect()->back()->with('deletemessage', 'You cancelled this order');
    }

    public function products()
    {
        $product = product::paginate(3);
        return view('home.all_product', compact('product'));
    }
    public function testimonial()
    {
        return view('home.customers_testi');
    }
}