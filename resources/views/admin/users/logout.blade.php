<div style="width:300px">

    <div class="col-md-12">

        <form method="POST" class="form-horizontal" id="logout">
            {!! csrf_field() !!}
            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title"><strong>Ieșire</strong></h3>
                <div class="panel-body">
                    <p>Doriți să părăsiți profilul?</p>
                </div>
            </div>

            <button class="btn btn-default" id="cancel">Nu</button>
            <a href="{{route('logout')}}" class="btn btn-danger pull-right" type="submit">Da</a>
        </form>
    </div>
</div>


<script>

    $('#cancel').on('click', function(){
        $.fancybox.close();
    });

</script>
