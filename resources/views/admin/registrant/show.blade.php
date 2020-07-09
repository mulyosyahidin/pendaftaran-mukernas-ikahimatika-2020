@extends('layouts.admin')
@section('title', $registrant->user->name)

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $registrant->user->name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.reg.all') }}">Data Pendaftaran</a></div>
                <div class="breadcrumb-item">{{ $registrant->user->name }}</div>
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
                            <h5 class="card-title">Data Pendaftar</h5>
                        </div>
                        <div class="table-responsive" id="registrant-data">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <td>Nama</td>
                                    <td><b>{{ $registrant->user->name }}</b></td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td><b>{{ $registrant->nim }}</b></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><b>{{ $registrant->user->email }}</b></td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td><b>{{ $registrant->phone_number }}</b></td>
                                </tr>
                                <tr>
                                    <td>No. WhatsApp</td>
                                    <td><b>{{ $registrant->whatsapp_number }}</b></td>
                                </tr>
                                <tr>
                                    <td>Status Pendaftaran</td>
                                    <td><b>{{ $registrant->status->name }}</b></td>
                                </tr>
                                <tr>
                                    <td>Terdaftar pada</td>
                                    <td><b>{{ \Carbon\Carbon::parse($registrant->created_at)->format('l, d M Y H:i') }}</b>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Foto</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ $registrant->user->media[1]->getFullUrl() }}" alt="{{ $registrant->user->name }}" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Himpunan</h5>
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">File Pendaftaran</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <td>Surat Delegasi</td>
                                    <td><a href="{{ $registrant->user->media[0]->getFullUrl() }}">Download File</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Verifikasi Pendaftaran</h5>
                        </div>

                        @if ($registrant->status->id == 1)
                        <div class="card-body">
                            <p>
                                Status pendaftaran saat ini: <b>{{ $registrant->status->name }}</b>.
                                Silahkan download file <b>Surat Rekomendasi</b> dan <b>Form Pendaftaran</b> kemudian
                                lakukan
                                verifikasi.
                                <br>
                                Jika data <a href="#registrant-data">diatas</a> sesuai dengan file yang diunggah,
                                klik "<b>Tandai Berkas Diverifikasi</b>",<br>
                                jika tidak sesuai, klik "<b>Tandai Berkas Gagal Diverifikasi</b>"
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" data-toggle="modal" data-target="#accept-modal" class="btn btn-success">Tandai
                                Berkas Diverifikasi</a>
                            <a href="#" data-toggle="modal" data-target="#decline-modal" class="btn btn-danger">Tandai
                                Berkas Gagal Diverifikasi</a>
                        </div>
                        @elseif ($registrant->status->id == 2)
                        <div class="card-body">
                            <p>Status pendaftaran saat ini: <b>{{ $registrant->status->name }}</b></p>
                            <p>Silahkan kirimkan pesan kepada {{ $registrant->user->name }} untuk melakukan pembayaran.
                                Jika sudah, klik "<b>Tandai Sudah Dibayar</b>"
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" data-toggle="modal" data-target="#send-message-modal" class="btn btn-info">Kirim
                                Pesan</a>
                            <a href="#" data-toggle="modal" data-target="#verify-payment-modal"
                                class="btn btn-success">Tandai Sudah Dibayar</a>
                        </div>
                        @elseif ($registrant->status->id == 3)
                        <div class="card-footer">
                            <p>Pendaftaran telah berhasil.</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" data-toggle="modal" data-target="#send-message-modal"
                                class="btn btn-info btn-sm">Kirim Pesan</a>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('custom_html')
@if ($registrant->status->id == 1)
<div class="modal fade" tabindex="-1" role="dialog" id="accept-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verifikasi Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.reg.accept', $registrant->id) }}" method="POST" id="accept-form">
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <div class="modal-body">
                    <p>
                        Yakin data pendaftaran sudah sesuai?
                        <br>
                        Setelah data pendaftaran diterima, silahkan minta {{ $registrant->user->name }}
                        untuk mengirimkan biaya pendaftaran ke rekening yang sudah ditentukan.
                    </p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-accept">Terima</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="decline-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verifikasi Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.reg.decline', $registrant->id) }}" method="POST" id="accept-form">
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <div class="modal-body">
                    <p>
                        Yakin ingin menandai pendafar "tidak terverifikasi" ?
                    </p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-decline">Tandai</button>
                </div>
            </form>
        </div>
    </div>
</div>
@elseif ($registrant->status->id == 2)
<div class="modal fade" tabindex="-1" role="dialog" id="verify-payment-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tandai Pendaftaran Sebagai Sudah Dibayar?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.reg.mark-as-payed', $registrant->id) }}" method="POST" id="accept-form">
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <div class="modal-body">
                    <p>
                        Yakin ingin menandai pembayaran sebagai sudah dibayar?
                    </p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tandai</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="send-message-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kirim Pesan ke {{ $registrant->user->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="send-payment-message">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message">Isi pesan</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@elseif ($registrant->status->id == 3)
@endif
@endsection

@push('custom_js')
<script>
    @if($registrant->status-> id == 2)
    let form = document.querySelector('#send-payment-message');
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        let message = form.querySelector('#message').value;

        let
            wa = 'https://web.whatsapp.com/send',
            ajax = new XMLHttpRequest(),
            phone = number.replace('08', '628');

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            wa = 'whatsapp://send';
        }

        let url =
            `${wa}?phone=${phone}&text=Halo`;


        let w = 960,
            h = 540,
            left = Number((screen.width / 2) - (w / 2)),
            top = Number((screen.height / 2) - (h / 2)),
            popupWindow = window.open(url, '',
                'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=1, copyhistory=no, width=' +
                w + ', height=' + h + ', top=' + top + ', left=' + left);

        popupWindow.focus();
        btnSend.innerHTML = 'Kirim Pesan';

        return false;
    })
    @endif

</script>
@endpush
