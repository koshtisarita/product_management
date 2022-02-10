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
                    <td>image</td>                             
                </tr>
            </thead>                    
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td><img src="{{$category->image}}" width="60" height="60"></td>
                </tr>    
                @endforeach
                
            </tbody>
        </table>
</body>
</html>