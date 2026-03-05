@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Invoice: {{ $invoice_no }}</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Invoice: {{ $invoice_no }}</li>
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
                    <ul class="list-group list-group-flush">
                        @include('user.sidebar')
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="invoice-container" id="print_invoice">
                    <div class="invoice-top">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-border-0">
                                        <tbody>
                                            <tr>
                                                <td class="w-50">
                                                    <img src="{{ asset('uploads/logo.png') }}" alt="" class="h-60">
                                                </td>
                                                <td class="w-50">
                                                    <div class="invoice-top-right">
                                                        <h4>INVOICE</h4>
                                                        <h5>Order No: {{ $booking->invoice_no }}</h5>
                                                        <h5>Date: {{ $booking->created_at->format('Y-m-d') }}</h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-middle">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-border-0">
                                        <tbody>
                                            <tr>
                                                <td class="w-50">
                                                    <div class="invoice-middle-left">
                                                        <h4>Invoice To:</h4>
                                                        <p class="mb_0">{{ $booking->user->name }}</p>
                                                        <p class="mb_0">{{ $booking->user->email }}</p>
                                                        <p class="mb_0">{{ $booking->user->phone ?? '' }}</p>
                                                        <p class="mb_0">{{ $booking->user->address ?? '' }}</p>
                                                        <p class="mb_0">{{ $booking->user->city ?? '' }}{{ $booking->user->state ? ', '.$booking->user->state : '' }} {{ $booking->user->zip ?? '' }}</p>
                                                    </div>
                                                </td>
                                                <td class="w-50">
                                                    <div class="invoice-middle-right">
                                                        <h4>Invoice From:</h4>
                                                        <p class="mb_0">TripSummit</p>
                                                        <p class="mb_0 color_6d6d6d">{{ $admin_data->name }}</p>    
                                                        <p class="mb_0 color_6d6d6d">{{ $admin_data->email }}</p>
                                                        <p class="mb_0">{{ $admin_data->phone ?? ''}}</p>
                                                        <p class="mb_0">{{ $admin_data->address ?? '' }}</p>
                                                        <p class="mb_0">{{ $admin_data->city ?? '' }}{{ $admin_data->state ? ', '.$admin_data->state : '' }}{{ $admin_data->zip ?? '' }}</p>
                                                        <p class="mb_0">{{ 'STATUS :' .  $booking->payment_status }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered invoice-item-table">
                                        <tbody>
                                            <tr>
                                                <th>SL</th>
                                                <th>Package</th>
                                                <th>Tour Start Date</th>
                                                <th>Tour End Date</th>
                                                <th>Ticket Price</th>
                                                <th>Tickets</th>
                                                <th>Total Price</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $booking->package->name ?? 'N/A' }}</td>
                                                <td>{{ $booking->tour->tour_start_date ?? 'N/A' }}</td>
                                                <td>{{ $booking->tour->end_date ?? 'N/A' }}</td>
                                                <td>${{ $booking->total_person > 0 ? number_format($booking->paid_amount / $booking->total_person, 2) : '0.00' }}</td>
                                                <td>{{ $booking->total_person }}</td>
                                                <td>${{ number_format($booking->paid_amount, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-bottom">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-border-0">
                                        <tbody>
                                            <tr>
                                                <td class="w-70 invoice-bottom-payment">
                                                    <h4>Payment Method</h4>
                                                    <p>{{ $booking->payment_method }}</p>
                                                </td>
                                                <td class="w-30 tar invoice-bottom-total-box">
                                                    <p class="mb_0">Subtotal: <span>${{ number_format($booking->paid_amount, 2) }}</span></p>
                                                    <p class="mb_0">Discount: <span>$0</span></p>
                                                    <p class="mb_0">Total: <span>${{ number_format($booking->paid_amount, 2) }}</span></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="print-button mt_25">
                    <a onclick="printInvoice()" href="javascript:;" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
                </div>
                <script>
                    function printInvoice() {
                        let body = document.body.innerHTML;
                        let data = document.getElementById('print_invoice').innerHTML;
                        document.body.innerHTML = data;
                        window.print();
                        document.body.innerHTML = body;
                    }
                </script>
            </div>
        </div>
    </div>
</div>

@endsection
