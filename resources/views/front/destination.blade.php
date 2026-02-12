@extends('front.layout.master')


@section('main_content')

        <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{$destination->name}}</h2>
                        <div class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('destinations') }}">Destinations</a></li>
                                <li class="breadcrumb-item active">{{$destination->name}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="destination-detail pt_50 pb_50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="main-item mb_50">
                            <div class="main-photo">
                                <img src="{{asset('uploads/'.$destination->featured_photo)}}" alt="">
                            </div>
                        </div>
                        <div class="main-item mb_50">
                            <h2>
                                Description
                            </h2>
                            <p>
                                {!! $destination->description !!}
                            </p>
                            
                        </div>


                        <div class="main-item mb_50">
                            <h2>Packages</h2>
                            <div class="package">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="item pb_25">
                                            <div class="photo">
                                                <a href="package.html"><img src="uploads/package-1.jpg" alt=""></a>
                                                <div class="wishlist">
                                                    <a href=""><i class="far fa-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="text">
                                                <div class="price">
                                                    $150 <del>$250</del>
                                                </div>
                                                <h2>
                                                    <a href="package.html">Venice Grand Canal</a>
                                                </h2>
                                                <div class="review">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    (4 Reviews)
                                                </div>
                                                <div class="element">
                                                    <div class="element-left">
                                                        <i class="fas fa-plane-departure"></i> Italy
                                                    </div>
                                                    <div class="element-right">
                                                        <i class="fas fa-calendar-alt date-icon"></i> 14 Jun, 2024
                                                    </div>
                                                </div>
                                                <div class="element">
                                                    <div class="element-left">
                                                        <i class="fas fa-users"></i> 25 Persons
                                                    </div>
                                                    <div class="element-right">
                                                        <i class="fas fa-clock"></i> 7 Days
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="item pb_25">
                                            <div class="photo">
                                                <a href="package.html"><img src="uploads/package-2.jpg" alt=""></a>
                                                <div class="wishlist">
                                                    <a href=""><i class="far fa-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="text">
                                                <div class="price">
                                                    $230
                                                </div>
                                                <h2>
                                                    <a href="package.html">Great Barrier Reef</a>
                                                </h2>
                                                <div class="review">
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    (0 Reviews)
                                                </div>
                                                <div class="element">
                                                    <div class="element-left">
                                                        <i class="fas fa-plane-departure"></i> Australia
                                                    </div>
                                                    <div class="element-right">
                                                        <i class="fas fa-calendar-alt date-icon"></i> 23 Sep, 2024
                                                    </div>
                                                </div>
                                                <div class="element">
                                                    <div class="element-left">
                                                        <i class="fas fa-users"></i> 12 Persons
                                                    </div>
                                                    <div class="element-right">
                                                        <i class="fas fa-clock"></i> 3 Days
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="item pb_25">
                                            <div class="photo">
                                                <a href="package.html"><img src="uploads/package-3.jpg" alt=""></a>
                                                <div class="wishlist">
                                                    <a href=""><i class="far fa-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="text">
                                                <div class="price">
                                                    $540
                                                </div>
                                                <h2>
                                                    <a href="package.html">Similan Islands, Andaman Sea</a>
                                                </h2>
                                                <div class="review">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    (34 Reviews)
                                                </div>
                                                <div class="element">
                                                    <div class="element-left">
                                                        <i class="fas fa-plane-departure"></i> Thailand
                                                    </div>
                                                    <div class="element-right">
                                                        <i class="fas fa-calendar-alt date-icon"></i> 20 Jul, 2024
                                                    </div>
                                                </div>
                                                <div class="element">
                                                    <div class="element-left">
                                                        <i class="fas fa-users"></i> 22 Persons
                                                    </div>
                                                    <div class="element-right">
                                                        <i class="fas fa-clock"></i> 5 Days
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="main-item mb_50">
                            <h2>
                                Information
                            </h2>
                            <div class="summary">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        @if($destination->country)
                                        <tr>
                                                <td><b>Country</b></td>
                                                <td>{{$destination->country}}</td>
                                            </tr>
                                        @endif
                                        
                                        @if($destination->visa_requirement)
                                            <tr>
                                                <td><b>Visa Requirements</b></td>
                                                <td>
                                                    {{ $destination->visa_requirement }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if($destination->language)
                                        <tr>
                                            <td><b>Languages Spoken</b></td>
                                            <td>{{ $destination->language }}</td>
                                        </tr>
                                        @endif
                                        @if($destination->currency)
                                        <tr>
                                            <td><b>Currency Used</b></td>
                                            <td>{{ $destination->currency }}</td>
                                        </tr>
                                        @endif
                                        @if($destination->best_time)
                                        <tr>
                                            <td><b>Best Time to Visit</b></td>
                                            <td>
                                                {{ $destination->best_time }}
                                            </td>
                                        </tr>
                                        @endif
                                        @if($destination->activity)
                                        <tr>
                                            <td><b>Activities</b></td>
                                            <td>
                                                {!! $destination->activity !!}
                                            </td>
                                        </tr>
                                        @endif
                                        @if($destination->health_safety)
                                        <tr>
                                            <td><b>Health and Safety</b></td>
                                            <td>
                                                {{ $destination->health_safety }}
                                            </td>
                                        </tr>
                                        @endif
                                        @if($destination->area)
                                        <tr>
                                            <td><b>Area (km2)</b></td>
                                            <td>
                                                {{ $destination->area }}
                                            </td>
                                        </tr>
                                        @endif
                                        @if($destination->time_zone)
                                        <tr>
                                            <td><b>Time Zone</b></td>
                                            <td>
                                                {{ $destination->time_zone }}
                                            </td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>


                        @if($destination_photos->count() > 0)
                        <div class="main-item mb_50">
                            <h2>
                                Photos
                            </h2>
                            <div class="photo-all">
                                <div class="row">
                                    @foreach($destination_photos as $destination_photo)
                                    <div class="col-md-6 col-lg-3">
                                        <div class="item">
                                            <a href="{{ asset('uploads/'.$destination_photo->photo) }}" class="magnific">
                                                <img src="{{ asset('uploads/'.$destination_photo->photo) }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($destination_videos->count() > 0)
                        <div class="main-item mb_50">
                            <h2>
                                Videos
                            </h2>
                            <div class="video-all">
                               <div class="row justify-content-center">
    
                                  @foreach($destination_videos as $destination_video)
                                  <div class="col-md-6 col-lg-6 d-flex justify-content-center mb-4">
                                      <div class="item">
                                          <iframe class="iframe1" 
                                                  width="550" 
                                                  height="350" 
                                                  src="https://www.youtube.com/embed/{{ $destination_video->video }}" 
                                                  title="YouTube video player" 
                                                  frameborder="0" 
                                                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                                  referrerpolicy="strict-origin-when-cross-origin" 
                                                  allowfullscreen>
                                          </iframe> 
                                      </div>
                                  </div>
                                  @endforeach

                                </div>
                            </div>
                        </div>
                        @endif

                        @if($destination->map)
                        <div class="main-item">
                            <h2>Map</h2>
                            <div class="location-map">
                                {!! $destination->map !!}           
                            </div>
                        </div>
                        @endif  
                    </div>
                </div>
            </div>
        </div>

@endsection
    
