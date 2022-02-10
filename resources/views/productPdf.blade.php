<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Core Css -->
    <link href="{{ url('js/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
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
                @foreach($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category_name}}</td>
                    <td><img src="{{$product->image}}" width="60" height="60"></td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                </tr>    
                @endforeach
                
            </tbody>
        </table>
</body>
</html>