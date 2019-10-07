$(document).ready(function () {
      var form = document.getElementById('forum_post');
      form.addEventListener('submit', function(e) {
        e.preventDefault();
         for (instance in CKEDITOR.instances) {
       CKEDITOR.instances[instance].updateElement();
        }

          var ajax = new XMLHttpRequest();
          ajax.open("POST", "inc/add_process.php", true);
          ajax.onload = function(e) {
            $("#error").html(ajax.responseText);
            // if (ajax.responseText.indexOf('successfully!') != -1) {
            //   location.href = 'add-post';
            // }
          };
          ajax.send(new FormData(form));
        
      },false);
})