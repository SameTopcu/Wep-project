@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Create Destinations</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_destination_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
                    </div>
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
                                    
                                    <form action="{{ route('admin_destination_create_submit') }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Featured Photo *</label>
                                           <div><input type="file" name="featured_photo" class="form-control"></div>
                                       </div>
                                        <div class="row ">
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Name *</label>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                                </div>
                                            </div>    
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug *</label>
                                                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Country*</label>
                                                    <input type="text" name="country" class="form-control" value="{{ old('country') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Language*</label>
                                                    <input type="text" name="language" class="form-control" value="{{ old('language') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Currency*</label>
                                                    <input type="text" name="currency" class="form-control" value="{{ old('currency') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Area*</label>
                                                    <input type="text" name="area" class="form-control" value="{{ old('area') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Time Zone*</label>
                                                    <input type="text" name="time_zone" class="form-control" value="{{ old('time_zone') }}">
                                                </div>
                                            </div>
                                            
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Visa Requirement *</label>
                                                    <input type="text" name="visa_requirement" class="form-control" value="{{ old('visa_requirement') }}">
                                                </div>
                                            </div>
                                            
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Best Time *</label>
                                                    <input type="text" name="best_time" class="form-control" value="{{ old('best_time') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Health & Safety *</label>
                                                    <input type="text" name="health_safety" class="form-control" value="{{ old('health_safety') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label"> Activity *</label> *</label>
                                                    <textarea name="activity" class="form-control" rows="10">{{ old('activity') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Description *</label>
                                           <textarea
                                               name="description"
                                               class="form-control editor"
                                               cols="30"
                                               rows="10"
                                           >{{ old('description') }}</textarea>
                                       </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Map *</label>
                                            <textarea
                                               name="map"
                                               class="form-control h_100"
                                               cols="30"
                                               rows="10"
                                           >{{ old('map') }}</textarea>
                                       </div>

                                       <div class="mb-3">
                                           <button type="submit" class="btn btn-primary">
                                               Submit
                                           </button>
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
