@extends('layouts.main')

@section('content')

    <div class="container gallery-container">

        @foreach($gallaryCategory as $item)
            @if(!empty($item['images']) && $item['images'] != '[]')
                <div class="my_title">{{$item['name']}}</div>
                <div class="tz-gallery">
                    <div class="row">
                        @foreach($item['images'] as $image)
                                <div class="col-sm-12 col-md-4">
                                    <a class="lightbox" href="{{asset('images/gallary') . '/' . $image['image']}}">
                                        <img src="{{asset('images/gallary') . '/' . $image['image']}}" alt="">
                                        <p>{{$image['title']}}</p>
                                        <span>{{$image['description']}}</span>
                                    </a>
                                </div>

                        @endforeach

                    </div>
                </div>
            @endif
        @endforeach

            <div class="row">
                <div class="col-md-12">
                    <div class="pagination text-center">
                        {{ $gallaryCategory->links('paginate') }}
                    </div>
                </div>
            </div>

    </div>

@endsection