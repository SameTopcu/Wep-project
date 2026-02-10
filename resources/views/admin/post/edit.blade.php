@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Edit Post</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_post_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
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
                                    
                                    <form action="{{ route('admin_post_edit_submit',$post->id) }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Existing Photo </label>
                                           <div><img src="{{ asset('uploads/'.$post->photo) }}" alt="" class="w_200"></div>
                                       </div>
                                       <div class="mb-3">
                                           <label class="form-label">Change Photo </label>
                                           <div><input type="file" name="photo" class="form-control"></div>
                                       </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Title *</label>
                                           <input
                                               type="text"
                                               class="form-control"
                                               name="title"
                                               value="{{ $post->title }}"
                                           >
                                       </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Slug*</label>
                                           <textarea
                                               name="slug"
                                               class="form-control"
                                               cols="30"
                                               rows="10"
                                           >{{ $post->slug }}</textarea>
                                       </div>
                                 
                                       <div class="mb-3">
                                            <label class="form-label">Description *</label>
                                           <textarea
                                               name="description"
                                               class="form-control h_100"
                                               cols="30"
                                               rows="10"
                                           >{{ $post->description }}</textarea>
                                           </textarea>
                                       </div>                                 
                                       <div class="mb-3">
                                           <label class="form-label">Short Description *</label>
                                           <textarea
                                               name="short_description"
                                               class="form-control h_100"
                                               cols="30"
                                               rows="10"
                                           >{{ $post->short_description }}</textarea>
                                       </div>
                                       <div class="mb-3">
                                           <label class="form-label">Blog Category *</label>
                                           <select name="blog_category_id" class="form-control">
                                               <option value="">Select Blog Category</option>
                                               @foreach ($blog_categories as $blog_category)
                                               <option value="{{ $blog_category->id }}">{{ $blog_category->name }}</option>
                                               @endforeach
                                           </select>
                                       </div>
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
