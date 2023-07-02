@extends('backend.layouts.master')

@section('title', 'Project Management')

@push('styles')
<link href="{{asset('assets/backend/plugins/custom/datatables/datatables.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Material Management</h3>
            </div>
            <div class="card-toolbar">
                <div class="dropdown dropdown-inline mr-2">
                    <a href="{{ route('admin.material.create') }}" class="btn btn-primary font-weight-bolder"><i class="la la-plus"></i>New Record</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('backend.layouts.error')
            <table class="table table-separate table-head-custom" id="kt_datatable_2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $key => $material)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $material->name }}</td>
                            <td>{{ $material->type->name }}</td>
                            <td>{{ $material->stock }}</td>
                            <td class="text-center mx-auto">
                                <div class="row p-2">
                                    <a href="{{ route('admin.material.edit', $material->id) }}" class="btn btn-link btn-sm btn-info btn-just-icon like mr-1" style="display: block; margin-block-end: 1.5em;">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.material.destroy', $material->id) }}" class="form-delete" method="POST">
                                        @csrf
                                        <button id="delete-btn" type="submit" class="btn btn-link btn-sm btn-danger btn-just-icon remove " name="delete_modal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('backend.layouts.modal')
<script src="{{asset('assets/backend/plugins/custom/datatables/datatables.bundle.js?v=7.0.5')}}"></script>
<script>
    $(document).ready(function() {
        $('#kt_datatable_2').DataTable({
            responsive:true,
            lengthMenu: [5, 10, 25, 50],
        });
    } );
</script>
<script>
    $('.form-delete').on('click', function (e) {
        e.preventDefault();
        var $form = $(this);
        $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        }).on('click', '#delete-btn', function () {
            $form.submit();
        });
    });
</script>

@endpush