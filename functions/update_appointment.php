<?php 


function update_appointment($userObject) {
  file_put_contents("db/appointments/". $userObject->id . ".json", json_encode($userObject));
}