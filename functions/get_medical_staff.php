
<?php

function get_medical_staff() {
  $allMedicalStaff = [];
  $allUsersInDb = scandir("db/users");
  $countAllUsers = count($allUsersInDb);

  for ($counter = 2; $counter < $countAllUsers; $counter++) {
    $currentUser = $allUsersInDb[$counter];
    $currentUserString = file_get_contents("db/users/".$currentUser);
    $currentUserObject = json_decode($currentUserString);
    $designation = $currentUserObject -> designation;

    if ($designation == "Medical Team (MT)") {
      array_push($allMedicalStaff, $currentUserObject);
    }
  }
  return $allMedicalStaff;
}