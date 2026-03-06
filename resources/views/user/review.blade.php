@extends('front.layout.master')

@section('main_content')

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
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>SL</th>
                                <th>Photo</th>
                                <th>Package</th>
                                <th>Destination</th>
                                <th>My Review</th>
                                <th>My Comment</th>
                                <th class="w-100">Action</th>
                            </tr>
                            @forelse($reviews as $review)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($review->package && $review->package->featured_photo)
                                    <img src="{{ asset('uploads/'.$review->package->featured_photo) }}" alt="" class="w-200">
                                    @else
                                    <img src="{{ asset('uploads/package-1.jpg') }}" alt="" class="w-200">
                                    @endif
                                </td>
                                <td>{{ $review->package->name ?? 'N/A' }}</td>
                                <td>{{ $review->package->destination->name ?? 'N/A' }}</td>
                                <td>
                                    <div class="review">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                            <i class="fas fa-star"></i>
                                            @else
                                            <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#commentModal{{ $review->id }}">Comment</a>
                                </td>
                                <td>
                                    @if($review->package)
                                    <a href="{{ route('package', $review->package->slug) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                    @endif
                                </td>
                            </tr>

                            <!-- Comment Modal -->
                            <div class="modal fade" id="commentModal{{ $review->id }}" tabindex="-1" aria-labelledby="commentModalLabel{{ $review->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="commentModalLabel{{ $review->id }}">Comment - {{ $review->package->name ?? '' }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 row">
                                                <div class="col-md-12">
                                                    {{ $review->comment ?? 'No comment provided.' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No reviews found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
