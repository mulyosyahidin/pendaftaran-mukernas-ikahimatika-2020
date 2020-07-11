@extends('layouts.admin')
@section('title', 'Edit Data Pendaftaran')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Edit Data</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('admin.reg.all') }}">Data Peserta</a></div>
          <div class="breadcrumb-item"><a href="{{ route('admin.reg.show', $registrant->id) }}">{{ $registrant->user->name }}</a></div>
          <div class="breadcrumb-item">Edit Data</div>
        </div>
      </div>

      <div class="section-body">
        @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
        @endif

        <form action="{{ route('admin.reg.update', $registrant->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Data Peserta</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input type="text" value="{{ old('name', $registrant->user->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required="required">
                            
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nim">NIM:</label>
                                <input type="text" value="{{ old('nim', $registrant->nim) }}" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" required="required">
                                
                                @error('nim')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="whatsapp_number">No. WhatsApp:</label>
                                <input type="text" value="{{ old('whastapp_number', $registrant->whatsapp_number) }}" class="form-control @error('whatsapp_number') is-invalid @enderror" name="whatsapp_number" required="required">
                            
                                @error('whatsapp_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone_number">No. HP:</label>
                                <input type="text" value="{{ old('phone_number', $registrant->phone_number) }}" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" required="required">
                            
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Foto</h5>
                        </div>
                        <div class="card-body">
                            @if (isset($registrant->user->media[1]))
                            <div class="text-center"><img src="{{ $registrant->user->media[1]->getFullUrl() }}" alt="{{ $registrant->user->name }}" class="img-fluid"></div>
                            @else
                            <div class="alert alert-info">Belum ada foto yang diunggah</div>
                            @endif

                            <div class="form-group">
                                <label for="picture">Ganti Foto:</label>
                                <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture">
                            
                                @error('picture')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <p class="text-muted">Pilih foto untuk mengganti. Kosongkan jika tidak.</p>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Himpunan</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="region">Wilayah:</label>
                                <select name="region_id" id="region" class="form-control"></select>
                            </div>

                            <div class="form-group">
                                <label for="university">Universitas:</label>
                                <select name="university_id" id="university" class="form-control">
                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}"
                                            @if ($university->id == $registrant->university_id) selected @endif>{{ $university->name }} ({{ $university->region->name }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="organization">Himpunan:</label>
                                <select name="organization_id" id="organization" class="form-control">
                                    @foreach ($organizations as $org)
                                        <option value="{{ $org->id }}"
                                            @if ($org->id == $registrant->organization_id) selected @endif>{{ $org->name }} {{ $org->university->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Akun</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" value="{{ old('email', $registrant->user->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>

                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            
                                @error('password')
                                    {{ $message }}
                                @enderror

                                <p class="text-muted">Masukkan password jika ingin mengganti. Kosongkan jika tidak</p>
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

@section('custom_head')
    <link rel="stylesheet" href="{{ getPluginUri('select2-js/dist/css/select2.min.css') }}">
@endsection

@push('custom_js')
    <script src="{{ getPluginUri('select2-js/dist/js/select2.min.js') }}"></script>
    <script>
        let regionOptions = document.querySelector('#region');
        fetch('{{ route('regions.index') }}', {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(regions => {
                for (region in regions.data) {
                    let option = document.createElement('option');
                        option.setAttribute('value', regions.data[region].id);
                        option.append(regions.data[region].name);

                        if (regions.data[region].id == {{ $registrant->region_id }}) {
                            option.setAttribute('selected', 'selected');
                        }

                    regionOptions.append(option);
                }
            });

        $('#university, #organization').select2();
    </script>
@endpush