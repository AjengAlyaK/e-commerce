<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Order Details</title>
</head>
<body>
    <h1>Order Details</h1>
    Name :<h3>{{$order->name}}</h3>
    Email :<h3>{{$order->email}}</h3>
    Phone :<h3>{{$order->phone}}</h3>
    Address :<h3>{{$order->address}}</h3>
    Customer Id :<h3>{{$order->user_id}}</h3>
    Product Title :<h3>{{$order->product_title}}</h3>
    Price :<h3>{{$order->price}}</h3>
    Quantity :<h3>{{$order->quantity}}</h3>
    Payment Status<h3>{{$order->payment_status}}</h3>
    Product Id :<h3>{{$order->product_id}}</h3>
    <br><br>
    <img width="150" src="product/{{$order->image}}" alt="">
</body>
</html>