<?php
  session_start();
	include ("core/dbc.php");
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
  <?php

  $gebruiker = $_SESSION["gebruiker"];
  $sql = "SELECT * FROM gebruikers WHERE gebruikersnaam = '$gebruiker'";
  $result = $dbc->query($sql);
  $row = mysqli_fetch_assoc($result);
  if($row["privilege"] == 2) {
    $privilege = 2;   
  } else {
    $privilege = 1;
  }
?>
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">MA-Twente</a><!-- Waar naar toe verwijzen ivm met home alleen bereikbaar if session exists ? -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php if($privilege == 2) { ?>
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gebruikers <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="gebruiker_toevoegen.php">Gebruikers toevoegen</a></li>
            <li><a href="gebruiker_bewerken.php">Gebruikers bewerken</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuratie <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="configuratie_toevoegen.php">Configuratie toevoegen</a></li>
            <li><a href="configuratie_bewerken.php">Configuratie bewerken</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Incidenten <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="incidenten_afgehandeld.php">Afgehandelde incidenten</a></li>
            <li><a href="incidenten_open.php">Open incidenten</a></li>
          </ul>
        </li>
      </ul>
      <?php } else if($privilege == 1) { ?>
        <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Incidenten <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="incidenten_melden.php">Incident melden</a></li>
            <li><a href="incidenten_status.php">Status</a></li>
          </ul>
        </li>
      </ul>
      <?php } ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="core/loguit.php">Loguit</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  <div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Open Incidenten</h3>
      </div>
      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Datum</th>
              <th>Omschrijving</th>
              <th>Gebruiker</th>
              <th>Details</th>
              <th>Betrekking</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
           <tr>
              <td>John</td>
              <td>Doe</td>
              <td>john@example.com</td>
              <td>Details</td>
              <td>1</td>
              <td><a href="#" class="btn btn-primary">Open</a></td>
            </tr>
            <tr>
              <td>Mary</td>
              <td>Moe</td>
              <td>mary@example.com</td>
              <td>Details</td>
              <td>1</td>
              <td><a href="#" class="btn btn-primary">Open</a></td>
            </tr>
            <tr>
              <td>July</td>
              <td>Dooley</td>
              <td>july@example.com</td>
              <td>Details</td>
              <td>1</td>
              <td><a href="#" class="btn btn-success">In Behandeling</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>