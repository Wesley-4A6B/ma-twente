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
        <h3 class="panel-title">Configuratie Toevoegen</h3>
      </div>
      <div class="panel-body">
        
        <form method="post" action="">
          <label>Gebruiker</label>
          <?php
          $sql = "SELECT * FROM gebruikers";
          $result = $dbc->query($sql);

          echo "<select name='gebruikersnaam' class='form-control' style='overflow: auto;'>";
          echo "<option value=''></option>";
      while($row = mysqli_fetch_assoc($result)) {
            echo "<option value='".$row['id']."' class='form-control'>".$row['gebruikersnaam']."</option>";
          }
          echo "</select>";
          ?>
          
      
          <label>Aanschafdatum</label>
          <input type="date" id="datepicker" class="form-control" name="aanschafdatum">
          <label>Soort computer</label>
          <select class="form-control" name="soortComputer">
            <option value=""></option>
            <option value="1">Desktop</option>
            <option value="2">Laptop</option>
          </select>
          <label>CPU</label>
          <select class="form-control" name="cpu">
            <option value=""></option>
            <option value="1">I3</option>
            <option value="2">I5</option>
            <option value="3">I7</option>
          </select>
          <label>Memory</label>
          <select class="form-control" name="memory">
            <option value=""></option>
            <option value="1">2GB</option>
            <option value="2">4GB</option>
            <option value="3">6GB</option>
            <option value="4">8GB</option>
            <option value="5">16GB</option>
          </select>
          <label>Harde Schijf</label>
          <select class="form-control" name="hardeSchijf">
            <option value=""></option>
            <option value="1">320GB HDD</option>
            <option value="2">500GB HDD</option>
            <option value="3">640GB HDD</option>
            <option value="4">2TB HDD</option>
            <option value="5">120GB SSD</option>
            <option value="6">128GB SSD</option>
            <option value="7">250GB SSD</option>
            <option value="8">120GB SSD + 640GB HDD</option>
            <option value="9">120GB SSD + 1TB HDD</option>
            <option value="10">120GB SSD + 2TB HDD</option>
          </select>
          <label>OS</label>
          <select class="form-control" name="os">
            <option value=""></option>
            <option value="1">Windows 10 Pro</option>
            <option value="2">Mac OSX</option>
          </select>
          <label>GPU</label>
          <select class="form-control" name="gpu">
            <option value=""></option>
            <option value="1">512MB</option>
            <option value="2">1GB</option>
            <option value="3">2GB</option>
            <option value="4">4GB</option>
            <option value="5">Onboard</option>
            <option value="6">2GB Onboard</option>
          </select>
          <br>
          <input type="submit" class="form-control btn btn-primary" name="submit" value="Configuratie Toevoegen" >
        </form>
      </div>
    </div>
  </div>
  <script>
    $(function(){
      $("#datepicker").datepicker();
    });
  </script>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
  if(isset($_POST["submit"])) {
    
    if(empty($_POST["aanschafdatum"]) |
     empty($_POST["soortComputer"]) |
     empty($_POST["cpu"]) |
     empty($_POST["memory"]) |
     empty($_POST["hardeSchijf"]) |
     empty($_POST["os"]) |
     empty($_POST["gpu"])) {
      echo("Vul alle velden in");  
      exit();
    } else {
      $gebruiker = $_POST["gebruikersnaam"];
      $aanschafdatum = $_POST["aanschafdatum"];
      $soortComputer = $_POST["soortComputer"];
      $cpu = $_POST["cpu"];
      $memory = $_POST["memory"];
      $hardeSchijf = $_POST["hardeSchijf"];
      $os = $_POST["os"];
      $gpu = $_POST["gpu"];
      $sql = "INSERT INTO configuratie
              (gebruiker, aanschaf_datum, computer_soort, cpu, memory, hdd, os, video_kaart) 
              VALUES('$gebruiker', '$aanschafdatum', '$soortComputer', '$cpu', '$memory', '$hardeSchijf', '$os', '$gpu')";
      $result = $dbc->query($sql);
      if($result) {
        echo "Configuratie met succes in de database toegevoegd";
      } else {
        echo "Fout";
      }
    }
  }
?>