$('#submit').click(function (e) {
	e.preventDefault();
	username = $("#username").val();
	password = $("#password").val();
	if (password != "" && username != "") {
		$.post('admin/inc/process.php', {
			check_login_user: 1,
			username: username,
			password: password
		}, function (data) {
			if (data === 'yes') {
				redirectme();
			} else {
				$("#available").html(data);
			}
		});
	}

})