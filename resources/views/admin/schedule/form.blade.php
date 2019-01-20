<div style="width:400px">
    <div class="col-md-12">
        <form method="POST" class="form-horizontal" id="schedule" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title"><strong>Orar</strong></h3>
            </div>

            <div class="form-group">
                <label for="link">Link: </label>
                <input type="text" class="form-control validate[required]" id="link" name="link" placeholder="Link:" value="{{!empty($link) ? $link : ''}}">
            </div>

            <button class="btn btn-default" type="reset">Curăța</button>
            <button class="btn btn-primary pull-right" type="submit">Salvați</button>

        </form>
    </div>
</div>
<script>

    var url = '{{route('schedule.save')}}';


    $("#schedule").validationEngine({
        promptPosition : "topLeft",
        onValidationComplete: function(form, status){
            if(status){

                $.ajax ({
                    url : url,
                    type: 'POST',
                    data: new FormData($('#schedule')[0]),
                    dataType: 'JSON',
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
                    success: function (response) {
                        new Noty({type: 'success', layout: 'topRight', text: response.message, timeout:3000}).show();

                        $.fancybox.close();
                    },
                    error: function (error) {
                        onSaveRequestError(error);
                    }
                })

            }
        }
    });

</script>
