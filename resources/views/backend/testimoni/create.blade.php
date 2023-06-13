@extends('backend.layouts.master')

@section('title', 'Testimonial Management')

@push('styles')
    <style>
        .image-input .image-input-wrapper {
            width: 240px;
            height: 212px;
            border-radius: 0.42rem;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <form action="{{ route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Create Testimoni</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-8">
                    @include('backend.layouts.error')
                </div>

                <div class="form-group row">
                    <label class="col-md-12"> Image {!! required_icon() !!}</label>
                    <div class="image-input image-input-empty image-input-outline ml-3" id="kt_image_5" style="background-image: url('{{ asset('assets/backend/img/placeholder.png') }}')">
                        <div class="image-input-wrapper"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change image">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="image_remove" />
                        </label>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel image">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove image">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <span class="form-text text-muted col-md-12 mt-4">Allowed file types: png, jpg, jpeg.</span>
                </div>

            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    var avatar5 = new KTImageInput('kt_image_5');
</script>
<script src="{{ asset('assets/backend/js/pages/crud/file-upload/image-input.js?v=7.0.5') }}"></script>
@endpush