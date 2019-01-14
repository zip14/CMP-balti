@extends('layouts.admin')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Comentarii</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="comments_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                    <th>Nume</th>
                    <th>Email</th>
                    <th>Comentariu</th>
                    <th>Stiri</th>
                    <th>Data</th>
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
            dt = $('#comments_table').DataTable( {
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                responsive: true,
                //"searching": false,
                stateSave: true,
                "order": [ 4, 'desc' ],
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
                    {orderable: true, searchable: true, className: "w-200", "targets": 0},
                    {orderable: false, searchable: true, className: "w-170", "targets": 1},
                    {orderable: false, searchable: false, "targets": 2},
                    {orderable: false, searchable: false, "targets": 3},
                    {orderable: true, className: "ta-c w-60", searchable: false, "targets": 4},
                    {orderable: false, className: "w-100", searchable: false, "targets": 5},


                ],
                "columns": [
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "comment"},
                    {"data": "news"},
                    {"data": "date"},
                    {"data": "actions"},

                ],

                "ajax": {
                    url: "{{ route('comments.list') }}",
                    type: 'POST',
                }
            });
        });
    </script>
@endsection