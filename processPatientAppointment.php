<?php session_start();
require_once("./functions/user.php");
require_once("./functions/redirect.php");



$errorCount = 0;

// Collect data, verify and validate.
$appointment_date = $_POST['appointment_date'] != '' ? $_POST['appointment_date'] : $errorCount++;
$appointment_time = $_POST['appointment_time'] != '' ? $_POST['appointment_time'] : $errorCount++;
$appointment_nature = $_POST['appointment_nature'] != '' ? $_POST['appointment_nature'] : $errorCount++;
$initial_complaint = $_POST['initial_complaint'] != '' ? $_POST['initial_complaint'] : $errorCount++;
$appointment_department = $_POST['appointment_department'] != '' ? $_POST['appointment_department'] : $errorCount++;


// Add sessions
$_SESSION['appointment_date'] = $appointment_date;
$_SESSION['appointment_time'] = $appointment_time;
$_SESSION['appointment_nature'] = $appointment_nature;
$_SESSION['initial_complaint'] = $initial_complaint;
$_SESSION['appointment_department'] = $appointment_department;



if ($errorCount > 0) {
  // Redirect user back to from and display error
  $session_error = "You have " . $errorCount . " error";
  if ($errorCount > 1) {
    $session_error .= 's';
  }
  $session_error .= ' in your form submission.<br> You have to fill all fields.';
  $_SESSION["error"] = $session_error;


  redirect_to("book_appointment.php");

} else {
  
  $userObject = [
    'appointment_date' => $appointment_date,
    'full_name' => $_SESSION['fullname'],
    'gender' => $_SESSION['gender'],
    'email' => $_SESSION['email'],
    'appointment_time' => $appointment_time,
    'appointment_nature' => $appointment_nature,
    'initial_complaint' => $initial_complaint,
    'appointment_department' => $appointment_department,
  ];



  add_appointment($userObject);

  $_SESSION["message"] = "Your appointment has been successfully booked";
  redirect_to("patient.php");
}