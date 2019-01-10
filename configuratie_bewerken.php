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
        <h3 class="panel-title">Configuratie Wijzigen</h3>
      </div>
      <div class="panel-body">
        
        <label><h2>Selecteer PC-Nummer</h2></label>
          <?php
          $sql = "SELECT * FROM configuratie";
          $result = $dbc->query($sql);

          echo "<form method='post' action=''>
          <select name='configuratie' class='form-control' style='overflow: auto;'>";
          while($row = mysqli_fetch_assoc($result)) {
            echo "<option value='".$row['pc_nummer']."' class='form-control'>".$row['pc_nummer']."</option>";
            $gebruiker = $_POST["configuratie"];
          }
          echo "</select>
          <br>
          <input type='submit' class='form-control btn btn-primary' value='Toon Gegevens'></form";
          ?>
          <br>
          <?php
          if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["configuratie"]) && !empty($_POST["configuratie"])) {
              $sql = "SELECT * FROM configuratie WHERE pc_nummer = '".$gebruiker."'";
              $result = $dbc->query($sql);
              $row = mysqli_fetch_assoc($result);
            }
          ?>
          <form method="post" action="">
          <hr>
          <label><h2>Wijzig Configuratie</h2></label>
          <br>
          
          <label>Aanschafdatum</label>
          <input type="date" id="datepicker" class="form-control" name="aanschafdatum" value="<?php echo $row['aanschaf_datum']; ?>">
          <label>Soort computer</label>
          <select class="form-control" name="soortComputer">
            <?php if($row["computer_soort"] == 1) { ?>
            <option value="1" selected="selected">Desktop</option>
            <option value="2">Laptop</option>
            <?php } else { ?>
            <option value="2" selected="selected">Laptop</option>  
            <option value="1">Desktop</option>
            <?php } ?>
          </select> 
          <label>CPU</label>
          <select class="form-control" name="cpu">
            <?php if($row["cpu"] == 1) { ?>
            <option value="1" selected="selected">I3</option>
            <option value="2">I5</option>
            <option value="3">I7</option>
            <?php } else if($row["cpu"] == 2) { ?>
            <option value="1">I3</option>
            <option value="2" selected="selected">I5</option>
            <option value="3">I7</option>
            <?php } else { ?>
            <option value="1">I3</option>
            <option value="2">I5</option>
            <option value="3" selected="selected">I7</option>
            <?php } ?>
          </select>
          <label>Memory</label>
          <select class="form-control" name="memory">
            <?php if($row["memory"] == 1) { ?>
            <option value="1" selected="selected">2GB</option>
            <option value="2">4GB</option>
            <option value="3">6GB</option>
            <option value="4">8GB</option>
            <option value="5">16GB</option>
            <?php } else if($row["cpu"] == 2) { ?>
            <option value="1">2GB</option>
            <option value="2" selected="selected">4GB</option>
            <option value="3">6GB</option>
            <option value="4">8GB</option>
            <option value="5">16GB</option>
            <?php } else if($row["cpu"] == 3) { ?>
            <option value="1">2GB</option>
            <option value="2">4GB</option>
            <option value="3" selected="selected">6GB</option>
            <option value="4">8GB</option>
            <option value="5">16GB</option>
            <?php } else if($row["cpu"] == 4) { ?>
            <option value="1">2GB</option>
            <option value="2">4GB</option>
            <option value="3">6GB</option>
            <option value="4" selected="selected">8GB</option>
            <option value="5">16GB</option>
            <?php } else { ?>
            <option value="1">2GB</option>
            <option value="2">4GB</option>
            <option value="3">6GB</option>
            <option value="4">8GB</option>
            <option value="5" selected="selected">16GB</option>
            <?php } ?>
          </select>
          <label>Harde Schijf</label>
          <select class="form-control" name="hardeSchijf">
            <?php if($row["hdd"] == 1) { ?>
            <option value="1" selected="selected">320GB HDD</option>
            <option value="2">500GB HDD</option>
            <option value="3">640GB HDD</option>
            <option value="4">2TB HDD</option>
            <option value="5">120GB SSD</option>
            <option value="6">128GB SSD</option>
            <option value="7">250GB SSD</option>
            <option value="8">120GB SSD + 640GB HDD</option>
            <option value="9">120GB SSD + 1TB HDD</option>
            <option value="10">120GB SSD + 2TB HDD</option>
            <?php } else if($row["hdd"] == 2) { ?>
            <option value="1">320GB HDD</option>
            <option value="2" selected="selected">500GB HDD</option>
            <option value="3">640GB HDD</option>
            <option value="4">2TB HDD</option>
            <option value="5">120GB SSD</option>
            <option value="6">128GB SSD</option>
            <option value="7">250GB SSD</option>
            <option value="8">120GB SSD + 640GB HDD</option>
            <option value="9">120GB SSD + 1TB HDD</option>
            <option value="10">120GB SSD + 2TB HDD</option>
            <?php } else if($row["hdd"] == 3) { ?>
            <option value="1">320GB HDD</option>
            <option value="2">500GB HDD</option>
            <option value="3" selected="selected">640GB HDD</option>
            <option value="4">2TB HDD</option>
            <option value="5">120GB SSD</option>
            <option value="6">128GB SSD</option>
            <option value="7">250GB SSD</option>
            <option value="8">120GB SSD + 640GB HDD</option>
            <option value="9">120GB SSD + 1TB HDD</option>
            <option value="10">120GB SSD + 2TB HDD</option>
            <?php } else if($row["hdd"] == 4) { ?>
            <option value="1">320GB HDD</option>
            <option value="2">500GB HDD</option>
            <option value="3">640GB HDD</option>
            <option value="4" selected="selected">2TB HDD</option>
            <option value="5">120GB SSD</option>
            <option value="6">128GB SSD</option>
            <option value="7">250GB SSD</option>
            <option value="8">120GB SSD + 640GB HDD</option>
            <option value="9">120GB SSD + 1TB HDD</option>
            <option value="10">120GB SSD + 2TB HDD</option>
            <?php } else if($row["hdd"] == 5) { ?>
            <option value="1">320GB HDD</option>
            <option value="2">500GB HDD</option>
            <option value="3">640GB HDD</option>
            <option value="4">2TB HDD</option>
            <option value="5" selected="selected">120GB SSD</option>
            <option value="6">128GB SSD</option>
            <option value="7">250GB SSD</option>
            <option value="8">120GB SSD + 640GB HDD</option>
            <option value="9">120GB SSD + 1TB HDD</option>
            <option value="10">120GB SSD + 2TB HDD</option>
            <?php } else if($row["hdd"] == 6) { ?>
            <option value="1">320GB HDD</option>
            <option value="2">500GB HDD</option>
            <option value="3">640GB HDD</option>
            <option value="4">2TB HDD</option>
            <option value="5">120GB SSD</option>
            <option value="6" selected="selected">128GB SSD</option>
            <option value="7">250GB SSD</option>
            <option value="8">120GB SSD + 640GB HDD</option>
            <option value="9">120GB SSD + 1TB HDD</option>
            <option value="10">120GB SSD + 2TB HDD</option>
            <?php } else if($row["hdd"] == 7) { ?>
            <option value="1">320GB HDD</option>
            <option value="2">500GB HDD</option>
            <option value="3">640GB HDD</option>
            <option value="4">2TB HDD</option>
            <option value="5">120GB SSD</option>
            <option value="6">128GB SSD</option>
            <option value="7" selected="selected">250GB SSD</option>
            <option value="8">120GB SSD + 640GB HDD</option>
            <option value="9">120GB SSD + 1TB HDD</option>
            <option value="10">120GB SSD + 2TB HDD</option>
            <?php } else if($row["hdd"] == 8) { ?>
            <option value="1">320GB HDD</option>
            <option value="2">500GB HDD</option>
            <option value="3">640GB HDD</option>
            <option value="4">2TB HDD</option>
            <option value="5">120GB SSD</option>
            <option value="6">128GB SSD</option>
            <option value="7">250GB SSD</option>
            <option value="8" selected="selected">120GB SSD + 640GB HDD</option>
            <option value="9">120GB SSD + 1TB HDD</option>
            <option value="10">120GB SSD + 2TB HDD</option>
            <?php } else if($row["hdd"] == 9) { ?>
            <option value="1">320GB HDD</option>
            <option value="2">500GB HDD</option>
            <option value="3">640GB HDD</option>
            <option value="4">2TB HDD</option>
            <option value="5">120GB SSD</option>
            <option value="6">128GB SSD</option>
            <option value="7">250GB SSD</option>
            <option value="8">120GB SSD + 640GB HDD</option>
            <option value="9" selected="selected">120GB SSD + 1TB HDD</option>
            <option value="10">120GB SSD + 2TB HDD</option>
            <?php } else { ?>
            <option value="1">320GB HDD</option>
            <option value="2">500GB HDD</option>
            <option value="3">640GB HDD</option>
            <option value="4">2TB HDD</option>
            <option value="5">120GB SSD</option>
            <option value="6">128GB SSD</option>
            <option value="7">250GB SSD</option>
            <option value="8">120GB SSD + 640GB HDD</option>
            <option value="9">120GB SSD + 1TB HDD</option>
            <option value="10" selected="selected">120GB SSD + 2TB HDD</option>
            <?php } ?>
          </select>
          <label>OS</label>
          <select class="form-control" name="os">
            <?php if($row["os"] == 1) { ?>
            <option value="1" selected="selected">Windows 10 Pro</option>
            <option value="2">Mac OSX</option>
            <?php } else { ?>
            <option value="1">Windows 10 Pro</option>
            <option value="2" selected="selected">Mac OSX</option>
            <?php } ?>
          </select>
          <label>GPU</label>
          <select class="form-control" name="gpu">
            <?php if($row["video_kaart"] == 1) { ?>
            <option value="1" selected="selected">512MB</option>
            <option value="2">1GB</option>
            <option value="3">2GB</option>
            <option value="4">4GB</option>
            <option value="5">Onboard</option>
            <option value="6">2GB Onboard</option>
            <?php } else if($row["video_kaart"] == 2) { ?>
            <option value="1">512MB</option>
            <option value="2" selected="selected">1GB</option>
            <option value="3">2GB</option>
            <option value="4">4GB</option>
            <option value="5">Onboard</option>
            <option value="6">2GB Onboard</option>
            <?php } else if($row["video_kaart"] == 3) { ?>
            <option value="1">512MB</option>
            <option value="2">1GB</option>
            <option value="3" selected="selected">2GB</option>
            <option value="4">4GB</option>
            <option value="5">Onboard</option>
            <option value="6">2GB Onboard</option>
            <?php } else if($row["video_kaart"] == 4) { ?>
            <option value="1">512MB</option>
            <option value="2">1GB</option>
            <option value="3">2GB</option>
            <option value="4" selected="selected">4GB</option>
            <option value="5">Onboard</option>
            <option value="6">2GB Onboard</option>
            <?php } else if($row["video_kaart"] == 5) { ?>
            <option value="1">512MB</option>
            <option value="2">1GB</option>
            <option value="3">2GB</option>
            <option value="4">4GB</option>
            <option value="5" selected="selected">Onboard</option>
            <option value="6">2GB Onboard</option>
            <?php } else { ?>
            <option value="1">512MB</option>
            <option value="2">1GB</option>
            <option value="3">2GB</option>
            <option value="4">4GB</option>
            <option value="5">Onboard</option>
            <option value="6" selected="selected">2GB Onboard</option>
            <?php } ?>
          </select>
          <br>
          <input type="submit" class="form-control btn btn-primary" name="submit" value="Wijzig Configuratie">
        </form>
        <?php } ?><!-- Afsluiting POST check -->
      </div>
    </div>
  </div>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
  if(isset($_POST["submit"])) {
    $datum = $_POST["aanschafdatum"];
    $computerSoort = $_POST["soortComputer"];
    $cpu = $_POST["cpu"];
    $memory = $_POST["memory"];
    $hdd = $_POST["hardeSchijf"];
    $os = $_POST["os"];
    $gpu = $_POST["gpu"];
    $sql = "UPDATE configuratie SET gebruiker = '$gebruiker', aanschaf_datum = '$datum', computer_soort = '$computerSoort', cpu = '$cpu', memory = '$memory', hdd = '$hdd', os = '$os', video_kaart = '$gpu'"; 
    $dbc->query($sql);
  }
?>