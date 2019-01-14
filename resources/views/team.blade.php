
@extends('layouts.main')

@section('content')

    <div class="container echipa_wrapper">
        <h2>Echipa noastra</h2>
        <div class="echipa_wrapp">
            @foreach($team as $item)
                <div class="echipa">
                    <div class="echipa_wrapp_img">
                        <img src="{{asset('images/team') . '/' . $item['image']}}" alt="{{$item['name']}}">
                    </div>
                    <p><a href="{{route('fullTeamPage', ['team' => $item['alias']])}}">{{$item['name']}}</a></p>
                </div>
            @endforeach

        </div>
    </div>

@endsection