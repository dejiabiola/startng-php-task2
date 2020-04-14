<?php include_once('lib/header.php'); 
require_once('functions/alert.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>

<div style="text-align:center">
  <h3>Super Admin Board</h3>
  <p>
    Welcome, <span style="text-decoration:underline"><?php echo $_SESSION['fullname'] ?></span>, 
    You are logged in as <span style="text-decoration:underline"><?php echo $_SESSION['designation'] ?></span>, 
    and your login time is <span style="text-decoration:underline"><?php echo $_SESSION['logInTime'] ?></span>.
  </p>
  <p>Your department is <span style="text-decoration:underline"><?php echo $_SESSION['department'] ?></span></p>
  <p>Your ID is <span style="text-decoration:underline"><?php echo $_SESSION['loggedIn'] ?></span></p>
  <p>Date of registration of account: <span style="text-decoration:underline"><?php echo $_SESSION['registered'] ?></span></p>
  <br>
  <br>
  <br>
  <p>
    <?php  print_alert();?>
  </p>
  <hr>
</div>
 
<div class="patient_body" style="margin-left:50px;text-align:center;">
  <div class="patient_links">
    <p>What do you want to do?</p>
    <a class="p-2" href="view_medical_staff.php">View Medical Staff</a>
    <a class="p-2" href="view_patients.php">View Patients</a>
    <a class="p-2" href="register_others.php">Register Someone</a>
  </div>
</div>
  
<?php include_once('lib/footer.php'); ?>
