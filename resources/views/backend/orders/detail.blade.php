@extends('backend.layouts.master')

@section('title', 'Orders Management')

@push('styles')

@endpush

@section('content')
@php
    $role = getRoleId();
@endphp
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
                        <div class="col-3 text-left px-5">Nama</div>
                        <div class="col-3">{{ $order->pic_name }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-white py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5">Telepon</div>
                        <div class="col-3">{{ $order->pic_phone }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Nama Brand</div>
                        <div class="col-3">{{ $order->brand_name }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Order yang diminta</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    @foreach ($order->details as $key => $item)
                        <div class="row bg-white py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5">Warna</div>
                            <div class="col-3">{{ $item->color }}</div>
                            <div class="col-3"></div>
                            <div class="col-3"></div>
                        </div>
                        <div class="row bg-white py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5">Ukuran</div>
                            <div class="col-3">{{ $item->size }}</div>
                            <div class="col-3"></div>
                            <div class="col-3"></div>
                        </div>
                        <div class="row bg-white py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5">Kuantitas</div>
                            <div class="col-3">{{ $item->quantity }}</div>
                            <div class="col-3"></div>
                            <div class="col-3"></div>
                        </div>
                        @if (!$loop->last)
                            <hr>
                        @endif
                    @endforeach

                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Bahan yang dibutuhkan</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    @if(count($order->materials) == 0)
                        <div class="row bg-white py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5 text-muted">Menunggu persetujuan</div>
                            <div class="col-3"></div>
                            <div class="col-3"></div>
                            <div class="col-3"></div>
                        </div>
                    @else
                        @foreach ($order->materials as $key => $item)
                            <div class="row bg-white py-5 font-weight-bold text-center">
                                <div class="col-3 text-left px-5">Bahan</div>
                                <div class="col-3">{{ $item->material->name }}</div>
                                <div class="col-3"></div>
                                <div class="col-3"></div>
                            </div>
                            <div class="row bg-white py-5 font-weight-bold text-center">
                                <div class="col-3 text-left px-5">Dibutuhkan</div>
                                <div class="col-3">{{ $item->used }}</div>
                                <div class="col-3"></div>
                                <div class="col-3"></div>
                            </div>
                            @if (!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    @endif


                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Order lainnya</div>
                        <div class="col-3">{{ $order->other ?? "-" }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Harga</div>
                        <div class="col-3">{!! $order->price == null ? "<span class='text-muted'>Menunggu keputusan</span>" : "Rp ".cRupiah($order->price) !!}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Hanya Jasa</div>
                        <div class="col-3">{{ $order->only_services == true ? "Yes" : "No" }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Pembayaran Installment/DP</div>
                        <div class="col-3">{{ $order->installment == true ? "Yes" : "No" }}</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                        <div class="col-3 text-left px-5 font-weight-boldest">Design Baju</div>
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
                        <div class="col-3 text-left px-5 font-weight-boldest">Bukti Pembayaran</div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    <div class="row bg-white py-5 font-weight-bold text-center">
                        @if(count($payments) > 0)
                            @foreach ($payments as $payment)
                                <div class="col-6 text-left px-5">
                                    <img src="{{ asset("uploads/bukti/")."/".$payment->bukti }}" alt="bukti" class="img-fluid" width="300">
                                </div>
                            @endforeach
                            @if($role == 6)
                                @if($order->status == 9 || $order->status == 4)
                                    <div class="col-12 mt-5">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#paymentModal"> Unggah Bukti Pembayaran </button>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="col-12">
                                <p class="text-muted">Belum ada bukti pembayaran yang diunggah.</p>
                                @if($role == 6)
                                    @if($order->status == 9 || $order->status == 4)
                                        <div class="col-12 mt-5">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#paymentModal"> Unggah Bukti Pembayaran </button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        @endif
                    </div>
                    @if($role !== 6)
                        <div class="row bg-white py-5 font-weight-bold">
                            <form action="{{ route('admin.order.updatestatus', $order->id) }}" method="post">
                                @csrf
                                <div class="col-12 text-left px-5 font-weight-boldest mb-5">Approval</div>
                                <div class="col-12 px-5">
                                    <div class="form-group">
                                        <label class="col-12">Status {!! required_icon() !!}</label>
                                        @if($role == 2 && $order->status == 6)
                                            <p class="text-muted">Anda sudah merubah status ini</p>
                                        @elseif($role == 3 && $order->status == 7)
                                            <p class="text-muted">Anda sudah merubah status ini</p>
                                        @elseif($role == 4 && $order->status == 9)
                                            <p class="text-muted">Anda sudah merubah status ini</p>
                                        @elseif($role == 5 && $order->status == 8)
                                            <p class="text-muted">Anda sudah merubah status ini</p>
                                        @else
                                            <select class="form-control select2 w-100" id="kt_select2_1" name="status" required>
                                                <option></option>
                                                @if($role == 2)
                                                    <option value="6">Approved</option>
                                                    <option value="5">Done</option>
                                                @elseif($role == 3)
                                                    <option value="7">Approved</option>
                                                @elseif($role == 4)
                                                    <option value="9">Approved</option>
                                                @elseif($role == 5)
                                                    <option value="8">Approved</option>
                                                @else
                                                    <option value="1">Pending</option>
                                                    <option value="2">Reject</option>
                                                    <option value="3">Approve Orders</option>
                                                    <option value="4">Paid</option>
                                                    <option value="5">Done</option>
                                                    <option value="6">Approve Admin</option>
                                                    <option value="7">Approve Production</option>
                                                    <option value="8">Approve Material</option>
                                                    <option value="9">Approve Owners</option>
                                                @endif
                                            </select>
                                        @endif

                                    </div>
                                    @if($role == 3)
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                Bahan yang dibutuhkan
                                            </div>
                                            <div class="card-body">
                                                @if($order->status > 7)
                                                <div class="getOR">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label>Bahan {!! required_icon() !!}</label>
                                                                <select class="form-control select2 regis0" id="material0" name="materials[]" required>
                                                                    <option value="" disabled selected></option>
                                                                    @foreach ($materials as $material)
                                                                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                                                                    @endforeach
                                                                    <option value="others">Bahan Lainnya</option>
                                                                </select>
                                                                <input type="text" class="form-control mt-2 d-none" id="other_material0" placeholder="Input other materials" name="other_materials[]" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label> Dibutuhkan {!! required_icon() !!}</label>
                                                                <input type="number" class="form-control" placeholder="quantity" id="quantity0" name="quantity[]" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 mt-5 pt-3">
                                                            <button type="button" class="btn btn-icon btn-primary btn-hover-primary shadow-sm btn-sm btn-add-or">
                                                                <i class="ki ki-plus icon-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                    <div class="text-center">
                                                        <p class="text-muted">Bahan telah dipilih.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif


                                    <div id="form-note" style="display:none">
                                        <div class="form-group">
                                            <label> Note </label>
                                            <textarea id="form7" name="note" placeholder="Note" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>

                                    @if($role == 5 && $order->status == 7)
                                        <div class="form-group">
                                            <label> Harga {!! required_icon() !!} </label>
                                            <input type="number" class="form-control" value="" placeholder="Price" name="price" required>
                                        </div>
                                    @endif
                                </div>

                                @if($role == 3 && $order->status == 7)
                                @elseif($role == 4 && $order->status == 9)
                                @elseif($role == 5 && $order->status == 8)
                                @else
                                    <button type="submit" class="btn btn-success">Update</button>
                                @endif


                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Back to Orders</a>
                @if(count($payments) > 0)
                    <a href="{{ route('admin.order.invoice', $order->no_invoice) }}" target="_blank" class="btn btn-light-primary font-weight-bold"> Invoice </a>
                @else
                    <span class="d-inline-block" data-toggle="tooltip" title="Pembayaran belum diterima">
                        <button class="btn btn-light-primary font-weight-bold" style="pointer-events: none;" type="button" disabled>Invoice</button>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.order.payment', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentTitle">Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $price = 0;
                        if($order->installment == 1) {
                            if(count($payments) == 0) {
                                $price = $order->price * 70 / 100;
                                $text = "DP";
                            }else {
                                $price = $order->price * 30 / 100;
                                $text = "Tersisa";
                            }
                        }else {
                            $price = $order->price;
                            $text = "Full Payment";
                        }
                    @endphp
                    <p class="text-small">
                        Terima kasih telah melakukan Transaksi di tclothbandung, silahkan unggah bukti pembayaran Anda 
                        dengan nominal <span class="text-danger">Rp {{ cRupiah($price) }} {{ $text }}  </span>
                    </p>
                    <hr>
                    <input type="hidden" name="nominal" value="{{ $price }}">
                    <div class="form-group row mt-5">
                        <label class="col-md-12"> Bukti Pembayaran</label>
                        <div class="image-input image-input-empty image-input-outline ml-3" id="kt_image_5" style="background-image: url('{{ asset('assets/backend/img/placeholder.png') }}')">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Pilih Gambar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="bukti_pembayaran" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="bukti_pembayaran_remove" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Batalkan">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Buang">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted col-md-12 mt-4">Allowed file types: png, jpg, jpeg.</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Kembali</button>
                    <button  class="btn btn-primary font-weight-bold">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset("assets/backend/js/pages/crud/forms/widgets/bootstrap-datepicker.js?v=7.0.5") }}"></script>
<script src="{{ asset('assets/backend/js/pages/crud/file-upload/image-input.js?v=7.0.5') }}"></script>
<script>
    var avatar5 = new KTImageInput('kt_image_5');
</script>
<script>
    function quantity($el) {
        $el.on('input', function (e, state) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
            if(e.originalEvent === undefined){
                return
            };
        });
    }
</script>
<script>
    select2refresh($('.select2'));
    quantity($('#quantity0'));
    
    $('.select2-container').addClass('w-100');
</script>


<script>
    $(document).ready(function() {
        select2refresh($('.select2'));

        // If selected "others", show freetext
        $('#material0').change(function() {
            if($(this).find(':selected').val() == 'others') {
                $("#other_material0").removeClass('d-none');
                $("#other_material0").show();
            }else {
                $("#other_material0").removeAttr('required');
                $("#other_material0").hide();
            }
        });
    });
</script>

<script>
    $('.btn-add-or').click(function() {
        var container = $('.getOR');
        let length = container.find('.row').length;
        console.log(length);
        $.ajax({
            type: "GET",
            url : "{{ route('admin.material.get') }}",
            success: function (response) {
                let res = response.data,
                    option = "";
                option += '<option value="" disabled selected></option>';
                for(var i in res) {
                    option += '<option value="' +res[i].id+ '">' +res[i].name+'</option>';
                }
                option += '<option value="others">Bahan Lainnya</option>';
                container.append(
                    `<div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Bahan {!! required_icon() !!}</label>
                                <select class="form-control select2 regis`+length+`" id="material`+length+`" name="materials[]" required>
                                    `+option+`
                                </select>
                                <input type="text" class="form-control mt-2 d-none" id="other_material`+length+`" placeholder="Input other materials" name="other_materials[]" value="" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label> Dibutuhkan {!! required_icon() !!}</label>
                                <input type="number" class="form-control" placeholder="quantity" id="quantity`+length+`" name="quantity[]" value="" required>
                            </div>
                        </div>
                        <div class="col-md-2 mt-5 pt-3">
                            <button type="button" class="btn btn-icon btn-danger btn-hover-danger shadow-sm btn-sm" id="btn-del-or">
                                <i class="ki ki-bold-close icon-sm"></i>
                            </button>
                        </div>
                    </div>`
                );
                // If selected "others", show freetext
                $('#material'+length).change(function() {
                    if($(this).find(':selected').val() == 'others') {
                        $("#other_material"+length).removeClass('d-none');
                        $("#other_material"+length).show();
                    }else {
                        $("#other_material"+length).removeAttr('required');
                        $("#other_material"+length).hide();
                    }
                });
                quantity($('#quantity'+length));
                select2refresh($('#material'+length));
            }
        })

        $("body").on("click","#btn-del-or",function(){
            $(this).closest('.getOR .row').remove();
            select2refresh($('#material'+length));
        }); 
    })

    $(document).ready(function() {
        select2refresh($('.select2'));
    }) 

</script>
@endpush
