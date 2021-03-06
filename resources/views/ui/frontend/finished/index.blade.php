@extends('ui.frontend.layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')
    <div class="box-shadow">
        <div class="col-12 shadow-lg">
            <div class="py-3">
                <a href="{{ route('frontend.dashboard.index') }}">
                    <img src="{{ asset('images/icon/back.png') }}" width="18" height="18">
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="text-header font-size-18 text-active-pink font-weight-500">Data Stok Barang Jadi</div>
            </div>
        </div>
    </div>
    <div class="bg-grey pt-23 mt-1" style="max-height: 86vh; overflow: scroll;">
        {{-- @include('components.frontend.flashmessage') --}}
        <div class="container-omyra" style="margin-bottom: 90px;">
            <a href="{{ route('frontend.finish.create') }}" class="float"
                data-bs-toggle="tooltip" data-bs-placement="left" title="Tambah Data">
                <i class="fa fa-plus my-float"></i>
            </a>
            {{-- <div class="float-right">
                <a href="{{ route('frontend.finish.create') }}" class="btn btn-sm btn-primary" style="border-radius: 30px">
                    <i class="fa fa-plus"></i> Tambah</a>
            </div> --}}
            <h5 class="py-3"></h5>

            <table id="dataTable" class="table table-striped table-bordered table-responsive" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Brand / Ukuran</th>
                        <th>Jenis/Kebutuhan Inner</th>
                        <th>Jenis/Kebutuhan Master</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($finishes as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->product->brand->name . ' / ' . $item->product->size }}</td>
                            <td>{{ $item->inner->name . ' / ' . $item->need_inner }}</td>
                            <td>{{ $item->master->name . ' / ' . $item->total }}</td>
                            <td>{{ number_format($item->total,0,',','.') }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                {{-- <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> --}}
                                <form id="delete-finish-{{ $item->id }}" action="{{ route('frontend.finish.delete', $item->id) }}"
                                    class="d-inline" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button id="btn-delete" data-id="{{ $item->id }}" class="btn btn-sm btn-danger btn-delete"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-center">
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
            $('#dataTable').DataTable({
                "oLanguage": {
                                "sSearch": "Cari Data:",
                                "lengthMenu":     "Tampilkan _MENU_ Data",
                                },
                "language": {
                                "zeroRecords": "Data yang dicari tidak ditemukan",
                                "paginate": {
                                            "next": "Selanjutnya",
                                            "previous": "Kembali"

                                            },
                                "infoEmpty": "Tidak ada data yang tampil",
                            },
            });

            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const id=$(this).data('id')
                Swal.fire({
                    title: 'Hapus Data Ini ?',
                    text: "Anda tidak dapat mengembalikannya !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`form#delete-finish-${id}`).submit();
                    }
                })
            });
        });
    </script>
    {{-- Display success message --}}
    @if ($message = Session::get('success'))
        <script>
            $(function() {
                let Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500
                });
                Toast.fire({
                    icon: 'success',
                    title: '{{ $message }}'
                });
            });
        </script>
    @endif
    {{-- End Display success message --}}
@endpush
