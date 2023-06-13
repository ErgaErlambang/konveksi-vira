@extends('backend.layouts.master')

@section('title', 'Orders Management')

@push('styles')

@endpush

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body position-relative p-0 rounded-card-top">
            <div class="bg-white text-dark text-center py-10 m-0 rounded-card-top">
                <h3> Transaction {{ $order->data['name'] }} {!! getStatusTrx($order->status_id) !!} </h3>
                <p>{{ findStatus($order->status_id)->phase }}</p>
                
                @if($order->status_id == 2)
                    <div class="alert alert-custom alert-notice alert-light-danger fade show mx-10" role="alert">
                        <div class="alert-icon"><i class="flaticon-cancel"></i></div>
                        <div class="alert-text">{{ $order->note }}</div>
                    </div>
                @endif

                <div class="form-group mb-8">
                    @include('backend.layouts.error')
                </div>
            </div>

            <div class="row justify-content-center mx-0 mb-15 d-lg-flex mt-5">
                <div class="col-11">
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">No. Article</div>
                        <div class="col-3">{{ $order->data['article'] }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Detail Clothes {{ Request::get('key') }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-white py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5">Color</div>
                        <div class="col-3">{{ $order->data['color'] }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-white py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5">Size</div>
                        <div class="col-3">{{ $order->data['size'] }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-white py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5">Dress Order</div>
                        <div class="col-3">{{ Request::get('key') }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Other Request</div>
                        <div class="col-3">{{ $order->data['others'] }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Design</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    <div class="row bg-white py-5 font-weight-bold text-center">
                        <div class="col-12 text-left px-5">
                            <img src="{{ asset("uploads/design/")."/".$order->image }}" alt="design" class="img-fluid" width="300">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
