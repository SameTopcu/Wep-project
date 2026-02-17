@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Edit Package</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_package_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
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
                                    
                                    <form action="{{ route('admin_package_edit_submit',$package->id) }}" method="post" enctype="multipart/form-data">
                                       @csrf

                                       <div class="row">
                                        <div class="col md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Existing Featured Photo </label>
                                                <div><img src="{{ asset('uploads/'.$package->featured_photo) }}" alt="" class="w_200"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Change Featured Photo </label>
                                                <div><input type="file" name="featured_photo" class="form-control" value="{{ $package->featured_photo }}"></div>
                                            </div>
                                        </div>
                                        <div class="col md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Existing Banner Photo </label>
                                                <div><img src="{{ asset('uploads/'.$package->banner) }}" alt="" class="w_200"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Change Banner Photo </label>
                                                <div><input type="file" name="banner" class="form-control" value="{{ $package->banner }}"></div>
                                            </div>
                                       </div>
                                    </div>
                                       
                                       
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Name *</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $package->name }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug *</label>
                                                    <input type="text" name="slug" class="form-control" value="{{ $package->slug }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Map *</label>
                                                    <input type="text" name="map" class="form-control" value="{{ $package->map }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                            <div class="mb-3">
                                                <label class="form-label">Destination *</label>
                                                 <select name="destination_id" id="destination_id" class="form-control select2-destination" required>
                                                     <option value=""></option>
                                                     @foreach($destinations as $destination)
                                                         <option value="{{ $destination->id }}" 
                                                             @if(old('destination_id', $package->destination_id) == $destination->id) selected @endif>
                                                             {{ $destination->name }}
                                                         </option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Price *</label>
                                                    <input type="text" name="price" class="form-control" value="{{ $package->price }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Old Price *</label>
                                                    <input type="text" name="old_price" class="form-control" value="{{ $package->old_price }}">
                                                </div>
                                            </div>                                                                                                                                    
                                        </div>

                                        <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Description *</label>
                                                    <textarea name="description" class="form-control editor" rows="10">{{ $package->description }}</textarea>
                                                </div>
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
