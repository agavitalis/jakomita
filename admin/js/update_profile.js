$(document).ready(function () {
      var form = document.getElementById('profile');
      form.addEventListener('submit', function(e) {
        e.preventDefault();
          var ajax = new XMLHttpRequest();
          ajax.open("POST", "inc/update_process.php", true);
          ajax.onload = function(e) {
            $("#error").html(ajax.responseText);
            if (ajax.responseText.indexOf('successfully!') != -1) {
              location.href = 'profile';
            }
          };
          ajax.send(new FormData(form));
        
      },false);

})