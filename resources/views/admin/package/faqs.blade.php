@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>FAQ of {{$package->name}}</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_package_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="table-responsive">
                                <h4>FAQ List</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @if($package_faqs->count() > 0)
                                    @foreach($package_faqs as $package_faq)
                                    <tbody>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $package_faq->question }}</td>
                                        <td>{{ $package_faq->answer }}</td>
                                        <td>
                                            <a href="{{ route('admin_package_faqs_delete',$package_faq->id) }}" class="btn btn-danger btn-sm delete-confirm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tbody>
                                    @endforeach
                                    @else
                                    <tbody>
                                        <tr><td colspan="4" class="text-center">No faqs found</td></tr>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <h4>Add FAQ</h4>
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
                                    
                                    <form action="{{ route('admin_package_faqs_submit', $package->id) }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                 
                                       <div class="mb-3">
                                           <label class="form-label">Question *</label>
                                           <input type="text" name="question" class="form-control" value="{{ old('question') }}">
                                        </div>
                                       <div class="mb-3">
                                           <label class="form-label">Answer *</label>
                                           <textarea name="answer" class="form-control h_100" cols="30" rows="10">{{ old('answer') }}</textarea>
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
