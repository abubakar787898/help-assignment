@extends('layouts.frontend.app')

@section('title','Blog')

@push('css')
    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/blog/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet"> --}}
    <style>
        .favorite_posts{
            color: blue;
        }
    </style>
@endpush

@section('content')
 
<div class="blog_menu">

    <div class="blog_head">
        <h1>Blogs</h1>

        <div class="crumbs">
            <li><a href="{{route('home')}}">Home</a></li>
            <li>Blogs</li>
        </div>
    </div>

        <div class="blog_content">

            <div class="cards">

                @foreach ($posts as $item)
                <div class="card">
                    
                    <div class="card_img">
                        <a href="{{ route('blog.show', ['slug' => $item->slug]) }}"> <img src="{{ asset('assets/frontend/css/blog/image/1.png') }}"  alt="" width="350px" height="200px"></a>
                    <p>admin on {{$item->created_at}}</p>
                    </div>
                    <a href="">{{$item->title}}</a>
                    <p>{{strip_tags($item->body)}}</p>

                </div>
@endforeach
                <div class="card">
                    
                    <div class="card_img">
                        <img src="{{ asset('assets/frontend/css/blog/image/1.png') }}" alt="" width="350px" height="200px">
                    <p>admin on 2020-05-04</p>
                    </div>
                    <h2>Essay on Progress of Pakistan</h2>
                    <p>When Pakistan came into being it was only a piece of land with people with great belief, vision and the courage to stand[...]</p>
                
                </div>

            </div>

        </div>

    
</div>


 
@endsection

