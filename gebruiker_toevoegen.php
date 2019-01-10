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
        <h3 class="panel-title">Gebruiker Toevoegen</h3>
      </div>
      <div class="panel-body">
        <form method="post">
          <label>Geslacht</label>
          <select class="form-control" name="geslacht">
            <option value=""></option>
            <option value="1">Vrouw</option>
            <option value="2">Man</option>
          </select>
          <label>Voorletter</label>
          <input type="text" class="form-control" name="voorletter">
          <label>Achternaam</label>
          <input type="text" class="form-control" name="achternaam">
          <label>Afdeling</label>
          <select class="form-control" name="afdeling">
            <option value=""></option>
            <option value="cad">CAD</option>
            <option value="directie">Directie</option>
            <option value="engineering">Engineering</option>
            <option value="financiele_administratie">Financiele Administratie</option>
            <option value="hrm">HRM</option>
            <option value="ict">ICT</option>
            <option value="onderzoek">Onderzoek</option>
            <option value="planning">Planning</option>
            <option value="project_planning">Project Planning</option>
            <option value="rapportage">Rapportage</option>
            <option value="secretariaat">Secretariaat</option>
            <option value="verkoop_en_marketing">Verkoop en Marketing</option>
          </select>
          <label>Intern telefoonnummer</label>
          <input type="text" class="form-control" name="telefoon">
          <label>Wachtwoord</label>
          <input type="password" class="form-control" name="wachtwoord">
          <label>Privilege</label>
          <select class="form-control" name="privilege">
            <option value="1">Gebruiker</option>
            <option value="2">Beheerder</option>
          </select>
          <br>
          <input type="submit" class="form-control btn btn-primary" name="submit" value="Gebruiker Toevoegen">
        </form>
      </div>
    </div>
  </div>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
  if(isset($_POST["submit"])) {
    if(empty($_POST["geslacht"]) | 
       empty($_POST["voorletter"]) | 
       empty($_POST["achternaam"]) | 
       empty($_POST["afdeling"]) | 
       empty($_POST["telefoon"]) | 
       empty($_POST["wachtwoord"]) | 
       empty($_POST["privilege"])) {
      echo("Vul alle velden in");
      exit();
    } else {
      $geslacht = $_POST["geslacht"];
      $voorletter = strtolower($_POST["voorletter"]);
      $achternaam = strtolower($_POST["achternaam"]);
      $gebruikersnaam = $voorletter . "." . $achternaam;
      $afdeling = $_POST["afdeling"];
      $telefoon = $_POST["telefoon"];
      $wachtwoord = sha1($_POST["wachtwoord"]);
      $privilege = $_POST["privilege"];
      $sql = "INSERT INTO gebruikers
              (geslacht, voorletter, achternaam, gebruikersnaam, afdeling, intern_telefoon_nummer, wachtwoord, privilege) 
              VALUES('$geslacht', '$voorletter', '$achternaam', '$gebruikersnaam', '$afdeling', '$telefoon', '$wachtwoord', '$privilege')";
      $result = $dbc->query($sql);
      echo("Gebruiker met succes in de database toegevoegd");      
    }
  }
?>