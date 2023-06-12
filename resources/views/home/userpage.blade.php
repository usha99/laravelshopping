<!DOCTYPE html>
<html>
   <head>
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
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="assets/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="assets.css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.new_arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.our_product')
     
      {{-- Comment and reply section starts --}}

      <div style="text-align: center">

         <h1 style="font-size: 30px; text-align:center; padding-top: 20px; padding-bottom: 20px; ">Comments</h1>
          <form action="" method="POST">
            <textarea style=" height: 150px; width: 600px; " placeholder="Comment Something here" name="comment" id="comment" cols="30" rows="10"></textarea>
            <br>
            <a class="btn btn-success" href="">submit</a> 
         </form>
      </div>

      <div style="padding-left: 20%">
         <h1 style="font-size: 20px;padding-top: 20px; padding-bottom: 20px; ">All Comments</h1>
      
      {{-- Comment and reply section starts --}}
       <div>
         <b>Usha</b>
         <p>First Comment</p>
         <a  href="javascript::void(0);">Reply</a>
       </div>
       <div style="display: none" class="replyDiv" >
         <textarea style="height:100px; widht: 500px;" placeholder="Write something here..." name="commentReply" id="commentReply"></textarea>
         <br>
         <a class="btn btn-primary" onclick="reply(this)" href="">Reply</a>
      </div>
      </div>

     
      
      @include('home.subscribe')
    
      @include('home.customers_testi')
   
      @include('home.footer')
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script type="text/javascript">
         function reply(caller){
           $('.replyDiv').insertAfter($(caller));
           $('.replyDiv').show();
         }
      </script>

      <script src="assets/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="assets/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="assets/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="assets/js/custom.js"></script>


     

   </body>
</html>
