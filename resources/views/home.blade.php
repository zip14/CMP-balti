@extends('layouts.main')

@section('content')


    <div class="swiper-container">
        <div class="swiper-wrapper">

            <div class="swiper-slide" style="background-image: url(images/slide1.jpg);">
                <div class="overlay-s"></div>
                <div class="slider-caption">
                    <div class="inner-content">
                        <h2>Despre noi</h2>
                        <p>În primii ani de înfiinţare ca instituţie de învăţămînt mediu de specialitate, procesul instructiv-educativ a demarat doar în cadrul a  cinci catedre şi specializări respective...</p>
                        <a href="{{route('aboutPage')}}" class="main-btn white">mai mult</a>
                    </div> <!-- /.inner-content -->
                </div> <!-- /.slider-caption -->
            </div> <!-- /.swier-slide -->

            <div class="swiper-slide" style="background-image: url(images/slide2.jpg);">
                <div class="overlay-s"></div>
                <div class="slider-caption">
                    <div class="inner-content">
                        <h2>Orar</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe porro aut quia, ea inventore aliquam?</p>
                        <a href="{{route('schedulePage')}}" class="main-btn white">mai mult</a>
                    </div> <!-- /.inner-content -->
                </div> <!-- /.slider-caption -->
            </div> <!-- /.swier-slide -->

            <div class="swiper-slide" style="background-image: url(images/slide3.jpg);">
                <div class="overlay-s"></div>
                <div class="slider-caption">
                    <div class="inner-content">
                        <h2>Profesori</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat est reiciendis, in amet deserunt soluta.</p>
                        <a href="{{route('teamPage')}}" class="main-btn white">mai mult</a>
                    </div> <!-- /.inner-content -->
                </div> <!-- /.slider-caption -->
            </div> <!-- /.swier-slide -->

        </div> <!-- /.swiper-wrapper -->
    </div> <!-- /.swiper-container -->

    <div class="container" id="director">
        <img src="images/my_img/man-user.png" alt="">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque blanditiis quaerat, deserunt quam aliquam repellendus minima vero expedita doloremque amet possimus nisi, deleniti ullam labore nemo error iste ducimus atque perferendis, in mollitia veritatis ex praesentium dolorem! Inventore porro, dolore nesciunt sapiente, eum alias, laboriosam rem laborum cupiditate esse provident.</p>
    </div>

    <div class="inner-container container">
        <div class="projects-holder">
            <div class="row">
                @foreach($topNews as $item)

                    <div class="col-md-4 project-item mix design">
                        <div class="project-thumb">
                            @if(!empty($item['image']))
                                <img src="{{asset('images/news') . '/' . $item['image']}}" alt="{{$item['title']}}">
                            @else
                                <img src="{{asset('images/news/noImg.jpg')}}" alt="{{$item['title']}}">
                            @endif

                            <div class="overlay-b">
                                <div class="overlay-inner">
                                    <a href="{{route('fullNewsPage', ['news' => $item['id']])}}" class="fancybox fa fa-expand" title="{{$item['title']}}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="box-content project-detail">
                            <h2><a href="{{route('fullNewsPage', ['news' => $item['alias']])}}">{{$item['title']}}</a></h2>
                            <p>{{$item['description']}}</p>
                        </div>
                    </div> <!-- /.project-item -->

                @endforeach

            </div> <!-- /.row -->
        </div> <!-- /.projects-holder -->
    </div>
    <div class="view_all"><a href="#">Vezi toate</a></div>

    <p id="text_index"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quisquam, dignissimos tempore. Animi voluptatum quo fugiat est pariatur, sequi blanditiis quisquam recusandae!</span></p>

    <div id="special_index" class="container">
        <ul>
            @foreach($lastSpecialty as $item)
                <li>
                    @if(!empty($item['image']))
                        <img src="{{asset('images/specialty') . '/' . $item['image']}}" alt="{{$item['name']}}">
                    @else
                        <img src="{{asset('images/news/noImg.jpg')}}" alt="{{$item['name']}}">
                    @endif

                    <p>{{$item['name']}}</p>
                </li>
            @endforeach

        </ul>
    </div>
    <div class="view_all"><a href="{{route('specialtyPage')}}">Vezi toate</a></div>

@endsection