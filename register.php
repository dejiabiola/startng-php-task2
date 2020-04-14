<?php include_once('lib/header.php');
 require_once('functions/alert.php');
 require_once('functions/redirect.php');
if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
    // redirect to dashboard
    if ($_SESSION['designation'] == 'Patient') {
      redirect_to("patient.php");
      die();
    } else if ($_SESSION['designation'] == 'Medical Team (MT)') {
      redirect_to("medical_team.php");
      die();
    } else if ($_SESSION['designation'] == 'Super Admin (SA)') {
      redirect_to("super_admin.php");
      die();
    }
}

?>
<div class=" register_container">
    <div class="">
        <h3>Register</h3>
    </div>
    <div class="">
        <p><strong>Welcome, Please Register</strong></p>
    </div>
    <div class="">
        <p>All Fields are required</p>
    </div>
    <div class="">

        <form method="POST" action="processregister.php" class="register_form">
        <p class="register_error">
            <?php  print_alert(); ?>
        </p>

          <div class="register_input_items">
            <p>
                <label>First Name</label><br />
                <input  
                <?php              
                    if(isset($_SESSION['first_name'])){
                        echo "value=" . $_SESSION['first_name'];                                                             
                    }                
                ?>
                type="text" class="form-control register_input" name="first_name" placeholder="First Name" />
            </p>
            <p>
                <label>Last Name</label><br />
                <input
                <?php              
                    if(isset($_SESSION['last_name'])){
                        echo "value=" . $_SESSION['last_name'];                                                             
                    }                
                ?>
                type="text" class="form-control register_input" name="last_name" placeholder="Last Name"  />
            </p>
          </div>
          <div class="register_email">
            <p>
                <label>Email</label><br />
                <input
                
                <?php              
                    if(isset($_SESSION['email'])){
                        echo "value=" . $_SESSION['email'];                                                             
                    }                
                ?>

                type="text" class="form-control register_email_input" name="email" placeholder="Email"  />
            </p>
          </div>
          <div class="register_input_items">
            <p>
                <label>Password</label><br />
                <input type="password" class="form-control register_input" name="password" placeholder="Password"  />
            </p>
            <p>
                <label>Gender</label><br />
                <select class="form-control register_input" name="gender" >
                <?php              
                    if(isset($_SESSION['department'])){
                        echo "value=" . $_SESSION['department'];                                                             
                    }                
                ?>
                    <option value="">Select One</option>
                    <option 
                    <?php              
                        if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female'){
                            echo "selected";                                                           
                        }                
                    ?>
                    >Female</option>
                    <option 
                    <?php              
                        if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male'){
                            echo "selected";                                                           
                        }                
                    ?>
                    >Male</option>
                </select>
            </p>
          </div>
          <div class="register_input_items">
            <p>
                <label>Designation</label><br />
                <select class="form-control register_input" name="designation" >
                
                    <option value="">Select One</option>
                    <option 
                    <?php              
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Super Admin (SA)'){
                            echo "selected";                                                           
                        }                
                    ?>
                    >Super Admin (SA)</option>
                    <option 
                    <?php              
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team (MT)'){
                            echo "selected";                                                           
                        }                
                    ?>
                    >Medical Team (MT)</option>
                    <option 
                    <?php              
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient'){
                            echo "selected";                                                           
                        }                
                    ?>
                    >Patient</option>
                </select>
            </p>
            <p>
                <label class="label" for="department">Department</label><br />
                <input
                <?php              
                    if(isset($_SESSION['department'])){
                        echo "value=" . $_SESSION['department'];                                                             
                    }                
                ?>
                type="text" id="department" class="form-control register_input" name="department" placeholder="Department"  />
            
            </p>
          </div>
            <p>
              <button class="btn btn-sm btn-success register_button" type="submit">Register</button>
            </p>
            <p>
              <a href="forgot.php">Forgot Password</a><br />
              <a href="login.php">Already have an account? Login</a>
            </p>
        </form>

    </div>

</div>
<?php include_once('lib/footer.php'); ?>