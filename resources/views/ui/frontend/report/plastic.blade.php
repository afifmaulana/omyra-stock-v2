@extends('ui.frontend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/multi-select/css/multi-select.css') }}">
    <style>
        .select2-container .select2-selection--single {
            height: 42px;
            border: solid 1px #b4d5ff;
        }

        .input-filter {
            border-radius: 4px !important;
            direction: ltr !important;
            padding: 5px !important;
            font-size: 12px !important;
        }

        .multiselect_div>.btn-group .btn {
            min-width: 150px;
            font-size: 12px;
            border: 1px solid black;
            background: white;
            color: black;
        }

        .multiselect_div .btn-group .multiselect-container {
            font-size: 12px !important;
        }

        tfoot {
            background: white;
        }
    </style>
@endpush
@section('content')
    <div class="box-shadow">
        <div class="col-12 shadow-lg">
            <div class="py-3">
                <a href="#">
                    <img src="{{ asset('images/icon/back.png') }}" width="18" height="18">
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="text-header font-size-18 text-active-pink font-weight-500">Laporan Stok Plastik</div>
            </div>
        </div>
    </div>
    <div class="bg-grey pt-23 mt-1" style="max-height: 86vh; overflow: scroll;">
        {{-- @include('components.frontend.flashmessage') --}}
        <div class="container-omyra" style="margin-bottom: 90px;">
            <form action="#" method="POST" enctype="multipart/form-data" id="form-tambah">
                @csrf
                <div class="form-group">
                    <label class="font-weight-500">Brand / Ukuran</label>
                    <select
                        class="select2 form-control font-size-16 form-omyra product-plastic {{ $errors->has('product') ? 'is-invalid' : '' }}"
                        id="product" name="product">
                        <option selected disabled>Pilih Brand / Ukuran</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->brand->name . ' / ' . $product->size }}
                            </option>
                        @endforeach
                        @if ($errors->has('product'))
                            <span class="invalid-feedback" role="alert">
                                <p><b>{{ $errors->first('product') }}</b></p>
                            </span>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-500">Jenis</label>
                    <select
                        class="select2 form-control font-size-16 form-omyra material-plastic {{ $errors->has('material') ? 'is-invalid' : '' }}"
                        id="material" name="material">
                        <option selected="selected" disabled>-- Pilih Brand / Ukuran Dulu --</option>
                    </select>
                </div>
                <button class="btn btn-sm btn-info float-right" type="submit">Submit</button>
                <a class="btn btn-sm btn-outline-secondary" href="#">Reset</a>
            </form>
            {{-- <h5 class="py-3"></h5> --}}
            <hr>
            <div class="py-3 d-flex justify-content-center">
                <a href="#" class="btn btn-sm btn-success mr-3">
                    <i class="fas fa-download"></i>
                    Download Excel
                </a>
                <button class="btn btn-sm btn-outline-info" id="print-all">
                    <i class="fa fa-print"></i>
                    Print
                </button>
            </div>
            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Brand / Ukuran</th>
                        <th>Jenis</th>
                        <th>Jumlah Masuk</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr> --}}
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th><input type="text" class="input-filter w-50px" name="stock_id"></th>
                        <th><input type="text" class="input-filter w-50px" name="date"></th>
                        <th>
                            <div class="multiselect_div">
                                <select name="products" id="multiselect4-filter"
                                    class="multiselect multiselect-custom input-filter">
                                    @php
                                        $products = \App\Models\Product::all();
                                    @endphp
                                    <option value="">All </option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->brand->name }} /
                                            {{ $item->size }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </th>
                        <th>
                            <div class="multiselect_div">
                                <select name="material" id="multiselect5-filter"
                                    class="multiselect multiselect-custom input-filter">
                                    @php
                                        $materials = \App\Models\Materials::where('type', 'plastic')->get();
                                    @endphp
                                    <option value="">All </option>
                                    @foreach ($materials as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </th>
                        <th><input type="text" class="input-filter" name="total"></th>
                        <th></th>
                    </tr>

                </tfoot> --}}
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('vendor/multi-select/js/jquery.multi-select.js') }}"></script><!-- Multi Select Plugin Js -->
    <script src="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script>
        $(function() {
            // $('#dataTable').DataTable();

            let list_stock_plastic = [];
            let product = $("#filter-product").val(),
                brand = $("#filter-brand").val(),
                material = $("#filter-material").val()

            const table = $('#dataTable').DataTable({
                "pageLength": 100,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'semua']
                ],
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "processing": true,
                "bServerSide": true,
                "order": [
                    [1, "desc"]
                ],
                "autoWidth": false,
                "ajax": {
                    url: "{{ url('') }}/report/plastic/data",
                    // type: "post",
                    data: function(d) {
                        d.brand = brand;
                        d.product = product;
                        d.material = material;
                        return d
                    }
                },
            });

            // if ($('#dataTable').length) {
            //     let url = '/report/plastic';
            //     let rowData = [{
            //             data: 'id',
            //             name: 'id'
            //         },
            //         {
            //             data: 'date',
            //             name: 'date'
            //         },
            //         {
            //             data: 'product',
            //             name: 'product'
            //         },
            //         {
            //             data: 'material',
            //             name: 'material'
            //         },
            //         {
            //             data: 'total',
            //             name: 'total'
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //             orderable: false,
            //             sortable: false
            //         },
            //     ];
            //     table = $("#dataTable").DataTable({
            //         dom: 'Brtp',
            //         searching: false,
            //         paging: true,
            //         responsive: false,
            //         autoWidth: false,
            //         bPaginate: true,
            //         processing: true,
            //         serverSide: true,
            //         order: [0, 'desc'],
            //         oLanguage: {
            //             oPaginate: {
            //                 sNext: '<span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
            //                 sPrevious: '<span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
            //             }
            //         },
            //         ajax: {
            //             url: url,
            //             data: function(d) {
            //                 d.id = $('input[name=stock_id]').val()
            //                 d.date = $('input[name=date]').val()
            //                 d.product = $('select[name=products]').val()
            //                 d.material = $('select[name=material]').val()
            //                 d.total = $('input[name=total]').val()
            //             },
            //         },
            //         columns: rowData
            //     });
            // }
            $('.input-filter').on('keyup change', function() {
                table.draw();
            })
            $('#print-all').click(printAll);

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
                        $('form#delete-plastic').submit();
                    }
                })
            });

        });

        function printAll() {
            $('#dataTable_wrapper .buttons-print').click();
        }
        $('.product-plastic').on('change', function() {
            let productId = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('api.get_plastic.by.product_id', '') }}" + '/' + productId,
                dataType: "json",
                success: function(response) {
                    let html = ``;
                    html +=
                        `<option selected="selected" disabled>-- Pilih Jenis Plastik --</option>`;
                    response.materials.forEach(material => {
                        html +=
                            `<option value="${ material.id }">${ material.name } | stock: ${material.stock}</option>`;
                    });
                    $('#material').html(html);
                }
            });
        });

        $('.material-plastic').on('change', function() {
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
    </script>
@endpush
