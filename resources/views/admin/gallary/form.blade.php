<div style="width:700px">
    <div class="col-md-12">
        <form method="POST"  class="form-horizontal" id="gallary" enctype="multipart/form-data">
            {!! csrf_field() !!}

            @if(!empty($gallary['id']))
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id='id' name="id" value="{{$gallary['id']}}">
            @endif

            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title"><strong>{{!empty($gallary['id']) ? 'Editați' : 'Adăugați'}} imaginea</strong></h3>
            </div>

            <div class="form-group">
                <label for="description">Descriere</label>
                <input type="text" class="form-control validate[required]" id="description" name="description" placeholder="Descriere:" value="{{!empty($gallary['description']) ? $gallary['description'] : ''}}">
            </div>

            <div class="form-group">
                <label for="title">Titlu</label>
                <input type="text" class="form-control validate[required]" id="title" name="title" placeholder="Titlu:" value="{{!empty($gallary['title']) ? $gallary['title'] : ''}}">
            </div>

            <div class="form-group">
                <label>Сategorie</label>
                <select class="form-control validate[required]" name="id_category">
                    <option>Alegeți o categorie</option>
                    @foreach($category as $item)
                        <option value="{{ $item['id'] }}" {{ (!empty($gallary['id_category']) && $gallary['id_category'] == $item['id']) ? 'selected' : '' }}>{{ $item['name'] }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="image">Imaginea</label>
                <input type="file" class="{{!empty($gallary['id']) ? '' : 'validate[required]'}}"  id="image" name="image">
            </div>

            <div class="form-group">
                @if(!empty($gallary['image']))
                    <img src="/public/images/gallary/{{ $gallary['image'] }}" width="200px">
                    <input type="hidden" value="{{ $gallary['image'] }}" name="old_image">
                @elseif(!empty($gallary['id']))
                    <img src="/public/images/noImg.jpg" width="200px">
                @endif
            </div>

            <button class="btn btn-default" type="reset">Curăța</button>
            <button class="btn btn-primary pull-right" type="submit">{{!empty($gallary['id']) ? 'Modifica' : 'Adăuga'}}</button>

        </form>
    </div>
</div>
<script>

    var url = '{{route('gallary.store')}}';
    var id = $('#id'). val()
    if(id != undefined){
        url = 'gallary/' + id;
    }
    $("#gallary").validationEngine({
        promptPosition : "topLeft",
        onValidationComplete: function(form, status){
            if(status){

                $.ajax ({
                    url : url,
                    type: 'POST',
                    data: new FormData($('#gallary')[0]),
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
