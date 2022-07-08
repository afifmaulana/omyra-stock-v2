@extends('ui.admin.layouts.app')

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Halaman Produk</li>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Data Produk</h3>
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus mr-1"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Brand</th>
                                        <th>Ukuran</th>
                                        <th>Stok <br> Barang 1/2 Jadi</th>
                                        <th>Stok <br> Barang Jadi</th>
                                        <th>Kebutuhan Inner</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->brand->name }}</td>
                                        <td>{{ $product->size }}</td>
                                        <td>{{ $product->stock_semifinish }}</td>
                                        <td>{{ $product->stock_finish }}</td>
                                        <td>{{ $product->need_inner }}</td>
                                        <td>
                                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-info"><i
                                                    class="fa fa-edit"></i></a>
                                            <form id="delete-product"
                                                action="{{ route('admin.product.delete', $product->id) }}"
                                                class="d-inline" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button id="btn-delete" class="btn btn-sm btn-danger"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Brand</th>
                                        <th>Ukuran</th>
                                        <th>Stok Semifinish</th>
                                        <th>Stok Finish</th>
                                        <th>Kebutuhan Inner</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    $(function () {
        $("#table-data").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table-data_wrapper .col-md-6:eq(0)');

        $('#btn-delete').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: "You won't be able to revert this !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('form#delete-product').submit();
                }
            })
        });
    });

</script>

{{-- Display success message --}}
@if ($message = Session::get('success'))
<script>
    $(function () {
        let Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 2500 });
        Toast.fire({ icon: 'success', title: '{{ $message }}' });
    });
</script>
@endif
{{-- End Display success message --}}

@endpush
