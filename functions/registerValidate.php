<?php 


  // Start of helper functions for form validation
  function nameCheck($string) {
    if (preg_match('/\\d/', $string) > 0) {
      return false;
    } else {
      return true;
    }
  }

  function lengthCheck($string, $length) {
    if (strlen($string) < $length) {
      return false;
    } else {
      return true;
    }
  }

  function checkReturnLocation($super_admin_check) {
    if ($super_admin_check) {
      header("location: super_admin.php");
    } else {
      header("location: register.php");
    }
  }

  function checkSuccessReturnLocation($super_admin_check) {
    if ($super_admin_check) {
      $_SESSION["message"] = "The user has been added successfully. They can now log in";
      header("location: super_admin.php");
    } else {
      $_SESSION["message"] = "Your information has been added successfully. You can now log in";
      header("location: login.php");
    }
  }

  
  // function 
  // End of helper functions for form validation


?>