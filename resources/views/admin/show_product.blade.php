<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .center{
            margin: auto;
            width: 90%;
            border: 2px solid white;
            text-align: center;
            margin-top: 40px;
        }
        tr, th, td{
            border: 1px solid white;
            padding: 5px 10px 5px 10px;
        }
        .font_size{
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }
        .img_size{
            width: 130px
        }
        .th_color{
            background: rgb(66, 187, 235);
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
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
                @endif
                <h2 class="font_size">All Product</h2>
                <table class="center">
                    <thead class="th_color">
                        <tr>
                            <th>No</th>
                            <th>Product Title</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th class="col_img">Product Image</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->discount_price}}</td>
                            <td>
                                <img class="img_size" src="product/{{$product->image}}" alt="">
                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this ?')" href="/delete_product/{{$product->id}}">Delete</a> 
                            </td>
                            <td>
                                <a class="btn btn-success" href="/update_product/{{$product->id}}">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
        @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>