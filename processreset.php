<?php 
  session_start();
  require_once("./functions/user.php");
  require_once("./functions/alert.php");
  require_once("./functions/redirect.php");
  require_once("./functions/token.php");

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;


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


    $checkToken = is_user_loggedIn() ? "true" :  find_token($email);

    if ($checkToken) {
      
      
      if (find_user($email) !== false) {
        //Check for password
        
        $userObject = find_user($email);
        $userObject->password = password_hash($password, PASSWORD_BCRYPT);

        unlink("db/users/" . $email . ".json"); // Delete current data from file
        if ($_SESSION['token'] && !empty($_SESSION['token'])) {
          unlink("db/token/" . $email . ".json");
        }

        update_user($userObject);
  


        /* Stert of Send email to the user code block */

        // Load Composer's autoloader
        require "./vendor/autoload.php";

        

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
          //Server settings
          $mail->isSMTP();                                            // Send using SMTP
          $mail->Host       = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mail->Username   = '38a70c6d5e5842';                     // SMTP username
          $mail->Password   = '9ce9389295adda';                               // SMTP password
          $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
          $mail->Port       = 2525;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

          //Recipients
          $mail->setFrom('no-reply@snh.org', 'SNH');
          $mail->addAddress($email);     // Add a recipient
          $mail->addCC('deji@snh.org');

        
          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Password Change Successful';
          $mail->Body    = '<p>Your password change on SNH was successful.</p>
                            <p>If you did not initiate the password change, visit snh.org and reset your password immediately.</p>';
          $mail->AltBody = 'Your password change on SNH was successful. If you did not initiate the password change, visit snh.org and reset your password immediately.';

          $mail->send();
          set_alert('message',"Your password has been updated successfully");
          return_to($_SESSION['designation']);
          
        } catch (Exception $e) {
          set_alert('error',"An error occured. Please contact support");
          return_to($_SESSION['designation']);
          return false;
        }
      }
       die();   
    }
    set_alert('error',"Password Change Failed, token/email invalid or expired");
    redirect_to("login.php");
  }

?>