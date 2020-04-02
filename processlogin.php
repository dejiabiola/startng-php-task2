<?php 
  session_start();
  require_once('./functions/alert.php');
  require_once('./functions/redirect.php');
  require_once('./functions/token.php');
  require_once('./functions/user.php');

  $errorCount = 0;

  $email = $_POST['email'] != '' ? $_POST['email'] : $errorCount++;
  $password = $_POST['password'] != '' ? $_POST['password'] : $errorCount++;

  $_SESSION['email'] = $email;

  if ($errorCount > 0) {
    // Redirect user back to from and display error
    $session_error = "You have " . $errorCount . " error";
    if ($errorCount > 1) {
      $session_error .= 's';
    }
    $session_error .= ' in your form submission.';
    set_alert('error',$session_error);
      
    redirect_to("login.php");
  

  } else {
    // Count all the users,
    $currentUser = find_user($email);
//  print_r($currentUser);
    // die();

    if ($currentUser) {

      //Check for password
      $userString = file_get_contents("db/users/".$currentUser->email . ".json");
      $userObject = json_decode($userString);
      $passwordFromDB = $userObject -> password;


      $passwrodFromUser = password_verify($password, $passwordFromDB);

      if (password_verify($password, $passwordFromDB)) {
        $_SESSION['loggedIn'] = $userObject -> id;
        $_SESSION['email'] = $userObject -> email;
        $_SESSION['fullname'] = $userObject -> first_name . ' ' . $userObject -> last_name;
        $_SESSION['role'] = $userObject -> designation;
        $_SESSION['department'] = $userObject -> department;
        $_SESSION['registered'] = $userObject -> registration_date;


        // Get login date and time
        date_default_timezone_set("Africa/Lagos");
        $login_date = date("Y/m/d");
        $login_time = date("h:i:sa");

        $userObject -> last_login_date = $login_date;
        $userObject -> last_login_time = $login_time; 

        unlink("db/users/" . $email . ".json");

        file_put_contents("db/users/". $userObject -> email . ".json", json_encode($userObject));

        $_SESSION['logInDate'] = $userObject -> last_login_date;
        $_SESSION['logInTime'] = $userObject -> last_login_time;

        if ($_SESSION['role'] == 'Patient') {
          header("Location: ./patient.php");
          die();
        } else if ($_SESSION['role'] == 'Medical Team (MT)') {
          header("Location: ./medical_team.php");
          die();
        } else if ($_SESSION['role'] == 'Super Admin (SA)') {
          header("Location: ./super_admin.php");
          die();
        }


        die();
      } else {
        set_alert('error',"Invalid Email or Password");
        redirect_to("login.php");
          die(); 
      }
      die();
    }  
    

    set_alert('error',"Invalid Email or Password");
    redirect_to("login.php");
    die();
    

  
  }


?>