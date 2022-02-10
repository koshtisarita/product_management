
<!-- Bootstrap Core Css -->
<link href="{{ url('js/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
 <div class='container'>
     <div class="row">
         <div class="col">
             <p class="text-center"><h4> Category Detail</h4></p>
         </div>
     </div>
     <div class="row text-right">
         <div class="col">
             <a href="{{route('category')}}" class='btn btn-primary'>New Category</a>
             <a href="{{route('cat-export-to-excel')}}" class='btn btn-warning'>Excel</a>
             <a href="{{route('cat-export-to-pdf')}}" class='btn btn-info'>PDF</a>
         </div>
     </div>
     <br><br>
     <div class="row">
         <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead style='background:gray'>
                        <tr>
                            <td>Name</td>
                            <td>image</td>
                            <td>Action</td>                             
                        </tr>
                    </thead>                    
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td><img src="{{$category->image}}" width="60" height="60"></td>
                            <td>
                                 <a  href='/edit-category/{{$category->id}}' class='btn btn-info waves-effect edit m-r-10'>Edit</a>
                                <button type="button" class="btn btn-danger delete" data-id="{{$category->id}}" name='delete' id='delete' >Delete</button>

                            </td>
                        </tr>    
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
         </div>
     </div>           
              

</div>
<!-- Jquery Core Js -->
<script src="{{ url('js/jquery/jquery.min.js')}}"></script>
 
 
<script>
         $('.delete').on('click',function(e){
           var cat_id= $(this).attr('data-id');
           if(confirm("Are you sure? Product of this category also delete"))
           {
            $.ajax({
                url: '/delete-category',
                type: 'POST',
                data: {
                    cat_id:cat_id,                    
                    _token: '{{ csrf_token() }}',
                },
                success: function(data, textStatus, jqXHR) {                   
                     console.log(data);
                     if(data.result == 1)
                     {
                            alert("Category deleted successfully");
                            location.reload();
                     }
                     else
                     {
                        alert("Some thing went wrong with the code");
                     }
                      

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Some thing went wrong");
                },
            });
           }
          
          
           
       })
    </script>