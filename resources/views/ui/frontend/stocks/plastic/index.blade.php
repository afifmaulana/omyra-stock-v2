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
                <div class="text-header font-size-18 text-active-pink font-weight-500">Data Stok Plastik</div>
            </div>
        </div>
    </div>
    <div class="bg-grey pt-23 mt-1" style="max-height: 86vh; overflow: scroll;">
        {{-- @include('components.frontend.flashmessage') --}}
        <div class="container-omyra" style="margin-bottom: 90px;">
            <a href="{{ route('frontend.plastic.create') }}" class="float" data-bs-toggle="tooltip"
                data-bs-placement="left" title="Tambah Data">
                <i class="fa fa-plus my-float"></i>
            </a>
            {{-- <a href="{{ route('frontend.reject.plastic.index') }}" class="float-reject" data-bs-toggle="tooltip"
                data-bs-placement="left" title="Tambah Data">
                <i class="fa fa-recycle my-float"></i>
            </a> --}}
            <div class="float-right">
                <a href="{{ route('frontend.reject.plastic.index') }}" class="btn btn-sm btn-danger"
                    style="border-radius: 30px">
                    <i class="fa fa-list"></i>
                    Reject
                </a>
                {{-- <a href="{{ route('frontend.reject.plastic.index') }}" class="btn btn-sm btn-primary"
                    style="border-radius: 30px">
                    <i class="fa fa-plus"></i>
                    Tambah
                </a> --}}
            </div>
            <h5 class="py-3"></h5>

            <table id="dataTable" class="table table-striped table-bordered table-responsive display table-condensed"
                style="border-collapse:collapse;">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Brand</th>
                        <th>Jenis / Ukuran</th>
                        <th>Jumlah Masuk</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($stock->date)->format('d-m-Y') }}</td>

                                <td>
                                    {{ $stock->material->product->brand->name }}
                                </td>
                                <td>{{ $stock->material->name . ' / ' . $stock->material->product->size }}</td>
                                <td>{{ number_format($stock->total, 0, ',', '.') }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    {{-- <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> --}}
                                    <form id="delete-plastic-{{ $stock->id }}" action="{{ route('frontend.plastic.delete', $stock->id) }}"
                                        class="d-inline" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button id="btn-delete" data-id="{{ $stock->id }}" class="btn btn-sm btn-danger btn-delete"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                    {{-- <a href="{{ route('frontend.plastic.detail', $stock->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-history text-white"></i>
                                    </a> --}}
                                </td>
                            </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Brand</th>
                        <th>Jenis / Ukuran</th>
                        <th>Jumlah Masuk</th>
                        <th>Action</th>
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

                // dom: 'Bfrtip',
                // select: {
                //             selector:'td:not(:first-child)',
                //             style:    'os'
                //         }
                // buttons: [
                //         { extend: 'copyHtml5', className: 'rounded btn btn-sm btn-secondary mb-3' },
                //         { extend: 'excelHtml5', className: 'rounded btn btn-sm btn-success mb-3' },
                //         { extend: 'csvHtml5', className: 'rounded btn btn-sm btn-primary mb-3' },
                //         { extend: 'pdfHtml5', className: 'rounded btn btn-sm btn-danger mb-3' },
                //         { extend: 'print', className: 'rounded btn btn-sm btn-outline-primary mb-3' },
                //             // 'copyHtml5',
                //         ]
            });
            // $('#dataTable tbody').on('click', 'td.dt-control', function() {
            //     var tr = $(this).closest('tr');
            //     var row = table.row(tr);

            //     if (row.child.isShown()) {
            //         // This row is already open - close it
            //         row.child.hide();
            //         tr.removeClass('shown');
            //     } else {
            //         // Open this row
            //         row.child('.semifinish'(row.data())).show();
            //         tr.addClass('shown');
            //     }
            // });

            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const id=$(this).data('id')
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
                        $(`form#delete-plastic-${id}`).submit();
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
