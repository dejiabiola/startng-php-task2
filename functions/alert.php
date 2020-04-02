<?php 

function print_message() {
  if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo "<span style='color:green;'>" . $_SESSION['message'] . "</span>";

    if (!$_SESSION['admin']) {
      // session_unset();
    session_destroy();
    }
    
  };
}

function print_alert(){
  //for printing message or error;
  $types = ['message','info','error'];
  $colors = ['success','info','danger'];
    
  for($i = 0; $i < count($types); $i++){
      
      if( isset($_SESSION[$types[$i]]) && !empty($_SESSION[$types[$i]]) ) {
          echo "<div class='alert alert-".$colors[$i]."' role='alert'>" . $_SESSION[$types[$i]] .
                  "</div>";
        
          // if (!$_SESSION['admin'] || isset($_SESSION['admin']) == false) {
          //   // session_unset();
          // session_destroy();
          // }
      }

  }

}

function print_error() {
  if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    echo "<span style='color:red;'>" . $_SESSION['error'] . "</span>";

    // session_unset();
    if (!$_SESSION['admin']) {
      // session_unset();
    session_destroy();
    }
  } 
}

function set_alert($type = "message", $content = ""){
  switch($type){
      case "message":
          $_SESSION['message']=$content;
      break;
      case "error":
          $_SESSION['error'] = $content;
      break;
      case "info":
          $_SESSION['info'] = $content;
      break;
      default:
      $_SESSION['message'] = $content;
  break;
  }
}
?>