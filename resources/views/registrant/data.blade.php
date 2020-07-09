@extends('layouts.registrant')
@section('title', 'Data Pendaftaran Saya')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Pendaftaran</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('reg.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Data Pendaftaran</div>
        </div>
      </div>

      <div class="section-body">
        @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Saya</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <td>Nama</td>
                                <td><b>{{ Auth::user()->name }}</b></td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td><b>{{ Auth::user()->data->nim }}</b></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><b>{{ Auth::user()->email }}</b></td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td><b>{{ Auth::user()->data->phone_number }}</b></td>
                            </tr>
                            <tr>
                                <td>No. WhatsApp</td>
                                <td><b>{{ Auth::user()->data->whatsapp_number }}</b></td>
                            </tr>
                            <tr>
                                <td>Terdaftar pada</td>
                                <td><b>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('l, d M Y H:i') }}</b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Universitas</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <td>Wilayah</td>
                                <td><b>
                                    @if (isset($registrant->region->name) && $registrant->region->name !== '')
                                        {{ $registrant->region->name }}
                                    @else
                                        -
                                    @endif
                                </b></td>
                            </tr>
                            <tr>
                                <td>Universitas</td>
                                <td><b>
                                    @if (isset($registrant->university->name) && $registrant->university->name !== '')
                                        {{ $registrant->university->name }}
                                    @else
                                        {{ $registrant->custom->university_name }}
                                    @endif
                                </b></td>
                            </tr>
                            <tr>
                                <td>Himpunan</td>
                                <td><b>
                                    @if (isset($registrant->organization->name) && $registrant->organization->name !== '')
                                        {{ $registrant->organization->name }}
                                    @else
                                        {{ $registrant->custom->organization_name }}
                                    @endif
                                </b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
@endsection