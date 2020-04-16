<?php 
  session_start();
  require_once("./functions/alert.php");
  require_once('functions/token.php');
  require_once('functions/user.php');
  require_once("./functions/redirect.php");

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  // Collect date
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


      $userObject = find_user($email);

      if($userObject) {
        $token = generate_token();


        $subject = "Passwor Reset Link";
        $message = "A password reset has been initiated from this account. If your did not initiate this rest, please ignore this 
        message otherwise, visit: http://192.168.64.2/snh-hospital/reset.php?token=".$token;
        

        file_put_contents("./db/token/" . $email . ".json", json_encode(['token'=>$token]));

       

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
          $mail->Body    = "<p>A password reset has been initiated from this account.</p>
                            <p>If your did not initiate this rest, please ignore this 
                            message otherwise, 
                            visit:<a href=http://192.168.64.2/snh-hospital/reset.php?token=".$token . ">snh.org</p>";
          $mail->AltBody = "A password reset has been initiated from this account. If your did not initiate this rest, please ignore this 
                            message otherwise, visit: http://192.168.64.2/snh-hospital/reset.php?token=".$token;

          $mail->send();
          set_alert('message',"A rest link has been sent to your email");
          redirect_to("login.php");
          
        } catch (Exception $e) {
          set_alert('error',"An error occured. Please contact support");
          redirect_to("login.php");
          return false;
        }
      }
      die();   
  }
  set_alert('error', "Your email is not registered with us " . $email);
  redirect_to("./forgot.php");

?>