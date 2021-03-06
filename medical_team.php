<?php include_once('lib/header.php'); 
require_once('functions/alert.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>

<div style="text-align:center">
<h3>Medical Team Board</h3>
<p>Welcome, <span style="text-decoration:underline"><?php echo $_SESSION['fullname'] ?></span>, 
You are logged in as <span style="text-decoration:underline"><?php echo $_SESSION['role'] ?></span>, 
and your login time is <span style="text-decoration:underline"><?php echo $_SESSION['logInTime'] ?></span>.</p>
<p>Your department is <span style="text-decoration:underline"><?php echo $_SESSION['department'] ?></span></p>
<p>Your ID is <span style="text-decoration:underline"><?php echo $_SESSION['loggedIn'] ?></span></p>
<p>Date of registration of account: <span style="text-decoration:underline"><?php echo $_SESSION['registered'] ?></span></p>
<br>
<br>
<br>

<hr>