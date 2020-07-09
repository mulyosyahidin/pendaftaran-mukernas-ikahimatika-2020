@extends('layouts.admin')
@section('title', 'Export Data Pendaftaran')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Export Data</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.reg.all') }}">Data Pendaftaran</a></div>
                <div class="breadcrumb-item">Export Data</div>
            </div>
        </div>

        <div class="section-body">
            @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
            @endif

            <form action="{{ route('admin.reg.export-data') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="data">Ekspor:</label>
                                    <select name="data" id="data" class="form-control">
                                        <option value="all">Semua Data</option>
                                        <option value="1">Menunggu Verifikasi Berkas</option>
                                        <option value="2">Menunggu Pembayaran</option>
                                        <option value="3">Pendaftaran Selesai</option>
                                        <option value="4">Pendaftaran Gagal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" value="Ekspor">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
</div>
@endsection
