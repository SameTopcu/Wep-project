@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Send Email to All Subscribers</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_subscribers') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
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
                                    
                                    <form action="{{ route('admin_subscribers_send_email_submit') }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                 
                                       
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Subject *</label>
                                           <input
                                               type="text"
                                               class="form-control"
                                               name="subject"
                                               value="{{ old('subject') }}"
                                           >
                                       </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Message *</label>
                                           <textarea
                                               name="message"
                                               class="form-control h_100"
                                               cols="30"
                                               rows="10"
                                           >{{ old('message') }}</textarea>
                                       </div>
                                 
                                       <div class="mb-3">
                                           <input type="submit" class="btn btn-primary" value="Send Email">
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
