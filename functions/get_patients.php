<?php

function get_patients() {
  $allPatients = [];
  $allUsersInDb = scandir("db/users");
  $countAllUsers = count($allUsersInDb);

  for ($counter = 2; $counter < $countAllUsers; $counter++) {
    $currentUser = $allUsersInDb[$counter];
    $currentUserString = file_get_contents("db/users/".$currentUser);
    $currentUserObject = json_decode($currentUserString);
    $designation = $currentUserObject->designation;
    if ($designation == "Patient") {
      array_push($allPatients, $currentUserObject);
    }
  }
  return $allPatients;
}