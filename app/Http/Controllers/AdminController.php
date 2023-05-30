<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    //
    public function view_category(){
        $data = category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request){
       $data = new Category;
       $data->category_name = $request->cgname;
       $data->save();
       return redirect()->back()->with('message','Category Added Successfully');

    }
    public function delete_cat($id){
            $data = category::find($id);
            $data->delete();
            return redirect()->back()->with('deletemessage','Category Deleted Successfully');
    }
    public function view_product(){
        $category = category::all();
        return view('admin.product',compact('category'));
    }

    public function add_product(Request $request){
       $product = new Product();
       $product->title = $request->ptitle;
       $product->description = $request->pdescription;
       $product->price = $request->p_price;
       $product->quantity = $request->p_quantity;
       $product->category = $request->select_product;
       $product->discount_price = $request->p_discount;

       // image upload into database
       $image = $request->image;
       $imagename = time().'.'.$image->getClientOriginalExtension();

       $request->image->move('product', $imagename);
       $product->image = $imagename;


       $product->save();
       return redirect()->back()->with('message','Product Added Successfully');

    }

    public function show_product(){
        $product = product::all();
        return view('admin.show_product',compact('product'));
    }
    
}
