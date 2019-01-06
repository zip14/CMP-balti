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
            <div class="row">
                <div class="blog-image col-md-12">

                    @if(!empty($news['image']))
                        <img src="{{asset('images/news') . '/' . $news['image']}}" alt="{{$news['title']}}">
                    @else
                        <img src="{{asset('images/news/noImg.jpg')}}" alt="{{$news['title']}}">
                    @endif

                </div> <!-- /.blog-image -->
                <div class="blog-info col-md-12">
                    <div class="box-content">
                        <h2 class="blog-title">{{$news['title']}}</h2>

                        {!!$news['content']!!}

                    </div>
                </div> <!-- /.blog-info -->
            </div> <!-- /.row -->

            <div class="project-infos">
                <ul class="project-meta">
                    <li><i class="fa fa-folder-open"></i>{{$news->category['name']}}</li>
                    <li><i class="fa fa-calendar-o"></i>{{date('d F Y', strtotime($news['created_at']))}}</li>
                    <li><i class="fa fa-envelope-o"></i><a href="mailto:info@company.com">info@company.com</a></li>
                </ul>
            </div>

            <div class="row" style="margin-top: 50px;">
                <div class="col-md-12">
                    <h2 class="comment-heading">Comments (3)</h2>
                    <div class="box-content">
                        <div class="comment">
                            <div class="comment-inner">

                                <div class="comment-body">
                                    <h4>name</h4>
                                    <span>6 November 2084</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque ab culpa unde quisquam. Dolorum, sint, nobis quisquam quaerat dicta laudantium at voluptatem eum expedita mollitia quas placeat tenetur possimus eligendi.</p>
                                </div>
                                <div class="comment-body">
                                    <h4>name</h4>
                                    <span>6 November 2084</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque ab culpa unde quisquam. Dolorum, sint, nobis quisquam quaerat dicta laudantium at voluptatem eum expedita mollitia quas placeat tenetur possimus eligendi.</p>
                                </div>
                                <div class="comment-body">
                                    <h4>name</h4>
                                    <span>6 November 2084</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque ab culpa unde quisquam. Dolorum, sint, nobis quisquam quaerat dicta laudantium at voluptatem eum expedita mollitia quas placeat tenetur possimus eligendi.</p>
                                </div>

                            </div>

                        </div> <!-- /.comment -->

                    </div> <!-- /.box-content -->
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-12 comment-form">
                    <h2 class="comment-heading">Lăsați un commentarii</h2>
                    <div class="box-content">
                        <p>
                            <label for="name">Prenume dvs:</label>
                            <input type="text" name="name" id="name">
                        </p>
                        <p>
                            <label for="email">E-mail:</label>
                            <input type="text" name="email" id="email">
                        </p>
                        <p>
                            <label for="comment">Commentariu dvs:</label>
                            <textarea name="comment" id="comment"></textarea>
                        </p>
                        <input type="submit" class="mainBtn" id="submit-comment" value="Trimite" />
                    </div> <!-- /.box-content -->
                </div> <!-- /.comment-form -->
            </div> <!-- /.row -->
        </div> <!-- /.inner-content -->
    </div> <!-- /.content-wrapper -->

@endsection