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

		tbody .dt-control{
			background: "images/datatables/details_open.png" no-repeat center center;
			cursor:pointer;
		}
		tbody .dt-control.shown{
			background: "images/datatables/details_close.png" no-repeat center center;
			cursor:pointer;
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
                <button class="btn btn-sm btn-circle btn-outline-primary float-right mr-2"
                data-toggle="modal" data-target="#notes">
                    <i class="fa fa-info"></i>
                </button>
            </div>
            <div class="row justify-content-center">
                <div class="text-header font-size-18 text-active-pink font-weight-500">Laporan Stok Inner</div>
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
                        class="select2 form-control font-size-16 form-omyra brand-inner {{ $errors->has('brand') ? 'is-invalid' : '' }}"
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
                        class="select2 form-control font-size-16 form-omyra product-inner material-show {{ $errors->has('product') ? 'is-invalid' : '' }}"
                        id="filter-material" name="product">
                        <option selected disabled>-- Pilih Brand Dulu --</option>
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label class="font-weight-500">Jenis</label>
                    <select
                        class="select2 form-control font-size-16 form-omyra material-inner {{ $errors->has('material') ? 'is-invalid' : '' }}"
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
            <table id="main-table" class="table table-striped table-bordered table-responsive" style="width:100%"></table>
        </div>
    </div>

        <!-- Modal -->
        <div class="modal fade" id="notes" tabindex="-1" role="dialog" aria-labelledby="notesLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="notesLabel">Catatan Keterangan:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row px-2" style="font-size: 10px;">
                        <div class="square" style="background: red"></div> &nbsp; <span style="color: red">Teks merah</span>&nbsp;  = Data telah Dihapus
                    </div>
                    <div class="row px-2" style="font-size: 10px;">
                        <div class="square" style="background: orange"></div> &nbsp; <span style="color: orange">Teks Oren/Jingga</span>&nbsp;  = Barang dipakai untuk barang jadi (stuffing)
                    </div>
                    <div class="row px-2" style="font-size: 10px;">
                        <div class="square" style="background: green"></div> &nbsp; <span style="color: green">Teks Hijau</span>&nbsp;  = Barang Masuk
                    </div>
                    <div class="row px-2" style="font-size: 10px;">
                        <div class="square" style="background: purple"></div> &nbsp; <span style="color: purple">Teks Ungu</span>&nbsp;  = Barang Reject
                    </div>
                    <div class="row px-2" style="font-size: 10px;">
                        <div class="square" style="background: grey"></div> &nbsp; <span style="color: grey">Teks abu-abu</span>&nbsp;  = Data Dikembalikan karena data barang jadi dihapus
                    </div>
                </div>
                <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                </div>
            </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
    {{-- <script src="{{ asset('vendor/multi-select/js/jquery.multi-select.js') }}"></script><!-- Multi Select Plugin Js -->
    <script src="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script> --}}
    <script>
        $(function() {
            // $('#dataTable').DataTable();
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

            let list_stock_inner = [];

            const table = $('#main-table').DataTable({
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
                "destroy": true,
                "pageLength": 10,
                "processing": false,
                "serverSide": false,
                "ajax": {
                    url: "{{ url('') }}/report/inner/data",
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
				select: {
					selector: 'td:not(:first-child)',
					style: 'os'
				},
                "columns": [
					{
						"className": 'dt-control',
						"orderable": false,
						"data": null,
						"defaultContent": ''
					},
					// {
                    //     title: "No",
                    //     width: "5%",
                    //     searchable: false,
                    //     orderable: false,
                    //     data: null,
                    //     render: (data, type, full, meta) => meta.row + 1
                    // },
                    {
                        title: "Tanggal", name: "date", data: 'date',
                        render: (data) => {
                            if (data) {
                                return data
                            }
                            return '-'
                        }
                    },
                    {
                        title: "Brand", name: "brand", data: null,
                        render: (data) => {
                            if (!data.material || !data.material.product || !data.material.product
                                .brand) {
                                return '-'
                            }
                            return `${data.material.product.brand.name}`
                        }
                    },
                    {
                        title: "Jenis / Ukuran", name: "type", data: null,
                        render: (data) => {
                            if (data.material) {
                                return `${data.material.name} / ${data.material.product.size}`
                            }
                            return '-'
                        }
                    },
                    {
                        title: "Jumlah Masuk", name: "count", data: 'total',
                        render: (data) => data ? formatRupiah(data.toString()) : 0
                    },
                    // {
					// 	title : "Action",
                    //     data : null,
					//     render: (data) => `<a href="{{ route('frontend.report.record.inner') }}" class="btn btn-sm btn-outline-warning"><i class="fa fa-history"></i></a>`,
					// },
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

			table.on('click', 'td.dt-control', function () {
				const tr = $(this).closest('tr');
				const row = table.row(tr);
				if (row.child.isShown()) {
					row.child.hide();
					tr.removeClass('shown');
					$(this).removeClass('shown');
				}
				else {
					row.child(showChildren(row.data())).show();
					tr.addClass('shown');
					$(this).addClass('shown');
                    $(`#child-${row.data().id}`).DataTable({
                    // "destroy": true,
                    "pageLength": 5,
                    "processing": false,
                    "serverSide": false,
                    "searching": false,
                    "orderable": false,
                });
				}
			});


			function showChildren(data) {
				let total = 0
				html = ''
				html += `<table style="width:100%" class="table child-table">`
				html += `	<thead>`
				html += `		<tr class="text-center">`
				html += `			<th>No</th>`
				html += `			<th>Tanggal</th>`
				html += `			<th>Brand</th>`
				html += `			<th>Jenis/Ukuran</th>`
				html += `			<th>Stok Sebelumnya</th>`
				html += `			<th>+/-</th>`
				html += `			<th>Jumlah</th>`
				html += `			<th>Stok Sekarang</th>`
				html += `			<th>Keterangan</th>`
				html += `		</tr>`
				html += `	</thead>`
				html += `	<tbody>`
					data.material.records.forEach((item, key) => {
                        if(item.type == 'Barang Dipakai') {
                            html += `		<tr style="color: orange" class="text-center">`
                            html += `			<td>${key+1}</td>`
                            html += `			<td>${item.date}</td>`
                            html += `			<td>${item.brand.name}</td>`
                            html += `			<td>${item.material.name} / ${item.product.size}</td>`
                            html += `			<td>${item.stock_before ? formatRupiah(item.stock_before.toString()) : 0}</td>`
                            html += `			<td>${item.type_calculation}</td>`
                            html += `			<td>${item.total ? formatRupiah(item.total.toString()) : 0}</td>`
                            html += `			<td>${item.stock_now ? formatRupiah(item.stock_now.toString()) : 0}</td>`
                            html += `			<td>${item.type}</td>`
                            html += `		</tr>`
                        }
                        if(item.type == 'Barang Masuk')
                        {
                            html += `		<tr style="color: green" class="text-center">`
                            html += `			<td>${key+1}</td>`
                            html += `			<td>${item.date}</td>`
                            html += `			<td>${item.brand.name}</td>`
                            html += `			<td>${item.material.name} / ${item.product.size}</td>`
                            html += `			<td>${item.stock_before ? formatRupiah(item.stock_before.toString()) : 0}</td>`
                            html += `			<td>${item.type_calculation}</td>`
                            html += `			<td>${item.total ? formatRupiah(item.total.toString()) : 0}</td>`
                            html += `			<td>${item.stock_now ? formatRupiah(item.stock_now.toString()) : 0}</td>`
                            html += `			<td>${item.type}</td>`
                            html += `		</tr>`
                        }
                        if(item.type == 'Barang Reject')
                        {
                            html += `		<tr style="color: purple; font-style: italic;" class="text-center">`
                            html += `			<td>${key+1}</td>`
                            html += `			<td>${item.date}</td>`
                            html += `			<td>${item.brand.name}</td>`
                            html += `			<td>${item.material.name} / ${item.product.size}</td>`
                            html += `			<td>${item.stock_before ? formatRupiah(item.stock_before.toString()) : 0}</td>`
                            html += `			<td>${item.type_calculation}</td>`
                            html += `			<td>${item.total ? formatRupiah(item.total.toString()) : 0}</td>`
                            html += `			<td>${item.stock_now ? formatRupiah(item.stock_now.toString()) : 0}</td>`
                            html += `			<td>${item.type}</td>`
                            html += `		</tr>`
                        }
                        if(item.type == 'Data Dikembalikan')
                        {
                            html += `		<tr style="color: grey;" class="text-center">`
                            html += `			<td>${key+1}</td>`
                            html += `			<td>${item.date}</td>`
                            html += `			<td>${item.brand.name}</td>`
                            html += `			<td>${item.material.name} / ${item.product.size}</td>`
                            html += `			<td>${item.stock_before ? formatRupiah(item.stock_before.toString()) : 0}</td>`
                            html += `			<td>${item.type_calculation}</td>`
                            html += `			<td>${item.total ? formatRupiah(item.total.toString()) : 0}</td>`
                            html += `			<td>${item.stock_now ? formatRupiah(item.stock_now.toString()) : 0}</td>`
                            html += `			<td>${item.type}</td>`
                            html += `		</tr>`
                        }
                        if(item.type == 'Data Dihapus')
                        {
                            html += `		<tr style="color: red;" class="text-center">`
                            html += `			<td>${key+1}</td>`
                            html += `			<td>${item.date}</td>`
                            html += `			<td>${item.brand.name}</td>`
                            html += `			<td>${item.material.name} / ${item.product.size}</td>`
                            html += `			<td>${item.stock_before ? formatRupiah(item.stock_before.toString()) : 0}</td>`
                            html += `			<td>${item.type_calculation}</td>`
                            html += `			<td>${item.total ? formatRupiah(item.total.toString()) : 0}</td>`
                            html += `			<td>${item.stock_now ? formatRupiah(item.stock_now.toString()) : 0}</td>`
                            html += `			<td>${item.type}</td>`
                            html += `		</tr>`
                        }

						// total += parseInt(item.total)
					})
				html += `	</tbody>`

				html += `	<tfoot>`
                html += `		<tr class="text-center">`
				html += `			<th>No</th>`
				html += `			<th>Tanggal</th>`
				html += `			<th>Brand</th>`
				html += `			<th>Jenis/Ukuran</th>`
				html += `			<th>Stok Sebelumnya</th>`
				html += `			<th>+/-</th>`
				html += `			<th>Jumlah</th>`
				html += `			<th>Stok Sekarang</th>`
				html += `			<th>Keterangan</th>`
				html += `		</tr>`
                html += `	</tfoot>`

				// html += `	<tfoot style="color: red">`
				// html += `		<tr>`
				// html += `			<th colspan="3">Jumlah</th>`
				// html += `			<th>${total}</th>`
				// html += `		</tr>`
				// html += `		<tr>`
				// html += `			<th colspan="3">Total Pengurangan</th>`
				// html += `			<th colspan="3">${data.total} - ${total}</th>`
				// html += `			<th>${parseInt(data.total) - parseInt(total)}</th>`
				// html += `		</tr>`
				// html += `	</tfoot>`
				html += `</table>`
				return html
			}

            $(document).on('click', '.btn-reset', function(e) {
                e.preventDefault()
                $('#filter-brand').val('')
                $('#filter-material').val('')
                table.ajax.reload()
            })

        });
        $('.brand-inner').on('change', function() {
            let brandId = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('api.get_inner.by.brand_id', '') }}" + '/' + brandId,
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

        // $('.product-inner').on('change', function() {
        //     let productId = $(this).val();
        //     $.ajax({
        //         type: "GET",
        //         url: "{{ route('api.get_inner.by.product_id', '') }}" + '/' + productId,
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
                        $('#max-label').html(material ? 'Sisa stok: ' +  formatRupiah(material.stock.toString()) : 0);
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
