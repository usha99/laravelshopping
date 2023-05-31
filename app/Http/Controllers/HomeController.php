<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Carts;

class HomeController extends Controller
{
    //

    public function index(){
        $product = product::paginate(1);
        return view('home.userpage', compact('product'));
    }
    public function redirect(){
        $userType = Auth::user()->usertype; 
        if($userType=='1')
        {
            return view('admin.home');
        }
        else{
            $product = product::paginate(1);
            return view('home.userpage', compact('product'));   
        }
    }

    public function product_details($id){

        $product = product::find($id);
        return view('home.product_details',compact('product'));

    }
    public function add_cart(Request $request, $id)
    {
      
        if(Auth::id())
        {
            // return redirect()->back();

            $user = Auth::user(); // get logged in user data 
             
            // dd($user);
            $product = product::find($id);
            
            $cart = new carts();  
            $cart->name=$user->name; // adding logged in user's name into carts table
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;  // adding user's column id into user_id column into carts table
            // adding product table data into carts table
            $cart->product_title=$product->title;
            if($product->discount_price!=null)
            {
                $cart->price=$product->discount_price * $request->quantity;

            }
            else{
            $cart->price=$product->price * $request->quantity;
            }
            $cart->image=$product->image;
            $cart->product_id=$product->id;
            $cart->quantity=$request->quantity;

            $cart->save(); 
            return redirect()->back()->with('message',' Product Added to Cart Successfully');          
            
        }
        else
        {
            return redirect('login');
        }

    }

   
}
