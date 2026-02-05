@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Edit Testimonials</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_testimonial_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
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
                                    
                                    <form action="{{ route('admin_testimonial_edit_submit',$testimonial->id) }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Existing Photo </label>
                                           <div><img src="{{ asset('uploads/'.$testimonial->photo) }}" alt="" class="w_200"></div>
                                       </div>
                                       <div class="mb-3">
                                           <label class="form-label">Change Photo </label>
                                           <div><input type="file" name="photo" class="form-control"></div>
                                       </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Name *</label>
                                           <input
                                               type="text"
                                               class="form-control"
                                               name="name"
                                               value="{{ $testimonial->name }}"
                                           >
                                       </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Designation *</label>
                                           <textarea
                                               name="designation"
                                               class="form-control"
                                               cols="30"
                                               rows="10"
                                           >{{ $testimonial->designation }}</textarea>
                                       </div>
                                 
                                       <div class="mb-3">
                                            <label class="form-label">Comment *</label>
                                           <textarea
                                               name="comment"
                                               class="form-control h_100"
                                               cols="30"
                                               rows="10"
                                           >{{ $testimonial->comment }}</textarea>
                                           </textarea>
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
