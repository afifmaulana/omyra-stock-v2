@extends('ui.frontend.layouts.app')
@push('styles')
    <style>
        .select2-container .select2-selection--single {
            height: 42px;
            border: solid 1px #b4d5ff;
        }

    </style>
@endpush
@section('content')
    <div class="box-shadow">
        <div class="col-12 shadow shadow-lg">
            <div class="py-3">
                <a href="{{ route('frontend.semi-finish.index') }}">
                    <img src="{{ asset('images/icon/back.png') }}" width="18" height="18">
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="text-header font-size-18 text-active-pink font-weight-500">Form input Barang 1/2 Jadi</div>
            </div>
        </div>
    </div>
    <div class="bg-grey pt-23 mt-1" style="max-height: 86vh; overflow: scroll; margin-bottom: 30px">
        <div class="container-omyra" style="margin-bottom: 90px;">
            <form action="{{ route('frontend.semi-finish.store') }}" method="POST" enctype="multipart/form-data"
                id="form-tambah">
                @csrf
                <div class="form-group">
                    <label class="font-weight-500">Tanggal</label>
                    <input type="text" name="date" id="date"
                        class="datepicker form-control font-size-16 form-omyra {{ $errors->has('date') ? 'is-invalid' : '' }}"
                        placeholder="Masukkan Tanggal Borongan">
                    @if ($errors->has('date'))
                        <span class="invalid-feedback" role="alert">
                            <p><b>{{ $errors->first('date') }}</b></p>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="font-weight-500">Tanggal</label>
                    <input type="text" name="unloading_date" id="unloading_date"
                        class="datepicker form-control font-size-16 form-omyra {{ $errors->has('unloading_date') ? 'is-invalid' : '' }}"
                        placeholder="Masukkan Tanggal Bongkar Oven">
                    @if ($errors->has('unloading_date'))
                        <span class="invalid-feedback" role="alert">
                            <p><b>{{ $errors->first('unloading_date') }}</b></p>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="font-weight-500">Brand / Ukuran</label>
                    <select
                        class="select2 form-control font-size-16 form-omyra {{ $errors->has('product') ? 'is-invalid' : '' }}"
                        id="product" name="product">
                        <option selected disabled>Pilih Brand / Ukuran</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->brand->name . ' / ' . $product->size }}
                            </option>
                        @endforeach
                        @if ($errors->has('product'))
                            <span class="invalid-feedback" role="alert">
                                <p><b>{{ $errors->first('product') }}</b></p>
                            </span>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-500">Jenis</label>
                    <select
                        class="select2 form-control font-size-16 form-omyra {{ $errors->has('material') ? 'is-invalid' : '' }}"
                        id="material" name="material">
                        <option selected="selected" disabled>-- Pilih Brand / Ukuran Dulu --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-500">Total</label>
                    <div id="max-label" class="text-danger font-weight-bold float-right"></div>
                    <input type="number" name="total" id="total"
                        class="form-control font-size-16 form-omyra {{ $errors->has('total') ? 'is-invalid' : '' }}"
                        placeholder="12.000">
                    @if ($errors->has('total'))
                        <span class="invalid-feedback" role="alert">
                            <p><b>{{ $errors->first('total') }}</b></p>
                        </span>
                    @endif
                </div>
                <button class="btn btn-omyra btn-block btn-pink text-white" type="submit">Simpan</button>
                <a class="btn btn-outline-secondary btn-block"
                    href="{{ route('frontend.semi-finish.index') }}">Kembali</a>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/additional-methods.min.js"></script>
    <script>
        jQuery.extend(jQuery.validator.messages, {
            max: jQuery.validator.format("Maksimal {0}."),
        });
    </script>
    <script>
        $(function() {
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

            $('#form-tambah').validate({
                rules: {
                    date: {
                        required: true,
                    },
                    unloading_date: {
                        required: true,
                    },
                    product: {
                        required: true,
                    },
                    material: {
                        required: true,
                    },
                    need_plastic: {
                        required: true,
                    },
                    total: {
                        required: true,
                    },
                },
                messages: {
                    date: {
                        required: "Mohon masukan tanggal borongan",
                    },
                    unloading_date: {
                        required: "Mohon masukan tanggal bongkar oven",
                    },
                    product: {
                        required: "Mohon pilih brand / ukuran",
                    },
                    material: {
                        required: "Mohon pilih material plastic",
                    },
                    need_plastic: {
                        required: "Mohon masukan jumlah plastic yang dibutuhkan",
                    },
                    total: {
                        required: "Mohon masukan total",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('#product').on('change', function() {
                let productId = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('api.get_plastic.by.product_id', '') }}" + '/' + productId,
                    dataType: "json",
                    success: function(response) {
                        let html = ``;
                        html +=
                            `<option selected="selected" disabled>-- Pilih Jenis Plastik --</option>`;
                        response.materials.forEach(material => {
                            html +=
                                `<option value="${ material.id }">${ material.name } | stock: ${material.stock}</option>`;
                        });
                        $('#material').html(html);
                    }
                });
            });

            $('#material').on('change', function() {
                let materialId = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('api.show.material', '') }}" + '/' + materialId,
                    dataType: "json",
                    success: function(response) {
                        let material = response.material;
                        console.log(typeof(material.stock));
                        if (material != null) {
                            $('#max-label').html('Max: ' + material.stock);
                            $('#total').attr('max', material.stock);
                        } else {
                            $('#max-label').html('');
                        }
                    }
                });
            });
        });
    </script>
@endpush
