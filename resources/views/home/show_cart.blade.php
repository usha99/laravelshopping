<!DOCTYPE html>
<html>
   <head>
    <base href="/public">
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      {{-- <link rel="shortcut icon" href="assets/images/favicon.png" type=""> --}}
      <title>Laravel Shopping Project</title>
      
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
     
      <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  
      <link href="assets/css/style.css" rel="stylesheet" />
      
      <link href="assets.css/responsive.css" rel="stylesheet" />

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
             width: 100px;
             height: 100px  ;
          }
          .image_Desg
          {
                height: 200px;
                width: ;
          } 
          .div_total
          {
             font-size: 20px;
             padding: 40px;
             color: crimson;
          }         
          </style>
   </head>
   <body>
      <div class="hero_area">
        
        @include('home.header')

        
              @if(session()->has('deletemessage'))
                   <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
                      {{session()->get('deletemessage')}}
                   </div>
    
    
                  @endif

                  @if(session()->has('message'))
                   <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
                      {{session()->get('deletemessage')}}
                   </div>
    
    
                  @endif

                  <h2 class="h2_font">All Products added in your's cart</h2>
                <table class="table table-bordered center">
                    <thead class="thead-dark">
                      <tr>
                        <th>Product Title</th>
                        <th>Product Quantity</th>
                        <th>Product Price</th>
                        <th>Product Image</th> 
                        <th>Action</th>  
                        {{-- <th class="btn btn-danger">Delete</th> --}}
                      </tr>
                    </thead> 

                    <?php $totalprice=0; ?>

                    @foreach($cart as $cart) 
                    <tbody>
                    <tr>
                      <td>{{$cart->product_title}}</td>
                      <td>{{$cart->quantity}}</td>
                      <td>${{$cart->price}}</td>
                      <td class="image_Desg"><img  src="/product/{{$cart->image}}"></td>
                      <td> <a  class="btn btn-danger" onclick="return confirm('Are you sure to remove this product ?')" href="{{url('remove_product',$cart->id)}}">Remove Product</a></td>
                      <td>
                        {{--  --}}
                      </td>
                                    
                    </tr>
                  </tbody>
                    <?php $totalprice = $totalprice+ $cart->price ?>
                   @endforeach
                  </table>
                  <div class="h-100 d-flex align-items-center justify-content-center div_total">
                    <h3>
                        Total Price : ${{$totalprice}}</h3>
                  </div>
                  <div class="container">
                    <div class="row">                    
                        <div class="col text-center">
                        <h1 style="font-size:25px; padding-bottom:15px;">Proceed to Order</h1>
                      </div>
                    </div>
                </div> 
                <div class="container">
                    <div class="row">                    
                        <div class="col text-center">
                      <a class="btn btn-success" href="{{url('product_cod')}}">Cash on Delivery</a> 
                      <a class="btn btn-success" href="{{url('stripe',$totalprice)}}">Pay with card</a>
                    </div>
                    </div>
                </div>
                  
      </div>
                  
        {{-- @include('home.footer') --}}
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="assets/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="assets/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="assets/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="assets/js/custom.js"></script>
   </body>
</html>