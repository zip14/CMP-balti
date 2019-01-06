@extends('layouts.admin')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Profil</h3>
            <div class="box-tools">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="col-md-4 col-md-offset-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-blue">
                        <div class="widget-user-image">
                            @if(!empty($image))
                                <img src="{{asset('public/images/users') . '/' . $image}}" class="img-circle" alt="{{$surname}} {{$name}}" style="margin-top: -10px">
                            @else
                                <img src="{{asset('public/images/noavatar.png')}}" class="img-circle" alt="{{$surname}} {{$name}}" style="margin-top: -10px">
                            @endif

                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{$surname}} {{$name}}</h3>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#"><i class="fa fa-fw fa-user"></i><strong> Login:</strong> {{$login}}</a></li>
                            <li><a href="#"><i class="fa fa-fw fa-envelope"></i><strong> Email:</strong> {{$email}}</a></li>
                            <li><a href="#"><i class="fa fa-fw fa-group"></i><strong> Rolul:</strong> {{$type}}</a></li>

                        </ul><br>
                        <div class="row">
                            <div class="col-md-6">
                                <a data-fancybox data-type="ajax" data-src="{{ route('users.edit', $id) }}" href="javascript:;" class="btn btn-primary" style="width: 90%; margin-left: 10px"><i class="fa fa-fw fa-pencil"></i> Edita</a>

                            </div>
                            <div class="col-md-6">
                                <a data-fancybox data-type="ajax" data-src="{{ route('users.password', $id) }}" href="javascript:;" class="btn btn-default" style="width: 90%; margin-right: 10px"><i class="fa fa-fw fa-unlock-alt"></i> Schimba parola</a>
                            </div>
                        </div>
                    <br>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
    </div>

@endsection