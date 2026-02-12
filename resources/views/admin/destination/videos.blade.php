@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Video Gallery of {{$destination->name}}</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_destination_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
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
                                            <th>Video</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @if($destination_videos->count() > 0)
                                    @foreach($destination_videos as $destination_video)
                                    <tbody>
                                        <td>{{ $loop->iteration }}</td>
                                          <td>
                                            
                                            <iframe class="iframe1" width="350" height="200" src="https://www.youtube.com/embed/{{ $destination_video->video }}"
                                                  title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                  referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                            </iframe>                         
                                    
                                          </td>
                                        <td>
                                            <a href="{{ route('destination_video_delete',$destination_video->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tbody>
                                    @endforeach
                                    @else
                                    <tbody>
                                        <td colspan="3" class="text-center">No videos found</td>
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
                                    
                                    <form action="{{ route('destination_video_submit',$destination->id) }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Video (Youtube Video ID) *</label>
                                           <div><input type="text" name="video" class="form-control" value="{{ old('video') }}" placeholder="e.g. dQw4w9WgXcQ"></div>
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
