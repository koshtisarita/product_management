
<!-- Bootstrap Core Css -->
<link href="<?php echo e(url('js/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">
 <div class='container'>
     <div class="row">
         <div class="col">
             <p class="text-center"><h4> Category Detail</h4></p>
         </div>
     </div>
     <div class="row text-right">
         <div class="col">
             <a href="<?php echo e(route('category')); ?>" class='btn btn-primary'>New Category</a>
             <a href="<?php echo e(route('cat-export-to-excel')); ?>" class='btn btn-warning'>Excel</a>
             <a href="<?php echo e(route('cat-export-to-pdf')); ?>" class='btn btn-info'>PDF</a>
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
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($category->name); ?></td>
                            <td><img src="<?php echo e($category->image); ?>" width="60" height="60"></td>
                            <td>
                                 <a  href='/edit-category/<?php echo e($category->id); ?>' class='btn btn-info waves-effect edit m-r-10'>Edit</a>
                                <button type="button" class="btn btn-danger delete" data-id="<?php echo e($category->id); ?>" name='delete' id='delete' >Delete</button>

                            </td>
                        </tr>    
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                </table>
            </div>
         </div>
     </div>           
              

</div>
<!-- Jquery Core Js -->
<script src="<?php echo e(url('js/jquery/jquery.min.js')); ?>"></script>
 
 
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
                    _token: '<?php echo e(csrf_token()); ?>',
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
    </script><?php /**PATH F:\simplifies_solution\resources\views/view_category.blade.php ENDPATH**/ ?>