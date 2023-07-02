@extends('backend.layouts.master')

@section('title', 'Type Management')

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
    <form action="{{ route('admin.types.update', $material->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Edit Types</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-8">
                    @include('backend.layouts.error')
                </div>

                <div class="form-group">
                    <label> Name {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="type name" name="name" value="{{ $material->name }}">
                </div>

            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.types.index') }}" class="btn btn-secondary">Cancel</a>
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