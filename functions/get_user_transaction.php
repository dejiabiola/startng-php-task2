<?php 



function get_patient_transaction($patient_email) {
  $allTransactions = [];

  $appointmentsInDb = scandir("db/appointments");
  $countAllAppointments = count($appointmentsInDb);

  for ($counter = 2; $counter < $countAllAppointments; $counter++) {
    $currentAppointment = $appointmentsInDb[$counter];
    $currentAppointmentString = file_get_contents("db/appointments/".$currentAppointment);
    $currentAppointmentObject = json_decode($currentAppointmentString);
    $patientEmail = $currentAppointmentObject->email;
    $payment_status = $currentAppointmentObject->payment_status;
    if ($patient_email == $patientEmail && $payment_status == 'Paid') {
      array_push($allTransactions, $currentAppointmentObject);
    }
  }
  return $allTransactions;
}

function get_paid_appointments() {
  $allTransactions = [];

  $appointmentsInDb = scandir("db/appointments");
  $countAllAppointments = count($appointmentsInDb);

  for ($counter = 2; $counter < $countAllAppointments; $counter++) {
    $currentAppointment = $appointmentsInDb[$counter];
    $currentAppointmentString = file_get_contents("db/appointments/".$currentAppointment);
    $currentAppointmentObject = json_decode($currentAppointmentString);
    $payment_status = $currentAppointmentObject->payment_status;
    if ($payment_status == 'Paid') {
      array_push($allTransactions, $currentAppointmentObject);
    }
  }
  return $allTransactions;
}


?>