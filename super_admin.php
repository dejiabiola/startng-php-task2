<?php include_once('lib/header.php'); 
require_once('functions/alert.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>

<div style="text-align:center">
<h3>Super Admin Board</h3>
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
<h4>Add Other Members</h4>
<p>Please fill this form to add other members</p>
<div style="display:flex;flex-direction:column;flex-wrap:wrap;justify-content:center;text-align:left;align-items:center">
<p>
        <?php  print_alert(); 'q';?>
        </p>
<form method="POST" action="processregister.php" style="width: 300px;background-color:#0156B3;padding:20px;">
        <p>
            <input type="hidden" name="super_admin" value = "super_admin">
            <input type="hidden" name="admin_email" value="<?php echo $_SESSION['email'] ?>" >
        </p>
            <p>
                <label>First Name</label><br />
                <input  
                <?php              
                    if(isset($_SESSION['first_name'])){
                        echo "value=" . $_SESSION['first_name'];                                                          
                    }                
                ?>
                type="text" class="form-control" name="first_name" placeholder="First Name" />
            </p>
            <p>
                <label>Last Name</label><br />
                <input
                <?php              
                    if(isset($_SESSION['last_name'])){
                        echo "value=" . $_SESSION['last_name'];                                                             
                    }                
                ?>
                type="text" class="form-control" name="last_name" placeholder="Last Name"  />
            </p>
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
                <input type="password" class="form-control" name="password" placeholder="Password"  />
            </p>
            <p>
                <label>Gender</label><br />
                <select class="form-control" name="gender" >
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
        
            <p>
                <label>Designation</label><br />
                <select class="form-control" name="designation" >
                
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
                type="text" id="department" class="form-control" name="department" placeholder="Department"  />
            
            </p>
            <p>
                <button class="btn btn-sm btn-success" type="submit">Register</button>
            </p>
        </form>
        </div>
</div>
<?php include_once('lib/footer.php'); ?>
