@extends('layouts.admin')
@section('title', 'Wilayah Universitas')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Wilayah Universitas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.himpunan') }}">Himpunan</a></div>
                <div class="breadcrumb-item">Wilayah Universitas</div>
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
                            <h5 class="card-title">Daftar Wilayah Universitas</h5>

                            <span class="ml-auto">
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-modal"
                                    data-keyboard="false" data-backdrop="static"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="region-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kode</th>
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
                <h5 class="modal-title">Tambah Wilayah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="add-region-form">
                <div class="modal-body">
                    <div class="add-message-container"></div>

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control add-name" name="name" required="required">
                    </div>

                    <div class="form-group">
                        <label for="code">Kode:</label>
                        <input type="text" name="code" class="form-control add-code" id="code" required>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
                <h5 class="modal-title">Wilayah</h5>
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
                        <td>Kode</td>
                        <td><span class="data-code font-weight-bold"></span></td>
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
                <h5 class="modal-title">Edit Wilayah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="edit-region-form">
                <div class="modal-body">
                    <div class="edit-message-container"></div>

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control edit-name" name="name" required="required">
                    </div>

                    <div class="form-group">
                        <label for="code">Kode:</label>
                        <input type="text" name="code" class="form-control edit-code" id="code" required>
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
                <h5 class="modal-title">Hapus Wilayah?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="delete-region-form">
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
    let table = $('#region-table').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": "{{ route('regions.index') }}",
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
                data: "code"
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

    let addRegionForm = document.querySelector('#add-region-form');
    let addRegionBtn = addRegionForm.querySelector('.btn-add');
    let addMessageContainer = addRegionForm.querySelector('.add-message-container');

    addRegionForm.addEventListener('submit', (e) => {
        e.preventDefault();

        addRegionBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menambah...';
        let regionData = new FormData(addRegionForm);

        fetch(`{{ route('regions.store') }}`, {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
                },
                body: regionData
            })
            .then(res => res.json())
            .then(res => {
                if (res.error) {
                    let errors = res.errors;
                    let ul = document.createElement('ul');
                    ul.setAttribute('class', 'alert alert-danger');

                    for (err in errors) {
                        let elem = document.createElement('li');
                        elem.append(errors[err]);

                        ul.append(elem);
                    }

                    addMessageContainer.append(ul);
                    addRegionBtn.innerHTML = 'Tambah';
                } else if (res.success) {
                    table.ajax.reload();
                    addRegionForm.reset();

                    let message = res.message;

                    addMessageContainer.setAttribute('class', 'alert alert-success');
                    addMessageContainer.innerHTML = message;

                    addRegionBtn.innerHTML = '<i class="fa fa-check"></i> Berhasil!';

                    setTimeout(() => {
                        addRegionBtn.innerHTML = 'Tambah';
                    }, 2500);
                }
            })
            .catch(errors => {
                addMessageContainer.setAttribute('class', 'alert alert-info')
                addMessageContainer.innerHTML = errors;

                addRegionBtn.innerHTML = 'Tambah';
            })
    });

    $('#add-modal').on('hide.bs.modal', function (e) {
        while (addMessageContainer.firstChild) {
            addMessageContainer.removeChild(addMessageContainer.firstChild);
            addMessageContainer.removeAttribute('class');
        }

        addRegionForm.reset();

        addRegionBtn.innerHTML = 'Tambah';
    });

    $(document).on('click', '.btn-view', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        fetch(`{{ route('regions.show', FALSE) }}/${id}`, {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            },
        })
            .then(res => res.json())
            .then(res => {
                let viewData = document.querySelector('#view-data');
                viewData.querySelector('.data-name')
                    .innerHTML = res.name;
                viewData.querySelector('.data-code')
                    .innerHTML = res.code;

                $('#view-modal').modal('show');
            })
            .catch(errors => {
                console.log(errors);
            })
    });

    let actionID;
    let editRegionForm = document.querySelector('#edit-region-form');
    let editRegionBtn = editRegionForm.querySelector('.btn-save');
    let editMessageContainer = editRegionForm.querySelector('.edit-message-container');

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        actionID = id;

        fetch(`{{ route('regions.show', FALSE) }}/${id}`, {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            },
        })
            .then(res => res.json())
            .then(res => {
                editRegionForm.querySelector('.edit-name')
                    .value = res.name;
                editRegionForm.querySelector('.edit-code')
                    .value = res.code;

                $('#edit-modal').modal('show');
            })
            .catch(errors => {
                console.log(errors);
            })
    })

    editRegionForm.addEventListener('submit', (e) => {
        e.preventDefault();

        let newData = $('#edit-region-form').serialize();

        editRegionBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menyimpan...';

        $.ajax({
            method: 'PUT',
            url: `{{ route('regions.update', FALSE) }}/${actionID}`,
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
                    editRegionBtn.innerHTML = 'Simpan';
                } else if (res.success) {
                    table.ajax.reload();

                    let message = res.message;

                    editMessageContainer.setAttribute('class', 'alert alert-success');
                    editMessageContainer.innerHTML = message;

                    editRegionBtn.innerHTML = '<i class="fa fa-check"></i> Tersimpan!';

                    setTimeout(() => {
                        editRegionBtn.innerHTML = 'Simpan';
                    }, 2500);
                }
            },
            error: function (xhr, response, ajaxSettings) {
                editMessageContainer.setAttribute('class', 'alert alert-info')
                editMessageContainer.innerHTML = xhr.responseText;

                editRegionBtn.innerHTML = 'Simpan';
            }
        });
    });

    $('#edit-modal').on('hide.bs.modal', function (e) {
        while (editMessageContainer.firstChild) {
            editMessageContainer.removeChild(editMessageContainer.firstChild);
            editMessageContainer.removeAttribute('class');
        }

        editRegionBtn.innerHTML = 'Simpan';
    });

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        actionID = id;

        $('#delete-modal').modal('show');
    });

    let delRegionForm = document.querySelector('#delete-region-form');
    let delRegionBtn = delRegionForm.querySelector('.btn-do-delete');
    let delRegionMessage = delRegionForm.querySelector('.delete-message');

    delRegionForm.addEventListener('submit', (e) => {
        e.preventDefault();

        delRegionBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menghapus...';
        fetch(`{{ route('regions.destroy', FALSE) }}/${actionID}`, {
            method: 'DELETE',
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                table.ajax.reload();
                delRegionBtn.innerHTML = '<i class="fa fa-check"></i> Terhapus!';

                delRegionMessage.innerHTML = res.message;
            })
            .catch(errors => {
                delRegionMessage.innerHTML = errors;
            })
    });

    $('#delete-modal').on('hide.bs.modal', function (e) {
        while (delRegionMessage.firstChild) {
            delRegionMessage.removeChild(delRegionMessage.firstChild);
        }

        delRegionBtn.innerHTML = 'Hapus';
        delRegionMessage.innerHTML = 'Yakin ingin menghapus?';
    });
</script>
@endpush