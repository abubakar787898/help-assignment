@extends('layouts.frontend.app')

@section('title','About Us')

@push('css')
    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/contact/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet"> --}}
    <style>
        .favorite_posts{
            color: blue;
        }
    </style>
@endpush

@section('content')
 

<div class="contact_menu">

    <div class="contact_head">
        <h1>Contact-Us</h1>
            <div class="crumbs">
                <li><a href="{{route('home')}}">Home</a></li>
                <li>Contact-Us</li>
            </div>
    </div>

    <div class="contact_info">

        <form action="{{ route('contact-us') }}" method="POST" enctype="multipart/form-data" >
            @csrf
<div>           <span>
                <input type="text" name="name" placeholder="Name">
            </span>
            <span>
                <input type="email" name="email" placeholder="Email">
            </span>
        </div>
 
            <br>
            <div class="forth_form">
            <textarea name="body"  placeholder="Type details here..."></textarea>
        </div>
        <div class="form_btn">
            <button>Submit your Query</button>
        </div>
        </form>

       

    

        {{-- <form action="#" class="forth_form">
            <textarea name="textarea" placeholder="Type details here..."></textarea>
        </form> --}}

    

    </div>

   

</div>

@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}
@endpush

