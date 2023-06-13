@extends('backend.layouts.master')

@section('title', 'Roles Management')

@push('styles')
    <style>
        .show-password {
            background-color: #F3F6F9;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Update Role {{ $role->name }}</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-8">
                    @include('backend.layouts.error')
                </div>

                <div class="form-group mb-4">
                    <div class="alert alert-custom alert-outline-2x alert-outline-warning fade show mb-5" role="alert">
                        <div class="alert-icon">
                            <i class="flaticon-warning"></i>
                        </div>
                        <div class="alert-text">
                            <strong>
                                Do NOT edit the role unless you have a permission!
                            </strong>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label> Name {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="Role Name" name="name" value="{{ $role->name }}">
                </div>


            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script>
        $('.select2').select2({
            placeholder: "Select an option"
        });
    </script>
    <script>
        $(function() {
            $('.password').click(function() {
                if($('input[name="password"]').attr('type') !== "password") {
                    $('input[name="password"]').attr('type', 'password');
                    $(".icon-show").show()
                    $(".icon-showed").hide()
                }else {
                    $('input[name="password"]').attr('type', 'text');
                    $(".icon-show").hide()
                    $(".icon-showed").show()
                }
            });
        });
    </script>
@endpush