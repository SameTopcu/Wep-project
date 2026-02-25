@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Invoice No : {{ $booking->invoice_no }}</h1>
                </div>
                <div class="section-body">
                    <div class="invoice">
                        <div class="invoice-print">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><b>Invoice No:</b></td>
                                        <td>{{ $booking->invoice_no }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Invoice To:</b></td>
                                        <td>
                                            Name: {{ $booking->user->name ?? 'N/A' }}<br>
                                            Email: {{ $booking->user->email ?? 'N/A' }}<br>
                                            Phone: {{ $booking->user->phone ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Invoice From:</b></td>
                                        <td>
                                            Name: {{ Auth::guard('admin')->user()->name ?? 'N/A' }}<br>
                                            Email: {{ Auth::guard('admin')->user()->email ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Tour Information:</b></td>
                                        <td>
                                            @if($booking->tour)
                                            <strong>Start: </strong>{{ $booking->tour->tour_start_date }} - <strong>End: </strong>{{ $booking->tour->end_date }}
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Package Information:</b></td>
                                        <td>{{ $booking->package->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Booking Date:</b></td>
                                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Payment Method:</b></td>
                                        <td>{{ $booking->payment_method ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Payment Status:</b></td>
                                        <td>{{ $booking->payment_status == 'COMPLETED' ? 'Completed' : 'Pending' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Persons:</b></td>
                                        <td>{{ $booking->total_person }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Paid Amount:</b></td>
                                        <td>${{ number_format($booking->paid_amount, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="text-md-right">
                            <a href="javascript:window.print();" class="btn btn-warning btn-icon icon-left text-white print-invoice-button"><i class="fas fa-print"></i> Print</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
</div>
@endsection