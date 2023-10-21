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

             
                <div class="card">
                    
                    <div class="card_img">
                        <img src="/image/{{ $post->image }}" >
                       {{-- <img src="{{ asset('assets/frontend/css/blog/image/1.png') }}"  alt="" > --}}
                    <p>admin on {{$post->created_at}}</p>
                    </div>
                    <a href="">{{$post->title}}</a>
                    <p>{{strip_tags($post->body)}}</p>

                </div>

               

            </div>

        </div>

    
</div>


 
@endsection

