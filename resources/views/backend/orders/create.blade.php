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
                    <label> Brand name {!! required_icon() !!}</label>
                    <input type="text" class="form-control" placeholder="Branding name" name="brand" value="{{ old('brand') }}">
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> PIC/Owner Name {!! required_icon() !!}</label>
                            <input type="text" class="form-control" placeholder="PIC name" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> PIC/Owner Phone {!! required_icon() !!}</label>
                            <input type="number" class="form-control" placeholder="PIC phone" name="phone" value="{{ old('phone') }}">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="getOR">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Color {!! required_icon() !!}</label>
                                        <input type="text" class="form-control" placeholder="Requested color" name="color[]" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Size {!! required_icon() !!}</label>
                                        <input type="text" class="form-control" placeholder="Requested size" name="size[]" value="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label> Quantity {!! required_icon() !!}</label>
                                        <input type="number" class="form-control" placeholder="Requested quantity" name="quantity[]" value="">
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
                    <label class="col-form-label text-right">Material {!! required_icon() !!}</label>
                    <select class="form-control select2" id="material" name="material" required>
                        <option disabled selected></option>
                        @foreach ($materials as $material)
                            <option value="{{ $material->id }}">{{ $material->name }}</option> 
                        @endforeach
                        <option value="others">Other materials</option>
                    </select>
                    <input type="text" class="form-control mt-2 {{ empty(old('other_materials')) ? 'd-none' : '' }}" id="other_material" placeholder="Input other materials" name="other_materials" value="{{ old('other_materials') }}" >
                    
                </div>

                <div class="form-group">
                    <label> Price {!! required_icon() !!}</label>
                    <input type="number" class="form-control" placeholder="Price" name="price" value="{{ old('price') }}">
                </div>


                <div class="form-group row mt-5">
                    <label class="col-md-12"> Design Logo</label>
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
                    <label> Others </label>
                    <textarea id="form7" name="others" placeholder="Other request" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Services Only</label>
                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                        <input type="checkbox" name="is_services" {{ old('draft') ? 'checked' : '' }}>
                        <span></span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Make Installment Payment</label>
                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                        <input type="checkbox" name="is_installment" {{ old('draft') ? 'checked' : '' }}>
                        <span></span>
                    </label>
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
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select an option"
        });

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
    $(document).ready(function() {
        var container = $('.getOR');
        var btnIncrement = $('.btn-add-or');
        
        btnIncrement.click(function() {
            container.append(
                `<div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Color {!! required_icon() !!}</label>
                            <input type="text" class="form-control" placeholder="Requested color" name="color[]" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Size {!! required_icon() !!}</label>
                            <input type="text" class="form-control" placeholder="Requested size" name="size[]" value="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> Quantity {!! required_icon() !!}</label>
                            <input type="number" class="form-control" placeholder="Requested quantity" name="quantity[]" value="">
                        </div>
                    </div>
                    <div class="col-md-1 mt-5 pt-3">
                        <button type="button" class="btn btn-icon btn-danger btn-hover-danger shadow-sm btn-sm" id="btn-del-or">
                            <i class="ki ki-bold-close icon-sm"></i>
                        </button>
                    </div>
                </div>`
            )
            $('.select2').select2({
                placeholder: "Select an option"
            });

            $("body").on("click","#btn-del-or",function(){
                $(this).closest('.getOR .row').remove();
            }); 
        })
    });
</script>
@endpush