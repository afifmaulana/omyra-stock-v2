@extends('ui.frontend.layouts.app')
@section('content')
    <div class="box-shadow">
        <div class="col-12 shadow shadow-lg">
            <div class="py-3">
                <a href="{{ route('frontend.dashboard.index') }}">
                    <img src="{{ asset('images/icon/back.png') }}" width="18" height="18">
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="text-header font-size-18 text-active-pink font-weight-500">Notifikasi</div>
            </div>
        </div>
    </div>
    <div class="bg-grey mt-1" style="max-height: 86vh; overflow: scroll;">
        <div class="container-omyra" style="margin-bottom: 90px;">
            @foreach ($log as $item)
                <div class="d-flex">
                    <div class="w-251 d-inline-block">
                        <div class="text-pink d-inline-block">{{ $item->user->name }}</div>
                        <div class="font-weight-500 line-height-23 font-18px d-inline-block">
                            {{ $item->description }}
                        </div>
                        <div class="d-inline-block font-14" style="color: #BBBBBB">{{ $item->created_at }}</div>
                    </div>
                </div>
                <hr>
            @endforeach
            <div class="d-flex justify-content-center py-3">
                {{ $log->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
