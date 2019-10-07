 $(document).ready(function(){
      var form = document.getElementById("register");
      $("#fullname").focus(function(){
        $("#fullnameerror").html("Enter your full name");
      }).blur(function(){
        $("#fullnameerror").html("");
      });

      $("#username").focus(function(){
        $("#usernameerror").html("choose a unique username");
      }).keyup(function () {
        username = $(this).val();
       if (username !='') {
         $.post('inc/process.php',{check_username:1,username:username},function (data) {
            $("#usernameerror").html(data);
           });
       }else{
            $("#usernameerror").html("please choose a username");
       }
      }).blur(function (data) {
         $("#usernameerror").html("");
      });

      $("#email").focus(function () {
        $("#emailerror").html("Enter your email address");
      }).keyup(function(){
        email = $(this).val();
       if (email !='') {
         $.post('inc/process.php',{check_email:1,email:email},function (data) {
            $("#emailerror").html(data);
           });
       }else{
            $("#emailerror").html("please enter an email");
       }
      }).blur(function(){
        $("#emailerror").html("");
      });

      $("#school").focus(function () {
        $("#institutionerror").html("Enter your school");
      }).keyup(function(){
        school = $(this).val();
       if (school !='') {
         $.post('inc/process.php',{check_school:1,school:school},function (data) {
            $("#institutionerror").html(data);
            $("#school").parent().attr('style','margin-bottom:110px');
            $('span#institutionerror').show();
           });
       }else{
            $("#school").parent().attr('style','margin-bottom:0px');
            $("#institutionerror").html("please enter a school");
       }
      })
      $(document).on('click','li',function(e) {
      $('input#school').val($(this).html());
      $("#school").parent().attr('style','margin-bottom:0px');
      $('span#institutionerror').fadeOut();
    });

      
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        firstpassword = $("#password").val();
        secondpassword = $("#confirm_password").val();
        if (firstpassword === secondpassword) {
          var ajax = new XMLHttpRequest();
          ajax.open("POST", "inc/process.php", true);
          ajax.onload = function(e) {
            $("#error").html(ajax.responseText);
          };
          ajax.send(new FormData(form));
        }else{
         
           $("#passworderror").html("Passwords do not match!");
        }
        
      },false);
  })