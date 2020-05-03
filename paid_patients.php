<?php include_once('lib/header.php');  
  require_once('./functions/get_user_transaction.php');
  require_once('./functions/alert.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>


<a href="super_admin.php" class="appointment_back_button">Go back</a>
<p style="text-align: center;">
    <?php  print_alert();?>
  </p>
<div class="medical_main">
  <h3>Ledger Page</h3>
  <p>The following patients have paid their consultation fees</p>
  <?php 
  
   $transaction = get_paid_appointments();
  if(count($transaction) < 1)  { ?>
    <p>Ledger book is currently empty</p>
  <?php }else{ ?>
    <table class="medical_table">
      <thead>
        <tr>
          <th>S/N</th>
          <th>Full Name</th>
          <th>Appointment Date</th>
          <th>Payment Date</th>
          <th>Payment Time</th>
          <th>Department</th>
          <th>Paid For</th>
          <th>Amount Paid</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $transaction = get_paid_appointments();
        for ($i = 0; $i < count($transaction); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $transaction[$i]->full_name ?></td>
            <td><?php echo $transaction[$i]->appointment_date ?></td>
            <td><?php echo $transaction[$i]->payment_date ?></td>
            <td><?php echo $transaction[$i]->payment_time ?></td>
            <td><?php echo $transaction[$i]->appointment_department ?></td>
            <td><?php echo $transaction[$i]->paid_for ?></td>
            <td><?php echo $transaction[$i]->amount ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div>


<?php include_once('lib/footer.php'); ?>