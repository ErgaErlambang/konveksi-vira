@extends('backend.layouts.master')

@section('title', 'Orders Management')

@push('styles')
    <style>
        .show-password {
            background-color: #F3F6F9;
        }
        .image-input .image-input-wrapper {
            width: 240px;
            height: 212px;
            border-radius: 0.42rem;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <form action="{{ route('admin.order.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Create Order</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-8">
                    @include('backend.layouts.error')
                </div>
                
                <div class="form-group">
                    <label> Nama Brand {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="Branding name" name="brand" value="{{ old('brand') }}" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Nama PIC {!! required_icon() !!}</label>
                            <input type="text" class="form-control" placeholder="PIC name" name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Nomor PIC {!! required_icon() !!}</label>
                            <input type="number" class="form-control" placeholder="PIC phone" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="getOR">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Warna {!! required_icon() !!}</label>
                                        <input type="text" class="form-control" placeholder="Requested color" name="color[]" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ukuran {!! required_icon() !!}</label>
                                        <select class="form-control select2 regis0" id="size0" name="size[]" required>
                                            <option value="" disabled selected></option>
                                            <option value="s">S</option> 
                                            <option value="m">M</option> 
                                            <option value="l">L</option> 
                                            <option value="xl">XL</option> 
                                            <option value="xxl">XXL</option> 
                                            <option value="xxxl">XXXL</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label> Kuantitas {!! required_icon() !!}</label>
                                        <input type="number" class="form-control" placeholder="Requested quantity" name="quantity[]" value="" min="12" required>
                                    </div>
                                </div>
                                <div class="col-md-1 mt-5 pt-3">
                                    <button type="button" class="btn btn-icon btn-primary btn-hover-primary shadow-sm btn-sm btn-add-or">
                                        <i class="ki ki-plus icon-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-right">Bahan {!! required_icon() !!}</label>
                    <select class="form-control select2" id="material" name="material" required>
                        <option disabled selected></option>
                        @foreach ($materials as $material)
                            <option value="{{ $material->id }}">{{ $material->name }}</option> 
                        @endforeach
                        {{-- <option value="others">Bahan lainnya</option> --}}
                    </select>
                    <input type="text" class="form-control mt-2 {{ empty(old('other_materials')) ? 'd-none' : '' }}" id="other_material" placeholder="Input other materials" name="other_materials" value="{{ old('other_materials') }}" >
                    
                </div>

                <div class="form-group row mt-5">
                    <label class="col-md-12"> Design Baju</label>
                    <div class="image-input image-input-empty image-input-outline ml-3" id="kt_image_5" style="background-image: url('{{ asset('assets/backend/img/placeholder.png') }}')">
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
                    <label> Lainnya </label>
                    <textarea id="form7" name="others" placeholder="Other request" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Hanya jasa</label>
                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                        <input type="checkbox" name="is_services" {{ old('draft') ? 'checked' : '' }}>
                        <span></span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Pembayaran Installment/DP</label>
                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                        <input type="checkbox" name="is_installment" {{ old('draft') ? 'checked' : '' }}>
                        <span></span>
                    </label>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Kirim</button>
                <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Kembali</a>
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
<script>
    $(document).ready(function() {
        select2refresh($('.select2'));

        // If selected "others", show freetext
        $('#material').change(function() {
            if($(this).find(':selected').val() == 'others') {
                $("#other_material").removeClass('d-none');
                $("#other_material").show();
            }else {
                $("#other_material").hide();
            }
        });
    });
</script>
<script>
    $('.btn-add-or').click(function() {
        var container = $('.getOR');
        let length = container.find('.row').length;
        console.log(length);
        container.append(
            `<div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label> Warna {!! required_icon() !!}</label>
                        <input type="text" class="form-control" placeholder="Requested color" name="color[]" value="" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Ukuran {!! required_icon() !!}</label>
                        <select class="form-control select2 regis`+length+`" id="size`+length+`" name="size[]" required>
                            <option value="" disabled selected></option>
                            <option value="s">S</option> 
                            <option value="m">M</option> 
                            <option value="l">L</option> 
                            <option value="xl">XL</option> 
                            <option value="xxl">XXL</option> 
                            <option value="xxxl">XXXL</option> 
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label> Kuantitas {!! required_icon() !!}</label>
                        <input type="number" class="form-control" placeholder="Requested quantity" name="quantity[]" value="" min="12" required>
                    </div>
                </div>
                <div class="col-md-1 mt-5 pt-3">
                    <button type="button" class="btn btn-icon btn-danger btn-hover-danger shadow-sm btn-sm" id="btn-del-or">
                        <i class="ki ki-bold-close icon-sm"></i>
                    </button>
                </div>
            </div>`
        );
        select2refresh($('#size'+length));
        $("body").on("click","#btn-del-or",function(){
            $(this).closest('.getOR .row').remove();
            select2refresh($('#size'+length));
        }); 
    })

    $(document).ready(function() {
        select2refresh($('.select2'));
    }) 

</script>
@endpush