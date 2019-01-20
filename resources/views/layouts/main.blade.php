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

    @if($active == 'gallary')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
    @endif
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

                @if($active == 'home')
                    <a href="#" class="btn-left arrow-left fa fa-angle-left" style="margin-left:70px;"></a>
                    <a href="#" class="btn-left arrow-right fa fa-angle-right "></a>
                @endif

            </div> <!-- /.main-header-left -->

            <div class="menu-wrapper col-md-9 col-sm-6 col-xs-4">
                <a href="#" class="toggle-menu visible-sm visible-xs"><i class="fa fa-bars"></i></a>
                <ul class="sf-menu hidden-xs hidden-sm">
                    <li class="{{$active == 'home' ? 'active' : ''}}"><a href="{{route('homePage')}}">Acasă</a></li>
                    <li class="{{$active == 'news' ? 'active' : ''}}"><a href="{{route('newsPage')}}">Noutăți</a></li>
                    <li class="{{$active == 'gallary' ? 'active' : ''}}"><a href="{{route('gallaryPage')}}">Galerie</a></li>
                    <li class="{{$active == 'about' ? 'active' : ''}}"><a href="{{route('aboutPage')}}">Despre noi</a>
                        <ul>
                            <li><a href="{{route('specialtyPage')}}">Specialități</a></li>
                            <li><a href="{{route('teamPage')}}">echipa</a></li>
                        </ul>
                    </li>
                    <li class="{{$active == 'schedule' ? 'active' : ''}}"><a href="#">Elevi</a>
                        <ul>
                            <li><a href="{{route('schedulePage')}}">Orar</a></li>
                            <li><a href="absolvenți.html">absolvenți</a></li>
                        </ul>
                    </li>
                    <li class="{{$active == 'contact' ? 'active' : ''}}"><a href="{{route('contactPage')}}">Contact</a></li>
                </ul>
            </div> <!-- /.menu-wrapper -->
        </div> <!-- /.row -->
    </div> <!-- /.main-header -->
    <div id="responsive-menu">
        <ul>
            <li class="{{$active == 'home' ? 'active' : ''}}"><a href="{{route('homePage')}}">Acasă</a></li>
            <li class="{{$active == 'news' ? 'active' : ''}}"><a href="{{route('newsPage')}}">Noutăți</a></li>
            <li class="{{$active == 'gallary' ? 'active' : ''}}"><a href="{{route('gallaryPage')}}">Galerie</a></li>
            <li class="{{$active == 'about' ? 'active' : ''}}"><a href="{{route('aboutPage')}}">Despre noi</a>
                <ul class="sub_menu">
                    <li><a href="{{route('specialtyPage')}}">Specialități</a></li>
                    <li><a href="{{route('teamPage')}}">echipa</a></li>
                </ul>
            </li>
            <li class="{{$active == 'schedule' ? 'active' : ''}}"><a href="#">Elevi</a>
                <ul class="sub_menu">
                    <li><a href="{{route('schedulePage')}}">Orar</a></li>
                    <li><a href="absolvenți.html">absolvenți</a></li>
                </ul>
            </li>
            <li class="{{$active == 'contact' ? 'active' : ''}}"><a href="{{route('contactPage')}}">Contact</a></li>
        </ul>
    </div>
</header> <!-- /.site-header -->

<div class="search_container"></div>
@yield('content')

<footer>
    <ul>
        @foreach($lastNews as $item)
            <li>
                <span>{{date('d-m-Y', strtotime($item['created_at']))}}</span><i class="fa fa-calendar-o"></i>
                @if(!empty($item['image']))
                    <img src="{{asset('images/news/' . $item['image'])}}" alt="{{$item['title']}}">
                @else
                    <img src="{{asset('images/news/noImg.jpg')}}" alt="{{$item['title']}}">
                @endif
                <p><a href="{{route('fullNewsPage', ['news' => $item['alias']])}}">{{$item['title']}}</a></p>
            </li>
        @endforeach
    </ul>

    <div id="_footer_contact">
        <div class="footer_contact">
            <i class="fa fa-envelope"></i>
            <p>colegiumuzical@gmail.com</p>
        </div>
        <div class="footer_contact">
            <i class="fa fa-phone"></i>
            <p>0 (231) 25-2-89</p>
        </div>
        <div class="footer_contact">
            <i class="fa fa-map-marker"></i>
            <p> Ciprian Porumbescu 18</p>
        </div>
    </div>
    <div id="footer_bootom">
        <p>Colegiul de Muzică și Pedagogie mun. Bălți</p>
    </div>
</footer>

@if($active == 'gallary')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
@endif

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

    $('#search_input').on('keyup', function () {

        $.ajax ({
            url : '{{route('search')}}',
            type: 'POST',
            data:   $('#search').serialize(),
            dataType: 'JSON',
            success: function (response) {
                $( ".container, .view_all, .swiper-container, .content-wrapper, #text_index, #special_index" ).remove();
                $('.search_container').prepend(response.renderData);

            },
    
        })
    
    })
</script>

</body>
</html>
