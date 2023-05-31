
<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style type="text/css">
  .center{
      margin: auto;
      width: 50%;
      text-align: center;
      margin-top:30px;
      border: 3px solid white;
    }
    .h2_font {
      font-size: 30px;
      padding-bottom: 40px;
      text-align: center;
       padding-top: 40px;
    }
    .text_color{
      color: black;
    }
    .img_size{
       width: 150px;
       height: 150px  ;
    }
    </style>
  </head>
  <body>
    <div class="container-scroller">
     
      @include('admin.sidebar')
      @include('admin.header') 
      
      <div class="main-panel ">
        <div class="content-wrapper">
          @if(session()->has('deletemessage'))
               <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
                  {{session()->get('deletemessage')}}
               </div>


              @endif
              <h2 class="h2_font">All Products</h2>
            <table class="table table-bordered center">
                <thead class="thead-dark">
                  <tr>
                    <th>Product Title</th>
                    <th>Product Description</th>
                    <th>Product Image</th> 
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Product Category</th>
                    <th>Product</th>
                    <th>Action</th>   
                    {{-- <th class="btn btn-danger">Delete</th> --}}
                  </tr>
                </thead> 
                @foreach($product as $product) 
                <tbody>
                <tr>
                  <td>{{$product->title}}</td>
                  <td>{{$product->description}}</td>
                  <td>{{$product->price}}</td>
                  <td>{{$product->quantity}}</td>
                  <td>{{$product->category}}</td>
                  <td>{{$product->discount_price}}</td>
                  <td>
                    <img  src="/product/{{$product->image}}">
                  </td>
                  <td>
                   <a class="btn btn-success" href="{{url('/edit_product',$product->id)}}">edit</a>
                   <a class="btn btn-danger" href="{{url('delete_product',$product->id)}}">delete</a>      
                  </td>                  
                </tr>
              </tbody>
               @endforeach
              </table>

        </div>
      </div>
 
    @include('admin.script')
  </body>
</html>