@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Edit Faqs</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_faq_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
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
                                    
                                    <form action="{{ route('admin_faq_edit_submit',$faq->id) }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Question *</label>
                                           <div><input type="text" name="question" class="form-control" value="{{ $faq->question }}"></div>
                                       </div>
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Answer *</label>
                                           <textarea
                                               name="answer"
                                               class="form-control h_100"
                                               cols="30"
                                               rows="10"
                                            >{{ $faq->answer }}</textarea>
                                       </div>
                                 
                                       <div class="mb-3">
                                           <button type="submit" class="btn btn-primary">
                                               Update
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
