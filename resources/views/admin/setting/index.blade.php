@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Settings</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif

                            <form action="{{ route('admin_setting_update') }}" method="post">
                                @csrf

                                <h4>Footer Information</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Footer Address *</label>
                                        <input type="text" class="form-control" name="footer_address" value="{{ old('footer_address', $setting->footer_address) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Footer Phone *</label>
                                        <input type="text" class="form-control" name="footer_phone" value="{{ old('footer_phone', $setting->footer_phone) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Footer Email *</label>
                                        <input type="text" class="form-control" name="footer_email" value="{{ old('footer_email', $setting->footer_email) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Footer Copyright *</label>
                                        <input type="text" class="form-control" name="footer_copyright" value="{{ old('footer_copyright', $setting->footer_copyright) }}">
                                    </div>
                                </div>

                                <h4 class="mt-4">Social Media Links</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" value="{{ old('facebook', $setting->facebook) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" value="{{ old('twitter', $setting->twitter) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">YouTube</label>
                                        <input type="text" class="form-control" name="youtube" value="{{ old('youtube', $setting->youtube) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">LinkedIn</label>
                                        <input type="text" class="form-control" name="linkedin" value="{{ old('linkedin', $setting->linkedin) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Instagram</label>
                                        <input type="text" class="form-control" name="instagram" value="{{ old('instagram', $setting->instagram) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-primary">Update Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

</div>
</div>
@endsection
