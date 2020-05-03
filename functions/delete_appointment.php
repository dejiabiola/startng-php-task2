<?php 


function delete_appointment($id) {
  unlink("db/appointments/" . $id . ".json");
}