@extends('layouts.registrant')
@section('title', 'Rekening Bank Pembayaran')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Rekening Bank Pembayaran</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('reg.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('reg.help') }}">Bantuan</a></div>
          <div class="breadcrumb-item">Rekening Bank Pembayaran</div>
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
                    <h5 class="card-title">Rekening Pembayaran</h5>
                </div>
                @if (count($banks) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Bank</th>
                                <th scope="col">Nomor Rekening</th>
                                <th scope="col">Nama Pemilik</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banks as $bank)
                            <tr>
                                <th scope="row">{{ $bank->id }}</th>
                                <td>{{ $bank->bank_name }}</td>
                                <td>{{ $bank->bank_number }}</td>
                                <td>{{ $bank->owner_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="card-body">
                    <div class="alert alert-info">Tidak ada data untuk ditampilkan</div>
                </div>
                @endif
            </div>
          </div>
          <div class="col-md-4">
              <div class="card">
                  <div class="card-header">
                      <h5 class="card-title">Pembayaran</h5>
                  </div>
                  <div class="card-body">
                      <p>
                          Setelah admin memverifikasi berkas pendaftaran kamu, segera lakukan pembayaran
                          sebesar <b>Rp. 25.000</b> ke rekening tersebut.
                          <br>
                          Jika sudah mengirimkan pembayaran, segera lakukan konfirmasi pembayaran ke admin
                          melalui <a href="{{ route('reg.help.contacts') }}">kontak ini</a>.
                      </p>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection