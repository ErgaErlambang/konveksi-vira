@extends('backend.layouts.master')

@section('title', 'Orders Management')

@push('styles')

@endpush

@section('content')
<div class="container">
    <div class="card card-custom overflow-hidden">
        <div class="card-body p-0">
            <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                <div class="col-md-9">
                    <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                        <h1 class="display-4 font-weight-boldest mb-10">Invoice</h1>
                        <div class="d-flex flex-column align-items-md-end px-0">
                            <a href="#" class="mb-5 display-4 font-weight-boldest text-dark">
                                Konveksi
                                {{-- <img src="{{ asset('assets/backend/media/logos/logo-dark.png') }}" alt="" /> --}}
                            </a>
                            <span class="d-flex flex-column align-items-md-end opacity-70">
                                <span>Jl. cibangkong</span>
                                <span>Kota Bandung, Jawa Barat 14045</span>
                                <span>0812-3456-9998</span>
                            </span>
                        </div>
                    </div>
                    <div class="border-bottom w-100"></div>
                    <div class="d-flex justify-content-between pt-6">
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">TANGGAL</span>
                            <span class="opacity-70">{{ $transaction->created_at->format("d F Y") }}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">INVOICE NO.</span>
                            <span class="opacity-70">{{ $transaction->no_invoice }}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">INVOICE KEPADA.</span>
                            <span class="opacity-70">{{ $transaction->pic_name }}
                                <br />{{ $transaction->pic_phone }}</span>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pl-0 font-weight-bold text-muted text-uppercase">Nama Barang</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">Quantity</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-weight-boldest">
                                    <td class="pl-0 pt-7">{{ $transaction->brand_name }}</td>
                                    <td class="text-right pt-7">{{ array_sum(array_column($transaction->details->toArray(), 'quantity')) }}</td>
                                    <td class="text-danger pr-0 pt-7 text-right">IDR {{ cRupiah($transaction->price) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold text-muted text-uppercase">TOTAL AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-weight-bolder">
                                    <td class="text-danger font-size-h3 font-weight-boldest">IDR {{ cRupiah($transaction->price * array_sum(array_column($transaction->details->toArray(), 'quantity'))) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                <div class="col-md-9">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                            onclick="window.print();">Download Invoice</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
