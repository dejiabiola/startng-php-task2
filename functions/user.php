<?php require_once("alert.php");

  function is_user_loggedIn() {
    if($_SESSION['loggedIn'] && !empty($_SESSION['loggedIn']))  {
      return true;
    }
    return false;
  }

  function is_token_set() {
    return is_token_set_in_get() || is_token_set_in_session();
  }


  function is_token_set_in_get() {
    return isset($_GET['token']);
 
  }

  function is_token_set_in_session() {
    return isset($_SESSION['token']);
  }

  function find_user($email = ""){
    //check the database if the user exsits
    if(!$email){
        set_alert('error','User Email is not set');
        die();
    }

    $allUsers = scandir("db/users/"); //return @array (2 filled)
    $countAllUsers = count($allUsers);

    for ($counter = 0; $counter < $countAllUsers; $counter++) {
       
        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
          //check the user password.
            $userString = file_get_contents("db/users/".$currentUser);
            $userObject = json_decode($userString);
                       
            return $userObject;
          
        }        
        
    }

    return false;
}


function save_user($userObject){

  file_put_contents("db/users/". $userObject['email'] . ".json", json_encode($userObject));
}

function add_appointment($userObject){
  file_put_contents("db/appointments/". strtolower($userObject['appointment_department']) . uniqid() . ".json", json_encode($userObject));
}


function get_appointment($department) {
  $allAppointments = [];

  $appointmentsInDb = scandir("db/appointments");
  $countAllAppointments = count($appointmentsInDb);

  for ($counter = 0; $counter < $countAllAppointments; $counter++) {
    $currentAppointment = $appointmentsInDb[$counter];

    if(strpos($currentAppointment, strtolower($department)) !== false) {
      $appointmentString = file_get_contents("db/appointments/".$currentAppointment);
      $appointmentObject = json_decode($appointmentString);
      array_push($allAppointments, $appointmentObject);
    }
  }

  // print_r($allAppointments);
  // die();
  return $allAppointments;
}

?>
