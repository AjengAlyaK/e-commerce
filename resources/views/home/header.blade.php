<header class="header_section">
    <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="/"><img width="250" src="/images/logo.png" alt="#" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
            <li class="nav-item dropdown">
                @if (Route::has('login'))

                @auth
                <ul class="dropdown-menu">
                    <li><a href="about.html">About</a></li>
                    <li><a href="testimonial.html">Testimonial</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/products">Products</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="blog_list.html">Blog</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/show_cart">Cart</a>
                </li>
                @else
                <ul class="dropdown-menu">
                    <li><a href="about.html">About</a></li>
                    <li><a href="testimonial.html">Testimonial</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/products">Products</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="blog_list.html">Blog</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/show_cart">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-dark" href="{{ route('login')}}" id="logincss">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-light" href="{{ route('register') }}">Register</a>
                </li>
                @endauth
                @endif
            </ul>
        </div>
    </nav>
    </div>
</header>