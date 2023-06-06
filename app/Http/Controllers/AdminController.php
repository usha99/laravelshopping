<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notifications\MyFirstNotification;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Notification;
use PDF;

class AdminController extends Controller
{
    //
    public function view_category()
    {
        $data = category::all();
        return view('admin.category', compact('data'));
    }
    public function add_category(Request $request)
    {
        $data = new Category;
        $data->category_name = $request->cgname;
        $data->save();
        return redirect()->back()->with('message', 'Category Added Successfully');

    }
    public function delete_cat($id)
    {
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('deletemessage', 'Category Deleted Successfully');
    }
    public function view_product()
    {
        $category = category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product = new Product();
        $product->title = $request->ptitle;
        $product->description = $request->pdescription;
        $product->price = $request->p_price;
        $product->quantity = $request->p_quantity;
        $product->category = $request->select_product;
        $product->discount_price = $request->p_discount;

        // image upload into database
        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();

        $request->image->move('product', $imagename);
        $product->image = $imagename;


        $product->save();
        return redirect()->back()->with('message', 'Product Added Successfully');

    }

    public function show_product()
    {
        $product = product::all();
        return view('admin.show_product', compact('product'));
    }

    public function edit_product($id)
    {
        $product = product::find($id);
        $category = category::all();
        return view('admin.edit_product', compact('product', 'category'));
    }
    public function delete_product($id)
    {
        $product = product::find($id);

        $product->delete();
        return redirect()->back()->with('deletemessage', 'Product Deleted Successfully');
    }

    public function update_product_confirm(Request $request, $id)
    {
        $product = product::find($id);
        $product->title = $request->ptitle;
        $product->description = $request->pdescription;
        $product->price = $request->p_price;
        $product->quantity = $request->p_quantity;
        $product->category = $request->select_product;
        $product->discount_price = $request->p_discount;

        // image update into database
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save();


        return redirect()->back()->with('message', 'Products Updated Successfully');
    }

    public function orders_rec()
    {
        $order = order::all();
        return view('admin.order', compact('order'));
    }
    public function delivered($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'delivered';
        $order->payment_status = 'Paid';
        $order->save();
        return redirect()->back();
    }

    public function download_pdf($id)
    {

        $order = order::find($id);
        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');

        // return redirect()->back();
    }

    public function send_email($id)
    {
        $order = order::find($id);
        return view('admin.email_info', compact('order'));
    }

    public function send_user_email(Request $request, $id)
    {
        $order = order::find($id);

        $details = [

            'greeting' => $request->greeting,
            'email_firstline' => $request->email_firstline,
            'email_body' => $request->email_body,
            'email_btn' => $request->email_btn,
            'email_url' => $request->email_url,
            'email_last_line' => $request->email_last_line,
        ];

        Notification::send($order, new MyFirstNotification($details));
        return redirect()->back()->with('success', 'Email Sent Successfully');
    }

    public function search_order(Request $request)
    {
        $searchText = $request->search;
        $order = order::where('name', 'LIKE', "%$searchText")->orWhere('phone', 'LIKE', "%$searchText")->orWhere('email', 'LIKE', "%$searchText")->
            orWhere('product_title', 'LIKE', "%$searchText")->orWhere('payment_status', 'LIKE', "%$searchText")->orWhere('delivery_status', 'LIKE', "%$searchText")->get();
        return view('admin.order', compact('order'));
    }
}