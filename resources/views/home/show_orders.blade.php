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

                  <h2 class="h2_font">Your All orders</h2>
                <table class="table table-bordered center">
                    <thead class="thead-dark">
                      <tr>
                        <th>Product Title</th>
                        <th>Product Quantity</th>
                        <th>Product Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Product Image</th> 
                         <th>Action</th>
                        {{-- <th class="btn btn-danger">Delete</th> --}}
                      </tr>
                    </thead> 

                    <?php $totalprice=0; ?>

                    @foreach($order as $order) 
                    <tbody>
                    <tr>
                      <td>{{$order->product_title}}</td>
                      <td>{{$order->quantity}}</td>
                      <td>${{$order->price}}</td>
                      <td>{{$order->payment_status}}</td>
                      <td>{{$order->delivery_status}}</td>
                      <td class="image_Desg"><img  src="/product/{{$order->image}}"></td>
                      @if($order->delivery_status=='processing')
                      <td> <a  class="btn btn-danger" onclick="return confirm('Are you sure to cancel this order ?')" href="{{url('cancel_order',$order->id)}}">Cancel Order</a></td>
                     
                      @else
                        <td> <p style="color:blueviolet">Cancellation not allowed.</p> </td>
                      @endif

                                    
                    </tr>
                  </tbody>
                    <?php $totalprice = $totalprice+ $order->price ?>
                   @endforeach
                  </table>
                  <div class="h-100 d-flex align-items-center justify-content-center div_total">
                    <h3>
                        Total Price : ${{$totalprice}}</h3>
                  </div>
                  
                </div> 
                
      </div>
                  
        {{-- @include('home.footer') --}}
      
      
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