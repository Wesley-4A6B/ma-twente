<?php
  if(isset($_POST["addConfig"])) {
    if(empty($_POST["gebruikersnaam"]) | empty($_POST["aanschafdatum"]) | empty($_POST["soortComputer"]) | empty($_POST["cpu"]) | 
       empty($_POST["memory"]) | empty($_POST["hardeSchijf"]) | empty($_POST["os"]) |empty($_POST["gpu"]) {
       echo("Vul alle velden in");  
       exit();
      }   
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
              VALUES('$gebruiker', $aanschafdatum', '$soortComputer', '$cpu', '$memory', '$hardeSchijf', '$os', '$gpu')";
      $result = $dbc->query($sql);
      if($result){
		 echo("Configuratie met succes in de database toegevoegd");    
	  } else{
		  echo("Fout");
	  }
	  
    }
  }
?>

<?php
  if(isset($_POST["addConfig"])) {
    if(empty($_POST["gebruikersnaam"]) | empty($_POST["aanschafdatum"]) | empty($_POST["soortComputer"]) | empty($_POST["cpu"]) | empty($_POST["memory"]) | empty($_POST["hardeSchijf"]) | empty($_POST["os"]) | empty($_POST["gpu"])) {
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
              VALUES('$gebruiker', $aanschafdatum', '$soortComputer', '$cpu', '$memory', '$hardeSchijf', '$os', '$gpu')";
      $result = $dbc->query($sql);
      if($result) {
        echo "Configuratie met succes in de database toegevoegd";
      } else {
        echo "Fout";
      }
    }
  } else {
    echo("Fout");
  }
?>