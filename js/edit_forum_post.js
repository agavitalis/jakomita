$(document).ready(function () {

      
    var form = document.getElementById('forum_post');
    form.addEventListener('submit', function(e) {
    e.preventDefault();
    // alert("yes");
    for (instance in CKEDITOR.instances) {
    	CKEDITOR.instances[instance].updateElement();
    }
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../edit_forum_post.php", true);
    ajax.onload = function(e) {
        if (ajax.responseText =="yes!") {
            window.location.href="../";
        }else{
            $("#error").html(ajax.responseText);
          };
        }
        ajax.send(new FormData(form));
        
      },false);
})