<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
          @if(session()->has('message'))
          <div class="alert alert-success">
           <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
             {{session()->get('message')}}
          </div>
          @endif
       </div>
       <div class="row">
        
         @foreach ($product as $products)   
          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                     <a href="{{url('product_details',$products->id)}}" class="option2">
                        Product Detail
                        </a>
                     <form action="{{url('add_cart',$products->id)}}" method="POST">
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
                <div class="img-box">
                   <img src="/product/{{$products->image}}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                      {{$products->title}}
                   </h5>
                   @if($products->discount_price!=null)

                   <h6 style="color: red">
                     Discount Price : <br>
                     ${{$products->discount_price}}
                  </h6>
                  <h6 style="text-decoration:line-through; color:blue">
                     Regular Price : <br>
                     ${{$products->price}}
                  </h6>
                  @else
                  <h6 style="color: blue">
                     Regular Price : <br>
                     ${{$products->discount_price}}
                  </h6>
               @endif
                   
                </div>
             </div>
          </div>
          @endforeach

         <span style="padding-top: 20px">
          {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
         </span>
       {{-- <div class="btn-box">
          <a href="">
          View All products
          </a>
       </div> --}}
    </div>
 </section>