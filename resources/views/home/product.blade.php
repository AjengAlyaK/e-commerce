<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
        <h2>Our<span>products</span></h2>
        <br><br>
        <div>
            <form action="/product_search" method="GET">
                @csrf
                <input style="width:500px;" type="text" name="search" placeholder="Search for Something">
                <input type="submit" value="search">
            </form>
        </div>
        </div>
        <div class="row">
            @foreach ($product as $p)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="/detail_product/{{$p->id}}" class="option1">Product Details</a>

                            <form action="/add_cart/{{$p->id}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" name="quantity" value="1" min="1" style="width: 100px;">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" value="Add to Cart">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="img-box">
                        <img src="product/{{$p->image}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>{{$p->title}}</h5>
                        @if ($p->discount_price != null)
                            <h6 style="color: red">Discount price
                                <br> $                                       {{$p->discount_price}}</h6>
                            <h6 style="text-decoration: line-through; color:blue">Price <br> ${{$p->price}}</h6>
                        @else
                            <h6 style="color: blue;">Price <br> ${{$p->price}}</h6>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            <span style="padding-top: 20px;">
                {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
            </span>
        </div>
    </div>

    </div>
</section>