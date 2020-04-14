<?php include_once('lib/header.php');
      require_once('functions/alert.php');

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
    // redirect to dashboard
    ;
    if ($_SESSION['designation'] == 'Super Admin (SA)') {
      header("Location: super_admin.php");
    } else if ($_SESSION['designation'] == 'Medical Team (MT)') {
      header("Location: medical_team.php");
    } else if ($_SESSION['designation'] == 'Patient') {
      header("Location: patient.php");
    }
}

?>
<div class="login_container">
    <div class="">
        <h3>Login</h3>
    </div>
    <div class="">
        <p>
        <?php  print_alert();?>
        </p>
        <form method="POST" action="processlogin.php" class="login_form">
    
                
            <p>
                <label>Email</label><br />
                <input
                
                <?php              
                    if(isset($_SESSION['email'])){
                        echo "value=" . $_SESSION['email'];                                                             
                    }                
                ?>

                type="text" class="form-control" name="email" placeholder="Email"  />
            </p>

            <p>
                <label>Password</label><br />
                <input class="form-control" type="password" name="password" placeholder="Password"  />
            </p>       
        
        
            <p>
                <button class="btn btn-sm btn-primary login_button" type="submit">Login</button>
            </p>
            <p>
                <a href="forgot.php">Forgot Password</a><br />
                <a href="register.php">Don't have an account? Register</a>
            </p>
        </form>
    </div>
</div>
<?php include_once('lib/footer.php'); ?>