(function ($) {
    $("#frm_login").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'validate',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data,xhr) {
               var rute = '../user/profile';
                window.location.href = rute;
            },
            error: function (xhr) {
                if (xhr.status == 401) {
                    document.getElementById('alerta').style.display ='none';
                    $("#email > input").removeClass('is-invalid');
                    $("#password > input").removeClass('is-invalid');
                    var json = JSON.parse(xhr.responseText);
                    if (json.email.length != 0) {
                        $("#email > div").html(json.email);
                        $("#email > input").addClass('is-invalid');
                    }
                    if (json.password.length != 0) {
                        $("#password > div").html(json.password);
                        $("#password > input").addClass('is-invalid');
                    }
                } else if (xhr.status == 402) {
                    document.getElementById('alerta').style.display ='inherit';
                    $("#email > input").removeClass('is-invalid');
                    $("#password > input").removeClass('is-invalid');
                }
            },
            
        });
    });
})(jQuery)