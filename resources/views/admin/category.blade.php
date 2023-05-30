
<!DOCTYPE html>
<html lang="en">
  <head>
    
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
    }
    .center{
      margin: auto;
      width: 50%;
      text-align: center;
      margin-top:30px;
      border: 3px solid white;
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
               @if(session()->has('deletemessage'))
               <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
                  {{session()->get('deletemessage')}}
               </div>


              @endif
              <div class="div_center">
                <h2 class="h2_font">ADD Category</h2>
                <form action="{{url('/add_category')}}" method="POST">
                  @csrf
                  <input type="text" class="text_color" name="cgname" placeholder="Add Category Name">
                  <input type="submit" class="btn btn-primary" name="submit" placeholder="Submit" value="Add Category">
                </form>
              </div>

              <table class="table table-striped center">
                <thead class="thead-dark">
                  <tr>
                    <th>Category Name</th>
                    <th>Action</th> 
                  </tr>
                </thead>

                @foreach($data as $data)
                <tbody>
                <tr>
                  <td>{{$data->category_name}}</td>
                  <td>
                  <a onclick="return confirm('Are You sure you want to delete')" class="btn btn-danger"href="{{url('delete_cat',$data->id)}}">Delete</a>
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