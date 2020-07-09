@extends('layouts.registrant')
@section('title', 'Kontak Bantuan')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kontak Bantuan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('reg.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('reg.help') }}"></a></div>
                <div class="breadcrumb-item">Kontak Bantuan</div>
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
                            <h5 class="card-title">Daftar Kontak Bantuan</h5>
                        </div>
                        @if (count($contacts) > 0)
                        <div class="table-responsive">
                            <table class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Nama</th>
                                            <th scope="col">No. WhatsApp</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->whatsapp_number }}</td>
                                            <td>
                                                <a href="#" data-number="{{ $contact->whatsapp_number }}"
                                                    data-name="{{ $contact->name }}"
                                                    class="btn btn-success btn-sm btn-contact"><i
                                                        class="fab fa-whatsapp"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                            <h5 class="card-title">Pesan</h5>
                        </div>
                        <div class="card-body">
                            <p>Jika ingin bertanya sesuatu atau mengkonfirmasi pengiriman biaya pendaftaran, silahkan kirimkan pesan ke salah satu kontak tersebut
                                melalui WhatsApp, atau klik tombol "WhatsApp" di samping kanan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('custom_html')
<div class="modal fade" tabindex="-1" role="dialog" id="contact-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hubungi <span class="admin-name">[ADMIN_NAME]</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Kirimkan pesan ke <span class="admin-name font-weight-bold"></span> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-send">Kirim Pesan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
<script>
    let contactBtn = document.querySelectorAll('.btn-contact');
    let name = '';
    let number = '';

    contactBtn.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            let contactName = btn.getAttribute('data-name');
            let contactNumber = btn.getAttribute('data-number');

            name = contactName;
            number = contactNumber;

            let modal = document.querySelector('#contact-modal');
            modal.querySelectorAll('.admin-name')
                .forEach(admin => {
                    admin.innerHTML = name;
                });

            $('#contact-modal').modal('show');
        });
    });

    let btnSend = document.querySelector('.btn-send');
    btnSend.addEventListener('click', (e) => {
        e.preventDefault();

        btnSend.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Membuka WhatsApp...';

        let
            wa = 'https://web.whatsapp.com/send',
            ajax = new XMLHttpRequest(),
            phone = number.replace('08', '628');

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            wa = 'whatsapp://send';
        }

        let url = `${wa}?phone=${phone}&text=Halo, ${name}%0A, Saya {{ Auth::user()->name }} ingin bertanya`;


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
    });
</script>
@endpush
