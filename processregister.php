<?php 
  session_start();
  require_once("./functions/user.php");
  require_once("./functions/registerValidate.php");

  $errorCount = 0;

  // Collect data, verify and validate.
  $first_name = $_POST['first_name'] != '' ? $_POST['first_name'] : $errorCount++;
  $last_name = $_POST['last_name'] != '' ? $_POST['last_name'] : $errorCount++;
  $email = $_POST['email'] != '' ? $_POST['email'] : $errorCount++;
  $password = $_POST['password'] != '' ? $_POST['password'] : $errorCount++;
  $gender = $_POST['gender'] != '' ? $_POST['gender'] : $errorCount++;
  $designation = $_POST['designation'] != '' ? $_POST['designation'] : $errorCount++;
  $department = $_POST['department'] != '' ? $_POST['department'] : $errorCount++;
  $super_admin_check = $_POST['super_admin'] != '' ? $_POST['super_admin'] : '';
  $super_admin_email = $_POST['admin_email'] != '' ? $_POST['admin_email'] : '';
 
  // Check if first and last name have numbers and if their length is greater than 2
  if (nameCheck($first_name) == false || nameCheck($last_name) == false) {
    $_SESSION['error'] = "Your first name and last name must not contain any digits";
    checkReturnLocation($super_admin_check);
    die();
  }

  // Check if length of first and last name is at least 2 
  if (lengthCheck($first_name, 2) == false || lengthCheck($last_name, 2) == false) {
    $_SESSION['error'] = "Your first name and last name must be at least two characters long";
    checkReturnLocation($super_admin_check);
    die();
  }


  // Verify that email address contains @ and . characters
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "You have entered an invalid email";
    checkReturnLocation($super_admin_check);
    die();
  }

  // Check if length of email is at least 5
  if (lengthCheck($email, 5) === false) {
    $_SESSION['error'] = "Length of your email address must be at least 5";
    checkReturnLocation($super_admin_check);
    die();
  }

  // Check if access came from the superadmin page
  if ($super_admin_check) {
    $_SESSION['admin'] = true;
  }


  // Assign sessions to new user information
  $_SESSION['first_name'] = $first_name;
  $_SESSION['last_name'] = $last_name;
  $_SESSION['email'] = $email;
  $_SESSION['gender'] = $gender;
  $_SESSION['designation'] = $designation;
  $_SESSION['department'] = $department;

  if ($errorCount > 0) {
    // Redirect user back to from and display error
    $session_error = "You have " . $errorCount . " error";
    if ($errorCount > 1) {
      $session_error .= 's';
    }
    $session_error .= ' in your form submission.<br> You have to fill all fields.';
    $_SESSION["error"] = $session_error;

    checkReturnLocation($super_admin_check);
  } else {
    //Continue to database

    if ($super_admin_check) {
      // Get the superadmin sessions data back
      $adminString = file_get_contents("db/users/".$super_admin_email . ".json");
      $adminObject = json_decode($adminString);
 

      $_SESSION['email'] = $adminObject -> email;
      $_SESSION['fullname'] = $adminObject -> first_name . ' ' . $adminObject -> last_name;
      $_SESSION['designation'] = $adminObject -> designation;
      $_SESSION['department'] = $adminObject -> department;
      $_SESSION['registered'] = $adminObject -> registration_date;
      $_SESSION['logInDate'] = $adminObject -> last_login_date;
      $_SESSION['logInTime'] = $adminObject -> last_login_time;
    }

    $registration_date = date("Y/m/d");
   
   // Create new user object and store new user data in it
    $userObject = [
      'id' => uniqid(),
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_BCRYPT),
      'gender' => $gender,
      'designation' => $designation,
      'department' => $department,
      'registration_date' => $registration_date
    ];

   
    // Look through entries in the db and check if user already exists
    $userExists = find_user($email);
    if ($userExists) {
      $_SESSION["error"] = "Registration failed.  This user already exists";
      checkReturnLocation($super_admin_check);
      die();
    }
    

    save_user($userObject);

    
    
    
    checkSuccessReturnLocation($super_admin_check);
  }

  
?>