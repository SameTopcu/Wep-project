@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Edit Tours</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_tour_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
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
                                    
                                    <form action="{{ route('admin_tour_edit_submit',$tour->id) }}" method="post">
                                       @csrf
                                       <div class="row">
                                           <div class="col-4">
                                               <div class="mb-3">
                                                   <label class="form-label">Select Package *</label>
                                                   <select name="package_id" class="form-control" required>
                                                       <option value="" disabled></option>
                                                       @foreach ($packages as $package)
                                                       <option value="{{ $package->id }}" {{ old('package_id', $tour->package_id) == $package->id ? 'selected' : '' }}>{{ $package->name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-4">
                                               <div class="mb-3">
                                                   <label class="form-label">Tour Start Date *</label>
                                                   <input type="date" name="tour_start_date" class="form-control" value="{{ old('tour_start_date', $tour->tour_start_date) }}">
                                               </div>
                                           </div>
                                           <div class="col-4">
                                               <div class="mb-3">
                                                   <label class="form-label">End Date *</label>
                                                   <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $tour->end_date) }}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-4">
                                               <div class="mb-3">
                                                   <label class="form-label">Booking End Date *</label>
                                                   <input type="date" name="booking_end_date" class="form-control" value="{{ old('booking_end_date', $tour->booking_end_date) }}">
                                               </div>
                                           </div>
                                           <div class="col-4">
                                               <div class="mb-3">
                                                   <label class="form-label">Tour Total Seat *</label>
                                                   <input type="number" name="tour_total_seat" class="form-control" value="{{ old('tour_total_seat', $tour->tour_total_seat) }}">
                                               </div>
                                           </div>
                                           <div class="col-4 d-flex align-items-end">
                                               <div class="mb-3">
                                                   <button type="submit" class="btn btn-primary">
                                                       Update
                                                   </button>
                                               </div>
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
