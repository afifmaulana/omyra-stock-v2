@extends('ui.frontend.layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')
    <div class="box-shadow">
        <div class="col-12 shadow-lg">
            <div class="py-3">
                <a href="{{ route('frontend.report.plastic.index') }}">
                    <img src="{{ asset('images/icon/back.png') }}" width="18" height="18">
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="text-header font-size-18 text-active-pink font-weight-500">Riwayat Plastik</div>
            </div>
        </div>
    </div>
    <div class="bg-grey pt-23 mt-1" style="max-height: 86vh; overflow: scroll;">
        {{-- @include('components.frontend.flashmessage') --}}
        <div class="container-omyra" style="margin-bottom: 90px;">
            <h5 class="py-3"></h5>

            <table id="dataTable" class="table table-striped table-bordered table-responsive display table-condensed"
                style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Brand</th>
                        <th>Jenis / Ukuran</th>
                        <th>Stok Sebelumnya</th>
                        <th>+/-</th>
                        <th>Jumlah</th>
                        <th>Stok Sekarang</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $item)
                        @if ($item->type == 'Barang Reject')
                            <tr style="color: red; font-style: italic; font-weight: 600">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $item->brand->name }}</td>
                                <td>{{ $item->material->name . ' / ' . $item->product->size }}</td>
                                <td>{{ number_format($item->stock_before, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $item->type_calculation }}</td>
                                <td>{{ number_format($item->total, 0, ',', '.') }}</td>
                                <td>= {{ number_format($item->stock_now, 0, ',', '.') }}</td>
                                <td>{{ $item->type }}</td>

                            </tr>
                        @endif

                        @if ($item->type == 'Barang Dipakai')
                            <tr style="color: red">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $item->brand->name }}</td>
                                <td>{{ $item->material->name . ' / ' . $item->product->size }}</td>
                                <td>{{ number_format($item->stock_before, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $item->type_calculation }}</td>
                                <td>{{ number_format($item->total, 0, ',', '.') }}</td>
                                <td>= {{ number_format($item->stock_now, 0, ',', '.') }}</td>
                                <td>{{ $item->type }}</td>

                            </tr>
                        @endif
                        @if ($item->type == 'Barang Masuk')
                            <tr style="color: green">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $item->brand->name }}</td>
                                <td>{{ $item->material->name . ' / ' . $item->product->size }}</td>
                                <td>{{ number_format($item->stock_before, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $item->type_calculation }}</td>
                                <td>{{ number_format($item->total, 0, ',', '.') }}</td>
                                <td>= {{ number_format($item->stock_now, 0, ',', '.') }}</td>
                                <td>{{ $item->type }}</td>

                            </tr>
                        @endif


                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Brand</th>
                        <th>Jenis / Ukuran</th>
                        <th>Stok Sebelumnya</th>
                        <th>+/-</th>
                        <th>Jumlah</th>
                        <th>Stok Sekarang</th>
                        <th>Keterangan</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script> --}}
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
