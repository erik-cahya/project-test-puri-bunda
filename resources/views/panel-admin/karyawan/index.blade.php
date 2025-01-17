@extends('panel-admin.partials.master')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Master Data Karyawan</h1>
    </div>

    {{-- <table class="table table-bordered" id="items-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
            </tr>
        </thead>
    </table> --}}

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Karyawan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="karyawan-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="100">No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Jabatan 1</th>
                                    <th>Jabatan 2</th>
                                    <th>Unit</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

     <script src="{{ asset('asset') }}/vendor/datatables/jquery.dataTables.min.js"></script>
     <script src="{{ asset('asset') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
 
     <script src="{{ asset('asset') }}/js/demo/datatables-demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#karyawan-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('karyawan.data') }}',
                    type: 'GET',
                    dataType: 'json',
                    dataSrc: function (json) {
                        return json.data;
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Kolom untuk nomor urut
                    { data: 'nama_karyawan', name: 'nama_karyawan' },
                    { data: 'username', name: 'username' },
                    { data: 'nama_jabatan_1', name: 'nama_jabatan_1' },
                    { data: 'nama_jabatan_2', name: 'nama_jabatan_2' },
                    { data: 'nama_unit', name: 'nama_unit' },
                    { data: 'tanggal_bergabung', name: 'tanggal_bergabung' },
                    { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false, 
                    render: function (data, type, row) {
                        var editButton = '<button class="btn btn-primary btn-sm mr-1" onclick="editItem(' + row.id + ')">Edit</button>';
                        var deleteButton = '<button class="btn btn-danger btn-sm" onclick="deleteItem(' + row.id + ')">Delete</button>';

                        return editButton + deleteButton;
                    }
                },
                ]
            });
        });

        function editItem(id) {
            window.location.href = '/karyawan/' + id + '/edit';
        }

        function deleteItem(id) {
        if (confirm("Are you sure you want to delete this item?")) {
            axios.delete('/karyawan/' + id)
                .then(function (response) {
                    // HotReload Data Table
                    $('#karyawan-table').DataTable().ajax.reload();
                })
                .catch(function (error) {
                    console.error('Error deleting item: ' + error);
                });
        }
    }
    </script>
@endsection