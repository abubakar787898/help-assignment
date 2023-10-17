@extends('layouts.frontend.app')

@section('title','About Us')

@push('css')
    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/about/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet"> --}}
    <style>
        .favorite_posts{
            color: blue;
        }
    </style>
@endpush

@section('content')
 


<div class="about_section">

    <div class="about_head">
        <h1>About-Us</h1>
        
            <div class="crumbs">
                <li><a href="{{route('home')}}">Home</a></li>
                <li>About-Us</li>
            </div>

    </div>

    <div class="about-container">
        <h1>About Assignment Help Hub</h1>
    
        <p>Welcome to Assignment Help Hub, where academic excellence meets expert guidance. Our journey began with a simple yet powerful idea: to empower students to achieve their academic goals with confidence.</p>
    
        <p>At Assignment Help Hub, we go beyond providing assignment assistance. We believe in crafting a supportive environment for learning, where students can thrive and unlock their full potential.</p>
    
        <p class="quote">"Education is the key to unlocking the golden door of freedom." - George Washington Carver</p>
    
        <p>Join us on this educational journey, and let's create success stories together!</p>
      </div>

</div>

 
@endsection

