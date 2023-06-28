<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        label
        {
            display: inline-block;
            width: 150px;
            font-size: 15px;
            font-weight: bold;
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

                <h1 style="text-align:center; font-size:25px;">Send Email to {{$order->email}}</h1>
                <form action="">
                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email Greeting :</label>
                        <input type="text" name="greeting">
                    </div>
                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email First Line :</label>
                        <input type="text" name="firstline">
                    </div>
                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email Body :</label>
                        <input type="text" name="body">
                    </div>
                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email Button Name :</label>
                        <input type="text" name="button">
                    </div>
                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email Url :</label>
                        <input type="text" name="url">
                    </div>
                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email Last Line :</label>
                        <input type="text" name="lastline">
                    </div>
                    <div style="padding-left:35%; padding-top:30px;">
                        <input type="submit" value="Send Email" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>