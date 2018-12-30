function onSaveRequestError(error) {
    if(!error.hasOwnProperty('statusCode')) {
        //console.error(error);

        return;
    }

    if(!error.hasOwnProperty('responseJSON')) {
        new Noty({type: 'error', layout: 'topRight', text: "Bad response"}).show();
       //console.error(error);

        return;
    }

    var responseBody = error.responseJSON || {};
    if(responseBody.hasOwnProperty('errors')) {
        for (var key in responseBody.errors) {
            if (responseBody.errors.hasOwnProperty(key)) {
                var errorEntry = responseBody.errors[key];
                if(Array.isArray(errorEntry)) {
                    errorEntry.forEach(function(entry) {
                        new Noty({type: 'error', layout: 'topRight', text: entry}).show();
                    });
                } else {
                    new Noty({type: 'error', layout: 'topRight', text: errorEntry}).show();
                }
            }
        }
    } else if(responseBody.hasOwnProperty('message')){
        new Noty({type: 'error', layout: 'topRight', text: responseBody.message}).show();
    } else {
        new Noty({type: 'error', layout: 'topRight', text: "Server error"}).show();
        //console.error(error);
    }
};

(function(window, $) {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token.content,
                'X-Shenanigans': true,
            }
        })
    } else {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }

    $(".close-alert").click(function () {
        $('#message-box-success').hide();
    });
    $("#message-box-danger").click(function () {
        $('.message-box-danger').removeClass("show");
        $('.message-box-danger').addClass("hide");
    });
} (window, jQuery));

$( document ).ready(function() {

    $("[data-fancybox]").fancybox({
		beforeClose  : function( instance, slide ) {

            if (typeof tinymce !== 'undefined') {
                tinymce.remove('#editor');
            }
		}
	});

    $("body").on("click", ".mce-btn", function () {
        var elm = $(this);

        if (elm.find('.mce-i-link').length || elm.find('.mce-i-image').length || elm.find('.mce-i-media').length) {
            $(".mce-primary").addClass("close-tinymce-modal");
            $(".mce-close").addClass("close-tinymce-modal");
            $(".mce-window, .mce-in").find(".mce-widget.mce-btn.mce-abs-layout-item.mce-last.mce-btn-has-text").addClass("close-tinymce-modal");
            $(".fancybox-container").hide();
        }
    });

    $(document).on("click", ".close-tinymce-modal", function (event) {
        $(".fancybox-container").show();
    });
});
