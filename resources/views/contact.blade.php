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
                <li><a href="../index.html">Home</a></li>
                <li>Contact-Us</li>
            </div>
    </div>

    <div class="contact_info">

        <form action="#" class="first_form">

            <span>
                <input type="text" placeholder="Name">
            </span>
            <span>
                <input type="email" placeholder="Email">
            </span>

        </form>

        <form action="#" class="sec_form">
            <span>
                <input type="text" placeholder="Contact Number">
            </span>
            <span>
                <select name="Country" id="Country">
                    <option value="Country" hidden>Country</option>
                    <option value="United States">United States</option>
                    <option value="Austrailia">Austrailia</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Canada">Canada</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="UAE">UAE</option>
                    <option value="Brazil">Brazil</option>
                    <option value="Bangladesh">Bangladesh</option>
                </select>
            </span>
        </form>

        <form action="#" class="third_form">
            <input type="text" placeholder="Subject">
        </form>

        <form action="#" class="forth_form">
            <textarea name="textarea" placeholder="Type details here..."></textarea>
        </form>

        <div class="form_btn">
            <button>Submit your Query</button>
        </div>

    </div>

   

</div>

 
@endsection

