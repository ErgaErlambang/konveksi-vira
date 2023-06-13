@extends('backend.layouts.master')

@section('title', 'User Management')

@push('styles')
    <style>
        .show-password {
            background-color: #F3F6F9;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Update User</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-8">
                    @include('backend.layouts.error')
                </div>
                

                <div class="form-group">
                    <label> Email {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="User Email" name="email" value="{{ $user->email }}">
                </div>
                
                <div class="form-group">
                    <label> Name {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="User Name" name="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label>Password {!! required_icon() !!}</label>
                    <div class="input-icon input-icon-right">
                        <input type="password" class="form-control" placeholder="password" name="password"/>
                        <span>
                            <a href="javascript:;" class="password">
                                <i class="flaticon-eye icon-md icon-show"></i>
                                <i class="ki ki-hide icon-md icon-showed" style="display: none;"></i>
                            </a>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-right">Role {!! required_icon() !!}</label>
                    <select class="form-control select2" id="kt_select2_1" name="role" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->getRoleId() == $role->id ? 'selected' : '' }}>{{ $role->name }}</option> 
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Cancel</a>
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