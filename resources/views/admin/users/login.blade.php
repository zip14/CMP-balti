<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Colegiul de Muzică și Pedagogie mun. Bălți</title>
    <meta name="description" content="Colegiul de Muzică și Pedagogie mun. Bălți">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,300italic,300,500,500italic,700,900">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/templatemo-style.css')}}">

    <link href="{{asset('plugins/Validation-Engine/css/validationEngine.jquery.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/noty/css/noty.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/noty/themes/mint.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('js/vendor/modernizr-2.6.1-respond-1.1.0.min.js')}}"></script>
</head>
<body>

<section id="pageloader">
    <div class="loader-item fa fa-spin colored-border"></div>
</section>



<div id="admin_wrapp">
    <div class="admin">
        <form id="login_form" method="post">
            {!! csrf_field() !!}
            <label>Login</label>
            <input class="validate[required]" type="text" name="login">

            <label>Password</label>
            <input class="validate[required]" type="password" name="password">

            <input type="checkbox" name="remember">
            <p>Remember me</p>

            <button>click</button>
        </form>
    </div>
</div>


<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/vendor/jquery-1.11.0.min.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('.loader-item').fadeOut();
        $('#pageloader').delay(350).fadeOut('slow');
        $('body').delay(350).css({'overflow-y':'visible'});
    })
</script>

<script src="{{asset('plugins/noty/js/noty.js')}}"></script>
<script src="{{asset('plugins/Validation-Engine/js/jquery.validationEngine.js')}}"></script>
<script src="{{asset('plugins/Validation-Engine/js/jquery.validationEngine-ro.js')}}"></script>

<script src="{{asset('js/script_admin.js')}}"></script>

<script>
    $("#login_form").validationEngine({
        promptPosition : "topLeft",
        onValidationComplete: function(form, status){

            if(status){

                $.ajax ({
                    url : '{{route('authenticate')}}',
                    type: 'POST',
                    data:  $('#login_form').serialize(),
                    dataType: 'JSON',
                    success: function (response) {
                        window.location="{{route('news.index')}}";
                    },
                    error: function (error) {
                        onSaveRequestError(error);
                    }
                })
            }
        }
    });
</script>
</body>
</html>
