@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Subscribers</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_subscribers_send_email') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Send Email</a>
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
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="example1">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subscribers as $subscriber )
                                                
                                                
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    
                                                    <td>{{ $subscriber->email }}</td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{ route('admin_subscribers_delete',$subscriber->id) }}" class="btn btn-danger delete-confirm"><i class="fas fa-trash"></i></a>
                                                    </td>                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>



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
