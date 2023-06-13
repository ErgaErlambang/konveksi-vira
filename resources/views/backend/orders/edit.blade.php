@extends('backend.layouts.master')

@section('title', 'Orders Management')

@push('styles')

@endpush

@section('content')
<div class="container">
    <form action="{{ route('admin.order.update', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Edit Order</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-8">
                    @include('backend.layouts.error')
                </div>
                
                <div class="form-group">
                    <label> Brand name {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="Branding name" name="brand" value="{{ $order->data['brand'] }}">
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> PIC/Owner Name {!! required_icon() !!}</label>
                            <input type="text" class="form-control" placeholder="PIC name" name="name" value="{{ $order->data['name'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> PIC/Owner Phone {!! required_icon() !!}</label>
                            <input type="number" class="form-control" placeholder="PIC phone" name="phone" value="{{ $order->data['phone'] }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label> No. Article {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="Requested Article" name="article" value="{{ $order->data['article'] }}">
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Color {!! required_icon() !!}</label>
                            <input type="text" class="form-control" placeholder="Requested color" name="color" value="{{ $order->data['color'] }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Size {!! required_icon() !!}</label>
                            <input type="text" class="form-control" placeholder="Requested size" name="size" value="{{ $order->data['size'] }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Quantity {!! required_icon() !!}</label>
                            <input type="number" class="form-control" placeholder="Requested quantity" name="quantity" value="{{ $order->data['quantity'] }}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    @php
                        $img = isset($order->image) ? asset('uploads/order/'.$order->image) : asset('assets/img/placeholder.png');
                    @endphp
                    <label class="col-md-12"> Order Logo</label>
                    <div class="image-input image-input-empty image-input-outline ml-3" id="kt_image_5" style="background-image: url('{{ $img }}')">
                        <div class="image-input-wrapper"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Design">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="design" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="design_remove" />
                        </label>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Design">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Design">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <span class="form-text text-muted col-md-12 mt-4">Allowed file types: png, jpg, jpeg.</span>
                </div>


                <div class="form-group">
                    <label> Others </label>
                    <textarea id="form7" name="others" placeholder="Other request" class="form-control" rows="3">{{ $order->data['others'] ?? null }}</textarea>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Cancel</a>
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