$(document).ready(function () {

      
    var form = document.getElementById('comment');
    form.addEventListener('submit', function(e) {
    e.preventDefault();
    var button = document.getElementById('submit');
    botton.attr("disabled","true");
    // alert("yes");
    for (instance in CKEDITOR.instances) {
    	CKEDITOR.instances[instance].updateElement();
    }
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../post_reply.php", true);
    ajax.onload = function(e) {
        if (ajax.responseText =="yes!") {
            window.location.reload();
            
        }else{

        $("#error").html(ajax.responseText);
          };
        }
        ajax.send(new FormData(form));
        
      },false);
})