<!DOCTYPE html>
<html>
<head>
    {{-- <base href="/public"> --}}
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('/images/favicon.png')}}" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <style>
        .center{
            margin: auto;
            width: 50%;
            text-align: center;
            padding: 30px;
        }

        table, th, td {
            border: 1px solid grey;
        }

        th{
            font-size: 15px;
            padding: 5px;
            background: skyblue;
        }

        .total_deg{
            font-size: 20px;
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

    <div class="center">
        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Product Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>

            {{-- error somewhere --}}
            <tbody>
                <?php $total_price = 0; ?>
                @foreach ($cart as $c)
                <tr>
                    <td>{{$c->product_title}}</td>
                    <td>{{$c->quantity}}</td>
                    <td>${{$c->price}}</td>
                    <td><img style="margin: auto; width: 175px;" src="product/{{$c->image}}" alt=""></td>
                    <td><a onclick="return confirm('Are you sure remove this product from your cart ?')" class="btn btn-danger" href="/remove_product/{{$c->id}}">Remove</a></td>
                </tr>
                <?php $total_price = $total_price + $c->price; ?>
                @endforeach

            </tbody>
        </table>
        <div>
            <h1 class="total_deg">Total  : Rp. {{$total_price}}</h1>
        </div>

        <div>
            <h1 style="font-size: 25px; padding-bottom:15px">Proceed to Order</h1>
            <a href="/cash_order" class="btn btn-danger">Cash On Delivery</a>
            <a href="/stripe/{{$total_price}}" class="btn btn-danger">Pay Using Card</a>
        </div>
    </div>
    
    <!-- footer start -->

    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
        
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        
        </p>
    </div>
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>
</html>