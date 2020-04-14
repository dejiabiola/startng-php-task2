<?php include_once('lib/header.php'); 
require_once('functions/alert.php');
require_once('functions/get_medical_staff.php');


if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>
<a href="super_admin.php" class="appointment_back_button">Go back</a>

<div class="medical_main">
  <h3>Medical Staff List</h3>
  <?php 
  
   $staff = get_medical_staff();
  if(count($staff) < 1)  { ?>
    <p>StartNG Hospital currently has no medical staff</p>
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
        $staff = get_medical_staff();
        for ($i = 0; $i < count($staff); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $staff[$i]->first_name ?></td>
            <td><?php echo $staff[$i]->last_name; ?></td>
            <td><?php echo $staff[$i]->email ?></td>
            <td><?php echo $staff[$i]->gender ?></td>
            <td><?php echo $staff[$i]->department ?></td>
            <td><?php echo $staff[$i]->registration_date ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div>



<?php include_once('lib/footer.php'); ?>
