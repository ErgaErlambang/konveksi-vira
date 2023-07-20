@extends('backend.layouts.master')

@section('title', 'Types Management')

@push('styles')

@endpush

@section('content')
<div class="container">
    <form action="{{ route('admin.types.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Types</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-8">
                    @include('backend.layouts.error')
                </div>

                <div class="form-group">
                    <label> Name {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="type name" name="name" value="{{ old('name') }}">
                </div>

                
                <div class="form-group">
                    <label> Dapat Terpakai pcs per kg{!! required_icon() !!} </label>
                    <input type="text" class="form-control" placeholder="type usable" name="usable" value="{{ old('usable') }}">
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

@endpush