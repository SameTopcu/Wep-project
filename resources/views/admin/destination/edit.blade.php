@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Edit Destination</h1>
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
                                    
                                    <form action="{{ route('admin_destination_edit_submit',$destination->id) }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Existing Photo </label>
                                           <div><img src="{{ asset('uploads/'.$destination->featured_photo) }}" alt="" class="w_200"></div>
                                       </div>
                                       <div class="mb-3">
                                           <label class="form-label">Change Photo </label>
                                           <div><input type="file" name="featured_photo" class="form-control"></div>
                                       </div>

                                        <div class="row">
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Name *</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $destination->name }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug *</label>
                                                    <input type="text" name="slug" class="form-control" value="{{ $destination->slug }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Country *</label>
                                                    <input type="text" name="country" class="form-control" value="{{ $destination->country }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Language *</label>
                                                    <input type="text" name="language" class="form-control" value="{{ $destination->language }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Currency *</label>
                                                    <input type="text" name="currency" class="form-control" value="{{ $destination->currency }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Area *</label>
                                                    <input type="text" name="area" class="form-control" value="{{ $destination->area }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Time Zone *</label>
                                                    <input type="text" name="time_zone" class="form-control" value="{{ $destination->time_zone }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Visa Requirement *</label>
                                                    <input type="text" name="visa_requirement" class="form-control" value="{{ $destination->visa_requirement }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Best Time *</label>
                                                    <input type="text" name="best_time" class="form-control" value="{{ $destination->best_time }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Health & Safety *</label>
                                                    <input type="text" name="health_safety" class="form-control" value="{{ $destination->health_safety }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label"> Activity *</label>
                                                    <textarea name="activity" class="form-control" rows="10">{{ $destination->activity }}</textarea>
                                                </div>
                                            </div>
                                            
                                        </div>
                                 
                                       <div class="mb-3">
                                            <label class="form-label"> Description *</label>
                                           <textarea
                                               name="description"
                                               class="form-control editor"
                                               cols="30"
                                               rows="10"
                                           >{{ $destination->description }}</textarea>
                                       </div>
                                 
                                       <div class="mb-3">
                                            <label class="form-label">Map *</label>
                                           <textarea
                                               name="map"
                                               class="form-control h_100"
                                               cols="30"
                                               rows="10"
                                           >{{ $destination->map }}</textarea>
                                           </textarea>
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
