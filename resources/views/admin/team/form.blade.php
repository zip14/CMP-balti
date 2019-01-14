<div style="width:700px">
    <div class="col-md-12">
        <form method="POST"  class="form-horizontal" id="team_add_form" enctype="multipart/form-data">
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
                <label for="name">Nume Prenume</label>
                <input type="text" class="form-control validate[required]" id="name" name="name" placeholder="Nume Prenume:" value="{{!empty($name) ? $name : ''}}">
            </div>

            <div class="row justify-content-md-center">
                <div class="col-6">
                    @if(!empty($image))
                        <img src="{{asset('public/images/team/') . '/' . $image}}" width="50%" style="margin-left: 25%" id="add_image">
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
                <label for="position">Poziţia</label>
                <input type="text" class="form-control validate[required]" id="position" name="position" placeholder="Poziţia:" value="{{!empty($position) ? $position : ''}}">
            </div>

            <div class="form-group">
                <label for="education">Studii</label>
                <input type="text" class="form-control validate[required]" id="education" name="education" placeholder="Studii:" value="{{!empty($education) ? $education : ''}}">
            </div>

            <div class="form-group">
                <label for="achievements">Realizări</label>
                <input type="text" class="form-control" id="achievements" name="achievements" placeholder="Realizări:" value="{{!empty($achievements) ? $achievements : ''}}">
            </div>

            <div class="form-group">
                <label for="description">Descriere</label>
                <textarea class="form-control validate[required]" id="editor" name="description" rows="4" cols="80" style="resize: none" placeholder="Descriere:">{{!empty($description) ? $description : ''}}</textarea>
            </div>


            <button class="btn btn-default" type="reset">Curăța</button>
            <button class="btn btn-primary pull-right" type="submit">{{!empty($id) ? 'Modifica' : 'Adăuga'}}</button>

        </form>
    </div>
</div>

<script>
    var url = '{{route('team.store')}}';
    var id = $('#id'). val()
    if(id != undefined){
        url = 'team/' + id;
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


    var image;
    $('#upload_image').on('change', function(){
        image = $('#image').croppie({
            enableExif: true,
            viewport: {
                width: 550,
                height: 400,
                type: 'square'
            },
            boundary: {
                width: 600,
                height: 550
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

    $("#team_add_form").submit(function(e){
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
        if( ! $("#team_add_form").validationEngine('validate')){
            return false;
        }

        $.ajax({
            url : url,
            type : 'POST',
            dataType : 'JSON',
            data : $('#team_add_form').serialize(),
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
