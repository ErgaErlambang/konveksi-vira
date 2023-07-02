@extends('backend.layouts.master')

@section('title', 'Material Management')

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
    <form action="{{ route('admin.material.update', $material->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Perbarui Bahan Baku</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-8">
                    @include('backend.layouts.error')
                </div>

                <div class="form-group">
                    <label> Nama {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="Material name" name="name" value="{{ $material->name }}">
                </div>

                <div class="form-group">
                    <label class="col-form-label text-right">Tipe {!! required_icon() !!}</label>
                    <select class="form-control select2" id="kt_select2_1" name="type" required>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ $material->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option> 
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label> Stock {!! required_icon() !!}</label>
                    <input type="number" class="form-control" placeholder="Material stock" name="stock" value="{{ $material->stock }}">
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.material.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    var avatar5 = new KTImageInput('kt_image_5');
</script>
<script>
    $('.select2').select2({
        placeholder: "Select an option"
    });
</script>
@endpush