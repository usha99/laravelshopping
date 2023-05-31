
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('admin.css')
    <style type="text/css">
    .div_center {
        text-align: center;
        padding-top: 40px;
     }
     .h2_font {
       font-size: 30px;
       padding-bottom: 40px;
     }
     .text_color{
       color: black;
       padding-bottom: 20px;
     }
     label{
        display: inline-block;
        width: 200px;
     }
     .div_design{
           padding-bottom: 15px;
     }
    </style>
  </head>
  <body>
    <div class="container-scroller">
    
      @include('admin.sidebar')
      @include('admin.header') 
        
      <div class="main-panel ">
        <div class="content-wrapper">
            @if(session()->has('message'))
               <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
                  {{session()->get('message')}}
               </div> 
                @endif
            <div class="div_center">
                <h2 class="h2_font">Edit Product Details</h2>
                <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="div_design">
                <label for="product_title">Product Title :</label>
                <input value="{{$product->title}}" class="text_color" required="" type="text" name="ptitle" placeholder="Enter Product Title">
                </div> 
                <div class="div_design">
                    <label for="product_description">Product Description :</label>
                    <input value="{{$product->description}}" class="text_color" required="" type="text" name="pdescription" placeholder="Enter Product Description">
                </div> 
                <div class="div_design">
                    <label for="product_price">Product Price</label>
                    <input value="{{$product->price}}" class="text_color" required="" type="number" name="p_price" placeholder="Enter Product Price">
                </div>  
                <div class="div_design">
                    <label for="product_quantity">Product Quantity :</label>
                    <input value="{{$product->quantity}}" class="text_color" required="" type="number" min="0" name="p_quantity" placeholder="Enter Product Quantity">
                </div> 
                <div class="div_design">
                    <label for="product_category">Product Category :</label>
                    <select required="" class="text_color" name="select_product" id="select_product">
                        <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                        @foreach($category as $category)
                        <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="div_design">
                    <label for="product_discount">Product Discount :</label>
                    <input value="{{$product->discount_price}}" class="text_color" type="number" required="" name="p_discount" placeholder="Enter Product Discount">
                </div> 
                <div class="div_design">
                    <label for="product_image"> Previous Product Image :</label>
                    <img style="margin: auto" height="100px" width="100px" src="/product/{{$product->image}}">
                </div> 
                <div class="div_design">
                    <label for="product_image"> Change Product Image :</label>
                    <input type="file" name="image" placeholder="Upload new product Image">
                </div> 
                <div class="div_design">
                   <input  class="btn btn-success" value="Update Product" type="submit"> 
                </div> 
            </form>
            </div>
        </div>
      </div>
      
    @include('admin.script')
  </body>
</html>