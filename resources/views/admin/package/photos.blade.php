@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Photo Gallery of {{$package->name}}</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_package_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="table-responsive">
                                <h4>Photo Gallery List</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Photo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @if($package_photos->count() > 0)
                                    @foreach($package_photos as $package_photo)
                                    <tbody>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('uploads/'.$package_photo->photo) }}" alt="" class="w_100"></td>
                                        <td>
                                            <a href="{{ route('admin_package_photos_delete',$package_photo->id) }}" class="btn btn-danger btn-sm delete-confirm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tbody>
                                    @endforeach
                                    @else
                                    <tbody>
                                        <tr><td colspan="4" class="text-center">No photos found</td></tr>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <h4>Add Photo</h4>
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
                                    
                                    <form action="{{ route('admin_package_photos_submit', $package->id) }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Photo *</label>
                                           <div><input type="file" name="photo" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml"></div>
                                        </div>  
                                       <div class="mb-3">
                                           <label class="form-label" ></label>
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
