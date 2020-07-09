@extends('layouts.registrant')
@section('title', 'Dasbor '. getSiteName())

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dasbor</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('reg.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Selamat Datang</div>
        </div>
      </div>

      <div class="section-body">
        @if (Session::has('loginHello'))
            <h2 class="section-title">
                {{ Session::get('loginHello') }}
            </h2>
        @endif

        <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h5 class="card-title">Dasbor Saya</h5>
                  </div>
                  <div class="card-body">
                      @if (Session::has('success'))
                      <div class="alert alert-success">
                          Terima kasih telah mendaftar di {{ getSiteName() }}.
                          Silahkan kirimkan biaya pendaftaran untuk menyelesaikan pendaftaran.
                      </div>

                      <div class="text-center">
                        <a href="{{ route('reg.help.banks') }}" class="btn btn-info btn-sm">Lihat Daftar Rekening</a>
                        <a href="{{ route('reg.help.contacts') }}" class="btn btn-success btn-sm">Kontak Bantuan</a>
                      </div>
                      @else
                      <p>Selamat datang di dasbor {{ getSiteName() }}</p>
                      @endif

                      @if (\Carbon\Carbon::parse(Auth::user()->created_at)->addDay(3) < \Carbon\Carbon::now())
                        @if (Auth::user()->data->registration_status == 2)
                          <span class="font-weight-bold">
                            Sepertinya kamu belum mengirimkan pembayaran?
                          </span>
                          <div>
                            Sudah 3 hari, segera kirimkan pembayaran ke
                            <a href="{{ route('reg.help.banks') }}" target="_blank">rekening berikut</a> dan kirimkan bukti pembayaran
                            ke nomor kontak <a href="{{ route('reg.help.contacts') }}" target="_blank">berikut.</a>
                            <br>
                            Admin akan mengirimkan <i>link konferensi</i> ke email yang kamu daftarkan (pastikan email sudah benar,
                            konfirmasi ke admin jika terdapat kesalahan)
                          </div>
                        @endif
                      @endif
                  </div>
                  <div class="card-footer">
                      <ul class="list-group">
                          <li class="list-group-item active">Link</li>
                          <li class="list-group-item">
                              <a href="{{ route('reg.data') }}">Data Pendaftaran</a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('reg.status') }}">Status Pendaftaran</a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection