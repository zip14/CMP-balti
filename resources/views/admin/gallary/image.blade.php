@if(isset($image) &&!empty($image))
    <img src="/public/images/gallary/{{ $image }}" width="100px">
@else
    <img src="/public/images/noImg.jpg" width="100px">
@endif