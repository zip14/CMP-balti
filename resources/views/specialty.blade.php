@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <div class="inner-container container">
            <div class="row">
                <div class="section-header col-md-12">
                    <h2>Specialitate</h2>
                    <span>Specialitate</span>
                </div> <!-- /.section-header -->
            </div> <!-- /.row -->

            @foreach($specialty as $item)
                <div class="our-team ">
                    <div class="team-member col-md-6 col-sm-6">
                        @if(!empty($item['image']))
                            <img src="{{asset('images/specialty') . '/' . $item['image']}}" alt="{{$item['name']}}" class="scpecialitati">
                        @else
                            <img src="{{asset('images/news/noImg.jpg')}}" alt="{{$item['name']}}" class="scpecialitati">
                        @endif

                        <div class="box-content">
                            <h4 class="member-name"><a href="{{route('fullSpecialtyPage', ['specialty' => $item['alias']])}}">{{$item['name']}}</a></h4>
                            <span>Specialitate</span>
                            <p>{{$item['description']}}</p>
                        </div>
                    </div>
                </div> <!-- /.our-team -->

            @endforeach

        </div> <!-- /.inner-content -->
    </div> <!-- /.content-wrapper -->

@endsection