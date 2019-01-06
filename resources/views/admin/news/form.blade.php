<div style="max-width:900px">
    <div class="col-md-12">
        <form method="POST"  class="form-horizontal" id="news_form" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <?php if(!empty($news['id'])){?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id='id' name="id" value="{{$news['id']}}">
            <?php }?>

            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title"><strong>{{!empty($id) ? 'Editați' : 'Adăugați'}} știri</strong></h3>
            </div>

            <div class="form-group">
                <label for="title">Titlu</label>
                <input type="text" class="form-control validate[required]" id="title" name="title" placeholder="Titlu:" value="{{!empty($news['title']) ? $news['title'] : ''}}">
            </div>

            <div class="form-group">
                <label for="description">Descriere</label>
                <textarea class="form-control validate[required]" id="description" name="description" rows="4" cols="80" style="resize: none" placeholder="Descriere:">{{!empty($news['description']) ? $news['description'] : ''}}</textarea>
            </div>

            <div class="form-group">
                <label for="editor">Conţinut</label>
                <textarea class="validate[required]" id="editor" name="content" rows="10" cols="80">{{!empty($news['content']) ? $news['content'] : ''}}</textarea>
            </div>

            <div class="form-group">
                <label>Сategorie</label>
                <select class="form-control validate[required]" name="id_category">
                    <option>Alegeți o categorie</option>
                    @foreach($category as $item)
                        <option value="{{ $item['id'] }}" {{ (!empty($news['id_category']) && $news['id_category'] == $item['id']) ? 'selected' : '' }}>{{ $item['name'] }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="image">Imaginea</label>
                <input type="file" class="validate[required]" id="image" name="image">
            </div>

            <div class="form-group">
                @if(!empty($news['image']))
                    <img src="/public/images/news/{{$news['image']}}" width="200px">
                    <input type="hidden" value="{{$news['image']}}" name="old_image">
                @elseif(!empty($news['id']))
                    <img src="/public/images/noImg.jpg" width="200px">
                @endif
            </div>


            <button class="btn btn-default" type="reset">Curăța</button>
            <button class="btn btn-primary pull-right" type="submit">{{!empty($id) ? 'Modifica' : 'Adăuga'}}</button>

        </form>
    </div>
</div>
<script>

    var url = '{{route('news.store')}}';
    var id = $('#id'). val()
    if(id != undefined){
        url = 'news/' + id;
    }

    tinymce.init({
        selector: '#editor',
        entity_encoding: 'raw',
        menubar: false,
        branding: false,
        height: 500,
        max_height: 700,
        min_height: 500,
        plugins: [
            'autolink autoresize fullscreen link lists paste media image imagetools responsivefilemanager',
        ],
        toolbar: 'undo redo | bold italic | underline strikethrough | bullist numlist | link image media | fullscreen',

        style_formats: [
            {
                title: 'Blocks',
                items: [{
                    title: 'Paragraph',
                    format: 'p'
                },
                    {
                        title: 'Blockquote',
                        format: 'blockquote'
                    },
                    {
                        title: 'Div',
                        format: 'div'
                    },
                    {
                        title: 'Pre',
                        format: 'pre'
                    }
                ]
            },
        ],

        link_assume_external_targets: true,
        relative_urls: false,
        image_advtab: true ,
        remove_script_host: false,
        force_br_newlines: false,
        force_p_newlines: false,
        forced_root_block: "",
        extended_valid_elements: "br",
        verify_html: false,
        valid_children: "br",
        paste_as_text: true,

    });

    $("#news_form").validationEngine({
        promptPosition : "topLeft",
        onValidationComplete: function(form, status){
            if(status){

                $.ajax ({
                    url : url,
                    type: 'POST',
                    data: new FormData($('#news_form')[0]),
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
