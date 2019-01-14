@extends('layouts.main')

@section('content')

    <div id="echipa_wrapp_full">
        <div id="echipa_full">
            <div class="echipa_wrapp_img_full">
                <figure>
                    <img src="{{asset('images/team') . '/' . $person['image']}}" alt="{{$person['name']}}">
                    <figcaption>{{$person['name']}}</figcaption>
                </figure>
            </div>
            <ul>
                @if(!empty($person['position']))
                    <li><i class="fa fa-music"></i><span>{{$person['position']}}</span></li>
                @endif

                @if(!empty($person['education']))
                    <li><i class="fa fa-music"></i><span>{{$person['education']}}</span></li>
                @endif

                @if(!empty($person['achievements']))
                    <li><i class="fa fa-music"></i><span>{{$person['achievements']}}</span></li>
                @endif

            </ul><br><br>
            <p>{!! $person['description'] !!}</p>
        </div>

    </div>


@endsection