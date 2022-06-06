@extends('ui.frontend.layouts.app')
@push('css')
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

    .pagination a:hover:not(.active) {background-color: #ddd;}
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
                            <div class="text-red px-2 font-40px font-weight-bold border border-danger">{{ $stock_semifinish }}</div>
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
        <div class="row mb-2 px-2">
            <div class="col-6">
                <div class="rounded bg-green mb-1px">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-archive fa-2x text-white"></i>
                        </div>
                        <div class="font-weight-bold text-white text-center">{{ $total_inner }}</div>
                    </div>
                </div>
                <p class="text-center font-xs lh-15">Inner Box</p>
            </div>
            <div class="col-6">
                <div class="rounded bg-blue mb-1px">
                    <div class="card-body ">
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-cube fa-2x text-white"></i>
                        </div>
                        <div class="font-weight-bold text-white text-center">{{ $total_master }}</div>
                    </div>
                </div>
                <p class="text-center font-xs lh-15">Master Carton</p>
            </div>
            <div class="col-6">
                <div class="rounded bg-red mb-1px">
                    <div class="card-body ">
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-cubes fa-2x text-white"></i>
                        </div>
                        <div class="font-weight-bold text-white text-center">{{ $stock_finish }}</div>
                        {{-- <img src="{{ asset('images/icon/catatan.png') }}" width="30" height="30"> --}}
                        {{-- <i class="fas fa-list-ul fa-2x text-white"></i> --}}
                    </div>
                </div>
                <p class="text-center font-xs lh-15">Barang Jadi</p>
            </div>
            <div class="col-6">
                <div class="rounded bg-yellow mb-1px">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-archive fa-2x text-white"></i>
                        </div>
                        <div class="font-weight-bold text-white text-center">{{ $total_plastic }}</div>
                        {{-- <i class="fas fa-user-md fa-2x text-white"></i> --}}
                    </div>
                </div>
                <p class="text-center font-xs lh-15">Plastik</p>
            </div>
        </div>

        <h4 class="font-weight-bold font-20 mt-4">Aktivitas Terbaru</h4>

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
