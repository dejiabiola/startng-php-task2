<?php 


function delete_appointment($email, $id) {
  unlink("db/appointments/" . $email . $id . ".json");
}