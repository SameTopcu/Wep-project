@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Itineraries of {{$package->name}}</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_package_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <h4>Itineraries List</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @if($package_itineraries->count() > 0)
                                    @foreach($package_itineraries as $package_itinerary)
                                    <tbody>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $package_itinerary->name ?? 'N/A' }}</td>
                                        <td>{!! $package_itinerary->description ?? 'N/A' !!}</td>
                                        <td>
                                            <a href="{{ route('admin_package_itineraries_delete',$package_itinerary->id) }}" class="btn btn-danger btn-sm delete-confirm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tbody>
                                    @endforeach
                                    @else
                                    <tbody>
                                        <tr><td colspan="4" class="text-center">No itineraries found</td></tr>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h4>Add Itinerary</h4>
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
                                    
                                    <form action="{{ route('admin_package_itineraries_submit', $package->id) }}" method="post">
                                       @csrf
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Name *</label>
                                           <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name">
                                        </div>  
                                        <div class="mb-3">
                                            <label class="form-label">Description *</label>
                                           <textarea name="description" class="form-control editor" rows="10">{!! old('description') !!}</textarea>
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
