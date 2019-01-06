<div style="max-width:700px">
    <div class="col-md-12">
        <form method="POST"  class="form-horizontal" id="gallary-category" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <?php if(!empty($id)){?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id='id' name="id" value="{{$id}}">
            <?php }?>

            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title"><strong>{{!empty($id) ? 'Editați' : 'Adăugați'}} categorie pentru galerie</strong></h3>
            </div>

            <div class="form-group">
                <label for="name">Denumirea</label>
                <input type="text" class="form-control validate[required]" id="name" name="name" placeholder="Denumirea:" value="{{!empty($name) ? $name : ''}}">
            </div>


            <button class="btn btn-default" type="reset">Curăța</button>
            <button class="btn btn-primary pull-right" type="submit">{{!empty($id) ? 'Modifica' : 'Adăuga'}}</button>

        </form>
    </div>
</div>
<script>

    var url = '{{route('gallary-category.store')}}';
    var id = $('#id'). val()
    if(id != undefined){
        url = 'gallary-category/' + id;
    }

    $("#gallary-category").validationEngine({
        promptPosition : "topLeft",
        onValidationComplete: function(form, status){
            if(status){

                $.ajax ({
                    url : url,
                    type: 'POST',
                    data: new FormData($('#gallary-category')[0]),
                    dataType: 'JSON',
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
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
                })

            }
        }
    });

</script>
