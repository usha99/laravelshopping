
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('admin.css')
    <style type="text/css">
      label{
        display: inline-block;
        width: 200px;
        font-size: 15px;
        font-weight: bold; 
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      @include('admin.header') 
      <div class="main-panel ">
        <div class="content-wrapper">
            @if(session()->has('success'))
            <div class="alert alert-success">
             <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
               {{session()->get('success')}}
            </div>


           @endif

         <h1 style="text-align:center; font-size: 25px;" >Send Email to {{$order->email}}</h1>
         <form action="{{url('send_user_email',$order->id)}}" method="POST"> 
            @csrf
         <div style="padding-left: 35%; padding-top: 30px;">
           <label>Email Greeting : </label>
           <input style="color:black" type="text" name="greeting">
        </div>
        <div style="padding-left: 35%; padding-top: 30px;">
            <label>Email FirstLine : </label>
            <input style="color:black" type="text" name="email_firstline">
         </div>
         <div style="padding-left: 35%; padding-top: 30px;">
            <label>Email Body : </label>
            <input style="color:black"  type="text" name="email_body">
         </div>
         <div style="padding-left: 35%; padding-top: 30px;">
            <label>Email Button Name : </label>
            <input style="color:black" type="text" name="email_btn">
         </div>
         <div style="padding-left: 35%; padding-top: 30px;">
            <label>Email URL : </label>
            <input style="color:black" type="text" name="email_url">
         </div>
         <div style="padding-left: 35%; padding-top: 30px;">
            <label>Email Last Line : </label>
            <input style="color:black" type="text" name="email_last_line">
         </div>
         <div style="padding-left: 35%; padding-top: 30px;">
           
            <input class="btn btn-success" type="submit" name="submit" value="submit">
         </div>
    </form>
        </div>
      </div>
    @include('admin.script')
  </body>
</html>