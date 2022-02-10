<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Core Css -->
    <link href="<?php echo e(url('js/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <table class="table" width="100%">
            <thead style='background:gray'>
                <tr>
                    <td>Name</td>
                    <td>Category</td> 
                    <td>image</td> 
                    <td>Price</td> 
                    <td>Quantity</td>                             
                </tr>
            </thead>                    
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e($product->category_name); ?></td>
                    <td><img src="<?php echo e($product->image); ?>" width="60" height="60"></td>
                    <td><?php echo e($product->price); ?></td>
                    <td><?php echo e($product->quantity); ?></td>
                </tr>    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </tbody>
        </table>
</body>
</html><?php /**PATH F:\simplifies_solution\resources\views/productPdf.blade.php ENDPATH**/ ?>