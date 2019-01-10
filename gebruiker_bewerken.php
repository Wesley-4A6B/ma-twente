<?php
  session_start();
  include ("core/dbc.php");
  $gebruikers = "SELECT * FROM gebruikers";
  $gebruikersResult = $dbc->query($gebruikers);
  $gebruikersRow = mysqli_fetch_assoc($gebruikersResult);
  $geslacht = $gebruikersRow["geslacht"];
  $voorletter = $gebruikersRow['voorletter'];
  $achternaam = $gebruikersRow['achternaam'];
  $gebruikersnaam = $gebruikersRow['gebruikersnaam'];
  $telefoon = $gebruikersRow['intern_telefoon_nummer'];
  $afdeling = $gebruikersRow["afdeling"];
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
        <h3 class="panel-title">Gebruiker Wijzigen</h3>
      </div>
      <div class="panel-body">
        <label><h2>Selecteer Gebruiker</h2></label>
          <?php
          $sql = "SELECT * FROM gebruikers";
          $result = $dbc->query($sql);

          echo "<form method='post' action=''>
          <select name='gebruikersnaam' class='form-control' style='overflow: auto;'>";
          while($row = mysqli_fetch_assoc($result)) {
            echo "<option value='".$row['gebruikersnaam']."' class='form-control'>".$row['gebruikersnaam']."</option>";
          }
          echo "</select>
          <br>
          <input type='submit' class='form-control btn btn-primary' value='Toon Gegevens'></form";
          ?>
          <br>
          <?php
          if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["gebruikersnaam"]) && !empty($_POST["gebruikersnaam"])) {
              $sql = "SELECT * FROM gebruikers WHERE gebruikersnaam = '".$_POST["gebruikersnaam"]."'";
              $result = $dbc->query($sql);
              $row = mysqli_fetch_assoc($result);
            }
          ?>
          <hr>
          <label><h2>Wijzig Gebruiker</h2></label>
          <br>
          
          <form method="post" action="">
          <label>Geslacht</label>
          <select class="form-control" name="geslacht">
            <?php if($row['geslacht'] == 1) { ?>
              <option value="1" selected="selected">Vrouw</option>
              <option value="2">Man</option>
            <?php } else { ?>  
              <option value="2" selected="selected">Man</option>
              <option value="1">Vrouw</option>
            <?php } ?>  
          </select>
          <label>Voorletter</label>
          <input type="text" class="form-control" name="voorletter" value="<?php echo $row['voorletter']; ?>">
          <label>Achternaam</label>
          <input type="text" class="form-control" name="achternaam" value="<?php echo $row['achternaam']; ?>">
          <label>Afdeling</label>
          <?php include("afdeling_select.php"); ?>
          <label>Intern telefoonnummer</label>
          <input type="text" class="form-control" name="telefoon" value="<?php echo $row['intern_telefoon_nummer']; ?>">
          <label>Privilege</label>
          <select class="form-control" name="privilege">
            <?php if($row['privilege'] == 1) { ?>
              <option value="1" selected="selected">Gebruiker</option>
              <option value="2">Beheerder</option>
            <?php } else { ?>
              <option value="2" selected="selected">Beheerder</option>
              <option value="1">Gebruiker</option>
            <?php } ?>  
          </select>
          <br>
          <input type="submit" class="form-control btn btn-primary" name="submit" value="Gebruiker Wijzigen">
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
    $geslacht = $_POST["geslacht"];
    $voorletter = strtolower($_POST["voorletter"]);
    $achternaam = strtolower($_POST["achternaam"]);
    $gebruikersnaam = $voorletter . "." . $achternaam;
    $afdeling = $_POST["afdeling"];
    $telefoon = $_POST["telefoon"];
    $privilege = $_POST["privilege"];
    $sql = "UPDATE gebruikers SET geslacht = '$geslacht', voorletter = '$voorletter', achternaam = '$achternaam', gebruikersnaam = '$gebruikersnaam', afdeling = '$afdeling', intern_telefoon_nummer = '$telefoon', privilege = '$privilege'";  
    $dbc->query($sql);
  }
?>