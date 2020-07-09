@extends('layouts.admin')
@section('title', 'Himpunan Mahasiswa')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Himpunan Mahasiswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.himpunan') }}">Himpunan</a></div>
                <div class="breadcrumb-item">Himpunan Mahasiswa</div>
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
                            <h5 class="card-title">Daftar Himpunan Mahasiswa</h5>

                            <span class="ml-auto">
                                <a href="{{ route('admin.himpunan.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="organization-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Himpunan</th>
                                        <th scope="col">Universitas</th>
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
<div class="modal fade" tabindex="-1" role="dialog" id="view-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Himpunan Mahasiswa</h5>
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
                        <td>Universitas</td>
                        <td><span class="data-university font-weight-bold"></span></td>
                    </tr>
                    <tr>
                        <td>Ketua</td>
                        <td><span class="font-weight-bold data-head"></span></td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td><span class="font-weight-bold data-phone_number"></span></td>
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
                <h5 class="modal-title">Edit Himpunan Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="edit-organization-form">
                <div class="modal-body">
                    <div class="edit-message-container"></div>

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control edit-name" name="name" required="required">
                    </div>

                    <div class="form-group">
                        <label for="university">Universitas:</label>
                        <select name="university_id" id="university" class="form-control"></select>
                    </div>

                    <div class="form-group">
                        <label for="head_name">Ketua:</label>
                        <input type="text" class="form-control edit-head_name" id="head_name" name="head_name">
                    </div>

                    <div class="form-group">
                        <label for="phone_number">No. HP:</label>
                        <input type="text" id="phone_number" class="form-control edit-phone_number" name="phone_number">
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
                <h5 class="modal-title">Hapus Himpunan Mahasiswa?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="delete-organization-form">
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
    let table = $('#organization-table').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": "{{ route('organizations.index') }}",
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
                data: "university.name"
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

    $(document).on('click', '.btn-view', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        fetch(`{{ route('organizations.show', FALSE) }}/${id}`, {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                let viewData = document.querySelector('#view-data');
                viewData.querySelector('.data-name')
                    .innerHTML = res.name;
                viewData.querySelector('.data-university')
                    .innerHTML = res.university.name;
                viewData.querySelector('.data-head')
                    .innerHTML = (res.head_name == null) ? '-' : res.head_name;
                viewData.querySelector('.data-phone_number')
                    .innerHTML = (res.phone_number == null) ? '-' : res.phone_number;

                $('#view-modal').modal('show');
            })
            .catch(errors => {
                console.log(errors);
            })
    });

    let actionID;
    let editOrganizationForm = document.querySelector('#edit-organization-form');
    let editRegionBtn = editOrganizationForm.querySelector('.btn-save');
    let editMessageContainer = editOrganizationForm.querySelector('.edit-message-container');

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        let universityID;
        actionID = id;

        fetch(`{{ route('organizations.show', FALSE) }}/${id}`, {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                editOrganizationForm.querySelector('.edit-name')
                    .value = res.name;
                editOrganizationForm.querySelector('.edit-head_name')
                    .value = res.head_name;
                editOrganizationForm.querySelector('.edit-phone_number')
                    .value = res.phone_number;
                universityID = res.university_id;

                $('#edit-modal').modal('show');
            })
            .catch(errors => {
                console.log(errors);
            })
        fetch('{{ route('universities.index') }}', {
            headers: {
                'Authorization': 'Bearer {{ Session::get('Bearer_token') }}'
            }
        })
            .then(res => res.json())
            .then(res => {
                let editUniversity = document.querySelector('#university');
                while (editUniversity.firstChild) {
                    editUniversity.removeChild(editUniversity.firstChild);
                }

                res.data.forEach(university => {
                    let option = document.createElement('option');
                        option.setAttribute('value', university.id);

                    if (university.id == universityID) {
                        option.setAttribute('selected', 'selected');
                    }

                    option.append(university.name);

                    editUniversity.append(option);
                })
            })
            .catch(errors => {
                console.log(errors);
            })
    })

    editOrganizationForm.addEventListener('submit', (e) => {
        e.preventDefault();

        let newData = $('#edit-organization-form').serialize();

        editRegionBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menyimpan...';

        $.ajax({
            method: 'PUT',
            url: `{{ route('organizations.update', FALSE) }}/${actionID}`,
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
                editMessageContainer.innerHTML = `<pre>${xhr.responseText}</pre>`;

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

    let delRegionForm = document.querySelector('#delete-organization-form');
    let delRegionBtn = delRegionForm.querySelector('.btn-do-delete');
    let delRegionMessage = delRegionForm.querySelector('.delete-message');

    delRegionForm.addEventListener('submit', (e) => {
        e.preventDefault();

        delRegionBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menghapus...';
        fetch(`{{ route('organizations.destroy', FALSE) }}/${actionID}`, {
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