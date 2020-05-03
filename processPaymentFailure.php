<?php
  session_start();
  require_once("./functions/user.php");
  require_once("./functions/alert.php");
  require_once("./functions/redirect.php");

  set_alert('error',"Your payment could not be completed. Please try again");
    return_to($_SESSION['designation']);