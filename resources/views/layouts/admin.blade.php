
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Colegiul de Muzică și Pedagogie mun. Bălți</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">


    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <link href="{{asset('public/plugins/Validation-Engine/css/validationEngine.jquery.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/plugins/croppie/croppie.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>


    <link href="{{asset('public/plugins/noty/css/noty.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/plugins/noty/themes/mint.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('public/css/sizes.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('public/AdminLTE/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <script src="{{asset('public/js/script_admin.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo" target="_blank">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">CMP</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">CMP</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(!empty(Auth::user()->image))
                                <img src="{{asset('public/images/users') . '/' . Auth::user()->image}}" class="user-image" alt="{{Auth::user()->name}} {{Auth::user()->surname}}">
                            @else
                                <img src="{{asset('public/images/noavatar.png')}}" class="user-image" alt="{{Auth::user()->name}} {{Auth::user()->surname}}">
                            @endif


                            <span class="hidden-xs">{{Auth::user()->name}} {{Auth::user()->surname}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                @if(!empty(Auth::user()->image))
                                    <img src="{{asset('public/images/users'). '/' . Auth::user()->image}}" class="img-circle" alt="{{Auth::user()->name}} {{Auth::user()->surname}}">
                                @else
                                    <img src="{{asset('public/images/noavatar.png')}}" class="img-circle" alt="{{Auth::user()->name}} {{Auth::user()->surname}}">
                                @endif


                                <p>
                                    {{Auth::user()->name}} {{Auth::user()->surname}}
                                    <small>{{Auth::user()->position}}</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('users.profile')}}" class="btn btn-default btn-flat">Profil</a>
                                </div>
                                <div class="pull-right">
                                    <a data-fancybox data-type="ajax" data-src="{{ route('logoutForm') }}" href="javascript:;" class="btn btn-default btn-flat">Ieșire</a>
                                </div>
                            </li>
                        </ul>
                    </li>


                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    @if(!empty(Auth::user()->image))
                        <img src="{{asset('public/images/users') . '/' . Auth::user()->image}}" class="img-circle" alt="{{Auth::user()->name}} {{Auth::user()->surname}}">
                    @else
                        <img src="{{asset('public/images/noavatar.png')}}" class="img-circle" alt="{{Auth::user()->name}} {{Auth::user()->surname}}">
                    @endif
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}} {{Auth::user()->surname}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">NAVIGARE</li>

                <li><a href="{{ route('gallary-category.index') }}"><i class="fa fa-fw fa-list"></i> <span>Categorie pentru galerie</span></a></li>
                <li><a href="{{ route('gallary.index') }}"><i class="fa fa-fw fa-file-photo-o"></i> <span>Galerie</span></a></li>
                <li><a href="{{ route('news-category.index') }}"><i class="fa fa-fw fa-list-alt"></i> <span>Categorie pentru noutăţi</span></a></li>
                <li><a href="{{ route('news.index') }}"><i class="fa fa-fw fa-newspaper-o"></i> <span>Noutăţi</span></a></li>
                <li><a href="{{ route('specialty.index') }}"><i class="fa fa-fw fa-user"></i> <span>Specialități</span></a></li>
                <li><a href="{{ route('comments.index') }}"><i class="fa fa-fw fa-comments"></i> <span>Comentarii</span></a></li>
                <li><a href="{{ route('team.index') }}"><i class="fa fa-fw fa-graduation-cap"></i> <span>Echipa</span></a></li>

                @if(Auth::user()->type == 'admin')
                    <li><a href="{{ route('users.index') }}"><i class="fa fa-fw fa-group"></i> <span>Utilizatori</span></a></li>
                @endif

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Panoul de administrare

            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="col-xs-12">


            @yield('content')
            <!-- right col -->

            </div>

            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; <?=date('Y')?> <a href="">Zagorcea Ion</a>.</strong>
    </footer>

    <div class="control-sidebar-bg"></div>
</div>


<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('public/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('public/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('public/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('public/AdminLTE/bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('public/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<script src="{{asset('public/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/bower_components/fullcalendar/dist/locale-all.js')}}"></script>

<script src="{{asset('public/plugins/noty/js/noty.js')}}"></script>

<script src="{{asset('public/plugins/Validation-Engine/js/jquery.validationEngine.js')}}"></script>
<script src="{{asset('public/plugins/Validation-Engine/js/jquery.validationEngine-ro.js')}}"></script>

<script src="{{asset('public/plugins/croppie/croppie.js')}}"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

<script src="{{asset('public/plugins/tinymce/tinymce.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('public/AdminLTE/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/AdminLTE/dist/js/demo.js')}}"></script>
<!-- page script -->
</body>
</html>
