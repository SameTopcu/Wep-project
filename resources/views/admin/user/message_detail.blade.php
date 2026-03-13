@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Message Detail - {{ $message->user->name ?? 'Unknown User' }}</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_message') }}" class="btn btn-primary"><i class="fas fa-list"></i> Back</a>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>All Messages</h4>
                                </div>
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

                                    @forelse($message_comments as $comment)
                                    @php
                                        if($comment->type == 'user'){
                                            $sender_data = App\Models\User::where('id', $comment->sender_id)->first();
                                        } else {
                                            $sender_data = App\Models\Admin::where('id', $comment->sender_id)->first();
                                        }
                                    @endphp
                                    <div class="message-item @if($comment->type == 'admin') message-item-admin-border @endif" style="background: {{ $comment->type == 'admin' ? '#e8f4fd' : '#f5f5f5' }}; padding: 15px; border-radius: 8px; margin-bottom: 15px; border-left: 4px solid {{ $comment->type == 'admin' ? '#6777ef' : '#ccc' }};">
                                        <div class="message-top d-flex align-items-center mb-2">
                                            <div class="left mr-3">
                                                <img src="{{ asset('uploads/'.($sender_data->photo ?? 'default.png')) }}" alt="" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
                                            </div>
                                            <div class="right">
                                                <h6 class="mb-0">{{ $sender_data->name ?? 'Unknown' }}</h6>
                                                <small class="text-muted">{{ $comment->type == 'user' ? 'User' : 'Admin' }}</small>
                                                <br>
                                                <small class="text-muted">{{ $comment->created_at ? $comment->created_at->format('Y-m-d H:i') : '' }}</small>
                                            </div>
                                        </div>
                                        <div class="message-bottom">
                                            <p class="mb-0">{!! $comment->comment !!}</p>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="alert alert-info">No messages yet.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Reply</h4>
                                </div>
                                <div class="card-body ">
                                    <form action="{{ route('admin_message_reply', $message->id) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <textarea name="comment" class="form-control" rows="12" placeholder="Write your reply here..." style="height: 300px;"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block mt-3">Send Reply</button>
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
