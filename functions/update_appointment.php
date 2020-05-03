<?php 


function update_appointment($userObject) {
  file_put_contents("db/appointments/". $userObject->email . $userObject->id . ".json", json_encode($userObject));
}