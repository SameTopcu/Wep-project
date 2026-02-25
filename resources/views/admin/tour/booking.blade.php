@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Booking Information</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_tour_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> Back To Tours</a>
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
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>User Name</th>
                                                    <th>User Email</th>
                                                    <th>User Phone</th>
                                                    <th>Total Person</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Method</th>
                                                    <th>Payment Status</th>
                                                    <th>Invoice No</th>
                                                    <th>Show Invoice</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($all_data->count() > 0)
                                                @foreach($all_data as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->user->name ?? 'N/A' }}</td>
                                                    <td>{{ $data->user->email ?? 'N/A' }}</td>
                                                    <td>{{ $data->user->phone ?? 'N/A' }}</td>
                                                    <td>{{ $data->total_person }}</td>
                                                    <td>${{ $data->paid_amount }}</td>
                                                    <td>{{ $data->payment_method }}</td>
                                                    <td>
                                                        @if($data->payment_status == 'COMPLETED')
                                                            <span class="badge badge-success">{{ $data->payment_status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $data->payment_status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $data->invoice_no }}</td>

                                                    <td>
                                                      <a href="{{ route('admin_tour_invoice',$data->invoice_no) }}" target="_blank" class="badge badge-primary text-decoration-none">Show Invoice</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin_booking_delete',$data->id) }}" class="btn btn-danger btn-sm delete-confirm">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="10" class="text-center">No bookings found</td>
                                                </tr>
                                                @endif
                                                
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
