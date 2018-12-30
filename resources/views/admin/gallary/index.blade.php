@extends('layouts.admin')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Galerie</h3>
            <div class="box-tools">
                <a data-fancybox data-type="ajax" data-src="{{ route('gallary.create') }}" href="javascript:;" class="btn btn-block btn-primary "><i class="fa fa-fw fa-plus"></i> Adăuga imagine</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="gallary_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                    <th>Descrierea</th>
                    <th>Сategorie</th>
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
            dt = $('#gallary_table').DataTable( {
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                responsive: true,
                //"searching": false,
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
                    {orderable: true, searchable: true, "targets": 0},
                    {orderable: false, className: "w-200", searchable: false, "targets": 1},
                    {orderable: false, className: "w-120", searchable: false, "targets": 2},
                    {orderable: true, className: "w-100", searchable: false, "targets": 3},
                    {orderable: false, className: "w-170", searchable: false, "targets": 4},


                ],
                "columns": [
                    {"data": "description"},
                    {"data": "category"},
                    {"data": "image"},
                    {"data": "date"},
                    {"data": "actions"},

                ],

                "ajax": {
                    url: "{{ route('gallary.list') }}",
                    type: 'POST',
                }
            });
        });
    </script>
@endsection