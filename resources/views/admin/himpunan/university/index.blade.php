@extends('layouts.admin')
@section('title', 'Universitas')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Universitas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.himpunan') }}">Himpunan</a></div>
                <div class="breadcrumb-item">Universitas</div>
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
                            <h5 class="card-title">Daftar Universitas</h5>

                            <span class="ml-auto">
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-modal"
                                    data-keyboard="false" data-backdrop="static"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="university-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Wilayah</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('custom_head')
<link rel="stylesheet" href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}">
@endsection

@section('custom_html')
<div class="modal fade" tabindex="-1" role="dialog" id="add-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Universitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="add-university-form">
                <div class="modal-body">
                    <div class="add-message-container"></div>

                    <div class="form-group">
                        <label for="name">Nama Universitas:</label>
                        <input type="text" class="form-control add-name" name="university[0][name]" required="required">
                    </div>

                    <div class="form-group">
                        <label for="regions">Wilayah:</label>
                        <select name="university[0][region_id]" id="regions" class="form-control" required="required"></select>
                    </div>

                    <div class="add-bulk-container"></div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-info add-bulk">Tambah Kolom</button>
                    <button type="submit" class="btn btn-primary btn-add">Tambah Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="view-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Universitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" id="view-data">
                <table class="table table-striped table-hover">
                    <tr>
                        <td>Nama</td>
                        <td><span class="data-name font-weight-bold"></span></td>
                    </tr>
                    <tr>
                        <td>Wilayah</td>
                        <td><span class="data-region_id font-weight-bold"></span></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Universitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="edit-university-form">
                <div class="modal-body">
                    <div class="edit-message-container"></div>

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control edit-name" name="name" required="required">
                    </div>

                    <div class="form-group">
                        <label for="edit-region-id">Wilayah:</label>
                        <select name="region_id" id="edit-region-id" class="form-control"></select>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Universitas?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="delete-university-form">
                <div class="modal-body">
                    <p class="delete-message">Yakin ingin menghapus?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-do-delete">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>

<script>
    let regionOptions = document.querySelector('#regions');
    fetch(`{{ route('regions.index') }}`, {
        headers: {
            'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
        }
    })
        .then(res => res.json())
        .then(res => {
            res.data.forEach(data => {
                let option = document.createElement('option');
                    option.setAttribute('value', data.id);
                    option.append(data.name);

                    regionOptions.append(option);
            });
        })
        .catch(errors => {
            console.log(errors);
        });

    let table = $('#university-table').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": "{{ route('universities.index') }}",
            "headers": {
                "Authorization": "Bearer {{ Session::get('Bearer_token') }}"
            }
        },
        "columns": [{
                data: "id"
            },
            {
                data: "name"
            },
            {
                data: "region.name"
            },
            {
                data: function (data, type, row) {
                    let id = data.id;

                    return `
                        <div class="text-right">
                            <a href="#" class="btn btn-info btn-sm btn-view" data-id="${id}"><i class="fa fa-eye"></i></a>
                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="${id}"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="${id}"><i class="fa fa-trash"></i></a>
                        </div>
                    `;
                }
            }
        ]
    });

    let addBulkBtn = document.querySelector('.add-bulk');
    let addBulkContainer = document.querySelector('.add-bulk-container');
    let currentSelectedRegion;
    let n = 1;

    addBulkBtn.addEventListener('click', (e) => {
        e.preventDefault();

        if (document.querySelector(`[name="university[${n-1}][region_id]"]`) == null) {
            currentSelectedRegion = regionOptions.value;
        }
        else {
            currentSelectedRegion = document.querySelector(`[name="university[${n-1}][region_id]"]`).value;
        }

        let row = document.createElement('div');
            row.setAttribute('class', 'row');
        let leftCol = document.createElement('div');
            leftCol.setAttribute('class', 'col-6');

        let univName = document.createElement('div');
            univName.setAttribute('class', 'form-group');
        let univLabel = document.createElement('label');
            univLabel.append('Nama Universitas:');
        let univInput = document.createElement('input');
            univInput.setAttribute('type', 'text');
            univInput.setAttribute('class', 'form-control');
            univInput.setAttribute('name', `university[${n}][name]`);
            univName.append(univLabel);
            univName.append(univInput);

        let rightCol = document.createElement('div');
            rightCol.setAttribute('class', 'col-6');

        let regionName = document.createElement('div');
            regionName.setAttribute('class', 'form-group');
        let regionLabel = document.createElement('label');
            regionLabel.append('Wilayah:');
        let regionInput = document.createElement('select');
            regionInput.setAttribute('type', 'text');
            regionInput.setAttribute('class', 'form-control');
            regionInput.setAttribute('name', `university[${n}][region_id]`);

        fetch(`{{ route('regions.index') }}`, {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                res.data.forEach(data => {
                    let option = document.createElement('option');
                        option.setAttribute('value', data.id);
                        option.append(data.name);

                        if (currentSelectedRegion == data.id) {
                            option.setAttribute('selected', 'selected');
                        }

                        regionInput.append(option);
                });
        })
        .catch(errors => {
            console.log(errors);
        });

            regionName.append(regionLabel);
            regionName.append(regionInput);

            leftCol.append(univName);
            rightCol.append(regionName);
            row.append(leftCol);
            row.append(rightCol);

            addBulkContainer.append(row);

        n++;
    })

    let addUniversityForm = document.querySelector('#add-university-form');
    let addUniversityBtn = addUniversityForm.querySelector('.btn-add');
    let addMessageContainer = addUniversityForm.querySelector('.add-message-container');

    addUniversityForm.addEventListener('submit', (e) => {
        e.preventDefault();

        addUniversityBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menambah...';
        let universityData = new FormData(addUniversityForm);

        fetch(`{{ route('universities.store') }}`, {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
                },
                body: universityData
            })
            .then(res => res.json())
            .then(res => {
                if (res.error) {
                    while (addMessageContainer.firstChild) {
                        addMessageContainer.removeChild(addMessageContainer.firstChild);
                        addMessageContainer.removeAttribute('class');
                    }

                    let errors = res.errors;
                    let ul = document.createElement('ul');
                    ul.setAttribute('class', 'alert alert-danger');

                    for (err in errors) {
                        let elem = document.createElement('li');
                        elem.append(errors[err]);

                        ul.append(elem);
                    }

                    addMessageContainer.append(ul);
                    addUniversityBtn.innerHTML = 'Tambah';
                } else if (res.success) {
                    table.ajax.reload();
                    addUniversityForm.reset();

                    let message = res.message;

                    addMessageContainer.setAttribute('class', 'alert alert-success');
                    addMessageContainer.innerHTML = message;

                    addUniversityBtn.innerHTML = '<i class="fa fa-check"></i> Berhasil!';

                    setTimeout(() => {
                        addUniversityBtn.innerHTML = 'Tambah';
                    }, 2500);
                }
            })
            .catch(errors => {
                addMessageContainer.setAttribute('class', 'alert alert-info')
                addMessageContainer.innerHTML = errors;

                addUniversityBtn.innerHTML = 'Tambah';
            })
    });

    $('#add-modal').on('hide.bs.modal', function (e) {
        while (addMessageContainer.firstChild) {
            addMessageContainer.removeChild(addMessageContainer.firstChild);
            addMessageContainer.removeAttribute('class');
        }

        while (addBulkContainer.firstChild) {
            addBulkContainer.removeChild(addBulkContainer.firstChild);
        }

        addUniversityForm.reset();

        addUniversityBtn.innerHTML = 'Tambah';
    });

    $(document).on('click', '.btn-view', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        fetch(`{{ route('universities.show', FALSE) }}/${id}`, {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                let viewData = document.querySelector('#view-data');
                viewData.querySelector('.data-name')
                    .innerHTML = res.name;
                viewData.querySelector('.data-region_id')
                    .innerHTML = res.region.name;

                $('#view-modal').modal('show');
            })
            .catch(errors => {
                console.log(errors);
            })
    });

    let actionID;
    let editUniversityForm = document.querySelector('#edit-university-form');
    let editUniversityBtn = editUniversityForm.querySelector('.btn-save');
    let editMessageContainer = editUniversityForm.querySelector('.edit-message-container');
    let editRegionOptions = editUniversityForm.querySelector('#edit-region-id');

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();

        while (editRegionOptions.firstChild) {
            editRegionOptions.removeChild(editRegionOptions.firstChild);
        }

        let id = $(this).data('id');
        actionID = id;

        fetch(`{{ route('regions.index') }}`, {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                res.data.forEach(data => {
                    let option = document.createElement('option');
                        option.setAttribute('value', data.id);
                        option.append(data.name);

                    editRegionOptions.append(option);
                });
            })
            .catch(errors => {
                console.log(errors);
            });

        fetch(`{{ route('universities.show', FALSE) }}/${id}`, {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                editUniversityForm.querySelector('.edit-name')
                    .value = res.name;
                editUniversityForm.querySelector(`#edit-region-id [value="${res.region_id}"]`)
                    .setAttribute('selected', 'selected');
                
                
                $('#edit-modal').modal('show');
            })
            .catch(errors => {
                console.log(errors);
            })
    })

    editUniversityForm.addEventListener('submit', (e) => {
        e.preventDefault();

        let newData = $('#edit-university-form').serialize();

        editUniversityBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menyimpan...';

        $.ajax({
            method: 'PUT',
            url: `{{ route('universities.update', FALSE) }}/${actionID}`,
            data: newData,
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer {{ Session::get('Bearer_token') }}')
            },
            success: function (res) {
                if (res.error) {
                    while (editMessageContainer.firstChild) {
                        editMessageContainer.removeChild(editMessageContainer.firstChild);
                        editMessageContainer.removeAttribute('class');
                    }

                    let errors = res.errors;
                    let ul = document.createElement('ul');
                    ul.setAttribute('class', 'alert alert-danger');

                    for (err in errors) {
                        let elem = document.createElement('li');
                        elem.append(errors[err]);

                        ul.append(elem);
                    }

                    editMessageContainer.append(ul);
                    editUniversityBtn.innerHTML = 'Simpan';
                } else if (res.success) {
                    table.ajax.reload();

                    let message = res.message;

                    editMessageContainer.setAttribute('class', 'alert alert-success');
                    editMessageContainer.innerHTML = message;

                    editUniversityBtn.innerHTML = '<i class="fa fa-check"></i> Tersimpan!';

                    setTimeout(() => {
                        editUniversityBtn.innerHTML = 'Simpan';
                    }, 2500);
                }
            },
            error: function (xhr, response, ajaxSettings) {
                editMessageContainer.setAttribute('class', 'alert alert-info')
                editMessageContainer.innerHTML = errors;

                editUniversityBtn.innerHTML = 'Simpan';
            }
        });
    });

    $('#edit-modal').on('hide.bs.modal', function (e) {
        while (editMessageContainer.firstChild) {
            editMessageContainer.removeChild(editMessageContainer.firstChild);
            editMessageContainer.removeAttribute('class');
        }

        editUniversityBtn.innerHTML = 'Simpan';
    });

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        actionID = id;

        $('#delete-modal').modal('show');
    });

    let delUniversityForm = document.querySelector('#delete-university-form');
    let delUniversityBtn = delUniversityForm.querySelector('.btn-do-delete');
    let delUniversityMessage = delUniversityForm.querySelector('.delete-message');

    delUniversityForm.addEventListener('submit', (e) => {
        e.preventDefault();

        delUniversityBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menghapus...';
        fetch(`{{ route('universities.destroy', FALSE) }}/${actionID}`, {
            method: 'DELETE',
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                table.ajax.reload();
                delUniversityBtn.innerHTML = '<i class="fa fa-check"></i> Terhapus!';

                delUniversityMessage.innerHTML = res.message;
            })
            .catch(errors => {
                delUniversityMessage.innerHTML = errors;
            })
    });

    $('#delete-modal').on('hide.bs.modal', function (e) {
        while (delUniversityMessage.firstChild) {
            delUniversityMessage.removeChild(delUniversityMessage.firstChild);
        }

        delUniversityBtn.innerHTML = 'Hapus';
        delUniversityMessage.innerHTML = 'Yakin ingin menghapus?';
    });
</script>
@endpush