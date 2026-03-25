@extends('front.layout.master')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Terms of Use</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Terms of Use</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="special pt_70 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Please replace this text with your site’s terms of use. You can edit the content in the Terms of Use page template in your project.</p>
            </div>
        </div>
    </div>
</div>
@endsection
