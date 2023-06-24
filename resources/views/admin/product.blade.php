<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .div_center{
            text-align: center;
            padding-top: 40px;
        }
        .font_size{
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text_color{
            color: black;
            padding-bottom: 20px;
        }
        label{
            display: inline-block;
            width: 200px;
        }
        .div_design{
            padding-bottom: 15px;
        }
        .color_text{
            color: white;
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
                <div class="div_center">
                    <h1 class="font_size">Add Product</h1>
                
                    <form action="/add_product" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="div_design">
                            <label for="">Product Title : </label>
                            <input class="text_color" type="text" name="title" placeholder="Write a title" required>
                        </div>

                        <div class="div_design">
                            <label for="">Product Description : </label>
                            <input class="text_color" type="text" name="description" placeholder="Write a description" required>
                        </div>

                        <div class="div_design">
                            <label for="">Product Price : </label>
                            <input class="text_color" type="number" name="price" placeholder="Write a price" required>
                        </div>

                        <div class="div_design">
                            <label for="">Discount Price : </label>
                            <input class="text_color" type="number" name="discount_price" placeholder="Write a discount price">
                        </div>

                        <div class="div_design">
                            <label for="">Product Quantity : </label>
                            <input class="text_color" type="number" name="quantity" placeholder="Write a quantity" required>
                        </div>

                        <div class="div_design">
                            <label for="">Product Category : </label>
                            <select class="text_color" name="category" id="" required>
                                <option value="" selected>Add a Category</option>
                                @foreach ($category as $category)
                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        <div class="div_design">
                            <label for="">Product Image : </label>
                            <input class="text_color" type="file" name="image" required="">
                        </div>

                        <div class="div_design">
                            <input style="border:white" class="color_text" type="submit" value="Add Product" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
        @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>