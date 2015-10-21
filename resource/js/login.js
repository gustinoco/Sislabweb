$(document).ready(function(){
    
  $("#submit").click(function(){

    var username = $("#myusername").val();
    var password = $("#mypassword").val();
    
    if((username == "") || (password == "")) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter a username and a password</div>");
    }
    else {
      $.ajax({
        type: "POST",
        url: "../../../sislabweb/view/checklogin.php",
        data: "myusername="+username+"&mypassword="+password,
        success: function(html){    
          if(html=='true') {
            window.location="../../../sislabweb/view/main.php";
          }
          else {
            $("#message").html(html);
          }
        },
        beforeSend:function()
        {
          $("#message").html("<p class='text-center'><img src='img/ajax-loader.gif'></p>")
        }
      });
    }
    return false;
  });
});