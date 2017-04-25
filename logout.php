<?php
	session_start();
    ob_start();
    if(!isset($_SESSION['emailUser']) && !isset($_SESSION['senhaUser'])){
      $redirect = "login.php";
      header("location:$redirect");
    }
    else {
      session_destroy();
      session_unset(['emailUser']);
      session_unset(['senhaUser']);
      $redirect = "login.php";
      header("location:$redirect");
    }
?>