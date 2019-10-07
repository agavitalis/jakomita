 $(document).ready(function(){

      // var form = document.getElementById("register");
      $("#fullname").focus(function(){
        $("#fullnameerror").html("Enter your full name");
      }).blur(function(){
        $("#fullnameerror").html("");
      });

      //checks for username
      $("#username").focus(function(){
        $("#usernameerror").html("choose a unique username");
      }).keyup(function () {
        username = $(this).val();
       if (username !='') {
         $.post('admin/inc/process.php',{check_username:1,username:username},function (data) {
            $("#usernameerror").html(data);
           });
       }else{
            $("#usernameerror").html("please choose a username");
       }
      }).blur(function (data) {
         $("#usernameerror").html("");
      });


      //checks for email
      $("#email").focus(function () {
        $("#emailerror").html("Enter your email address");
      }).keyup(function(){
        email = $(this).val();
       if (email !='') {
         $.post('admin/inc/process.php',{check_email:1,email:email},function (data) {
            $("#emailerror").html(data);
           });
       }else{
            $("#emailerror").html("Email must be unique");
       }
      }).blur(function(){
        $("#emailerror").html("");
      });


     

      
  //  $("#register").click(function (e) {
  //       e.preventDefault();

  //       alert('welcome');
  //       // firstpassword = $("#password").val();
  //       // secondpassword = $("#confirm_password").val();
  //       // if (firstpassword === secondpassword) {
  //       //   var ajax = new XMLHttpRequest();
  //       //   ajax.open("POST", "admin/inc/process.php", true);
  //       //   ajax.onload = function(e) {
  //       //     if (ajax.responseText=="ok")  {
  //       //       redirectme();
  //       //     }else{
  //       //       $("#error").html(ajax.responseText);
  //       //     }
            
  //       //   };
  //       //   ajax.send(new FormData(form));
  //       // }else{
         
  //       //    $("#passworderror").html("Passwords do not match!");
  //       // }
        
  //     },false);

   $('#register').click(function (e) {
     e.preventDefault();

     firstpassword = $("#password").val();
     secondpassword = $("#confirm_password").val();

      if (firstpassword == secondpassword ){

        if ($("#fullname").val() != "" || $("#username").val() != "" || $("#phone").val() != "" || $("#email").val() != "" || $("#password").val() != ""){
          
            $.post('admin/inc/process.php', { register_user: 1, fullname: $("#fullname").val(), username: $("#username").val(), password: firstpassword, phone: $("#phone").val(), email: $("#email").val()  }, function (data) {
              if (data == 'ok') {
                //alert("I arrived");
                redirectme();
              } else {
              // alert(data)
                $("#passworderror").html(data);
              }
          });

        }
        else{
          $("#passworderror").html("Please fill all fields!");
        }
        
      }
      else{
        $("#passworderror").html("Passwords do not match!");
      }

   })
  })

