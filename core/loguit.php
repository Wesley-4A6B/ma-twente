<?php
	session_start();
	session_unset($_SESSION["gebruiker"]);
	header("Location: ../index.php");
?>