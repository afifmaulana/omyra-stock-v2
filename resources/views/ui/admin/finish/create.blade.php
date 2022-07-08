@extends('ui.admin.layouts.app')

@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Tambah Barang Jadi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Halaman Tambah Barang Jadi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Barang Jadi</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.finish.store') }}"
                            id="form-tambah">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product">Brand / Ukuran</label>
                                    <select class="form-control select2" style="width: 100%;" id="product"
                                        name="product">
                                        <option value="" selected="selected" disabled>-- Pilih Brand / Ukuran / Stock
                                            Semifinish --
                                        </option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->brand->name . ' / ' . $product->size . ' / semifinish: ' .
                                            $product->stock_semifinish }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inner">Material Inner Yang Digunakan</label>
                                    <select class="form-control select2" style="width: 100%;" id="inner" name="inner">
                                        <option value="" selected="selected" disabled>-- Pilih Brand / Ukuran Dulu --
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <label for="need_inner">Jumlah Kebutuhan Inner </label>
                                        <div id="label-need-inner" class="text-info font-weight-bold ml-2"></div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="text-sm text-info">Otomatis terisi jika sudah mengisi Total</p>
                                        <div id="max-label-inner" class="text-danger font-weight-bold"></div>
                                    </div>
                                    <input type="number" name="need_inner" class="form-control" id="need_inner"
                                        placeholder="Masukan jumlah kebutuhan Inner" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="master">Material Master Yang Digunakan</label>
                                    <select class="form-control select2" style="width: 100%;" id="master" name="master">
                                        <option value="" selected="selected" disabled>-- Pilih Brand / Ukuran Dulu --
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <div class="d-flex justify-content-between">
                                        <p class="text-sm text-info">Akan terbuka jika sudah mengisi semua form diatas
                                        </p>
                                        <div id="max-label" class="text-danger font-weight-bold"></div>
                                    </div>
                                    <input type="number" name="total" class="form-control" id="total"
                                        placeholder="Masukan jumlah total" disabled>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

@push('scripts')
<!-- jquery-validation -->
<script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    jQuery.extend(jQuery.validator.messages, {
        max: jQuery.validator.format("Maksimal {0}."),
    });
</script>
<script>
    $(function () {
        let need_inner = 0, max_inner = 0, max_master = 0, max_stock_semifinish = 0, max_total = 0;

        function setMaxInner(param) {
            max_inner = param/need_inner;
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

        $('.select2').select2({
            theme: 'bootstrap4'
        });

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
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#product').on('change', function () {
            let productId = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('api.get_inner.by.product_id', '') }}" + '/' + productId,
                dataType: "json",
                success: function (response) {
                    let html = ``;
                    html +=
                        `<option value="" selected="selected" disabled>-- Pilih Jenis Inner --</option>`;
                    response.materials.forEach(material => {
                        html +=
                            `<option value="${ material.id }">${ material.name } | stock: ${material.stock}</option>`;
                    });
                    $('#inner').html(html);
                }
            });
            $.ajax({
                type: "GET",
                url: "{{ route('api.show.product', '') }}" + '/' + productId,
                dataType: "json",
                success: function (response) {
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
                success: function (response) {
                    let html = ``;
                    html +=
                        `<option value="" selected="selected" disabled>-- Pilih Jenis Master --</option>`;
                    response.materials.forEach(material => {
                        html +=
                            `<option value="${ material.id }">${ material.name } | stock: ${material.stock}</option>`;
                    });
                    $('#master').html(html);
                }
            });
            checkAllField();
        });

        $('#inner').on('change', function () {
            let materialId = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('api.show.material', '') }}" + '/' + materialId,
                dataType: "json",
                success: function (response) {
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

        $('#master').on('change', function () {
            let materialId = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('api.show.material', '') }}" + '/' + materialId,
                dataType: "json",
                success: function (response) {
                    let material = response.material;
                    if (material != null) {
                        setMaxMaster(material.stock);
                        setGreatestNumber(max_inner, max_master, max_stock_semifinish);
                    }
                }
            });
            checkAllField();
        });

        $('#total').on('keyup', function () {
            let total = $(this).val();
            // let needInner = 0;
            let productId = $('#product').val();
            $.ajax({
                type: "GET",
                url: "{{ route('api.show.product', '') }}" + '/' + productId,
                dataType: "json",
                success: function (response) {
                    let product = response.product;
                    $('#need_inner').val(total * (product.need_inner ?? 0));
                }
            });
        });

    });
</script>
@endpush
