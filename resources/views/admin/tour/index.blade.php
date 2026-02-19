@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Tours</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_tour_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="example1">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Package</th>
                                                    <th>Tour Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Booking End Date</th>
                                                    <th>Tour Total Seat</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tours as $tour )
                                                
                                                
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $tour->package->name }}<br>
                                                        <a href="{{ route('package',$tour->package->slug) }}" target="_blank">See details</a>
                                                    </td>
                                                    <td>
                                                        {{ $tour->tour_start_date }} 
                                                    </td> 
                                                    <td>
                                                        {{ $tour->end_date }} 
                                                    </td> 
                                                    <td>
                                                        {{ $tour->booking_end_date }} 
                                                    </td> 
                                                    <td>
                                                        @if($tour->tour_total_seat > 0)
                                                        {{ $tour->tour_total_seat }} 
                                                        @else
                                                        <span class="text-danger">Unlimited</span>
                                                        @endif
                                                    </td> 

                                                    <td class="pt_10 pb_10">
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin_tour_edit',$tour->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                            <a href="{{ route('admin_tour_delete',$tour->id) }}" class="btn btn-danger btn-sm delete-confirm"><i class="fas fa-trash"></i></a>
                                                        </div>
                                                    </td>                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>



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
