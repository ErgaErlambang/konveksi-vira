@extends('backend.layouts.master')

@section('title', 'Orders Management')

@push('styles')
<link href="{{asset('assets/backend/plugins/custom/datatables/datatables.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Pending Orders</h3>
            </div>
            <div class="card-toolbar">
                @if(getRoleId() == 1 || getRoleId() == 2 || getRoleId() == 6)
                    <div class="dropdown dropdown-inline mr-2">
                        <a href="{{ route('admin.order.create') }}" class="btn btn-primary font-weight-bolder"><i class="la la-plus"></i>New Order</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            @include('backend.layouts.error')
            <table class="table table-separate table-head-custom" id="kt_datatable_2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Owner</th>
                        <th>Brand</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $order->pic_name }}</td>
                            <td>{{ $order->brand_name }}</td>
                            <td>{!! getStatusTrx($order->status) !!}</td>
                            <td>{{ $order->created_at }}</td>
                            <td class="text-center mx-auto">
                                <div class="row p-2">
                                    <a href="{{ route('admin.order.detail', $order->id) }}" class="btn btn-link btn-sm btn-primary btn-just-icon like mr-1">
                                        <i class="fas fa-search"></i>
                                    </a>
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
        $('#kt_datatable_21').DataTable({
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