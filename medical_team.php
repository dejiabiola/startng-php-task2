<?php  

include_once('lib/header.php'); 
require_once('functions/alert.php');
require_once('functions/user.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>

<div style="text-align:center">
  <h3>Medical Team Board</h3>
  <p>Welcome, <span style="text-decoration:underline"><?php echo $_SESSION['fullname'] ?></span>, 
  You are logged in as <span style="text-decoration:underline"><?php echo $_SESSION['designation'] ?></span>, 
  and your login time is <span style="text-decoration:underline"><?php echo $_SESSION['logInTime'] ?></span>.</p>
  <p>Your department is <span style="text-decoration:underline"><?php echo $_SESSION['department'] ?></span></p>
  <p>Your ID is <span style="text-decoration:underline"><?php echo $_SESSION['loggedIn'] ?></span></p>
  <p>Date of registration of account: <span style="text-decoration:underline"><?php echo $_SESSION['registered'] ?></span></p>
  <br>
  <br>
  <p class="register_error">
            <?php  print_alert(); ?>
        </p>

  <hr>
</div>
<div class="medical_main">
  <h3>Appointment List</h3>
  <?php 
  
   $appointments = get_appointment($_SESSION['department']);
  if(count($appointments) < 1)  { ?>
    <p>You have no pending appointments</p>
  <?php }else{ ?>
    <table class="medical_table">
      <thead>
        <tr>
          <th>S/N</th>
          <th>Patient Name</th>
          <th>Appointment Date</th>
          <th>Time</th>
          <th>Nature of Appointment</th>
          <th>Initial Complaint</th>
          <th>Gender</th>
          <th>Payment Status</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $appointments = get_appointment($_SESSION['department']);
        for ($i = 0; $i < count($appointments); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $appointments[$i]->full_name ?></td>
            <td><?php echo $appointments[$i]->appointment_date ?></td>
            <td><?php echo $appointments[$i]->appointment_time ?></td>
            <td><?php echo $appointments[$i]->appointment_nature ?></td>
            <td><?php echo $appointments[$i]->initial_complaint ?></td>
            <td><?php echo $appointments[$i]->gender ?></td>
            <td><?php echo $appointments[$i]->payment_status ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div>