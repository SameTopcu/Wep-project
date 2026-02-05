@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Create Team Members</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_team_member_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
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
                                    
                                    <form action="{{ route('admin_team_member_create_submit') }}" method="post" enctype="multipart/form-data">
                                       @csrf

                                       <div class="mb-3">
                                               <label class="form-label">Photo *</label>
                                                <div><input type="file" name="photo" class="form-control"></div>
                                        </div>
                                       
                                       <div class="row">

                                         <div class="col-md-6">
                                            <div class="mb-3">
                                               <label class="form-label">Name *</label>
                                               <input
                                               type="text"
                                               class="form-control"
                                               name="name"
                                               value="{{ old('name') }}"
                                               >
                                           </div>
                                         </div>
                                         <div class="col-md-6">
                                            <div class="mb-3">
                                               <label class="form-label">Slug *</label>
                                               <input
                                               type="text"
                                               class="form-control"
                                               name="slug"
                                               value="{{ old('slug') }}"
                                               >
                                           </div>
                                         </div>

                                         <div class="col-md-6">
                                            <div class="mb-3">
                                              <label class="form-label">Designation *</label>
                                              <textarea
                                               class="form-control"
                                               name="designation"
                                               cols="30"
                                               rows="10"
                                               >{{ old('designation') }}</textarea>
                                            </div>
                                         </div>
                                                                                                                                            

                                       
                                            <div class="col-md-6">
                                              <div class="mb-3">
                                               <label class="form-label">Address *</label>
                                               <input
                                                 type="text"
                                                 class="form-control"
                                                 name="address"
                                                 value="{{ old('address') }}"
                                                 >
                                              </div>
                                           </div>
                                           <div class="col-md-6">
                                             <div class="mb-3">
                                               <label class="form-label">Email *</label>
                                                 <input
                                                   type="text"
                                                   class="form-control"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                  >
                                            </div>
                                           </div>
                                           <div class="col-md-6">
                                            <div class="mb-3">
                                             <label class="form-label">Phone *</label>
                                              <input
                                               type="text"
                                               class="form-control"
                                               name="phone"
                                               value="{{ old('phone') }}"
                                               >
                                           </div>
                                          </div>
                                       
                                       
                                       
                                       
                                       
                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label">Facebook *</label>
                                                  <input type="text" name="facebook" class="form-control" value="{{ old('facebook') }}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label">Twitter *</label>
                                                  <input type="text" name="twitter" class="form-control" value="{{ old('twitter') }}">
                                              </div>
                                          </div>
                                      
                                      
                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label">Linkedin *</label>
                                                  <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin') }}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label class="form-label">Instagram *</label>
                                                  <input type="text" name="instagram" class="form-control" value="{{ old('instagram') }}">
                                              </div>
                                          </div>
                                      </div>   
                                      
                                      <div class="mb-3">
                                           <label class="form-label">Biography *</label>
                                            <textarea
                                               name="biography"
                                               class="form-control editor"
                                               cols="30"
                                               rows="10"
                                        >{{ old('biography') }}</textarea>
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
