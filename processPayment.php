<?php
  session_start();
  require_once("./functions/user.php");
  require_once("./functions/alert.php");
  require_once("./functions/redirect.php");
  require_once("./functions/get_patient_appointment.php");
  require_once("./functions/delete_appointment.php");
  require_once("./functions/update_appointment.php");

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  $appointmentId = $_GET['id']; 
  $email = $_GET['email'];
  
  $appointmentObject = get_appointment_by_id($appointmentId);

  if ($appointmentObject) {
    $appointmentObject->payment_status = "Paid";
    $appointmentObject->paid_for = "Consultation fee";
    $appointmentObject->amount = "NGN 2000";
    
    date_default_timezone_set("Africa/Lagos");
    $payment_date = date("Y/m/d");
    $payment_time = date("h:i:sa");

    $appointmentObject->payment_date = $payment_date;
    $appointmentObject->payment_time = $payment_time; 


    delete_appointment($appointmentId);

    update_appointment($appointmentObject);

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
          $mail->Subject = 'Payment Successful';
          $mail->Body    = '<p>Hello, your appointment has been successfully booked and we are looking forward to seeing you.</p>';
          $mail->AltBody = 'Hello, your appointment has been successfully booked and we are looking forward to seeing you.';

          $mail->send();
          // Email was sent. return back to the dashboard and display sucess message
          set_alert('message',"Your payment was successful");
          redirect_to("pay_bills.php");
          
        } catch (Exception $e) {
          // Email wan't sent. return back to dashboard tho
          set_alert('error',"Your payment was successful but we couln't send a confirmation email");
          return_to($_SESSION['designation']);
          return false;
        }
  } else {
    set_alert('error',"Payment might have been successful. But can't find appointment in DB");
    return_to($_SESSION['designation']);
  }

?>