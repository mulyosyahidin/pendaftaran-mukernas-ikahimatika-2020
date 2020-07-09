@extends('layouts.admin')
@section('title', 'Tambah Himpunan Mahasiswa')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Himpunan Mahasiswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.himpunan') }}">Himpunan</a></div>
                <div class="breadcrumb-item">Tambah Himpunan Mahasiswa</div>
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
                    <form action="{{ route('admin.himpunan.store') }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tambah Himpunan</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="university">Universitas:</label>
                                            <select name="create[0][university_id]" id="university-options"
                                                class="form-control @error('create[0][university_id]') is-invalid @enderror"></select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="name">Nama Himpunan:</label>
                                            <input type="text"
                                                class="form-control @error('create[0][name]') is-invalid @enderror"
                                                id="name" name="create[0][name]" required="required">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="head">Nama Ketua:</label>
                                            <input type="text" name="create[0][head_name]"
                                                class="form-control @error('create[0][head_name]') is-invalid @enderror"
                                                id="head">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="phone">No. HP:</label>
                                            <input type="text" name="create[0][phone_number]"
                                                class="form-control @error('create[0][phone_number]') is-invalid @enderror"
                                                id="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-column-container"></div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="button" value="Tambah Kolom" class="btn btn-info add-column">
                                <input type="submit" value="Tambah" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
    $('#university-options').select2({
        ajax: {
            url: '{{ route('universities.index') }}?select2=true',
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            },
            dataType: 'json'
        }
    });

    let addColumnBtn = document.querySelector('.add-column');
    let addColumnContainer = document.querySelector('.add-column-container');
    let currentSelectedUniversity;
    let n = 1;

    addColumnBtn.addEventListener('click', (e) => {
        e.preventDefault();

        if (document.querySelector(`[name="create[${n-1}][university_id]"]`) == null) {
            currentSelectedUniversity = universitesOptions.value;
        }
        else {
            currentSelectedUniversity = document.querySelector(`[name="create[${n-1}][university_id]"]`).value;
        }

        let row = document.createElement('div');
            row.setAttribute('class', 'row');

        let universityCol = document.createElement('div');
            universityCol.setAttribute('class', 'col-3');
        let universityForm = document.createElement('div');
            universityForm.setAttribute('class', 'form-group');
        let universityLabel = document.createElement('label');
            universityLabel.append('Universitas:');
        let universityOptions = document.createElement('select');
            universityOptions.setAttribute('class', 'form-control');
            universityOptions.setAttribute('name', `create[${n}][university_id]`);
            universityOptions.setAttribute('id', `select-university-${n}`);

        universityForm.append(universityLabel);
        universityForm.append(universityOptions);

        universityCol.append(universityForm);

        let nameCol = document.createElement('div');
            nameCol.setAttribute('class', 'col-3');
        let nameForm = document.createElement('div');
            nameForm.setAttribute('class', 'form-group');
        let nameLabel = document.createElement('label');
            nameLabel.append('Nama Himpunan:');
        let nameInput =  document.createElement('input');
            nameInput.setAttribute('class', 'form-control');
            nameInput.setAttribute('name', `create[${n}][name]`);

        nameForm.append(nameLabel);
        nameForm.append(nameInput);
        nameCol.append(nameForm);

        let headCol = document.createElement('div');
            headCol.setAttribute('class', 'col-3');
        let headForm = document.createElement('div');
            headForm.setAttribute('class', 'form-group');
        let headLabel = document.createElement('label');
            headLabel.append('Ketua:');
        let headInput =  document.createElement('input');
            headInput.setAttribute('class', 'form-control');
            headInput.setAttribute('name', `create[${n}][head_name]`);

        headForm.append(headLabel);
        headForm.append(headInput);
        headCol.append(headForm);

        let phoneCol = document.createElement('div');
            phoneCol.setAttribute('class', 'col-3');
        let phoneForm = document.createElement('div');
            phoneForm.setAttribute('class', 'form-group');
        let phoneLabel = document.createElement('label');
            phoneLabel.append('No. HP:');
        let phoneInput =  document.createElement('input');
            phoneInput.setAttribute('class', 'form-control');
            phoneInput.setAttribute('name', `create[${n}][phone_number]`);

        phoneForm.append(phoneLabel);
        phoneForm.append(phoneInput);
        phoneCol.append(phoneForm);

        row.append(universityCol);
        row.append(nameCol);
        row.append(headCol);
        row.append(phoneCol);

        addColumnContainer.append(row);

        $('#select-university-'+ n).select2({
            ajax: {
                url: '{{ route('universities.index') }}?select2=true&selected='+ currentSelectedUniversity,
                dataType: 'json'
            }
        });

        n++;
    });

</script>
@endpush
