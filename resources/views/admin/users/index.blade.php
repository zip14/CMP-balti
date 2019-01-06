@extends('layouts.admin')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Utilizatori</h3>
            <div class="box-tools">
                <a data-fancybox data-type="ajax" data-src="{{ route('users.create') }}" href="javascript:;" class="btn btn-block btn-primary"><i class="fa fa-fw fa-plus"></i> Adăuga utilizator</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="users_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                    <th>Imaginea</th>
                    <th>Nume Prenume</th>
                    <th>Rolul</th>
                    <th>Acţiuni</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
    </div>
    <script>
        var dt;
        $(document).ready(function() {
            dt = $('#users_table').DataTable( {
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                responsive: true,
                "searching": false,
                stateSave: true,
                "order": [ 1, 'desc' ],
                "language": {
                    "lengthMenu": "_MENU_ pe pagina",
                    "zeroRecords": "Nimic nu a fost găsit - îmi pare rău",
                    "info": "Pagina _PAGE_ din _PAGES_",
                    "infoEmpty": "Nu există înregistrări disponibile",
                    "infoFiltered": "(filtrarea a _MAX_ intrări)",
                    "sSearch": "Caută:",
                    "oPaginate": {
                        "sFirst":    "Prima",
                        "sLast":    "Ultima",
                        "sNext":    "Următoarea",
                        "sPrevious": "Precedenta"
                    }
                },
                "columnDefs": [
                    {orderable: false, className: "ta-c w-100", "targets": 0},
                    {orderable: true, searchable: true, "targets": 1},
                    {orderable: true, className: "ta-c w-100", searchable: false, "targets": 2},
                    {orderable: false, className: "ta-c w-170", searchable: false, "targets": 3}

                ],
                "columns": [
                    {"data": "image"},
                    {"data": "nameSurname"},
                    {"data": "type"},
                    {"data": "actions"}

                ],

                "ajax": {
                    url: "{{ route('users.list') }}",
                    type: 'POST'
                }
            });
        });
    </script>
@endsection