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
  <hr>
  <h4>Add Other Members</h4>
  <p>Please fill this form to add other members</p>
</div>
<div class="patient_body" style="margin-left:50px;">
  <div class="patient_links">
    <p>What do you want to do?</p>
    <p><a class="p-2" href="pay_bills.php">View Medical Staff</a></p>
    <p><a class="p-2" href="book_appointment.php">View Patients</a></p>
    <p><a class="p-2" href="book_appointment.php">Register Someone</a></p>
  </div>
</div>
  <div class="superadmin_form_container">
 
  <form method="POST" action="processregister.php" class="superadmin_form">
        <p>
          <?php  print_alert();?>
        </p>
          <p>
              <input type="hidden" name="super_admin" value = "super_admin">
              <input type="hidden" name="admin_email" value="<?php echo $_SESSION['email'] ?>" >
          </p>
          <div class="superadmin_input_items">
              <p>
                  <label>First Name</label><br />
                  <input  
                  <?php              
                      if(isset($_SESSION['first_name']) && !isset($_SESSION['logInTime'])){
                          echo "value=" . $_SESSION['first_name'];                                                          
                      }                
                  ?>
                  type="text" class="form-control superadmin_input" name="first_name" placeholder="First Name" />
              </p>
              <p>
                  <label>Last Name</label><br />
                  <input
                  <?php              
                      if(isset($_SESSION['last_name']) && !isset($_SESSION['logInTime'])){
                          echo "value=" . $_SESSION['last_name'];                                                             
                      }                
                  ?>
                  type="text" class="form-control superadmin_input" name="last_name" placeholder="Last Name"  />
              </p>
            </div>
            <p>
                <label>Email</label><br />
                <input
                
                <?php              
                    if(isset($_SESSION['email']) && !isset($_SESSION['logInTime'])){
                        echo "value=" . $_SESSION['email'];
                      }                                                                            
                ?>

                type="text" class="form-control" name="email" placeholder="Email"  />
            </p>
            <div class="superadmin_input_items">
              <p>
                  <label>Password</label><br />
                  <input type="password" class="form-control superadmin_input" name="password" placeholder="Password"  />
              </p>
              <p>
                  <label>Gender</label><br />
                  <select class="form-control superadmin_input" name="gender" >
                  <?php              
                      if(isset($_SESSION['department'])){
                          echo "value=" . $_SESSION['department'];                                                             
                      }                
                  ?>
                      <option value="">Select One</option>
                      <option 
                      <?php              
                          if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female' && !isset($_SESSION['logInTime'])){
                              echo "selected";                                                           
                          }                
                      ?>
                      >Female</option>
                      <option 
                      <?php              
                          if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male' && !isset($_SESSION['logInTime'])){
                              echo "selected";                                                           
                          }                
                      ?>
                      >Male</option>
                  </select>
              </p>
            </div>
            <div class="superadmin_input_items">
              <p>
                  <label>Designation</label><br />
                  <select class="form-control superadmin_input" name="designation" >
                  
                      <option value="">Select One</option>
                      <option 
                      <?php              
                          if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Super Admin (SA)' && !isset($_SESSION['logInTime'])){
                              echo "selected";                                                           
                          }                
                      ?>
                      >Super Admin (SA)</option>
                      <option 
                      <?php              
                          if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team (MT)' && !isset($_SESSION['logInTime'])){
                              echo "selected";                                                           
                          }                
                      ?>
                      >Medical Team (MT)</option>
                      <option 
                      <?php              
                          if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient' && !isset($_SESSION['logInTime'])){
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
                      if(isset($_SESSION['department']) && !isset($_SESSION['logInTime'])){
                          echo "value=" . $_SESSION['department']; 
                        }                                                                            
                  ?>
                  type="text" id="department" class="form-control superadmin_input" name="department" placeholder="Department"  />
              
              </p>
            </div>
            <p>
                <button class="btn btn-sm btn-success superadmin_button" type="submit">Register</button>
            </p>
        </form>
        </div>

<?php include_once('lib/footer.php'); ?>
