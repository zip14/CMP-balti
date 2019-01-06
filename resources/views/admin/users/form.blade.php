<div style="width:700px">
    <div class="col-md-12">
        <form method="POST"  class="form-horizontal" id="user_add_form" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" name="image" id="image_cropp">

            @if(!empty($id))
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id='id' name="id" value="{{$id}}">
            @endif

            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title"><strong>{{!empty($id) ? 'Editați' : 'Adăugați'}} persoana</strong></h3>
            </div>

            <div class="form-group">
                <label for="name">Prenume</label>
                <input type="text" class="form-control validate[required]" id="name" name="name" placeholder="Prenume:" value="{{!empty($name) ? $name : ''}}">
            </div>

            <div class="form-group">
                <label for="surname">Nume</label>
                <input type="text" class="form-control validate[required]" id="surnam" name="surname" placeholder="Nume:" value="{{!empty($surname) ? $surname : ''}}">
            </div>


            <div class="row justify-content-md-center">
                <div class="col-6">
                    @if(!empty($image))
                        <img src="{{asset('public/images/users/') . '/' . $image}}" width="50%" style="margin-left: 25%" id="add_image">
                        <input type="hidden" name="old_image" value="{{$image}}">
                    @endif
                </div>
            </div><br>

            <div class="form-group">
                <label for="upload_image">Imaginea</label>
                <input type="file" id="upload_image" name="upload_image"><br>
            </div>
            <div id="image"></div>

            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control validate[required]" id="login" name="login" placeholder="Login:" value="{{!empty($login) ? $login : ''}}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control validate[required,custom[email]]" id="email" name="email" placeholder="Email:" value="{{!empty($email) ? $email : ''}}">
            </div>

            @if(!isset($id))
                <div class="form-group">
                    <label for="password">Parola</label>
                    <input type="password" class="form-control validate[required]" id="password" name="password" placeholder="Password:">
                </div>
            @endif

            @if(Auth::user()->type == 'admin')
                <div class="row">
                    <div class="col-xs-3">
                        <label for="type">Administrator</label>
                        @if(!empty($type) && $type == 'admin')
                            <input type="checkbox" id="type" value="1" name="type" style="margin-left: 10px" checked>
                        @else
                            <input type="checkbox" id="type" value="1" name="type" style="margin-left: 10px">
                        @endif
                    </div>
                </div>
            @endif

            <button class="btn btn-default" type="reset">Curăța</button>
            <button class="btn btn-primary pull-right" type="submit">{{!empty($id) ? 'Modifica' : 'Adăuga'}}</button>

        </form>
    </div>
</div>

<script>
    var url = '{{route('users.store')}}';
    var id = $('#id'). val()
    if(id != undefined){
        url = 'users/' + id;
    }

    var image;
    $('#upload_image').on('change', function(){
        image = $('#image').croppie({
            enableExif: true,
            viewport: {
                width: 300,
                height: 300,
                type: 'square'
            },
            boundary: {
                width: 500,
                height: 450
            }
        });

        if (this.files && this.files[0]){
            var reader = new FileReader();

            reader.onload = function (e) {
                image.croppie('bind', {
                    url: e.target.result
                }).then(function(){});
            }

            reader.readAsDataURL(this.files[0]);
        }

    });

    $("#user_add_form").submit(function(e){
        e.preventDefault();
        if($('#upload_image').val() == ''){
            ajax_request_form();
            return;
        }
        image.croppie('result', {
            type: 'base64',
            size: 'viewport'

        }).then(function (resp){

            $('#image_cropp').val(resp);
            ajax_request_form();
        });
    });

    $('#upload_image').on('change', function(){
        $('#add_image').addClass('hide');
    })

    function ajax_request_form(){
        if( ! $("#user_add_form").validationEngine('validate')){
            return false;
        }

        $.ajax({
            url : url,
            type : 'POST',
            dataType : 'JSON',
            data : $('#user_add_form').serialize(),
            success: function (response) {
                new Noty({type: 'success', layout: 'topRight', text: response.message, timeout:3000}).show();

                $.fancybox.close();
                if(dt) {
                    dt.draw(false)
                }
            },
            error: function (error) {
                onSaveRequestError(error);
            }
        });
    }


</script>
