<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Colegiul de Muzică și Pedagogie mun. Bălți</title>
    <meta name="description" content="Colegiul de Muzică și Pedagogie mun. Bălți">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,300italic,300,500,500italic,700,900">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/templatemo-misc.css')}}">
    <link rel="stylesheet" href="{{asset('css/templatemo-style.css')}}">

    <link href="{{asset('plugins/noty/css/noty.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/noty/themes/mint.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('js/vendor/modernizr-2.6.1-respond-1.1.0.min.js')}}"></script>

    <script src="{{asset('plugins/noty/js/noty.js')}}"></script>
</head>
<body>
<section id="pageloader">
    <div class="loader-item fa fa-spin colored-border"></div>
</section>

<header class="site-header container-fluid">
    <div class="top-header">
        <div class="logo col-md-6 col-sm-6">
            <h1><a href="{{route('homePage')}}"><img src="{{asset('images/my_img/logo.png')}}" alt=""></a></h1><br>
            <span>Colegiul de Muzică și Pedagogie mun. Bălți</span>
        </div>
        <div class="social-top col-md-6 col-sm-6">
            <ul>
                <li><a href="#" class="fa fa-facebook"></a></li>
            </ul>
        </div>
    </div>

    <div class="main-header">
        <div class="row">
            <div class="main-header-left col-md-3 col-sm-6 col-xs-8">
                <div id="search-icon" class="">
                    <form id="search">
                        {!! csrf_field() !!}
                        <i class="fa fa-search"></i>
                        <input type="text" name="search" id="search_input">
                    </form>

                </div>

            </div> <!-- /.main-header-left -->

            <div class="menu-wrapper col-md-9 col-sm-6 col-xs-4">
                <a href="#" class="toggle-menu visible-sm visible-xs"><i class="fa fa-bars"></i></a>
                <ul class="sf-menu hidden-xs hidden-sm">
                    <li><a href="{{route('homePage')}}">Acasă</a></li>
                    <li><a href="{{route('newsPage')}}">Noutăți</a></li>
                    <li><a href="{{route('gallaryPage')}}">Galerie</a></li>
                    <li><a href="{{route('aboutPage')}}">Despre noi</a>
                        <ul>
                            <li><a href="{{route('specialtyPage')}}">Specialități</a></li>
                            <li><a href="{{route('teamPage')}}">echipa</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Elevi</a>
                        <ul>
                            <li><a href="orar.html">Orar</a></li>
                            <li><a href="absolvenți.html">absolvenți</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('contactPage')}}">Contact</a></li>
                </ul>
            </div> <!-- /.menu-wrapper -->
        </div> <!-- /.row -->
    </div> <!-- /.main-header -->
    <div id="responsive-menu">
        <ul>
            <li><a href="{{route('homePage')}}">Acasă</a></li>
            <li><a href="{{route('newsPage')}}">Noutăți</a></li>
            <li><a href="{{route('gallaryPage')}}">Galerie</a></li>
            <li><a href="{{route('aboutPage')}}">Despre noi</a>
                <ul class="sub_menu">
                    <li><a href="{{route('specialtyPage')}}">Specialități</a></li>
                    <li><a href="{{route('teamPage')}}">echipa</a></li>
                </ul>
            </li>
            <li><a href="#">Elevi</a>
                <ul class="sub_menu">
                    <li><a href="orar.html">Orar</a></li>
                    <li><a href="absolvenți.html">absolvenți</a></li>
                </ul>
            </li>
            <li><a href="{{route('contactPage')}}">Contact</a></li>
        </ul>
    </div>
</header> <!-- /.site-header -->

<div class="search_container"></div>

<div class="content-wrapper">
    <div class="inner-container container">
        <div class="row">
            <div class="section-header col-md-12">
                <h2>404 - Pagina nu a fost gasita !</h2>
            </div> <!-- /.section-header -->
        </div> <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box-content">
                    <div class="text-center error-page">
                        <h1>404</h1>
                        <span>Pagina nu poate fi găsită pe acest site.</span>
                        <p>Încercați Navigare sau Căutare pentru a găsi ceea ce căutați!</p>
                        <p><a href="{{route('homePage')}}">&larr; Acasă</a></p>
                    </div> <!-- /.text-center -->
                </div> <!-- /.box-content -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.inner-content -->
</div> <!-- /.content-wrapper -->


<script src="{{asset('js/vendor/jquery-1.11.0.min.js')}}"></script>
{{--<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>--}}
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('.loader-item').fadeOut();
        $('#pageloader').delay(350).fadeOut('slow');
        $('body').delay(350).css({'overflow-y':'visible'});
    })
</script>

<script>
    // $('#search_input').on('click', function () {
    //
    // });
    $('#search_input').on('keyup', function () {
        // alert($('#search_input').val()  );
        $.ajax ({
            url : '{{route('search')}}',
            type: 'POST',
            data:   $('#search').serialize(),
            dataType: 'JSON',
            success: function (response) {
                $( ".container, .view_all, .swiper-container, #text_index, #special_index" ).remove();
                $('.search_container').prepend(response.renderData);

                // $('#contactform').trigger("reset");
                // new Noty({type: 'success', layout: 'topRight', text: response.message, timeout:3000}).show();

            },

        })

    })
</script>

</body>
</html>
