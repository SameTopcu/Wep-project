@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}');">
                <div class="container">
                <div class="row">   
                    <div class="col-md-12">
                        <h2>Bookings</h2>
                        <div class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Bookings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content user-panel pt_70 pb_70">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="card">
                            @include('user.sidebar')
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>SL</th>
                                        <th>Invoice No</th>
                                        <th>Total Person</th>
                                        <th>Paid Amount</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>                                        
                                        <th class="w-100">
                                            Action
                                        </th>
                                    </tr>
                                    @foreach($all_data as $data)
                                    <tr>
                                        
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $data->invoice_no }}
                                        </td>
                                        <td>
                                            {{ $data->total_person }}
                                        </td>
                                        <td>${{ $data->paid_amount }}</td>
                                        <td>{{ $data->payment_method }}</td>
                                        <td>
                                            @if($data->payment_status == 'COMPLETED')
                                                <div class="badge bg-success">{{ $data->payment_status }}</div>
                                            @else
                                                <div class="badge bg-danger">{{ $data->payment_status }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm mb-1 w-100-p" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $loop->iteration }}">Detail</a>
                                            <a href="{{ route('user_invoice', $data->invoice_no) }}" class="btn btn-secondary btn-sm w-100-p">Invoice</a>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3 row modal-seperator">
                                                        <div class="col-md-5">
                                                            <b>Invoice No:</b>
                                                        </div>
                                                        <div class="col-md-7">
                                                            {{ $data->invoice_no }}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row modal-seperator">
                                                        <div class="col-md-5">
                                                            <b>Package:</b>
                                                        </div>
                                                        <div class="col-md-7">
                                                            {{ $data->package->name ?? 'N/A' }}
                                                            @if($data->package)
                                                                <br><a href="{{ route('package', $data->package->slug) }}">Show Detail</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row modal-seperator">
                                                        <div class="col-md-5">
                                                            <b>Tour:</b>
                                                        </div>
                                                        <div class="col-md-7">
                                                            {{ $data->tour->package->name ?? 'N/A' }} - {{ $data->tour->tour_start_date ?? '' }}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row modal-seperator">
                                                        <div class="col-md-5">
                                                            <b>Total Person:</b>
                                                        </div>
                                                        <div class="col-md-7">
                                                            {{ $data->total_person }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mb-3 row modal-seperator">
                                                        <div class="col-md-5">
                                                            <b>Paid Amount:</b>
                                                        </div>
                                                        <div class="col-md-7">
                                                            ${{ $data->paid_amount }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mb-3 row modal-seperator">
                                                        <div class="col-md-5">
                                                            <b>Payment Method:</b>
                                                        </div>
                                                        <div class="col-md-7">
                                                            {{ $data->payment_method }}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row modal-seperator">
                                                        <div class="col-md-5">
                                                            <b>Payment Status:</b>
                                                        </div>
                                                        <div class="col-md-7">
                                                           @if($data->payment_status == 'COMPLETED')
                                                                <div class="badge bg-success">{{ $data->payment_status }}</div>
                                                            @else
                                                                <div class="badge bg-danger">{{ $data->payment_status }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row modal-seperator">
                                                        <div class="col-md-5">
                                                            <b>Travel Start Date:</b>
                                                        </div>
                                                        <div class="col-md-7">
                                                            {{ $data->tour->tour_start_date ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row modal-seperator">
                                                        <div class="col-md-5">
                                                            <b>Travel End Date:</b>
                                                        </div>
                                                        <div class="col-md-7">
                                                            {{ $data->tour->end_date ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- // Modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection