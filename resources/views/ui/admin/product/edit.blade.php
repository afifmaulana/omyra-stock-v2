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
                    <h1 class="m-0">Halaman Ubah Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Halaman Ubah Produk</li>
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
                            <h3 class="card-title">Form Ubah Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.product.update', $product->id) }}"
                            id="form-edit">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <select class="form-control select2" style="width: 100%;" id="brand_id" name="brand_id">
                                        <option selected="selected" disabled>-- Pilih Brand --</option>
                                        @foreach ($brands as $item)
                                        {{-- <option value="{{ $item->id }}">{{ Str::upper($item->name) }}</option> --}}
                                        <option value="{{$item->id}}"@if($item->id == $product->brand_id){{"selected"}}@endif>{{ Str::upper($item->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="size">Ukuran</label>
                                    <input type="text" name="size" class="form-control" id="size"
                                        placeholder="Masukan nama lengkap" value="{{ $product->size }}">
                                </div>
                                <div class="form-group">
                                    <label for="inner">Kebutuhan Inner</label>
                                    <input type="number" name="need_inner" class="form-control" id="need_inner"
                                        placeholder="Masukan jumlah inner yang dibutuhkan" value="{{ $product->need_inner }}">
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

        $('#form-edit').validate({
            rules: {
                size: {
                    required: true,
                },
                brand_id: {
                    required: true,
                },
                need_inner: {
                    required: true,
                },
            },
            messages: {
                size: {
                    required: "Mohon masukan ukuran",
                },
                brand_id: {
                    required: "Mohon pilih brand",
                },
                need_inner: {
                    required: "Mohon masukan jumlah inner yang dibutuhkan",
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
    });

</script>
@endpush
