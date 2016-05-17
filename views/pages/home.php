<div class="row">
	<div class="col-md-4 col-md-offset-4">
    	<div class="login-form">
            <form action="?p"></form>
            <div class="form-group">
	            <input type="text" class="form-control login-field" value="" placeholder="Enter your email" id="login_name">
    	        <label class="login-field-icon fui-user" for="login-name"></label>
            </div>

            <div class="form-group">
	            <input type="password" class="form-control login-field" value="" placeholder="Password" id="login_pass">
	            <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>

            <button id="btn_login" class="btn btn-primary btn-lg btn-block">Log in</button>
	    </div>
        <br>
        <div id="login-msg-container">
        </div>
	</div>
</div>

<script>

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
                      window.location.href = "?p=look";
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

</script>