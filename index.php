<?php 
  include("core/loginModal.php");
  include("core/dbc.php");
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MA-Twente</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">MA-Twente</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#" data-toggle="modal" data-target=".loginModal">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div>
    <span></span>
  </div>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script>
    function login() {
      var login = $("#gebruiker").val();
      var pass = $("#wachtwoord").val();
      var post = $.post("core/dologin.php", {gebruiker: login, wachtwoord: pass});
      post.done(function(data) {
          var dt = data;
          if(dt == "U bent nu ingelogt") {
            window.location.href = "home.php";
            return;
          }
          $("#loginErrorMsg").text(dt);
      });
    }
  </script>
</body>
</html>