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

            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($reminders as $item)
                        <div class="swiper-slide">
                            <div class="card card-home">

                                <div class="card-body shadow text-center bg-image-card" style="height: 150px; background-image: url('{{ asset('images/bg-card-home-2.svg') }}'), linear-gradient(180deg, #fff 0%, #a1e9ff69 100%);">
                                    {{-- <div class="buble buble4" style="background: #fff;"></div> --}}
                                    <h6 class="text-red">--> Stuffing Selanjutnya <--</h6>
                                    {{-- <h6 class="text-red"></h6> --}}
                                    <h6 class="pt-2">{{ $item->material->product->brand->name . ' / ' . $item->material->name . ' / ' . $item->material->product->size }}
                                    </h6>

                                    {{-- <div class="row justify-content-center mb-2">
                                        <div class="col-auto">
                                            <div class="text-red px-2 font-40px font-weight-bold border border-danger">
                                                {{ $stock_semifinish }}</div>
                                        </div>
                                    </div> --}}
                                    <p>Tanggal: {{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</p>
                                    <p class="text-blue">Total: {{ $item->total }}</p>
                                    {{-- <p class="text-red text-card-top d-sm-inline-block" style="line-height: 150%">Jumlah
                                        stok
                                        otomatis akan
                                        berkurang setelah selesai laporan jumlah Stuffing
                                    </p> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <div class="container-omyra pb-5 mb-5">
        <h4 class="font-weight-bold font-20 pb-4">Laporan</h4>
        {{-- Desktop View --}}
        <div class="d-none d-md-block">
            <div class="row mb-2 px-2">
                <div class="col-sm">
                    <div class="card mb-1px shadow-lg"
                        style="border-radius: 50px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                        <a href="{{ route('frontend.report.plastic.index') }}">
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
                        <a href="{{ route('frontend.report.inner.index') }}">
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
                        <a href="{{ route('frontend.report.master.index') }}">
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
                        <a href="{{ route('frontend.report.semifinish.index') }}">
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
                        <a href="{{ route('frontend.report.finish.index') }}">
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
                <a href="{{ route('frontend.report.plastic.index') }}">
                    <div class="rounded-circle border-2 circle--menu shadow-lg"
                        style="display: flex; align-items: center; justify-content: center; height: 60px; width: 60px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                        <div class="text-success">
                            <img src="{{ asset('images/icon/plastic.png') }}" alt="" height="30" width="30">
                        </div>
                    </div>
                    <div class="text-center text-black text-card-top font-size-12 pt-2 d-sm-inline-block"
                        style="line-height: 150%;">
                        Plastik
                    </div>
                </a>
                <a href="{{ route('frontend.report.inner.index') }}">
                    <div class="rounded-circle border-2 circle--menu shadow-lg"
                        style="display: flex; align-items: center; justify-content: center; height: 60px; width: 60px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                        <div class="text-success">
                            <img src="{{ asset('images/icon/inner.png') }}" alt="" height="30" width="30">
                        </div>
                    </div>
                    <div class="text-center text-black text-card-top font-size-12 pt-2 d-sm-inline-block"
                        style="line-height: 150%;">
                        Inner
                    </div>
                </a>
                <a href="{{ route('frontend.report.master.index') }}">
                    <div class="rounded-circle border-2 circle--menu shadow-lg"
                        style="display: flex; align-items: center; justify-content: center; height: 60px; width: 60px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                        <div class="text-success">
                            <img src="{{ asset('images/icon/master.png') }}" alt="" height="30" width="30">
                        </div>
                    </div>
                    <div class="text-center text-black text-card-top font-size-12 pt-2 d-sm-inline-block"
                        style="line-height: 150%;">
                        Master
                    </div>
                </a>
                <a href="{{ route('frontend.report.semifinish.index') }}">
                    <div class="rounded-circle border-2 circle--menu shadow-lg"
                        style="display: flex; align-items: center; justify-content: center; height: 60px; width: 60px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                        <div class="text-success">
                            <img src="{{ asset('images/icon/semifinish.png') }}" alt="" height="30" width="30">
                        </div>
                    </div>
                    <div class="text-center text-black text-card-top font-size-12 pt-2 d-sm-inline-block"
                        style="line-height: 150%;">
                        Borongan
                    </div>
                </a>
                <a href="{{ route('frontend.report.finish.index') }}">
                    <div class="rounded-circle border-2 circle--menu shadow-lg"
                        style="display: flex; align-items: center; justify-content: center; height: 60px; width: 60px; box-shadow: 3px 3px 20px 2px rgba(128, 128, 128, 0.322);">
                        <div class="text-success">
                            <img src="{{ asset('images/icon/finish.png') }}" alt="" height="30" width="30">
                        </div>
                    </div>
                    <div class="text-center text-black text-card-top font-size-12 pt-2 d-sm-inline-block"
                        style="line-height: 150%;">
                        Stuffing
                    </div>
                </a>
            </div>
        </div>
        {{-- Mobile View End --}}


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
                    <div class="d-inline-block font-14" style="color: #BBBBBB">Tanggal: {{ $item->created_at }}</div>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center py-3">
            {{-- {{ $log->links('pagination::bootstrap-4') }} --}}
            <a href="{{ route('frontend.notification.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua Aktivitas
            <i class="fa fa-arrow-right"></i>
            </a>
        </div>

    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endpush
