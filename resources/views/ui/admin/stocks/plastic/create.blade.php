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
                    <h1 class="m-0">Halaman Tambah Penyetokan Plastic</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Halaman Tambah Penyetokan Plastic</li>
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
                            <h3 class="card-title">Form Tambah Penyetokan Plastic</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('admin.stock.plastic.store') }}" id="form-tambah">
                            @csrf
                            <div class="card-body">
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
                                    <label for="material">Material Plastic</label>
                                    <select class="form-control select2" style="width: 100%;" id="material"
                                        name="material">
                                        <option selected="selected" disabled>-- Pilih Brand / Ukuran Dulu --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total</label>
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
<script>
    $(function () {
        $('.select2').select2( { theme: 'bootstrap4' } );
        
        $('#form-tambah').validate({
            rules: {
                product: {
                    required: true,
                },
                material: {
                    required: true,
                },
                total: {
                    required: true,
                },
            },
            messages: {
                product: {
                    required: "Mohon pilih brand / ukuran",
                },
                material: {
                    required: "Mohon pilih material plastic",
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
                url: "{{ route('api.get_plastic.by.product_id', '') }}" + '/' + productId,
                dataType: "json",
                success: function (response) {
                    let html = ``;
                    html += `<option selected="selected" disabled>-- Pilih Material Plastic --</option>`;
                    response.materials.forEach(material => {
                        html += `<option value="${ material.id }">${ material.name }</option>`;
                    });
                    $('#material').html(html);
                }
            });
        });
    });

</script>
@endpush