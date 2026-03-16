@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Edit Home Items</h1>
                    
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
                                   
                                   <form action="{{ route('admin_home_item_update') }}" method="post" enctype="multipart/form-data">
                                       @csrf                                    
                                       
                                       <div class="row">
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Destination Heading *</label>
                                               <input type="text" class="form-control" name="destination_heading" value="{{ old('destination_heading', $home_item->destination_heading) }}">
                                           </div>
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Destination Subheading *</label>
                                               <input type="text" class="form-control" name="destination_subheading" value="{{ old('destination_subheading', $home_item->destination_subheading) }}">
                                           </div>
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Destination Status *</label>
                                               <select name="destination_status" class="form-select">
                                                   <option value="Show" {{ ($home_item->destination_status ?? '') == 'Show' ? 'selected' : '' }}>Show</option>
                                                   <option value="Hide" {{ ($home_item->destination_status ?? '') == 'Hide' ? 'selected' : '' }}>Hide</option>
                                               </select>
                                           </div>
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Feature Status *</label>
                                               <select name="feature_status" class="form-select">
                                                   <option value="Show" {{ ($home_item->feature_status ?? '') == 'Show' ? 'selected' : '' }}>Show</option>
                                                   <option value="Hide" {{ ($home_item->feature_status ?? '') == 'Hide' ? 'selected' : '' }}>Hide</option>
                                               </select>
                                           </div>
                                       </div>

              
                                       <div class="row">
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Package Heading  *</label>
                                               <input type="text" class="form-control" name="package_heading" value="{{ old('package_heading', $home_item->package_heading) }}">
                                           </div>
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Package Subheading *</label>
                                               <input type="text" class="form-control" name="package_subheading" value="{{ old('package_subheading', $home_item->package_subheading) }}">
                                           </div>
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Package Status *</label>
                                               <select name="package_status" class="form-select">
                                                   <option value="Show" {{ ($home_item->package_status ?? '') == 'Show' ? 'selected' : '' }}>Show</option>
                                                   <option value="Hide" {{ ($home_item->package_status ?? '') == 'Hide' ? 'selected' : '' }}>Hide</option>
                                               </select>
                                           </div>
                                       </div>
              
                                       <div class="row">
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Testimonial Background</label>
                                               @if($home_item->testimonial_background)
                                               <div class="mb-2"><img src="{{ asset('uploads/'.$home_item->testimonial_background) }}" alt="" class="img-thumbnail" style="max-height: 80px;"></div>
                                               @endif
                                               <input type="file" class="form-control" name="testimonial_background" accept="image/*">
                                               <small class="text-muted">Leave empty to keep current image.</small>
                                           </div>
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Testimonial Heading *</label>
                                               <input type="text" class="form-control" name="testimonial_heading" value="{{ old('testimonial_heading', $home_item->testimonial_heading) }}">
                                           </div>
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Testimonial Subheading *</label>
                                               <input type="text" class="form-control" name="testimonial_subheading" value="{{ old('testimonial_subheading', $home_item->testimonial_subheading) }}">
                                           </div>
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Testimonial Status *</label>
                                               <select name="testimonial_status" class="form-select">
                                                   <option value="Show" {{ ($home_item->testimonial_status ?? '') == 'Show' ? 'selected' : '' }}>Show</option>
                                                   <option value="Hide" {{ ($home_item->testimonial_status ?? '') == 'Hide' ? 'selected' : '' }}>Hide</option>
                                               </select>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Blog Heading *</label>
                                               <input type="text" class="form-control" name="blog_heading" value="{{ old('blog_heading', $home_item->blog_heading) }}">
                                           </div>
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Blog Subheading *</label>
                                               <input type="text" class="form-control" name="blog_subheading" value="{{ old('blog_subheading', $home_item->blog_subheading) }}">
                                           </div>
                                           <div class="col-md-6 mb-3">
                                               <label class="form-label">Blog Status *</label>
                                               <select name="blog_status" class="form-select">
                                                   <option value="Show" {{ ($home_item->blog_status ?? '') == 'Show' ? 'selected' : '' }}>Show</option>
                                                   <option value="Hide" {{ ($home_item->blog_status ?? '') == 'Hide' ? 'selected' : '' }}>Hide</option>
                                               </select>
                                           </div>
                                           <div class="col-md-6 mb-3 d-flex align-items-end">
                                               <button type="submit" class="btn btn-primary w-100">Update</button>
                                           </div>
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
