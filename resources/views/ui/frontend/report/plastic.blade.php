@extends('ui.frontend.layouts.app')
@push('styles')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/multi-select/css/multi-select.css') }}"> --}}
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
                <a href="{{ route('frontend.dashboard.index') }}">
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
            <form action="#" method="POST" enctype="multipart/form-data" class="myform" id="form-filter">
                @csrf
                <div class="form-group">
                    <label class="font-weight-500">Brand</label>
                    <select
                        class="select2 form-control font-size-16 form-omyra brand-plastic {{ $errors->has('brand') ? 'is-invalid' : '' }}"
                        id="filter-brand" name="brand">
                        <option selected disabled>-- Pilih Brand --</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">
                                {{ $brand->name }}
                            </option>
                        @endforeach
                        @if ($errors->has('brand'))
                            <span class="invalid-feedback" role="alert">
                                <p><b>{{ $errors->first('brand') }}</b></p>
                            </span>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-500">Jenis / Ukuran </label>
                    <select
                        class="select2 form-control font-size-16 form-omyra product-plastic material-show {{ $errors->has('product') ? 'is-invalid' : '' }}"
                        id="filter-material" name="product">
                        <option selected disabled>-- Pilih Brand Dulu --</option>
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label class="font-weight-500">Jenis</label>
                    <select
                        class="select2 form-control font-size-16 form-omyra material-plastic {{ $errors->has('material') ? 'is-invalid' : '' }}"
                        id="filter-material" name="material">
                        <option selected="selected" disabled>-- Pilih Ukuran Dulu --</option>
                    </select>
                </div> --}}
                <button class="btn btn-sm btn-info float-right mb-3" type="submit">Submit</button>
                <button type="reset" class="btn btn-sm btn-outline-secondary btn-reset mb-3">Reset</button>
            </form>

            <hr>
            <div class="row justify-content-center mb-2">
                <div class="col-auto">
                    <div id="max-label" class="text-red px-2 font-30px font-weight-bold border border-danger"></div>
                </div>
            </div>
            {{-- <h5 class="py-3"></h5> --}}
            {{-- <hr>
            <div class="py-3 d-flex justify-content-center">
                <a href="#" class="btn btn-sm btn-success mr-3">
                    <i class="fas fa-download"></i>
                    Download Excel
                </a>
                <button class="btn btn-sm btn-outline-info" id="print-all">
                    <i class="fa fa-print"></i>
                    Print
                </button>
            </div> --}}
            <table id="main-table" class="table table-striped table-bordered table-responsive" style="width:100%"></table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
    {{-- <script src="{{ asset('vendor/multi-select/js/jquery.multi-select.js') }}"></script><!-- Multi Select Plugin Js -->
    <script src="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script> --}}
    <script>
        $(function() {
            // $('#dataTable').DataTable();

            let list_stock_plastic = [];


            const table = $('#main-table').DataTable({
                "destroy": true,
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "{{ url('') }}/report/plastic/data",
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    type: "post",
                    data: function(d) {
                        d.brand = $("#filter-brand").val()
                        d.product = $("#filter-product").val()
                        d.material = $("#filter-material").val()
                    }
                },
                "columns": [{
                        title: "No",
                        width: "5%",
                        searchable: false,
                        orderable: false,
                        data: null,
                        render: (data, type, full, meta) => meta.row + 1
                    },
                    {
                        title: "Tanggal",
                        name: "date",
                        data: 'date'
                    },
                    {
                        title: "Brand",
                        name: "brand",
                        data: null,
                        render: (data) => {
                            if (!data.material || !data.material.product || !data.material.product
                                .brand) {
                                return '-'
                            }
                            return `${data.material.product.brand.name}`
                        }
                    },
                    {
                        title: "Jenis / Ukuran",
                        name: "type",
                        data: null,
                        render: (data) => {
                            if (data.material) {
                                return `${data.material.name} / ${data.material.product.size}`
                            }
                            return '-'
                        }
                    },
                    {
                        title: "Jumlah Masuk",
                        name: "count",
                        data: 'total',
                        render: (data) => data ? formatRupiah(data.toString()) : 0
                    },
                    // {
                    //     title: "Sisa Stok",
                    //     name: "stock",
                    //     data: null,
                    //     render: (data) => data ? formatRupiah(data.material.stock.toString()) : 0
                        // render : (data) => {
                        // 	if (data.material) {
                        // 		return  formatRupiah( data.material.stock.toString()) : 0
                        // 	}
                        // 	return '-'
                        // }
                    // },
                    // {title : "Action", searchable: false, orderable : false},
                ]
            });

            $(document).on('click', '.btn-reset', function(e) {
                e.preventDefault()
                $('#filter-brand').val('')
                $('#filter-material').val('')
                table.ajax.reload()
            })

        });
        $('.brand-plastic').on('change', function() {
            let brandId = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('api.get_plastic.by.brand_id', '') }}" + '/' + brandId,
                dataType: "json",
                success: function(response) {
                    let html = ``;
                    html +=
                        `<option selected="selected" disabled>-- Pilih Jenis / Ukuran --</option>`;
                    response.data.forEach(item => {
                        html +=
                            `<option value="${ item.id }">${item.name} / ${ item.product.size }</option>`;
                    });
                    $('#filter-material').html(html);
                }
            });
        });

        // $('.product-plastic').on('change', function() {
        //     let productId = $(this).val();
        //     $.ajax({
        //         type: "GET",
        //         url: "{{ route('api.get_plastic.by.product_id', '') }}" + '/' + productId,
        //         dataType: "json",
        //         success: function(response) {
        //             let html = ``;
        //             html +=
        //                 `<option selected="selected" disabled>-- Pilih Jenis Plastik --</option>`;
        //             response.materials.forEach(material => {
        //                 html +=
        //                     `<option value="${ material.id }">${ material.name } | stock: ${material.stock}</option>`;
        //             });
        //             $('#filter-material').html(html);
        //         }
        //     });
        // });

        $('.material-show').on('change', function() {
            let materialId = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('api.show.material', '') }}" + '/' + materialId,
                dataType: "json",
                success: function(response) {
                    let material = response.material;
                    // console.log(typeof(material.stock));
                    if (material != null) {
                        $('#max-label').html('Sisa stok: ' + material.stock);
                        // $('#total').attr('max', material.stock);
                    } else {
                        $('#max-label').html('');
                    }
                }
            });
        });


        $(document).on('submit', '#form-filter', function(e) {
            e.preventDefault()
            $("#main-table").DataTable().ajax.reload(null, false);
        })
    </script>
@endpush
