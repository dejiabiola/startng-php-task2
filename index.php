<?php  include_once('lib/header.php');  require_once('functions/alert.php'); ?>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4"> Welcome to SNG: Hospital for the ignorant</h1>
        <p class="lead">This is a specialist hospital to cure ignorance!</p>
        <p class="lead">Come as you are, it is completely free!</p>
        <p>
            <a class="btn btn-bg btn-outline-secondary" href="login.php">Login</a>
            <a class="btn btn-bg btn-outline-primary" href="register.php">Register</a>            
        </p>
    </div>


<?php include_once('lib/footer.php'); ?>

<form>
    <script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <button type="button" onClick="payWithRave()">Pay Now</button>
</form>

<script>
    const API_publicKey = "FLWPUBK_TEST-220bf416ebaa65762642ad7fe776ad9a-X";

    function payWithRave() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: "user@example.com",
            amount: 2000,
            customer_phone: "234099940409",
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
                    window.location = "http://192.168.64.2/snh-hospital/pay_bills.php";
                } else {
                    // redirect to a failure page.
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>