<?php 
include_once('lib/header.php'); 
require_once('functions/alert.php');


if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>



<div>
  <a href="patient.php" class="appointment_back_button">Go back</a>
  <div class="book_appointment_inner">
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
          class="form-control" type="date" id="example-date-input" name="appointment_date">
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
          class="form-control" type="time" id="example-time-input" name="appointment_time">
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
          class="form-control" type="text"  id="example-text-input" name="appointment_nature">
        </div>
      </div> 
      <div class="form-group column">
        <label for="example-text-input" class="col-12 col-form-label">Which department do you want to book an appointment?</label>
        <div class="col-12">
          <input 
          <?php              
            if(isset($_SESSION['appointment_department'])){
                echo "value=" . $_SESSION['appointment_department'];                                                             
            }                
          ?>
          class="form-control" type="text"  id="example-text-input" name="appointment_department">
        </div>
      </div>
      <div class="form-group column">
        <label for="exampleTextarea">Initial Complaint</label>
        <textarea
        <?php              
            if(isset($_SESSION['initial_complaint'])){
                echo "value=" . $_SESSION['initial_complaint'];                                                             
            }                
          ?>
         class="form-control" id="exampleTextarea" rows="6" name="initial_complaint"></textarea>
      </div>
      <button class="btn btn-sm btn-primary appointment_button" type="submit">Book Appointment</button> 
    </form>
        
  </div>
</div>



<?php include_once('lib/footer.php'); ?>