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
        <div class="col-12 shadow-lg">
            <div class="py-3">
                <a href="{{ route('frontend.finish.index') }}">
                    <img src="{{ asset('images/icon/back.png') }}" width="18" height="18">
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="text-header font-size-18 text-active-pink font-weight-500">Form input Barang Jadi</div>
            </div>
        </div>
    </div>
    <div class="bg-grey pt-23 mt-1" style="max-height: 86vh; overflow: scroll; margin-bottom: 30px">
        <div class="container-omyra" style="margin-bottom: 90px;">
            <form action="{{ route('frontend.finish.store') }}" method="POST" enctype="multipart/form-data"
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
                    <label class="font-weight-500">Brand / Ukuran</label>
                    <select
                        class="select2 form-control font-size-16 form-omyra {{ $errors->has('product') ? 'is-invalid' : '' }}"
                        id="product" name="product">
                        <option value="" selected="selected" disabled>-- Pilih Brand --
                        </option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">
                                {{ $brand->name }}
                            </option>
                        @endforeach
                        @if ($errors->has('brand'))
                            <span class="invalid-feedback" role="alert">
                                <p><b>{{ $errors->first('brand') }}</b></p>
                            </span>
                        @endif
                        {{-- @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->brand->name . ' / ' . $product->size . ' / barang 1/2 jadi: ' . $product->stock_semifinish }}
                            </option>
                        @endforeach
                        @if ($errors->has('product'))
                            <span class="invalid-feedback" role="alert">
                                <p><b>{{ $errors->first('product') }}</b></p>
                            </span>
                        @endif --}}
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-500">Jumlah inner yang digunakan</label>
                    <select class="select2 form-control font-size-16 form-omyra" id="inner" name="inner">
                        <option selected="selected" disabled>-- Pilih Brand Dulu --</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="d-flex">
                        <label for="need_inner">Jumlah Kebutuhan Inner </label>
                        <div id="label-need-inner" class="text-info font-weight-bold ml-2 font-size-16 form-omyra"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-sm text-info">Otomatis terisi jika sudah mengisi Total</p>
                        <div id="max-label-inner" class="text-danger font-weight-bold font-size-16 form-omyra"></div>
                    </div>
                    <input type="number" name="need_inner" class="form-control font-size-16 form-omyra" id="need_inner"
                        placeholder="Kebutuhan inner akan otomatis terisi" readonly>
                </div>
                <div class="form-group">
                    <label class="font-weight-500">Jumlah master yang digunakan</label>
                    <select class="select2 form-control font-size-16 form-omyra" id="master" name="master">
                        <option selected="selected" disabled>-- Pilih Brand / Ukuran Dulu --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-500 total">Total</label>
                    <div class="d-flex justify-content-between">
                        <p class="text-sm text-info">Akan terbuka jika sudah mengisi semua form diatas
                        </p>
                        <div id="max-label" class="text-danger font-weight-bold"></div>
                    </div>
                    <input type="number" name="total" id="total" class="form-control font-size-16 form-omyra"
                        placeholder="Masukkan Jumlah Barang Jadi" disabled>
                </div>
                <button class="btn btn-omyra btn-block btn-pink text-white" type="submit">Simpan</button>
                <a class="btn btn-outline-secondary btn-block" href="{{ route('frontend.finish.index') }}">Kembali</a>
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

            let need_inner = 0,
                max_inner = 0,
                max_master = 0,
                max_stock_semifinish = 0,
                max_total = 0;

            function setMaxInner(param) {
                max_inner = param / need_inner;
            }

            function setMaxMaster(param) {
                max_master = param;
            }

            function setMaxStockSemifinish(param) {
                max_stock_semifinish = param;
            }

            function setGreatestNumber(num1, num2, num3) {
                let greatest = Math.min(num1, num2, num3);
                max_total = greatest;
                $('#total').attr('max', max_total);
                $('#max-label').html('Max: ' + max_total);
            }

            function checkAllField() {
                let productId = $('#product option:selected').val();
                let innerId = $('#inner option:selected').val();
                let masterId = $('#master option:selected').val();
                if (productId != '' && innerId != '' && masterId != '') {
                    $('#total').attr('disabled', false);
                }
            }

            $('#form-tambah').validate({
                rules: {
                    date: {
                        required: true,
                    },
                    product: {
                        required: true,
                    },
                    inner: {
                        required: true,
                    },
                    need_inner: {
                        required: true,
                    },
                    total: {
                        required: true,
                    },
                },
                messages: {
                    date: {
                        required: "Mohon masukan tanggal stuffing",
                    },
                    product: {
                        required: "Mohon pilih brand / ukuran",
                    },
                    inner: {
                        required: "Mohon pilih material inner",
                    },
                    need_inner: {
                        required: "Mohon masukan jumlah inner yang dibutuhkan",
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
                    url: "{{ route('api.get_inner.by.product_id', '') }}" + '/' + productId,
                    dataType: "json",
                    success: function(response) {
                        let html = ``;
                        html +=
                            `<option value="" selected="selected" disabled>-- Pilih Jenis/Ukuran Inner --</option>`;
                        response.data.forEach(material => {
                            html +=
                                `<option value="${ material.id }">${ material.name } / ${material.product.size} | stok Inner: ${material.stock} | barang 1/2 jadi: ${material.product.stock_semifinish}</option>`;
                        });
                        $('#inner').html(html);
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{ route('api.show.product', '') }}" + '/' + productId,
                    dataType: "json",
                    success: function(response) {
                        let product = response.product;
                        $('#label-need-inner').html('x' + product.need_inner);
                        need_inner = product.need_inner;
                        // $('#max-label').html('Max: ' + product.stock_semifinish);
                        setMaxStockSemifinish(product.stock_semifinish);
                        setGreatestNumber(max_inner, max_master, max_stock_semifinish);
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{ route('api.get_master.by.product_id', '') }}" + '/' + productId,
                    dataType: "json",
                    success: function(response) {
                        let html = ``;
                        html +=
                            `<option value="" selected="selected" disabled>-- Pilih Jenis/Ukuran Master --</option>`;
                        response.data.forEach(material => {
                            html +=
                                `<option value="${ material.id }">${ material.name } / ${material.product.size} | stock: ${material.stock}</option>`;
                        });
                        $('#master').html(html);
                    }
                });
                checkAllField();
            });

            $('#inner').on('change', function() {
                let materialId = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('api.show.material', '') }}" + '/' + materialId,
                    dataType: "json",
                    success: function(response) {
                        let material = response.material;
                        if (material != null) {
                            $('#max-label-inner').html('Max: ' + material.stock);
                            // $('#need_inner').attr('max', material.stock);
                            setMaxInner(material.stock);
                            setGreatestNumber(max_inner, max_master, max_stock_semifinish);
                        }
                    }
                });
                checkAllField();
            });

            $('#master').on('change', function() {
                let materialId = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('api.show.material', '') }}" + '/' + materialId,
                    dataType: "json",
                    success: function(response) {
                        let material = response.material;
                        if (material != null) {
                            setMaxMaster(material.stock);
                            setGreatestNumber(max_inner, max_master, max_stock_semifinish);
                        }
                    }
                });
                checkAllField();
            });

            $('#total').on('keyup', function() {
                let total = $(this).val();
                // let needInner = 0;
                let productId = $('#product').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('api.show.product', '') }}" + '/' + productId,
                    dataType: "json",
                    success: function(response) {
                        let product = response.product;
                        $('#need_inner').val(total * (product.need_inner ?? 0));
                    }
                });
            });

        });
    </script>
@endpush
