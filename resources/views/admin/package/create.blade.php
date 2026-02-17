@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

        <div class="main-content">
            <section class="section">
                <div class="section-header justify-content-between">
                    <h1>Create Packages</h1>
                    <div class="ml-auto">
                        <a href="{{ route('admin_package_index') }}" class="btn btn-primary"><i class="fas fa-list"></i> View All</a>
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
                                    
                                    <form action="{{ route('admin_package_create_submit') }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                 
                                       <div class="row">
                                          <div class="mb-3 col-6">
                                            <label class="form-label">Featured Photo *</label>
                                            <div><input type="file" name="featured_photo" class="form-control"></div>
                                          </div>
                                          <div class="mb-3 col-6">
                                            <label class="form-label">Banner Photo *</label>
                                            <div><input type="file" name="banner" class="form-control"></div>
                                          </div>
                                       </div>
                                        <div class="row ">
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Name *</label>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                                </div>
                                            </div>    
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug *</label>
                                                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Map* (Google Map Link-İframe)</label>
                                                    <textarea name="map" class="form-control" rows="10">{{ old('map') }}</textarea>
                                                </div>
                                            </div>
                                                               
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Destination*</label>
                                                    <select name="destination_id" id="destination_id" class="form-control select2-destination" required>
                                                        <option value=""></option>
                                                        @foreach($destinations as $destination)
                                                        <option value="{{ $destination->id }}"@if(old('destination_id') == $destination->id) selected @endif>{{ $destination->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Price*</label>
                                                    <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Old Price*</label>
                                                    <input type="text" name="old_price" class="form-control" value="{{ old('old_price') }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Description*</label>
                                                    <textarea name="description" class="form-control editor" rows="10">{{ old('description') }}</textarea>
                                                </div>
                                            </div>
                                            
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

@push('styles')
<style>
    /* Select2 destination – Name/Slug/Price ile aynı hiza ve yükseklik (Bootstrap form-control) */
    .select2-destination + .select2-container {
        width: 100% !important;
        display: block;
    }
    .select2-destination + .select2-container .select2-selection--single {
        border-radius: 0.25rem !important;
        border: 1px solid #ced4da;
        height: calc(1.5em + 0.75rem + 2px) !important;
        min-height: unset !important;
        padding-left: 0.75rem;
        padding-right: 2rem !important; /* ok imleci için alan */
        overflow: hidden !important;
    }
    .select2-destination + .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 0;
        line-height: calc(1.5em + 0.75rem) !important;
    }
    /* Ok imleci – sağda sabit, çarpı ile çakışmasın; fazla imleç (artifact) çıkmasın */
    .select2-destination + .select2-container .select2-selection--single .select2-selection__arrow {
        right: 0 !important;
        width: 28px !important;
        height: 100% !important;
        overflow: hidden !important;
    }
    .select2-destination + .select2-container .select2-selection--single .select2-selection__arrow b {
        border-color: #6c757d transparent transparent transparent;
        border-width: 6px 5px 0 5px;
        margin-left: -5px;
        margin-top: -3px;
    }
    /* Açıkken yukarı dönen ok – sağ üstte artefakt oluşmasın */
    .select2-destination + .select2-container.select2-container--open .select2-selection__arrow b {
        border-color: transparent transparent #6c757d transparent;
        border-width: 0 5px 6px 5px;
        margin-top: -6px;
    }
    /* Clear butonu tamamen gizle (allowClear: false ile birlikte, ekstra güvence) */
    .select2-destination + .select2-container .select2-selection--single .select2-selection__clear {
        display: none !important;
    }
    /* Açılan dropdown kutusu (ızgara barlar – mevcut tasarım korunuyor) */
    .select2-container--open .select2-dropdown--below {
        border-radius: 15px !important;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        margin-top: 6px !important;
    }
    .select2-dropdown {
        border-radius: 15px !important;
    }
    .select2-results__option {
        padding: 8px 12px;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        border-radius:15px !important;
        background-color: #6777ef;
        color: #fff;
    }
    /* Izgara bardan search kutusunu kaldır (dropdown body'de olduğu için genel seçici) */
    .select2-container--default .select2-search--dropdown {
        display: none !important;
    }
    .select2-container--default .select2-results > .select2-results__options {
        max-height: 200px;
    }
</style>
@endpush

@push('scripts')
<script>
$(function() {
    $('.select2-destination').select2({
        placeholder: '',
        allowClear: false,
        width: '100%',
        minimumResultsForSearch: Infinity   /* ızgara barda search kutusu çıkmasın */
    });
});
</script>
@endpush
@endsection
