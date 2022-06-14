@extends('ui.admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="d-none d-md-block">
                            <h1 class="m-0">Selamat Datang Admin</h1>
                        </div>
                        <div class="d-block d-md-none">
                            <h1 class="m-0 text-center">Selamat Datang Admin</h1>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="d-none d-md-block">
                    <div class="row">
                        <div class="col-2">
                            <div class="card bg-red">
                                <div class="card-body text-center">
                                    <i class="fa fa-user"></i>
                                    <h4>Total Brand</h4>
                                    <h6>15</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card bg-blue">
                                <div class="card-body text-center">
                                    <i class="fa fa-archive"></i>
                                    <h4>Total Plastik</h4>
                                    <h6>15</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card bg-green">
                                <div class="card-body text-center">
                                    <i class="fa fa-user"></i>
                                    <h4>Total Inner</h4>
                                    <h6>15</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card bg-white">
                                <div class="card-body text-center">
                                    <i class="fa fa-user"></i>
                                    <h4>Total Master</h4>
                                    <h6>15</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card bg-black">
                                <div class="card-body text-center">
                                    <i class="fa fa-cubes"></i>
                                    <h4>Borongan</h4>
                                    <h6>15</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card bg-yellow">
                                <div class="card-body text-center">
                                    <i class="fa fa-cube"></i>
                                    <h4>Barang Jadi</h4>
                                    <h6>15</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-block d-md-none">
                    <div class="card shadow-sm bg-red">
                        <div class="card-body d-flex justify-content-center">
                            <div class="col-4 text-center">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-4">
                                <h6 class="text-center">Total Brand</h6>
                            </div>
                            <div class="col-4">
                                <h5 class="text-center">15</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm bg-blue">
                        <div class="card-body d-flex justify-content-center">
                            <div class="col-4 text-center">
                                <i class="fa fa-archive"></i>
                            </div>
                            <div class="col-4">
                                <h6 class="text-center">Total Plastik</h6>
                            </div>
                            <div class="col-4">
                                <h5 class="text-center">15</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm bg-green">
                        <div class="card-body d-flex justify-content-center">
                            <div class="col-4 text-center">
                                <i class="fa fa-cubes"></i>
                            </div>
                            <div class="col-4">
                                <h6 class="text-center">Total Inner</h6>
                            </div>
                            <div class="col-4">
                                <h5 class="text-center">15</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm bg-white">
                        <div class="card-body d-flex justify-content-center">
                            <div class="col-4 text-center">
                                <i class="fa fa-cube"></i>
                            </div>
                            <div class="col-4">
                                <h6 class="text-center">Total Master</h6>
                            </div>
                            <div class="col-4">
                                <h5 class="text-center">15</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm bg-black">
                        <div class="card-body d-flex justify-content-center">
                            <div class="col-4 text-center">
                                <i class="fa fa-cubes"></i>
                            </div>
                            <div class="col-4">
                                <h6 class="text-center">Borongan</h6>
                            </div>
                            <div class="col-4">
                                <h5 class="text-center">15</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm bg-yellow">
                        <div class="card-body d-flex justify-content-center">
                            <div class="col-4 text-center">
                                <i class="fa fa-cube"></i>
                            </div>
                            <div class="col-4">
                                <h6 class="text-center">Barang Jadi</h6>
                            </div>
                            <div class="col-4">
                                <h5 class="text-center">15</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-3">
                    <h5>Aktivitas Terbaru</h5>
                    <hr>
                </div>
                @foreach ($log as $item)
                    <div class="bd-callout bd-callout-primary shadow-sm">
                        <p style="color: pink">{{ $item->user->name }}</p>
                        <h6>{{ $item->description }}</h6>
                        <p style="color: grey"> {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</p>
                    </div>
                @endforeach

            </div><!-- /.container-fluid -->
            <div class="d-flex justify-content-center py-3">
                {{ $log->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <!-- /.content -->
    </div>
@endsection
