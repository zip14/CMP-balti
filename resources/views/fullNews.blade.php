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
                    <li><a href="{{route('categoryNewsPage', ['category' => $news->category['alias']])}}"><i class="fa fa-folder-open"></i>{{$news->category['name']}}</a></li>
                    <li><i class="fa fa-calendar-o"></i>{{date('d F Y', strtotime($news['created_at']))}}</li>
                    <li><i class="fa fa-envelope-o"></i><a href="mailto:info@company.com">info@company.com</a></li>
                </ul>
            </div>

            @if($commentsCount != '0')
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-12">
                        <h2 class="comment-heading">Comentarii ({{$commentsCount}})</h2>
                        <div class="box-content">
                            <div class="comment">
                                <div class="comment-inner">

                                    @foreach($newsComments as $item)
                                        <div class="comment-body">
                                            <h4>{{$item['name']}}</h4>
                                            <span>{{date('d F Y', strtotime($item['created_at']))}}</span>
                                            <p>{{$item['comment']}}</p>
                                        </div>
                                    @endforeach

                                </div>

                            </div> <!-- /.comment -->

                        </div> <!-- /.box-content -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            @endif()


            <div class="row" style="margin-top: 50px;">
                <div class="col-md-12 comment-form">
                    <h2 class="comment-heading">Lăsați un commentarii</h2>
                    <div class="box-content">

                        <form id="comment_form">
                            {!! csrf_field() !!}

                            <input type="hidden" name="id_news" value="{{$news['id']}}">
                            <p>
                                <label for="name">Prenume dvs:</label>
                                <input type="text" class="validate[required]" name="name" id="name" required>
                            </p>
                            <p>
                                <label for="email">E-mail:</label>
                                <input type="email" name="email" class="validate[required]" id="email" required>
                            </p>
                            <p>
                                <label for="comment">Commentariu dvs:</label>
                                <textarea name="comment" class="validate[required]" id="comment" required></textarea>
                            </p>
                            <input type="submit" class="mainBtn" value="Trimite" />
                        </form>

                    </div> <!-- /.box-content -->
                </div> <!-- /.comment-form -->
            </div> <!-- /.row -->
        </div> <!-- /.inner-content -->
    </div> <!-- /.content-wrapper -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/script_admin.js')}}"></script>

    <script>
        $( document ).ready(function() {

         $('#comment_form').on('submit', function (e) {
             e.preventDefault();

             $.ajax ({
                 url : '{{route('comments.store')}}',
                 type: 'POST',
                 data:  $('#comment_form').serialize(),
                 dataType: 'JSON',
                 success: function (response) {
                     $('#comment_form').trigger("reset");
                     $('.comment-inner').prepend(response.renderComment);

                     new Noty({type: 'success', layout: 'topRight', text: response.message, timeout:3000}).show();

                 },
                 error: function (error) {
                     onSaveRequestError(error);
                 }
             })

         })
        });
    </script>

@endsection