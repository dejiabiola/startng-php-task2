<?php include_once('lib/header.php');  
  require_once('./functions/get_patient_appointment.php');
  require_once('./functions/alert.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>

<a href="patient.php" class="appointment_back_button">Go back</a>
<p style="text-align: center;">
    <?php  print_alert();?>
  </p>
<div class="medical_main">
  <h3>Appointment List</h3>
  <?php 
  
   $appointments = get_patient_appointment($_SESSION['email']);
  if(count($appointments) < 1)  { ?>
    <p>You currently have not booked any appointment</p>
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
          <th>Payment Button</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $appointments = get_patient_appointment($_SESSION['email']);
        for ($i = 0; $i < count($appointments); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $appointments[$i]->appointment_date ?></td>
            <td><?php echo $appointments[$i]->appointment_time ?></td>
            <td><?php echo $appointments[$i]->appointment_nature ?></td>
            <td><?php echo $appointments[$i]->appointment_department ?></td>
            <td><?php echo $appointments[$i]->initial_complaint ?></td>
            <td><?php echo $appointments[$i]->payment_status ?></td>
            <?php if ($appointments[$i]->payment_status != 'Paid') { ?>
                <td>
                <form style="display:flex;justify-content:center;align-items:center;">
                  <input type="hidden" id="patient_email"
                  <?php              
                      echo "value=" . $_SESSION['email'];                                                                         
                  ?>
                  >
                  <script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                  <button type="button" class="pay_button"  
                  <?php              
                      echo "name=" . $appointments[$i]->id;                                                                         
                  ?>
                    style="padding:10px;color:white;">
                    Pay Now
                  </button>
                </form>
              </td>
              <?php } ?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <p style="width: 100%; text-align: left; margin-top: 30px;">*** Consultation fee is #2000 only</p>
  <?php } ?>
</div>
<?php include_once('lib/footer.php'); ?>





<script>
  
              
    const API_publicKey = "FLWPUBK_TEST-220bf416ebaa65762642ad7fe776ad9a-X";
    const email = document.getElementById('patient_email').value;

    const buttons = document.getElementsByClassName('pay_button')
    for (let button of buttons) {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const appointmentId = e.target.name;
        payWithRave(appointmentId);
      })
    }

    function payWithRave(appointmentId) {

        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: email,
            amount: 2000,
            currency: "NGN",
            txref: "rave-123456",
            meta: [{
                metaname: "flightID",
                metavalue: "AP1234"
            }],
            onclose: function() {},
            callback: function(response) {
                var txref = response.data.txRef; // collect txRef returned and pass to a                    server page to complete status check.
                console.log("This is the response returned after a charge", response);
                if (
                    response.respcode == "00" ||
                    response.data.data.status == "successful"
                ) {
                    // redirect to a success page
                    window.location = "http://192.168.64.2/snh-hospital/processPayment.php?id=" + appointmentId + "&email=" + email;
                } else {
                    // redirect to a failure page.
                    window.location = "http://192.168.64.2/snh-hospital/processPaymentFailure.php"
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>