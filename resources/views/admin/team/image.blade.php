@if(isset($image) &&!empty($image))
    <img src="/public/images/team/{{ $image }}" width="100px">
@else
    <img src="/public/images/noavatar.png" width="100px">
@endif