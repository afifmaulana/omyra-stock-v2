@extends('ui.frontend.layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')
    <div class="box-shadow">
        <div class="col-12 shadow shadow-lg">
            <div class="py-3">
                <a href="#">
                    <img src="{{ asset('images/icon/back.png') }}" width="18" height="18">
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="text-header font-size-18 text-active-pink font-weight-500">Data Stok Barang Jadi</div>
            </div>
        </div>
    </div>
    <div class="bg-grey pt-23 mt-1" style="max-height: 86vh; overflow: scroll;">
        @include('components.frontend.flashmessage')
        <div class="container-omyra" style="margin-bottom: 90px;">

            <div class="float-right">
                <a href="{{ route('frontend.finish.create') }}" class="btn btn-sm btn-primary"
                    style="border-radius: 30px">
                    <i class="fa fa-plus"></i> Tambah</a>
            </div>
            <h5 class="py-3"></h5>

            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Brand / Ukuran</th>
                        <th>Kebutuhan Inner / Jumlah</th>
                        <th>Kebutuhan Master</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($finishes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->product->brand->name . ' / ' . $item->product->size }}</td>
                                        <td>{{ $item->inner->name . ' / ' . $item->need_inner }}</td>
                                        <td>{{ $item->master->name . ' / ' . $item->total }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                            <form id="delete-finish" action="{{ route('frontend.finish.delete', $item->id) }}" class="d-inline" method="POST">
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
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Brand / Ukuran</th>
                        <th>Kebutuhan Inner / Jumlah</th>
                        <th>Kebutuhan Master</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(function() {
            $('#dataTable').DataTable();

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
                        $('form#delete-finish').submit();
                    }
                })
            });
        });
    </script>
@endpush
