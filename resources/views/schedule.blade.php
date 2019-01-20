@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="orar">
            <div class="orar_download">
                <h2>Programul lecțiilor</h2>
            </div>
            <iframe src="{{$schedule['link']}}" allowTransparency seamless></iframe>
        </div>
    </div>

@endsection