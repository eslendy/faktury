// JavaScript Document
$(function() {
    $('#login_').submit(function(e) {
        e.preventDefault();
    })
    $("#btnacceso").click(function() {
        if ($("#pass").val().length > 0 && $("#login").val().length > 0) {
            $.post(init.XNG_WEBSITE_URL + "usuarios/validar.php", {ps: $("#pass").val(), g: $("#login").val()}, function(html_response) {
                if (html_response == 1) {
                    location.href = init.XNG_WEBSITE_URL;
                } else {
                    $('.alert-error').fadeIn(500);
                    $("#message").html(html_response);
                    $("#message").addClass("ui-widget");
                }
            });
        }

    });
});