@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Edit Welcome Items</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_welcome_item_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
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
                                    
                                    <form action="{{ route('admin_welcome_item_update',$welcome_item->id) }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                 <label class="form-label">Existing Photo </label>
                                                 <div><img src="{{ asset('uploads/'.$welcome_item->photo) }}" alt="" class="w_300"></div>
                                            </div>
                                            <div class="mb-3">
                                                 <label class="form-label">Change Photo </label>
                                                 <div><input type="file" name="photo"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                 <label class="form-label">Existing Video (Youtube Video ID) </label>
                                                 <iframe class="iframe1" width="350" height="200" src="https://www.youtube.com/embed/{{ $welcome_item->video }}"
                                                  title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                  referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                                 </iframe>
                                                 
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                 <label class="form-label">Video (Youtube Video ID) </label>
                                                 <input
                                                 type="text"
                                                 class="form-control"
                                                 name="video"
                                                 value="{{ $welcome_item->video }}"
                                                 >
                                            </div>

                                        </div>
                                    </div>
                            
                                       <div class="mb-3">
                                           <label class="form-label">Heading *</label>
                                           <input
                                               type="text"
                                               class="form-control"
                                               name="heading"
                                               value="{{ $welcome_item->heading }}"
                                           >
                                       </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Text *</label>
                                           <textarea
                                               name="description"
                                               class="form-control h_100 editor"
                                               cols="30"
                                               rows="10"
                                           >{{ $welcome_item->description }}</textarea>
                                       </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Button Text *</label>
                                           <input
                                               type="text"
                                               class="form-control"
                                               name="button_text"
                                               value="{{$welcome_item->button_text}}"
                                           >
                                       </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Button Link *</label>
                                           <input
                                               type="text"
                                               class="form-control"
                                               name="button_link"
                                               value="{{ $welcome_item->button_link }}"
                                           >
                                       </div>

                                       <div class="mb-3">
                                           <label class="form-label">Status *</label>
                                           <select name="status" class="form-select">
                                               <option value="Show" {{ $welcome_item->status == 'Show' ? 'selected' : '' }}>Show</option>
                                               <option value="Hide" {{ $welcome_item->status == 'Hide' ? 'selected' : '' }}>Hide</option>
                                           </select>
                                       </div>
                                 
                                       <div class="mb-3">
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
