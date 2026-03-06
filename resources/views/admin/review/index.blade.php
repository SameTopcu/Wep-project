@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Reviews</h1>
                </div>
                <div class="section-body">                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="example1">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>User</th>
                                                    <th>Package</th>
                                                    <th>Rating</th>
                                                    <th>Comment</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reviews as $review )
                                                
                                                
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $review->user->name }}<br>
                                                        <a href={{ route('package',$review->package->slug) }} target="_blank">See Details</a>
                                                    </td>
                                                    <td>
                                                        {{ $review->package->name }} 
                                                    </td> 
                                                    <td>
                                                        {{ $review->rating }} 
                                                    </td> 
                                                    <td>
                                                        {{ $review->comment }} 
                                                    </td> 
                                                    <td>
                                                        {{ $review->created_at->format('d F Y') }} 
                                                    </td> 
                                                    <td class="pt_10 pb_10">
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin_review_delete',$review->id) }}" class="btn btn-danger btn-sm delete-confirm"><i class="fas fa-trash"></i></a>
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
