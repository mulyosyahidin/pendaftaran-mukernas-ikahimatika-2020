@extends('layouts.admin')
@section('title', 'Dasbor Admin')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fa fa-calendar-day text-white fa-2x"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pendaftar Hari Ini</h4>
                        </div>
                        <div class="card-body">
                            {{ $registrantToday }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fa fa-calendar-week fa-2x text-white"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Minggu Ini</h4>
                        </div>
                        <div class="card-body">
                            {{ $weekRegistrant }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fa fa-calendar-alt fa-2x text-white"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            0
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pendaftar</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalRegistrant }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Jumlah Pendaftar</h4>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group">
                          <li class="list-group-item border-top-0">
                            Semua Pendaftar
                            <span class="badge float-right badge-primary">{{ $totalRegistrant }}</span>
                          </li>
                          <li class="list-group-item border-top-0">
                            Menunggu Verifikasi Berkas
                            <span class="badge badge-info float-right">{{ $waitingForVerification }}</span>
                          </li>
                          <li class="list-group-item border-top-0">
                              Menunggu Pembayaran
                              <span class="badge btn-warning float-right">{{ $waitingForPayment }}</span>
                          </li>
                          <li class="list-group-item border-top-0">
                              Pendaftaran Selesai
                              <span class="badge btn-success float-right">{{ $finishedRegistrant }}</span>
                          </li>
                          <li class="list-group-item border-top-0">
                              Pendaftaran Gagal
                              <span class="badge btn-danger float-right">{{ $failedRegistrant }}</span>
                          </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Menunggu Verifikasi Berkas</h5>
                    </div>
                    @if (count($fileVerifications) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Terdaftar pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fileVerifications as $file)
                                <tr>
                                    <th scope="row">{{ $file->id }}</th>
                                    <td><a href="{{ route('admin.reg.show', $file->id) }}">{{ $file->user->name }}</a></td>
                                    <td>{{ \Carbon\Carbon::parse($file->created_at)->format('l, d M Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="card-body">
                        <div class="alert alert-info">
                            Tidak ada data untuk ditampilkan.
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Menunggu Pembayaran</h5>
                    </div>
                    @if (count($paymentVerifications) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Terdaftar pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fileVerifications as $file)
                                <tr>
                                    <th scope="row">{{ $file->id }}</th>
                                    <td><a href="{{ route('admin.reg.show', $file->id) }}">{{ $file->user->name }}</a></td>
                                    <td>{{ \Carbon\Carbon::parse($file->created_at)->format('l, d M Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="card-body">
                        <div class="alert alert-info">
                            Tidak ada data untuk ditampilkan.
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </section>
</div>
@endsection
