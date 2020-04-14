<?php include_once('lib/header.php'); 
require_once('functions/alert.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>




<div class="book_appointment_main">
  <div class="book_appointment_header_block">
    <h1 class="book_appointment_header">Book Appointment</h1>
    <p class>Please fill the form below to book your appointment</p>
  </div>
  
  <form action="processPatientAppointment.php" method="post">
    <p class="register_error">
      <?php  print_alert(); ?>
    </p>
    <div class="form-group column">
      <label for="example-date-input" class="col-12 col-form-label appointment_label">Date</label>
      <div class="col-12">
        <input
        <?php              
          if(isset($_SESSION['appointment_date'])){
              echo "value=" . $_SESSION['appointment_date'];                                                             
          }                
        ?>
        class="form-control" type="date" id="example-date-input">
      </div>
    </div>
    <div class="form-group column">
      <label for="example-time-input" class="col-12 col-form-label appointment_label">Time</label>
      <div class="col-12">
        <input 
        <?php              
          if(isset($_SESSION['appointment_time'])){
              echo "value=" . $_SESSION['appointment_time'];                                                             
          }                
        ?>
        class="form-control" type="time" id="example-time-input">
      </div>
    </div>
    <div class="form-group column">
      <label for="example-text-input" class="col-12 col-form-label">Nature of Appointment</label>
      <div class="col-12">
        <input 
        <?php              
          if(isset($_SESSION['appointment_nature'])){
              echo "value=" . $_SESSION['appointment_nature'];                                                             
          }                
        ?>
        class="form-control" type="text"  id="example-text-input">
      </div>
    </div> 
    <div class="form-group column">
      <label for="example-text-input" class="col-12 col-form-label">Initial Complaint</label>
      <div class="col-12">
        <input 
        <?php              
          if(isset($_SESSION['initial_complaint'])){
              echo "value=" . $_SESSION['initial_complaint'];                                                             
          }                
        ?>
        class="form-control" type="text"  id="example-text-input">
      </div>
    </div> 
    <div class="form-group column">
      <label for="example-text-input" class="col-12 col-form-label">In which department do you want to book an appointment?</label>
      <div class="col-12">
        <input 
        <?php              
          if(isset($_SESSION['appointment_date'])){
              echo "value=" . $_SESSION['appointment_date'];                                                             
          }                
        ?>
        class="form-control" type="text"  id="example-text-input">
      </div>
    </div>
    <button class="btn btn-sm btn-primary appointment_button" type="submit">Book Appointment</button> 
  </form>
      
</div>




<?php include_once('lib/footer.php'); ?>