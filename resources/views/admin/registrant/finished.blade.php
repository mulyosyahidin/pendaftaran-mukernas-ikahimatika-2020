@extends('layouts.admin')
@section('title', 'Pendaftaran Selesai')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Pendaftaran Selesai</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item active"><a href="{{ route('admin.reg.all') }}">Pendaftar</a></div>
          <div class="breadcrumb-item">Pendaftaran Selesai</div>
        </div>
      </div>

      <div class="section-body">
        @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
        @else
            <p>Pendaftar yang berkasnya sudah diverifikasi dan sudah dikonfirmasi pembayarannya.</p>
        @endif

        <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h5 class="card-title">Data Pendaftaran</h5>
                  </div>
                  <div class="table-responsive">
                      <table class="table table-striped table-hover" id="payment-table">
                          <thead class="thead-light">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Status Pendaftaran</th>
                                <th scope="col">Himpunan</th>
                                <th scope="col">Universitas</th>
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

@push('custom_js')
    <script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
    <script>
        let table = $('#payment-table').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": "{{ route('registrants-data.index') }}?status=3",
            "headers": {
                "Authorization": "Bearer {{ Session::get('Bearer_token') }}"
            }
        },
        "columns": [
            {
                data: "id"
            },
            {
                data: function (data, type, row) {
                    let id = data.id;
                    let name = data.name;

                    return `<a href="{{ route('admin.reg.show', FALSE) }}/${id}">${name}</a>`;
                }
            },
            {
                data: "nim"
            },
            {
                data: "status"
            },
            {
                data: "organization"
            },
            {
                data: "university"
            }
        ]
    });
    </script>
@endpush