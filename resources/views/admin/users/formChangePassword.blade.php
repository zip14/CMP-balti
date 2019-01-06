<div style="width:400px">
    <div class="col-md-12">
        <form method="POST"  class="form-horizontal" id="change_password_form" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <?php if(!empty($id)){?>
            <input type="hidden" id='id' name="id" value="{{$id}}">
            <?php }?>

            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title"><strong>Schimba parola</strong></h3>
            </div>

            @if(Auth::user()->type == 'user')
                <div class="form-group">
                    <label for="old_password">Parola veche</label>
                    <input type="password" class="form-control validate[required]" id="old_password" name="old_password" placeholder="Parola veche:">
                </div>

                <div class="form-group">
                    <label for="password">Parola noua</label>
                    <input type="password" class="form-control validate[required]" id="password" name="password" placeholder="Parola noua:">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirmați parola</label>
                    <input type="password" class="form-control validate[required,equals[password]]" id="confirm_password" name="confirm_password" placeholder="Confirmați parola:">
                </div>

            @else
                <div class="form-group">
                    <label for="password">Parola</label>
                    <input type="password" class="form-control validate[required]" id="password" name="password" placeholder="Parola:">
                </div>
            @endif



            <button class="btn btn-default" type="reset">Curăța</button>
            <button class="btn btn-primary pull-right" type="submit">Schimba</button>

        </form>
    </div>
</div>

<script>
    var url = '/admin-panel/users/' + $('#id'). val() + '/change-password';

    $("#change_password_form").validationEngine({
        promptPosition : "topLeft",
        onValidationComplete: function(form, status){
            if(status){
                $.post(url, $('#change_password_form').serialize(), null, 'json').done(function(response) {
                    if(response.redirect != 'undefine' && response.redirect == 'true'){
                        window.location="{{route('logout')}}";
                        return true;
                    }
                    new Noty({type: 'success', layout: 'topRight', text: response.message, timeout:3000}).show();
                    $.fancybox.close();
                    if(dt) {
                        dt.draw(false)
                    }
                }).fail(onSaveRequestError);
            }
        }
    });
</script>

