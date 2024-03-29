
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
      <!-- partial:partials/_sidebar.html -->
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
       <h2 class="h2_font">All Orders</h2>
       <div style="padding-left: 400px; padding-bottom: 30px;">
        <form action="{{url('search_order')}}" method="GET">
          <input style="color:black" type="text" name="search" placeholder="search...">
          <input type="submit" value="Search" class="btn-outline-primary">
        </form>
       </div>
     <table class="table table-bordered center">
         <thead class="thead-dark">
           <tr>
             <th>Name</th>
             <th>Email</th>
             <th>Phone</th>
             <th>Address</th>
             <th>Title</th>
             <th>Quantity</th>
             <th>Payment Status</th> 
             <th>Delivery Status</th>
             <th>Image</th>
             <th>Delivered</th> 
             <th>Print PDF</th>
             <th>Send Email</th>
           </tr>
         </thead> 
         @forelse($order as $order) 
         <tbody>
         <tr>
           <td>{{$order->name }}</td>
           <td>{{$order->email }}</td>
           <td>{{$order->phone }}</td>
           <td>{{$order->address }}</td>
           <td>{{$order->product_title }}</td>
           <td>{{$order->quantity }}</td>
           <td>{{$order->payment_status }}</td>
           <td>{{$order->delivery_status }}</td>
           <td>
             <img  src="/product/{{$order->image}}">
           </td> 
           <td>
            @if($order->delivery_status=="processing")
        <a class="btn btn-primary" onclick="return confirm('Are you sure this product is delivered !!!')" href="{{url('delivered',$order->id)}}">Delivered</a>  
        @else
        <p>Delivered</p>

        @endif 
        </td> 
        <td>
        <a class="btn btn-secondary" href="{{url('download_pdf',$order->id)}}">Download PDF</a>  
        </td>
        <td>
        <a class="btn btn-info" href="{{url('send_email',$order->id)}}">Send Email</a>  
        </td>              
         </tr>
       </tbody>
       
       @empty
       <div>
        No data found
       </div>

        @endforelse
       </table>

      </div>
    </div>
    @include('admin.script')
  </body>
</html>