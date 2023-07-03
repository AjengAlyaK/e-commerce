    <!DOCTYPE html>
    <html>
    <head>
        <base href="/public">
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Site Metas -->
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="images/favicon.png" type="">
        <title>Famms - Fashion HTML Template</title>
        <!-- bootstrap core css -->
        <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
        <!-- font awesome style -->
        <link href="home/css/font-awesome.min.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="home/css/style.css" rel="stylesheet" />
        <!-- responsive style -->
        <link href="home/css/responsive.css" rel="stylesheet" />
    </head>
    <body>
        <div class="hero_area">
            <!-- header section strats -->
            @include('home.header')
            <!-- end header section -->
            <!-- slider section -->
            @include('home.slider')
            <!-- end slider section -->
        </div>
        <!-- why section -->
        @include('home.why-section')
        <!-- end why section -->
        
        <!-- arrival section -->
        @include('home.new-arrival')
        <!-- end arrival section -->
        
        <!-- product section -->
        @include('home.product')
        <!-- end product section -->

        {{-- Comment and reply system start here --}}
        <div style="text-align: center; padding:30px">
            <h1 style="font-size: 30px;text-align: center; padding-top:20px; padding-bottom: 20px;">Comments</h1>

            <form action="/add_comment" method="post">
                @csrf
                <textarea placeholder="Comment something here" style="height: 150px;width:600px;" name="comment"></textarea><br>
                <input type="submit" class="btn btn-primary" value="Comment">
            </form>
        </div>

        <div style="padding-left: 20%;">
            <h1 style="font-size:20px; padding-bottom: 20px;">All Comments</h1>

            @foreach ($comment as $c)
            <div>
                <b>{{$c->name}}</b>
                <p>{{$c->comment}}</p>
                
                <a href="javascript::void(0);" style="color:blue;" onclick="reply(this)">Reply</a>
            </div>
            @endforeach

            <div style="display: none" class="replyDiv">
                <textarea style="height:100px;width:500px;" placeholder="write something here"></textarea><br>
                <a href="" class="btn btn-primary">Reply</a>
            </div>
        </div>

        {{-- Comment and reply system start here --}}
        <!-- subscribe section -->
        @include('home.subscribe')
        <!-- end subscribe section -->
        <!-- client section -->
        @include('home.client')
        <!-- end client section -->
        <!-- footer start -->
        @include('home.footer')
        <!-- footer end -->
        
        <script>
            function reply(caller){
                $('.replyDiv').insertAfter($(caller));
                $('.replyDiv').show();
            }
        </script>
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