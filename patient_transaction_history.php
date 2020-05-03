<?php include_once('lib/header.php');
 require_once('functions/alert.php');
 require_once('functions/redirect.php');
 require_once('./functions/get_user_transaction.php')
?>

<a href="patient.php" class="appointment_back_button">Go back</a>
<p style="text-align: center;">
    <?php  print_alert();?>
  </p>
<div class="medical_main">
  <h3>Transaction List</h3>
  <?php 
  
   $transaction = get_patient_transaction($_SESSION['email']);
  if(count($transaction) < 1)  { ?>
    <p>Your transaction history is currently empty</p>
  <?php }else{ ?>
    <table class="medical_table">
      <thead>
        <tr>
          <th>S/N</th>
          <th>Appointment Date</th>
          <th>Appointment Time</th>
          <th>Appointment Nature</th>
          <th>Department</th>
          <th>Initial Complaint</th>
          <th>Payment Status</th>
          <th>Amount Paid</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $transaction = get_patient_transaction($_SESSION['email']);
        for ($i = 0; $i < count($transaction); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $transaction[$i]->appointment_date ?></td>
            <td><?php echo $transaction[$i]->appointment_time ?></td>
            <td><?php echo $transaction[$i]->appointment_nature ?></td>
            <td><?php echo $transaction[$i]->appointment_department ?></td>
            <td><?php echo $transaction[$i]->initial_complaint ?></td>
            <td><?php echo $transaction[$i]->payment_status ?></td>
            <td>2000 Naira</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div>

<?php include_once('lib/footer.php'); ?>
