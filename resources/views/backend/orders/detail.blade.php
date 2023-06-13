@extends('backend.layouts.master')

@section('title', 'Orders Management')

@push('styles')

@endpush

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body position-relative p-0 rounded-card-top">
            <div class="bg-white text-dark text-center py-10 m-0 rounded-card-top">
                <h3> Transaction {{ $order->no_invoice }} {!! getStatusTrx($order->status) !!} </h3>
                
                @if($order->status == 2)
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
                        <div class="col-3 text-left px-5 font-weight-boldest">PIC/Owner</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-white py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5">Name</div>
                        <div class="col-3">{{ $order->pic_name }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-white py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5">Phone</div>
                        <div class="col-3">{{ $order->pic_phone }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Branding Name</div>
                        <div class="col-3">{{ $order->brand_name }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Requested Order</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    <div class="row bg-white py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5">Color</div>
                        <div class="col-3">{{ $order->color }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-white py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5">Size</div>
                        <div class="col-3">{{ $order->size }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-white py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5">Quantity</div>
                        <div class="col-3">{{ $order->quantity }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Other Request</div>
                        <div class="col-3">{{ $order->other }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Services Only</div>
                        <div class="col-3">{{ $order->only_services == true ? "Yes" : "No" }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Installment Payment</div>
                        <div class="col-3">{{ $order->installment == true ? "Yes" : "No" }}</div>
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
                            <img src="{{ asset("uploads/design/")."/".$order->design }}" alt="design" class="img-fluid" width="300">
                        </div>
                    </div>

                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Provement Payment</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    <div class="row bg-white py-5 font-weight-bold text-center">
                        @foreach ($payments as $payment)
                            <div class="col-6 text-left px-5">
                                <img src="{{ asset("uploads/payment/")."/".$payment->bukti }}" alt="design" class="img-fluid" width="300">
                            </div>
                        @endforeach
                    </div>
                    <div class="row bg-white py-5 font-weight-bold">
                        <form action="{{ route('admin.order.updatestatus', $order->id) }}" method="post">
                            @csrf
                            <div class="col-12 text-left px-5 font-weight-boldest mb-5">Approval</div>
                            <div class="col-12 px-5">
                                <div class="form-group">
                                    <label class="col-12">Status {!! required_icon() !!}</label>
                                    <select class="form-control select2 w-100" id="kt_select2_1" name="status" required>
                                        <option></option>
                                        <option value="3">Approved</option>
                                        <option value="2">Rejected</option>
                                        <option value="5">Done</option>
                                    </select>
                                </div>

                                <div id="form-note" style="display:none">
                                    <div class="form-group">
                                        <label> Note </label>
                                        <textarea id="form7" name="note" placeholder="Note" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Back to Orders</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset("assets/backend/js/pages/crud/forms/widgets/bootstrap-datepicker.js?v=7.0.5") }}"></script>
<script>
    $('.select2').select2({
        placeholder: "Select an option"
    });
    $('.select2-container').addClass('w-100');
</script>
@endpush
