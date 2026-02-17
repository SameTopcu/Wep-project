@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Amenities of {{$package->name}}</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_package_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Amenity</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @if($package_amenities->count() > 0)
                                    @foreach($package_amenities as $package_amenity)
                                    <tbody>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $package_amenity->rAmenity->name ?? 'N/A' }}</td>
                                        <td>
                                            @if($package_amenity->type == 'include')
                                                <span class="badge badge-success">Include</span>
                                            @else
                                                <span class="badge badge-danger">Exclude</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin_package_amenities_delete',$package_amenity->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tbody>
                                    @endforeach
                                    @else
                                    <tbody>
                                        <tr><td colspan="4" class="text-center">No amenities found</td></tr>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="col-md-5">
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
                                    
                                    <form action="{{ route('admin_package_amenities_submit', $package->id) }}" method="post">
                                       @csrf
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Amenity *</label>
                                           <select name="amenity_id" class="form-control">
                                           @foreach($amenities as $amenity)
                                                <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>  
                                        <div class="mb-3">
                                            <label class="form-label">Type *</label>
                                           <div><select name="type" class="form-control">
                                            
                                            <option value="include">Include</option>
                                            <option value="exclude">Exclude</option>
                                           </select></div>
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
