<?php include_once('lib/header.php');  
  require_once('./functions/get_patient_appointment.php');
  require_once('./functions/alert.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>

<a href="patient.php" class="appointment_back_button">Go back</a>
<p style="text-align: center;">
    <?php  print_alert();?>
  </p>
<div class="medical_main">
  <h3>Appointment List</h3>
  <?php 
  
   $appointments = get_patient_appointment($_SESSION['email']);
  if(count($appointments) < 1)  { ?>
    <p>You currently have not booked any appointment</p>
  <?php }else{ ?>
    <table class="medical_table">
      <thead>
        <tr>
          <th>S/N</th>
          <th>Appointment Date</th>
          <th>Appointment Time</th>
          <th>Appointment Nature</th>
          <th>Department</th>
          <th>Initial Complaint</th>
          <th>Payment Status</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $appointments = get_patient_appointment($_SESSION['email']);
        for ($i = 0; $i < count($appointments); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $appointments[$i]->appointment_date ?></td>
            <td><?php echo $appointments[$i]->appointment_time ?></td>
            <td><?php echo $appointments[$i]->appointment_nature ?></td>
            <td><?php echo $appointments[$i]->appointment_department ?></td>
            <td><?php echo $appointments[$i]->initial_complaint ?></td>
            <td><?php echo $appointments[$i]->payment_status ?></td>
            <td>
              Pay Now
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div>
<?php include_once('lib/footer.php'); ?>





