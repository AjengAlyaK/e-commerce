<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .title_deg{
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;
        }
        .table_deg{
            border: 2px solid white;
            width: 100%;
            margin: auto;
            padding-top: 50px;
            text-align: center;
        }
        th{
            background-color: skyblue;
        }
        td, th{
            border: 2px solid white;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="title_deg">All Orders</h1>
                
                <table class="table_deg">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Product Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Image</th>
                            <th>Delivered</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $o)
                        <tr>
                            <td>{{$o->name}}</td>
                            <td>{{$o->email}}</td>
                            <td>{{$o->address}}</td>
                            <td>{{$o->phone}}</td>
                            <td>{{$o->product_title}}</td>
                            <td>{{$o->quantity}}</td>
                            <td>{{$o->price}}</td>
                            <td>
                                {{$o->payment_status}}
                            </td>
                            <td>{{$o->delivery_status}}</td>
                            <td><img src="product/{{$o->image}}"></td>
                            <td>
                                @if ($o->delivery_status == 'processing')
                                    <a onclick="return confirm('Are you sure ?')" class="btn btn-primary" href="/delivered/{{$o->id}}">Deliver</a>
                                @else
                                    <p style="color:green">delivered</p>
                                @endif
                            </td>
                            <td><a href="/print_pdf/{{$o->id}}" class="btn btn-info">Print</a></td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
        @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>