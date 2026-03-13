@extends('front.layout.master')

@section('main_content')

<div class="page-top" style="background-image: url('uploads/banner.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Packages</h2>
                        <div class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Packages</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="package pt_70 pb_50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="package-sidebar">
                            <form action="{{ route('packages') }}" method="get">
                                
                                <div class="widget">
                                    <h2>Search Package</h2>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" name="name" class="form-control" placeholder="Package Name ..." value="{{ request('name') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h2>Filter by Price</h2>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="price_min" class="form-control" placeholder="Min" value="{{ request('price_min') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="price_max" class="form-control" placeholder="Max" value="{{ request('price_max') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h2>Filter by Destination</h2>
                                    <div class="box">
                                        <select name="destination_id" class="form-select">
                                            <option value="">All Destinations</option>
                                            @foreach($destinations as $destination)
                                            <option value="{{ $destination->id }}" {{ request('destination_id') == $destination->id ? 'selected' : '' }}>{{ $destination->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <li><a href=""><i class="fas fa-angle-right"></i> All</a></li>
                                            <li><a href=""><i class="fas fa-angle-right"></i> Australia</a></li>
                                            <li><a href=""><i class="fas fa-angle-right"></i> Italy</a></li>
                                            <li><a href=""><i class="fas fa-angle-right"></i> Thailand</a></li>
                                            <li><a href=""><i class="fas fa-angle-right"></i> Canada</a></li>
                                            <li><a href=""><i class="fas fa-angle-right"></i> Japan</a></li> --}}
                                    </div>
                                </div>
                                <div class="widget">
                                    <h2>Filter by Review</h2>
                                    <div class="box">
                                        <div class="form-check form-check-review form-check-review-1">
                                            <input class="form-check-input" type="radio" name="review" id="reviewRadiosAll" value="all" {{ !request('review') || request('review') == 'all' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="reviewRadiosAll">
                                                All
                                            </label>
                                        </div>
                                        <div class="form-check form-check-review">
                                            <input class="form-check-input" type="radio" name="review" id="reviewRadios1" value="5" {{ request('review') == '5' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="reviewRadios1">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-review">
                                            <input class="form-check-input" type="radio" name="review" id="reviewRadios2" value="4" {{ request('review') == '4' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="reviewRadios2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-review">
                                            <input class="form-check-input" type="radio" name="review" id="reviewRadios3" value="3" {{ request('review') == '3' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="reviewRadios3">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-review">
                                            <input class="form-check-input" type="radio" name="review" id="reviewRadios4" value="2" {{ request('review') == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="reviewRadios4">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-review">
                                            <input class="form-check-input" type="radio" name="review" id="reviewRadios5" value="1" {{ request('review') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="reviewRadios5">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-button">
                                    <button class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-6">
                        <div class="row">

                            @forelse($packages as $package)
                            <div class="col-lg-6 col-md-6">
                                <div class="item pb_25">
                                    <div class="photo">
                                        <a href="{{ route('package',$package->slug) }}"><img src="{{ asset('uploads/'.$package->featured_photo) }}" alt=""></a>
                                        <div class="wishlist">
                                            <a href="{{ route('wishlist',$package->id) }}"><i class="far fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="text">
                                        <div class="price">
                                            ${{ $package->price }} <del>${{ $package->old_price }}</del>
                                        </div>
                                        <h2>
                                            <a href="{{ route('package',$package->slug) }}">{{ $package->name }}</a>
                                        </h2>
                                        @if($package->total_score && $package->total_rating)
                                        <div class="review">
                                            @php
                                                $rating = $package->total_score / $package->total_rating;
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating)
                                                <i class="fas fa-star"></i>
                                                @elseif($i - 0.5 <= $rating)
                                                <i class="fas fa-star-half-alt"></i>
                                                @else
                                                <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            ({{ $package->reviews->count() }} Reviews)
                                        </div>
                                        @else
                                        <div class="review">
                                            @for($i=1; $i<=5; $i++)
                                            <i class="far fa-star"></i>
                                            @endfor
                                            
                                        </div>
                                        @endif
                                        <div class="element">
                                            <div class="element-left">
                                                <i class="fas fa-plane-departure"></i> {{ $package->destination->name }}
                                            </div>
                                            {{-- <div class="element-right">
                                                <i class="fas fa-calendar-alt date-icon"></i> {{ $package->created_at->format('d M, Y') }}
                                            </div>  --}}
                                            <div class="element-right">
                                                <i class="fas fa-align-justify"></i> {{ $package->package_amenities->count() }} Amenities
                                            </div> 
                                        </div>
                                        <div class="element">
                                            <div class="element-left">
                                                <i class="fas fa-users"></i> {{ $package->tours->count()}} tours
                                            </div>
                                            <div class="element-right">
                                                <i class="fas fa-clock"></i> {{ $package->package_itineraries->count() }} Days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            @empty
                            <div class="col-12">
                                <div class="alert alert-warning text-center">
                                    No package was found for this filter.
                                </div>
                            </div>
                            @endforelse
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pagi">
                                    {{ $packages->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


























@endsection