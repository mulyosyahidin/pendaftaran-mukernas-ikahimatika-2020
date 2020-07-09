@extends('layouts.admin')
@section('title', 'Pengaturan Kontak Pendaftaran')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Kontak Pendaftaran</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('admin.settings') }}">Pengaturan</a></div>
          <div class="breadcrumb-item">Kontak Pendaftaran</div>
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
                    <h5 class="card-title">Daftar Kontak Pendaftaran</h5>

                    <span class="ml-auto">
                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-modal"
                            data-keyboard="false" data-backdrop="static"><i class="fa fa-plus"></i></a>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="contact-table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">No. WhatsApp</th>
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
                <h5 class="modal-title">Tambah Kontak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="add-contact-form">
                <div class="modal-body">
                    <div class="add-message-container"></div>

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control add-name" name="name" required="required">
                    </div>

                    <div class="form-group">
                        <label for="whatsapp_number">No. WhatsApp:</label>
                        <input type="text" name="whatsapp_number" class="form-control add-whatsapp_number" id="whatsapp_number" required>
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
                <h5 class="modal-title">Kontak</h5>
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
                        <td>No. WhatsApp</td>
                        <td><span class="data-whatsapp_number font-weight-bold"></span></td>
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
                <h5 class="modal-title">Edit Kontak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="edit-contact-form">
                <div class="modal-body">
                    <div class="edit-message-container"></div>

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control edit-name" name="name" required="required">
                    </div>

                    <div class="form-group">
                        <label for="whatsapp_number">No. WhatsApp:</label>
                        <input type="text" name="whatsapp_number" class="form-control edit-whatsapp_number" id="whatsapp_number" required>
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
                <h5 class="modal-title">Hapus Kontak?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="delete-contact-form">
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
    let table = $('#contact-table').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": "{{ route('contacts.index') }}",
            headers: {
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
                data: "whatsapp_number"
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

    let addBankForm = document.querySelector('#add-contact-form');
    let addBankBtn = addBankForm.querySelector('.btn-add');
    let addMessageContainer = addBankForm.querySelector('.add-message-container');

    addBankForm.addEventListener('submit', (e) => {
        e.preventDefault();

        addBankBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menambah...';
        let contactData = new FormData(addBankForm);

        fetch(`{{ route('contacts.store') }}`, {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
                },
                body: contactData
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
                    addBankBtn.innerHTML = 'Tambah';
                } else if (res.success) {
                    table.ajax.reload();
                    addBankForm.reset();

                    let message = res.message;

                    addMessageContainer.setAttribute('class', 'alert alert-success');
                    addMessageContainer.innerHTML = message;

                    addBankBtn.innerHTML = '<i class="fa fa-check"></i> Berhasil!';

                    setTimeout(() => {
                        addBankBtn.innerHTML = 'Tambah';
                    }, 2500);
                }
            })
            .catch(errors => {
                addMessageContainer.setAttribute('class', 'alert alert-info')
                addMessageContainer.innerHTML = errors;

                addBankBtn.innerHTML = 'Tambah';
            })
    });

    $('#add-modal').on('hide.bs.modal', function (e) {
        while (addMessageContainer.firstChild) {
            addMessageContainer.removeChild(addMessageContainer.firstChild);
            addMessageContainer.removeAttribute('class');
        }

        addBankForm.reset();

        addBankBtn.innerHTML = 'Tambah';
    });

    $(document).on('click', '.btn-view', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        fetch(`{{ route('contacts.show', FALSE) }}/${id}`, {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                let viewData = document.querySelector('#view-data');
                viewData.querySelector('.data-name')
                    .innerHTML = res.name;
                viewData.querySelector('.data-whatsapp_number')
                    .innerHTML = res.whatsapp_number;

                $('#view-modal').modal('show');
            })
            .catch(errors => {
                console.log(errors);
            })
    });

    let actionID;
    let editBankForm = document.querySelector('#edit-contact-form');
    let editBankBtn = editBankForm.querySelector('.btn-save');
    let editMessageContainer = editBankForm.querySelector('.edit-message-container');

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        actionID = id;

        fetch(`{{ route('contacts.show', FALSE) }}/${id}`, {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                editBankForm.querySelector('.edit-name')
                    .value = res.name;
                editBankForm.querySelector('.edit-whatsapp_number')
                    .value = res.whatsapp_number;

                $('#edit-modal').modal('show');
            })
            .catch(errors => {
                console.log(errors);
            })
    })

    editBankForm.addEventListener('submit', (e) => {
        e.preventDefault();

        let newData = $('#edit-contact-form').serialize();

        editBankBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menyimpan...';

        $.ajax({
            method: 'PUT',
            url: `{{ route('contacts.update', FALSE) }}/${actionID}`,
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
                    editBankBtn.innerHTML = 'Simpan';
                } else if (res.success) {
                    table.ajax.reload();

                    let message = res.message;

                    editMessageContainer.setAttribute('class', 'alert alert-success');
                    editMessageContainer.innerHTML = message;

                    editBankBtn.innerHTML = '<i class="fa fa-check"></i> Tersimpan!';

                    setTimeout(() => {
                        editBankBtn.innerHTML = 'Simpan';
                    }, 2500);
                }
            },
            error: function (xhr, response, ajaxSettings) {
                editMessageContainer.setAttribute('class', 'alert alert-info')
                editMessageContainer.innerHTML = xhr.responseText;

                editBankBtn.innerHTML = 'Simpan';
            }
        });
    });

    $('#edit-modal').on('hide.bs.modal', function (e) {
        while (editMessageContainer.firstChild) {
            editMessageContainer.removeChild(editMessageContainer.firstChild);
            editMessageContainer.removeAttribute('class');
        }

        editBankBtn.innerHTML = 'Simpan';
    });

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        actionID = id;

        $('#delete-modal').modal('show');
    });

    let delBankForm = document.querySelector('#delete-contact-form');
    let delBankBtn = delBankForm.querySelector('.btn-do-delete');
    let delBankMessage = delBankForm.querySelector('.delete-message');

    delBankForm.addEventListener('submit', (e) => {
        e.preventDefault();

        delBankBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menghapus...';
        fetch(`{{ route('contacts.destroy', FALSE) }}/${actionID}`, {
            method: 'DELETE',
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                table.ajax.reload();
                delBankBtn.innerHTML = '<i class="fa fa-check"></i> Terhapus!';

                delBankMessage.innerHTML = res.message;
            })
            .catch(errors => {
                delBankMessage.innerHTML = errors;
            })
    });

    $('#delete-modal').on('hide.bs.modal', function (e) {
        while (delBankMessage.firstChild) {
            delBankMessage.removeChild(delBankMessage.firstChild);
        }

        delBankBtn.innerHTML = 'Hapus';
        delBankMessage.innerHTML = 'Yakin ingin menghapus?';
    });
</script>
@endpush