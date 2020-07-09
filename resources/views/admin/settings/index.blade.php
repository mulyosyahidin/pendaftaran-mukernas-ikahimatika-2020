@extends('layouts.admin')
@section('title', 'Pengaturan Situs')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan Situs</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Pengaturan</div>
            </div>
        </div>

        <div class="section-body">
            @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
            @endif


            <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Umum</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama:</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', getSiteName()) }}" id="name" required="required">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="submit" class="btn btn-primary" value="Simpan">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Logo</h5>
                            </div>
                            <div class="card-body">
                                @if (isset($logo->media[0]))
                                <div class="form-group text-center">
                                    <img src="{{ $logo->media[0]->getFullUrl() }}" class="img-fluid">
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="logo">Logo:</label>
                                    <input type="file" class="form-control" id="logo" name="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection