<!doctype html>
<html lang="en">
  @include('components.frontend.head')
  <body>
    <div class="box-shadow">
        <div class="col-12 shadow-lg">
            <div class="py-3">
                <a href="{{ route('frontend.dashboard.ceo') }}">
                    <img src="{{ asset('images/icon/back.png') }}" width="18" height="18">
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="text-header font-size-18 text-active-pink font-weight-500">Data Jenis Brand</div>
            </div>
        </div>
    </div>
    <div class="bg-grey pt-23 mt-1" style="max-height: 86vh; overflow: scroll;">
        {{-- @include('components.frontend.flashmessage') --}}
        <div class="container-omyra" style="margin-bottom: 90px;">

            <h5 class="py-3"></h5>

            <table id="dataTable" class="table table-striped table-bordered table-responsive" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Brand / Ukuran</th>
                        <th>Jenis Brand</th>
                        <th>Jenis</th>
                        <th>Stok</th>
                        <th>Tanggal</th>
                        <th>Dibuat Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->brand->name . '/' . $item->product->size }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                            <td>{{ $item->user->name }}</td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Brand / Ukuran</th>
                        <th>Jenis Brand</th>
                        <th>Jenis</th>
                        <th>Stok</th>
                        <th>Tanggal</th>
                        <th>Dibuat Oleh</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="bottom-nav">
        <div class="d-flex justify-content-around">
            <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.dashboard.ceo']) ? 'active' : '' }}" href="{{ route('frontend.dashboard.ceo') }}">
                <div class="text-light-pink {{ request()->routeIs(['frontend.dashboard.ceo']) ? 'text-active-pink' : '' }}">
                    <i class="fas fa-home h-40 p-0 m-0"></i>
                </div>
                <p class="font-xs text-light-pink p-0 m-0 {{ request()->routeIs(['frontend.dashboard.ceo']) ? 'text-active-pink' : '' }}">Home</p>
            </a>

            <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.profile.edit']) ? 'active' : '' }}" href="{{ route('frontend.profile.edit') }}">
                <div class="text-light-pink {{ request()->routeIs(['frontend.profile.edit']) ? 'text-active-pink' : '' }}">
                    <i class="fa fa-user h-40 p-0 m-0"></i>
                </div>
                <p class="font-xs text-light-pink p-0 m-0 {{ request()->routeIs(['frontend.profile.edit']) ? 'text-active-pink' : '' }}">Akun</p>
            </a>
        </div>
    </div>


    @include('components.frontend.scripts')
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
                        $(`form#delete-inner-${id}`).submit();
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
  </body>
</html>

