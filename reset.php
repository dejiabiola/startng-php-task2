<?php 
    include_once('lib/header.php'); 
    require_once('functions/alert.php');
    require_once('functions/user.php');
    require_once('functions/redirect.php');



if(!is_user_loggedIn() && !is_token_set()){

    $_SESSION["error"] = "You are not authorized to view that page";
    redirect_to("login.php");
}

?>
 <div style="text-align:center;">  
   <h3>Reset Password</h3>
   <p>Reset Password associated with your account : <?php echo $_SESSION['email'] ?></p> 
  </div>
  <div class="login_container">
    <form action="processreset.php" method="POST" class="reset_form">
    <p>
          <?php  print_alert(); ?>
      </p>
      <?php if(!is_user_loggedIn()) { ?>
      <input
              
              <?php              
                  if(is_token_set_in_session()){
                      echo "value='" . $_SESSION['token'] . "'";                                                             
                  }else{
                      echo "value='" . $_GET['token'] . "'";
                  }             
              ?>

            type="hidden" name="token"  />
      <?php } ?>

      <p>
          <label>Email</label><br />
          <input
              
              <?php              
                  if(isset($_SESSION['email'])){
                      echo "value=" . $_SESSION['email'];                                                             
                  }                
              ?>

              type="text" name="email" placeholder="Email" class="reset_input" />
      </p>
      <p>
          <label>Enter New Password</label><br />
          <input type="password" name="password" placeholder="Password" class="reset_input" />
      </p>
      <p>
          <button type="submit" class="btn btn-sm btn-primary reset_button">Reset Password</button>
      </p>
    </form>
   </div>
    
<?php include_once('lib/footer.php'); ?>