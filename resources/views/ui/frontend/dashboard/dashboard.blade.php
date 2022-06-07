@extends('ui.frontend.layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
@endpush
@section('content')
    <div class="home-card mb-37">
        <div class="buble buble1"></div>
        <div class="buble buble2"></div>
        <div class="container-omyra" style="position: relative">
            <div class="row justify-content-between pt-3 mb-41">
                <div class="row">
                    <div class="ml-25 mr-5px">
                        <img src="{{ asset('images/logo.png') }}" alt="m-health" width="100px" height="31px">
                    </div>
                </div>
                <div class="mr-15">
                    <a href="{{ route('frontend.notification.index') }}">
                        <img src="{{ asset('images/icon/notification.png') }}" width="25" height="25">
                    </a>
                    {{-- <a href="">
                        <img src="{{ asset('images/logout.png') }}" width="25" height="25">
                    </a> --}}
                    {{-- <i class="fas fa-bell fa-lg text-white"></i> --}}
                </div>
            </div>
            <div class="text-white mb-34" style="position: relative;">
                <div>Halo,</div>
                <h4 class="d-block font-weight-bold">{{ Auth::user()->name }}</h4>
            </div>


            <div class="card card-home">
                <div class="card-body shadow text-center" style="height: 150px">
                    <h6>Total Stok Barang 1/2 Jadi</h6>
                    <div class="row justify-content-center mb-2">
                        <div class="col-auto">
                            <div class="text-red px-2 font-40px font-weight-bold border border-danger">
                                {{ $stock_semifinish }}</div>
                        </div>
                    </div>
                    <p class="text-red text-card-top d-sm-inline-block" style="line-height: 150%">Jumlah stok otomatis akan
                        berkurang setelah selesai laporan jumlah Stuffing
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-omyra pb-5 mb-5">
        <h4 class="font-weight-bold font-20 py-4">Laporan</h4>
        {{-- Desktop View --}}
            <div class="d-none d-md-block">
                <div class="row mb-2 px-2">
                    <div class="col-sm">
                        <div class="card mb-1px shadow-lg"
                            style="border-radius: 50px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                            <a href="">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('images/icon/plastic.png') }}" alt="" height="50" width="50">
                                    </div>
                                    <div class="font-weight-bold text-black text-center">Plastik</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card mb-1px shadow-lg"
                            style="border-radius: 50px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                            <a href="">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('images/icon/inner.png') }}" alt="" height="50" width="50">
                                    </div>
                                    <div class="font-weight-bold text-black text-center">Inner</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card mb-1px shadow-lg"
                            style="border-radius: 50px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                            <a href="">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('images/icon/master.png') }}" alt="" height="50" width="50">
                                    </div>
                                    <div class="font-weight-bold text-black text-center">Master</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card mb-1px shadow-lg"
                            style="border-radius: 50px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                            <a href="">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('images/icon/semifinish.png') }}" alt="" height="50" width="50">
                                    </div>
                                    <div class="font-weight-bold text-black text-center">Borongan</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card mb-1px shadow-lg"
                            style="border-radius: 50px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                            <a href="">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('images/icon/finish.png') }}" alt="" height="50" width="50">
                                    </div>
                                    <div class="font-weight-bold text-black text-center">Stuffing</div>
                                </div>
                            </a>
                        </div>
                        {{-- <p class="text-center font-xs lh-15">Inner Box</p> --}}
                    </div>
                </div>
            </div>
        {{-- Desktop View End --}}

        {{-- Mobile View --}}
            <div class="d-block d-md-none">
                <div class="d-flex justify-content-around mb-3">
                    <a href="">
                        <div class="rounded-circle border-2 circle--menu shadow-lg">
                            <div class="text-success">
                                <img src="{{ asset('images/icon/plastic.png') }}" alt="" height="30" width="30">
                            </div>
                        </div>
                        <div class="text-center text-black font-size-12 pt-2 d-sm-inline-block" style="line-height: 1.2;">
                            Plastik
                        </div>
                    </a>
                    <a href="">
                        <div class="rounded-circle border-2 circle--menu shadow-lg">
                            <div class="text-success">
                                <img src="{{ asset('images/icon/inner.png') }}" alt="" height="30" width="30">
                            </div>
                        </div>
                        <div class="text-center text-black font-size-12 pt-2 d-sm-inline-block" style="line-height: 1.2;">
                            Inner
                        </div>
                    </a>
                    <a href="">
                        <div class="rounded-circle border-2 circle--menu shadow-lg">
                            <div class="text-success">
                                <img src="{{ asset('images/icon/master.png') }}" alt="" height="30" width="30">
                            </div>
                        </div>
                        <div class="text-center text-black font-size-12 pt-2 d-sm-inline-block" style="line-height: 1.2;">
                            Master
                        </div>
                    </a>
                    <a href="">
                        <div class="rounded-circle border-2 circle--menu shadow-lg">
                            <div class="text-success">
                                <img src="{{ asset('images/icon/semifinish.png') }}" alt="" height="30" width="30">
                            </div>
                        </div>
                        <div class="text-center text-black font-size-12 pt-2 d-sm-inline-block" style="line-height: 1.2;">
                            Borongan
                        </div>
                    </a>
                    <a href="">
                        <div class="rounded-circle border-2 circle--menu shadow-lg">
                            <div class="text-success">
                                <img src="{{ asset('images/icon/finish.png') }}" alt="" height="30" width="30">
                            </div>
                        </div>
                        <div class="text-center text-black font-size-12 pt-2 d-sm-inline-block" style="line-height: 1.2;">
                            Stuffing
                        </div>
                    </a>
                </div>
            </div>
        {{-- Mobile View End--}}


        <h4 class="font-weight-bold font-20 mt-5">Aktivitas Terbaru</h4>

        @foreach ($log as $item)
            <hr>
            <div class="d-flex">
                {{-- <div class="mr-19 h-94 w-94 d-inline-block">
                <img src="https://omyraglobal.com/public/uploads/galleries/1643357598jweyy9.jpg" class="rounded-4" width="94" height="94">
            </div> --}}
                <div class="w-251 d-inline-block">
                    <div class="text-pink d-inline-block">{{ $item->user->name }}</div>
                    <div class="font-weight-500 line-height-23 font-18px d-inline-block">
                        {{ $item->description }}
                    </div>
                    <div class="d-inline-block font-14" style="color: #BBBBBB">{{ $item->created_at }}</div>
                </div>
            </div>
        @endforeach


    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endpush
