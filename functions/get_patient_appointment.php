
<?php


// Get all appointment by the specific patient from Db
function get_patient_appointment($patient_email) {
  $allAppointments = [];

  $appointmentsInDb = scandir("db/appointments");
  $countAllAppointments = count($appointmentsInDb);

  for ($counter = 2; $counter < $countAllAppointments; $counter++) {
    $currentAppointment = $appointmentsInDb[$counter];
    $currentAppointmentString = file_get_contents("db/appointments/".$currentAppointment);
    $currentAppointmentObject = json_decode($currentAppointmentString);
    $patientEmail = $currentAppointmentObject->email;
    if ($patient_email == $patientEmail) {
      array_push($allAppointments, $currentAppointmentObject);
    }
  }
  return $allAppointments;
}

