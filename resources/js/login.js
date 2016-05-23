$("#btn_login").click(function(){

    $.post(
        "?p=api_login",
        {"email" : $("#login_name").val(), "password" : $("#login_pass").val()},
        function(data) {
            if (data.status == "ok") {
                $(`
                    <div class="alert alert-success">
                        <strong>Login success,</strong> redirecting...
                    </div>
                `).fadeIn(200).prependTo('#login-msg-container');
                setTimeout(function() {
                  window.location.href = "?p=home";
                }, 1000);
            } else {
                $(`
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed!</strong> Login Failed
                    </div>
                `).fadeIn(200).prependTo('#login-msg-container');
            }
        },
        "json"
    );

});