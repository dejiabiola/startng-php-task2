<?php include_once('lib/header.php'); 
require_once('functions/alert.php');
require_once('functions/get_patients.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>
<a href="super_admin.php" class="appointment_back_button">Go back</a>

<div class="medical_main">
  <h3>Patients List</h3>
  <?php 
  
   $patient = get_patients();
  if(count($patient) < 1)  { ?>
    <p>StartNG hospital currently has no registered patient</p>
  <?php }else{ ?>
    <table class="medical_table">
      <thead>
        <tr>
          <th>S/N</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Gender</th>
          <th>Department</th>
          <th>Registration Date</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $patient = get_patients();
        for ($i = 0; $i < count($patient); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $patient[$i]->first_name ?></td>
            <td><?php echo $patient[$i]->last_name; ?></td>
            <td><?php echo $patient[$i]->email ?></td>
            <td><?php echo $patient[$i]->gender ?></td>
            <td><?php echo $patient[$i]->department ?></td>
            <td><?php echo $patient[$i]->registration_date ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div>



<?php include_once('lib/footer.php'); ?>





