@extends('ui.admin.layouts.app')

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Halaman Tambah Barang 1/2 Jadi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Halaman Tambah Barang 1/2 Jadi</li>
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
                                <h3 class="card-title">Form Tambah Barang 1/2 Jadi</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.semifinish.store') }}" id="form-tambah">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="font-weight-500">Tanggal</label>
                                        <input type="text" name="date" id="date"
                                            class="datepicker form-control font-size-16 {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                            placeholder="Masukkan Tanggal Borongan">
                                        @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                                <p><b>{{ $errors->first('date') }}</b></p>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="unloading_date">Tanggal Bongkar Oven</label>
                                        <div class="input-group date" id="input-date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#input-date" id="unloading_date" name="unloading_date"
                                                placeholder="dd/mm/yyyy" />
                                            <div class="input-group-append" data-target="#input-date"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="product">Brand / Ukuran</label>
                                        <select class="form-control select2" style="width: 100%;" id="product"
                                            name="product">
                                            <option selected="selected" disabled>-- Pilih Brand / Ukuran --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->brand->name . ' / ' . $product->size }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="material">Material Plastic Yang Digunakan</label>
                                        <select class="form-control select2" style="width: 100%;" id="material"
                                            name="material">
                                            <option selected="selected" disabled>-- Pilih Brand / Ukuran Dulu --</option>
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="need_plastic">Jumlah Kebutuhan Plastic </label>
                                        <div id="max-label" class="text-danger"></div>
                                    </div>
                                    <input type="number" name="need_plastic" class="form-control" id="need_plastic"
                                        placeholder="Masukan jumlah kebutuhan plastic">
                                </div> --}}
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="total">Total</label>
                                            <div id="max-label" class="text-danger font-weight-bold"></div>
                                        </div>
                                        <input type="number" name="total" class="form-control" id="total"
                                            placeholder="Masukan jumlah total">
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
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.j') }}s"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>

    <script>
        jQuery.extend(jQuery.validator.messages, {
            max: jQuery.validator.format("Maksimal {0}."),
        });
    </script>
    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });
            //Date picker
            $('#input-date').datetimepicker({
                autoclose: true,
                locale: 'id',
                format: 'DD/MM/YYYY'
            });
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
                            `<option selected="selected" disabled>-- Pilih Material Plastic --</option>`;
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
