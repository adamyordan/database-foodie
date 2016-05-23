$('#btn_logout').click(function() {

    $.get(
        "?p=api_logout",
        {},
        function(data) {
        	if(data.status == "ok") {
                window.location.href = "index.php";
        	}
        },
        "json"
    );

});
