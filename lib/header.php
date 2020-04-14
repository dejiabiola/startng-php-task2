<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="5" >  -->
    <title>Welcome to SNG : Hospital for the ignorant</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/superadmin.css">
    <link rel="stylesheet" href="css/medicalteam.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/forgot.css">
    <link rel="stylesheet" href="css/patientappointment.css">
    <link rel="stylesheet" href="css/paybill.css">
    <link rel="stylesheet" href="css/patient.css">
    <script src="js/scripts.js"></script>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a href="index.php">StartNG Hospital</a></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <?php if(!isset($_SESSION['loggedIn'])){ ?>
              <a class="p-2 text-dark" href="index.php">Home</a>
                <a class="p-2 text-dark" href="login.php">Login</a> 
                <a class="btn btn-primary" href="register.php">Register</a> 
                <!-- <a class="p-2 text-dark" href="forgot.php">Forgot Password</a> -->
            <?php }else{ ?>
                
               <?php if ($_SESSION['designation'] == 'Super Admin (SA)') { ?>
                <a class="p-2 text-dark" href="super_admin.php">Dashboard</a> 
                <?php }else if ($_SESSION['designation'] == 'Medical Team (MT)') { ?>
                  <a class="p-2 text-dark" href="medical_team.php">Dashboard</a> 
                  <?php }else if ($_SESSION['designation'] == 'Patient') { ?>
                    <a class="p-2 text-dark" href="patient.php">Dashboard</a> 
                    <?php } ?>                
                <a class="p-2 text-dark" href="reset.php">Reset Password</a>
                <a class="p-2 text-dark" href="logout.php">Logout</a>
            <?php } ?>
          
        </nav>
       
    </div>