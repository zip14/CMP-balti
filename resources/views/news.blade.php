@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <div class="inner-container container">
            <div class="row">
                <div class="section-header col-md-12">
                    <h2>Noutăți</h2>
                    <span>de la academia noastră</span>
                </div> <!-- /.section-header -->
            </div> <!-- /.row -->
            <div class="projects-holder-3">

                <div class="filter-categories">
                    <ul class="project-filter">
                        <li class="{{$selctedCategory == 'all' ? 'active' : ''}}"><a href="{{route('newsPage')}}"><span>Toate</span></a></li>
                        @foreach($newsCategory as $item)
                        <li  class="{{$selctedCategory == $item['alias'] ? 'active' : ''}}"><a href="{{route('categoryNewsPage', ['category' => $item['alias']])}}"><span>{{$item['name']}}</span></a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="projects-holder">
                    <div class="row">
                        @foreach($news as $item)

                            <div class="col-md-4 project-item mix design">
                                <div class="project-thumb">
                                    <img src="{{asset('images/news') . '/' . $item['image']}}" alt="{{$item['title']}}">
                                    <div class="overlay-b">
                                        <div class="overlay-inner">
                                            <a href="{{asset('images/news') . '/' . $item['image']}}" class="fancybox fa fa-expand" title="{{$item['title']}}"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-content project-detail">
                                    <h2><a href="{{route('fullNewsPage', ['news' => $item['alias']])}}">{{$item['title']}}</a></h2>
                                    <p>{{$item['description']}}?</p>
                                </div>
                            </div> <!-- /.project-item -->
                        @endforeach


                    </div> <!-- /.row -->


                    <div class="row">
                        <div class="col-md-12">
                            <div class="pagination text-center">
                                {{ $news->links('paginate') }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection