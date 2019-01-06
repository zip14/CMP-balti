@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <div class="inner-container container">
            <div class="row">
                <div class="section-header col-md-12">
                    <h2>{{$specialty['name']}}</h2>
                    <span>Specialitate</span>
                </div> <!-- /.section-header -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="blog-image col-md-12">

                    @if(!empty($specialty['image']))
                        <img src="{{asset('images/specialty') . '/' . $specialty['image']}}" alt="{{$specialty['name']}}">
                    @else
                        <img src="{{asset('images/news/noImg.jpg')}}" alt="{{$specialty['name']}}">
                    @endif

                </div> <!-- /.blog-image -->

                <div class="orar specilitate_orar">
                    <div class="orar_download" style="top:20px;">
                        <h2>Programul lecțiilor specialitate</h2>
                    </div>
                    <iframe src="{{$specialty['schedule_link']}}" allowTransparency seamless></iframe>
                </div>

                <div class="blog-info col-md-12">
                    <div class="box-content">
                        {!!$specialty['content']!!}
                    </div>
                </div> <!-- /.blog-info -->
            </div> <!-- /.row -->


        </div> <!-- /.inner-content -->
    </div> <!-- /.content-wrapper -->


@endsection