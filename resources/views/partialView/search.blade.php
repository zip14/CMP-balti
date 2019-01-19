<div class="content-wrapper">
    <div class="inner-container container">
        <div class="row">
            <div class="section-header col-md-12">
                <h2>Noutăți la cerere: {{$search}}</h2>

            </div> <!-- /.section-header -->
        </div> <!-- /.row -->
        <div class="projects-holder-3">

<!--            --><?php
//            echo('<pre>');
//            print_r($news);
//            echo('</pre>');
//            ?>
            <div class="projects-holder">
                <div class="row">
                    @foreach($news as $item)

                        <div class="col-md-4 project-item design">
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