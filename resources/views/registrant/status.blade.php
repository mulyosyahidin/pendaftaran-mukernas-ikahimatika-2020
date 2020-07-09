@extends('layouts.registrant')
@section('title', 'Status Pendaftaran Saya')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Status Pendaftaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('reg.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Status Pendaftaran</div>
            </div>
        </div>

        <div class="section-body">
            @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Status pendaftaran saat ini: <u>{{ $status->name }}</u>
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="wizard-steps">
                                <div class="wizard-step wizard-step-success">
                                    <div class="wizard-step-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Pendaftaran Akun
                                    </div>
                                </div>
                                @if ($status->id == 1)
                                <div class="wizard-step wizard-step-active">
                                @else
                                <div class="wizard-step wizard-step-success">
                                @endif
                                    <div class="wizard-step-icon">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Verifikasi Berkas Pendaftaran
                                    </div>
                                </div>

                                @if ($status->id == 3)
                                <div class="wizard-step wizard-step-success">
                                @else
                                <div class="wizard-step wizard-step-active">
                                @endif
                                    <div class="wizard-step-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Pembayaran
                                    </div>
                                </div>

                                @if ($status->id == 3)
                                <div class="wizard-step wizard-step-success">
                                @else
                                <div class="wizard-step wizard-step-active">
                                @endif
                                    <div class="wizard-step-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Pendaftaran Selesai
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            @if ($status->id == 1)
                            <p class="text-muted">
                                <div class="alert alert-info">
                                    Admin akan memverifikasi berkas pendaftaran Anda.
                                    Mohon tunggu sampai berkas pendaftaran terverifikasi dan segera lakukan pembayaran.
                                </div>
                            </p>
                            @elseif($status->id == 2)
                            <p class="text-muted">
                                Kirimkan pembayaran sebesar <b>Rp 25.000</b> ke nomor rekening berikut:

                                <div class="table-responsive mb-3">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Nama Bank</th>
                                                <th scope="col">No. Rekening</th>
                                                <th scope="col">Nama Pemilik</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($banks as $bank)
                                                <tr>
                                                    <td>{{ $bank->bank_name }}</td>
                                                    <td>{{ $bank->bank_number }}</td>
                                                    <td>{{ $bank->owner_name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-2 mb-1">
                                    Kemudian kirimkan bukti pembayaran ke salah satu kontak berikut.
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Nama</th>
                                                <th scope="col">No. WhatsApp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contacts as $contact)
                                                <tr>
                                                    <td>{{ $contact->name }}</td>
                                                    <td>{{ $contact->whatsapp_number }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </p>
                            @elseif($status->id == 3)
                            <p class="text-muted">
                                <div class="alert alert-info">
                                    Terima kasih, admin telah memverifikasi pembayaran.
                                    <br>
                                    Kami akan mengirimkan <i>conference link</i> ke email yang terdaftar (pastikan email sudah benar, jika salah, silahkan hubungi admin)
                                </div>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection