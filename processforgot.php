<?php 
  session_start();
  require_once("./functions/alert.php");
  require_once('functions/token.php');
  require_once('functions/user.php');
  require_once("./functions/redirect.php");
  require_once('./functions/email.php');

  $errorCount = 0;

  $email = $_POST['email'] != '' ? $_POST['email'] : $errorCount++;

  $_SESSION['email'] = $email;


  if ($errorCount > 0) {
    // Redirect user back to from and display error
    $session_error = "You have " . $errorCount . " error";
    if ($errorCount > 1) {
      $session_error .= 's';
    }
    $session_error .= ' in your form submission.';
    set_alert('error', $session_error);
    redirect_to("./forgot.php");

  } else {
    //Continue to database

  
    // Count all the users,
    $allUsers = scanDir('./db/users/');
    $countAllUsers = count($allUsers);



    // Look through entries in the db and check if user already exists
    for ($counter = 0; $counter < $countAllUsers; $counter++) {
      $currentuser = $allUsers[$counter];

      $emailJson = $email . '.json';
      if ($currentuser == $emailJson) {

        $token = generate_token();


        $subject = "Passwor Reset Link";
        $message = "A password reset has been initiated from this account. If your did not initiate this rest, please ignore this 
        message otherwise, visit: http://192.168.64.2/snh-hospital/reset.php?token=".$token;
        

        file_put_contents("./db/token/" . $email . ".json", json_encode(['token'=>$token]));

        send_mail($subject, $email, $email);
        die();
      }

      
    }
    set_alert('string', "Your email is not registered with us " . $email);
    redirect_to("./login.php");

    

  }

?>