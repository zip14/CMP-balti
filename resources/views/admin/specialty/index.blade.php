@extends('layouts.admin')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Specialități</h3>
            <div class="box-tools">
                <a data-fancybox data-type="ajax" data-src="{{ route('specialty.create') }}" href="javascript:;" class="btn btn-block btn-primary "><i class="fa fa-fw fa-plus"></i> Adăuga specialitate</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="specialty_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                    <th>Denumire</th>
                    <th>Descriere</th>
                    <th>Orar</th>
                    <th>Imaginea</th>
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
            dt = $('#specialty_table').DataTable( {
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
                    {orderable: true, searchable: true, "targets": 0},
                    {orderable: false, searchable: true, "targets": 1},
                    {orderable: false, className: "w-150", searchable: false, "targets": 2},
                    {orderable: false, className: "w-120", searchable: false, "targets": 3},
                    {orderable: true, className: "ta-c w-60", searchable: false, "targets": 4},
                    {orderable: false, className: "w-170", searchable: false, "targets": 5},


                ],
                "columns": [
                    {"data": "nameLink"},
                    {"data": "description"},
                    {"data": "orar_link"},
                    {"data": "image"},
                    {"data": "date"},
                    {"data": "actions"},

                ],

                "ajax": {
                    url: "{{ route('specialty.list') }}",
                    type: 'POST',
                }
            });
        });
    </script>
@endsection