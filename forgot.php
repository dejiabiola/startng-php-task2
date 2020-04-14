<?php include_once('lib/header.php');  require_once('functions/alert.php'); ?>
   <div style="text-align: center;">
    <h3>Forgot Password</h3>
    <p>Provide the email address associated with your account</p>
   </div>
   <div class="reset_container">
    <form action="processforgot.php" method="POST" class="reset_form">
    <p>
          <?php print_alert() ; ?>
      </p>
    <p>
          <label>Email</label><br />
          <input
          
          <?php              
              if(isset($_SESSION['email'])){
                  echo "value=" . $_SESSION['email'];                                                             
              }                
          ?>

              type="text" name="email" placeholder="Email" class="forgot_input" />
      </p>
      <p>
          <button type="submit" class="btn btn-sm btn-primary forgot_button">Send Reset Code</button>
      </p>
    </form>
   </div>
    
<?php include_once('lib/footer.php'); ?>