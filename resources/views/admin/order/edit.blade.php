@extends('layouts.backend.app')

@section('title', 'DeadLine')

@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            View Orders Detail
                        </h2>
                    </div>
                    <div class="body">
                        {{-- <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" --}}
                        <form 
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                               User Detail
                                            </h2>
                                        </div>
                                        <div class="user">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" id="topic" class="form-control" name="topic"
                                                                value="{{ $order->user_name }}">
                                                            <label class="form-label">User Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" id="topic" class="form-control" name="topic"
                                                                value="{{ $order->email }}">
                                                            <label class="form-label">User Email</label>
                                                        </div>
                                                    </div>
                                                </div>
                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" id="topic" class="form-control" name="topic"
                                                                value="{{ $order->country }}">
                                                            <label class="form-label">Country</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" id="topic" class="form-control" name="topic"
                                                                value="{{ $order->mobile }}">
                                                            <label class="form-label">Mobile</label>
                                                        </div>
                                                    </div>
                                                </div>
                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="topic" class="form-control" name="topic"
                                        value="{{ $order->topic }}">
                                    <label class="form-label">Topic</label>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="topic" class="form-control" name="topic"
                                                value="{{ $order->deadline->name }}">
                                            <label class="form-label">DeadLine</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="topic" class="form-control" name="topic"
                                                value="{{ $order->subject->name }}">
                                            <label class="form-label">Subject</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="topic" class="form-control" name="topic"
                                                value="{{ $order->papertype->name }}">
                                            <label class="form-label">Paper Type</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="topic" class="form-control" name="topic"
                                                value="{{ $order->no_of_reference }}">
                                            <label class="form-label">No Of References</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="topic" class="form-control" name="topic"
                                                value="{{ $order->noword->name }}">
                                            <label class="form-label">No Of Words</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="topic" class="form-control" name="topic"
                                                value="{{ $order->reference->name }}">
                                            <label class="form-label">Reference</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="topic" class="form-control" name="topic"
                                                value="{{ $order->education->name }}">
                                            <label class="form-label">Education Level</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="topic" class="form-control" name="topic"
                                                value="{{ $order->reference->name }}">
                                            <label class="form-label">Reference Style</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="topic" class="form-control" name="topic"
                                        value="{{ $order->created_at }}">
                                    <label class="form-label">Order Date</label>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                               Detail
                                            </h2>
                                        </div>
                                        <div class="body">
                                            <textarea id="tinymce" name="detail">{{ $order->detail }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- 
                            <div class="form-group">
                                <input type="file" name="image">
                            </div> --}}

                            <a class="btn btn-danger m-t-15 waves-effect"
                                href="{{ route('admin.orders.index') }}">BACK</a>
                            {{-- <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
    </script>

@endpush
