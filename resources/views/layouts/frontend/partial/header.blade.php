{{-- <header class="bg-success text-white">
    <div class="container-fluid position-relative no-side-padding"> --}}

        {{-- <a href="{{ route('home') }}" class="logo">{{ env('APP_NAME') }}</a> --}}
        {{-- <a  class="logo">{{ env('APP_NAME') }}</a> --}}

        {{-- <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div> --}}

        {{-- <ul class="main-menu visible-on-click" id="main-menu"> --}}
            {{-- <li><a href="{{ route('home') }}">Home</a></li> --}}
            {{-- <li><a >Home</a></li> --}}
            {{-- <li><a href="{{ route('post.index') }}">Posts</a></li> --}}
            {{-- <li><a >Posts</a></li> --}}
            {{-- @guest --}}
                {{-- <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li> --}}
            {{-- @else --}}
                {{-- @if(Auth::user()->role->id == 1) --}}
                    {{-- <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li> --}}
                    {{-- <li><a href="">Dashboard</a></li>
                @endif
                @if(Auth::user()->role->id == 2)
                    <li><a href="">Dashboard</a></li>
                @endif
            @endguest
        </ul><!-- main-menu --> --}}

        {{-- <div class="src-area bg-success text-white"> --}}
            {{-- <form method="GET" action="{{ route('search') }}"> --}}
            {{-- <form method="GET" action="">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input class="src-input" value="{{ isset($query) ? $query : '' }}" name="query" type="text" placeholder="Search">
            </form>
        </div>

    </div><!-- conatiner --> --}}
{{-- </header> --}}

<div class="top_header">
    <p>Welcome To Assignment-ART UAE</p>
    <p>+971569715043</p>
    <p>assignmentart.com</p>
</div>

 <!-- navbar -->
 <nav class="navbar">

    <div class="brand_logo">
        <a href="{{route('home')}}">
            <img src="{{ asset('assets/frontend/css/home/images/logo.png')}}" width="160" height="60" alt="">
        </a>
    </div>

    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
    <i class="fa-solid fa-bars-staggered"></i>
    </label>

    <ul>
    
        <a href="{{route('home')}}"><li>Home</li></a>
        <a href="{{route('about.show')}}"><li>About Us</li></a>
        <a href="{{route('blog')}}"><li>Blogs</li></a>
      
        <a href="{{route('contact.show')}}"><li>Contact Us</li></a>
        <a href="{{route('home')}}#order"><button>Order Now</button></a>
        {{-- <button>Order Now</button> --}}

   </ul>

</nav>
