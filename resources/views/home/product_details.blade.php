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
   </head>
   <body>
      <div class="hero_area">
        
        @include('home.header')

         
    
          <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width:50%; padding:30px">
            @if(session()->has('message'))
               <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
                  {{session()->get('message')}}
               </div>
               @endif
             <div class="box">
                
                <div class="img-box" style="padding:20px">
                   <img src="/product/{{$product->image}}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                      {{$product->title}}
                   </h5>
                   @if($product->discount_price!=null)

                   <h6 style="color: red">
                     Discount Price : <br>
                     ${{$product->discount_price}}
                  </h6>
                  <h6 style="text-decoration:line-through; color:blue">
                     Regular Price : <br>
                     ${{$product->price}}
                  </h6>
                  @else
                  <h6 style="color: blue">
                     Regular Price : <br>
                     ${{$product->discount_price}}
                  </h6>
                  
               @endif

               <h6>Product Description : {{$product->description}}</h6>
               <h6>Product category : {{$product->category}}</h6>
               <h6>Availabe quantity : {{$product->quantity}}</h6>
               <form action="{{url('add_cart',$product->id)}}" method="POST">
                @csrf
                <div class="row">
                   <div class="col-md-4" style="width:100px">
                <input type="number" name="quantity" value="1" min="1">
             </div>
             <div class="col-md-4">
                <input type="submit" value="Add to cart">
             </div>
             </div>
             </form>
                   
                </div>
             </div>
          </div> 
        



        @include('home.footer')
      
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