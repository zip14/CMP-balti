<div style="width:300px">

    <div class="col-md-12">

        <form method="POST" class="form-horizontal" id="specialty">
            {!! csrf_field() !!}
            <?php if(!empty($id)){?>
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" id='id' name="id" value="{{$id}}">
            <?php }?>

            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title"><strong>Șterge specialitate</strong></h3>
                <div class="panel-body">
                    <p>Ești sigur?</p>
                </div>
            </div>

            <button class="btn btn-default" id="cancel">Anulare</button>
            <button class="btn btn-danger pull-right" type="submit">Șterge</button>
        </form>
    </div>
</div>


<script>
    var url = '/specialty/' + $('#id'). val();

    $('#cancel').on('click', function(){
        $.fancybox.close();
        return false;
    });

    $("#specialty").submit(function(e){
        e.preventDefault();

        $.post(url, $('#specialty').serialize(), null, 'json').done(function(response) {
            new Noty({type: 'success', layout: 'topRight', text: response.message, timeout:3000}).show();

            $.fancybox.close();

            if(dt) {
                dt.draw(false)
            }
        }).fail(onSaveRequestError);

    });
</script>
