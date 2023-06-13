@extends('backend.layouts.master')

@section('title', 'Material Management')

@push('styles')

@endpush

@section('content')
<div class="container">
    <form action="{{ route('admin.material.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Material Testimoni</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-8">
                    @include('backend.layouts.error')
                </div>

                <div class="form-group">
                    <label> Name {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="Material name" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label> Type {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="Material type" name="type" value="{{ old('type') }}">
                </div>
                
                <div class="form-group">
                    <label> Stock {!! required_icon() !!}</label>
                    <input type="number" class="form-control" placeholder="Material stock" name="stock" value="{{ old('stock') }}">
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

@endpush