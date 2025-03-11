<!DOCTYPE html>
<html>
<head>
    <title>Stock Update</title>
</head>
<body>
@foreach ($stock as $stocks) 
     @php
     if($stocks->quantity <= 3){
        echo '<pre>';
    var_dump($stocks );
     echo '</pre>';
     }
    

     @endphp


@endforeach
</body>
</html>
