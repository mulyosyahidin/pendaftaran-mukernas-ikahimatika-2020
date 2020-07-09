<!DOCTYPE html>
<html lang="id-ID">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Daftar di {{ getSiteName() }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/all.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/themes/stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/stisla/css/components.css') }}">

    <link rel="stylesheet" href="{{ getPluginUri('select2-js/dist/css/select2.min.css') }}">
</head>

<body>

    <form method="POST" action="{{ route('register.do') }}" enctype="multipart/form-data">
        @csrf
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 offset-sm-1offset-md-2 offset-lg-2 offset-xl-2">
                            <div class="login-brand">
                                <img src="{{ getSiteLogo() }}" alt="logo" width="100"
                                    class="shadow-light rounded-circle">
                            </div>

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>Mendaftar di {{ getSiteName() }}</h4>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nama lengkap:</label>
                                        <input type="text" minlength="6" maxlength="64" value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            required="required" name="name">

                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number">No. HP:</label>
                                                <input value="{{ old('phone_number') }}" type="text" id="phone_number"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    name="phone_number" required="required">

                                                @error('phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="whatsapp_number">No. WhatsApp:</label>
                                                <input value="{{ old('whatsapp_number') }}" type="text"
                                                    id="whatsapp_number"
                                                    class="form-control @error('whatsapp_number') is-invalid @enderror"
                                                    name="whatsapp_number" required="required">

                                                @error('whatsapp_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nim">NIM:</label>
                                        <input value="{{ old('nim') }}" type="text"
                                            class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim"
                                            required="required">

                                        @error('nim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="region">Wilayah Universitas:</label>
                                                <select name="region_id" id="region"
                                                    class="form-control @error('region_id') is-invalid @enderror">
                                                    <option disabled selected>Pilih Wilayah</option>
                                                </select>

                                                @error('region_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="university">Universitas:</label>
                                                <select name="university_id" id="university"
                                                    class="form-control @error('university_id') is-invalid @enderror">
                                                    <option selected="selected">Pilih Universitas</option>
                                                </select>

                                                @error('university_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <p class="text-muted university-message-container">
                                                    Pilih wilayah untuk memilih Universitas
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hima">Himpunan:</label>
                                                <select name="hima_id" id="hima"
                                                    class="form-control @error('hima_id') is-invalid @enderror"></select>

                                                @error('hima_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <p class="text-muted himpunan-message-container">Pilih Universitas untuk
                                                    memilih Himpunan</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <a href="#" data-toggle="modal" data-target="#custom-org">Universitas atau
                                            Himpunan tidak ada dalam daftar?</a>
                                    </div>

                                    <div class="form-group">
                                        <label for="delegation_letter">Surat Delegasi:</label>
                                        <input type="file" name="delegation_letter"
                                            class="form-control @error('delegation_letter') is-invalid @enderror"
                                            id="delegation_letter" required="required">

                                        @error('delegation_letter')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <p class="text-muted">
                                            Masukkan <i>scan</i> surat rekomendasi dalam format <b>PDF</b> dengan ukuran
                                            maksimal <b>2MB</b>.
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label for="picture">Foto formal:</label>
                                        <input type="file" class="form-control @error('picture') is-invalid @enderror"
                                            id="picture" name="picture" required="required">

                                        @error('picture')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <p class="text-muted">Unggah foto formal dengan format <b>JPG atau PNG</b>
                                            dengan ukuran maksimal 2MB</p>
                                    </div>

                                    <h5>Akun Login</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <input name="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    required="required">

                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password:</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    required="required">

                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p class="text-muted">Email dan Password akan digunakan untuk login ke akun
                                            kamu.</p>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Daftar
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="custom-org">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Universitas / Himpunan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="univ_name">Nama Universitas:</label>
                            <input type="text" class="form-control" id="univ_name" name="custom[university_name]">
                        </div>

                        <div class="form-group">
                            <label for="org_name">Nama Himpunan:</label>
                            <input type="text" class="form-control" id="org_name" name="custom[organization_name]">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/themes/stisla/js/stisla.js') }}"></script>
    <script src="{{ getPluginUri('select2-js/dist/js/select2.min.js') }}"></script>

    <script>
        let phoneNumber = document.querySelector('#phone_number');
        phoneNumber.addEventListener('keyup', (e) => {
            let whatsappNumber = document.querySelector('#whatsapp_number');
            let number = phoneNumber.value;

            if (number.indexOf('+62') != -1) {
                number = number.replace('+62', '0');
            }
            else if(number.indexOf('62') != -1) {
                number = number.replace('62', '0');
            }

            whatsappNumber.value = number;
            phoneNumber.value = number;
        });

        let regionOptions = document.querySelector('#region');
        let universityMessageContainer = document.querySelector('.university-message-container');
        let himpunanContainer = document.querySelector('.himpunan-message-container');

        fetch('{{ route('regions-public.index') }}')
            .then(res => res.json())
            .then(res => {
                res.data.forEach(d => {
                    let option = document.createElement('option');
                        option.setAttribute('value', d.id);
                        option.append(d.name);

                    regionOptions.append(option);
                })
            })
            .catch(errors => {
                console.log(errors);
            });

        regionOptions.addEventListener('change', (e) => {
            e.preventDefault();

            universityMessageContainer.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Mengambil data...';

            let regionID = regionOptions.value;
            $('#university').select2({
                ajax: {
                    url: '{{ route('universities-public.index') }}?select2=true&region='+ regionID,
                    dataType: 'json'
                }
            });

            setTimeout(() => {
                universityMessageContainer.innerHTML = 'Silahkan memilih Universitas';
            }, 2500)
        });

        let universityOptions = document.querySelector('#university');
        let himpunanOptions = document.querySelector('#hima');

        $('#university').on('change', function (e) {
            e.preventDefault();

            while (himpunanOptions.firstChild) {
                himpunanOptions.removeChild(himpunanOptions.firstChild);
            }

            let id = $(this).val();
            himpunanContainer.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Mengambil data himpunan...';

            fetch('{{ route('organizations-public.index') }}?select2=true&university_id='+ id)
                .then(res => res.json())
                .then(res => {
                    let length = res.results.length;

                    res.results.forEach(hima => {
                        let option = document.createElement('option');
                            option.setAttribute('value', hima.id);
                        option.append(hima.text);

                        himpunanOptions.append(option)
                    });

                    if (length > 0) {
                        himpunanContainer.innerHTML = 'Silahkan memilih himpunan';
                    }
                    else {
                        himpunanContainer.innerHTML = 'Tidak ada data Himpunan dalam Universitas tersebut. Silahkan memilih yang lain';
                    }
                })
                .catch(errors => {
                    console.log(errors);
                })
        })
    </script>
</body>

</html>