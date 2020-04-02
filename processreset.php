<?php 
  session_start();
  require_once("./functions/user.php");
  require_once("./functions/alert.php");
  require_once("./functions/redirect.php");
  require_once("./functions/token.php");
  require_once("./functions/email.php");


  $errorCount = 0;

  if (!is_user_loggedIn()) {
    $token = $_POST['token'] != '' ? $_POST['token'] : $errorCount++;
    $_SESSION['token'] = $token;
  }

  // Collect data, verify and validate.
  
  $password = $_POST['password'] != '' ? $_POST['password'] : $errorCount++;
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
    redirect_to("./reset.php");


  } else {


    $checkToken = is_user_loggedIn() ? true :  find_token($email);


        if ($checkToken) {

          $userExists = find_user($email);
          if ($userExists) {
            //Check for password
  
            $userObject = find_user($email);
            $userObject -> password = password_hash($password, PASSWORD_BCRYPT);
            
            
            unlink("db/users/" . $email . ".json"); // Delete current data from file
            if ($_SESSION['token'] && !empty($_SESSION['token'])) {
              unlink("db/token/" . $email . ".json");
            }
            

            file_put_contents("db/users/". $userObject -> email . ".json", json_encode($userObject));

            $_SESSION["message"] = "YPassword Reset Successful, you can now login";
            header("Location: ./login.php");

            // set_alert('message',"Password Reset Successful, you can now login");
            // redirect_to("login.php");


            // $subject = "Password Reset Successful";
            // $message = "Your password reset on SNH was successful. If you did not initiate the password, visit snh.org and reset your password immediately.";
            // send_mail($subject,$message,$email);
                       
            
            die();
          }
          
        }

    set_alert('error',"Password Reset Failed, token/email invalid or expired");
    redirect_to("login.php");
  }

?>