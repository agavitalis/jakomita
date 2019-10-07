$('#submit').click(function (e) {
     e.preventDefault();
	username = $("#username").val();
	password = $("#password").val();
	if (password != "" && username !="") {
		$.post('inc/process.php',{check_login:1,username:username,password:password},function (data) {
       if (data ==='yes') {
       	location.href = "dashboard";
       }else{
       	 $("#available").html(data);
       }
    	});
	}
	
})