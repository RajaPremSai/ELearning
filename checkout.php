<?php 
include('./dbConnection.php');
session_start();
 if(!isset($_SESSION['stuLogEmail'])) {
  echo "<script> location.href='loginorsignup.php'; </script>";
 } else {
  $stuEmail = $_SESSION['stuLogEmail'];
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
   <meta charset="UTF-8">
   <!-- <meta name="GENERATOR" content="Evrsoft First Page"> -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <link rel="icon" href="./image/point_logo.jpeg" />
    
    <title>Nexus</title>
   <title>Checkout</title>
  </head>
  <body>
  <div class="container mt-5">
    <div class="row">
    <div class="col-sm-6 offset-sm-3 jumbotron">
    <h3 class="mb-5">Welcome to Nexus Payment Page</h3>
     <form method="post" action="./paymentdone.php" id="myform">
      <div class="form-group row">
       <label for="ORDER_ID" class="col-sm-4 col-form-label">Order ID</label>
       <div class="col-sm-8">
         <input id="ORDER_ID" class="form-control" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off"
          value="<?php echo  "ORDS" . rand(10000,99999999)?>" readonly>
       </div>
      </div>
      <div class="form-group row">
       <label for="CUST_ID" class="col-sm-4 col-form-label">Student Email</label>
       <div class="col-sm-8">
         <input id="CUST_ID" class="form-control" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php if(isset($stuEmail)){echo $stuEmail; }?>" readonly>
       </div>
      </div>
      <div class="form-group row">
       <label for="TXN_AMOUNT" class="col-sm-4 col-form-label">Amount</label>
       <div class="col-sm-8">
        <input title="TXN_AMOUNT" class="form-control" tabindex="10"
          type="text" name="TXN_AMOUNT" value="<?php if(isset($_POST['id'])){echo $_POST['id']; }?>" readonly>
       </div>
      </div>

      <div class="text-center">
        <!--Setup a container element for the button-->
        <div id="paypal-button-container"></div>
       <a href="./courses.php" class="btn btn-secondary">Cancel</a>
      </div>
     </form>
     <small class="form-text text-muted">Note: Complete Payment by Clicking Checkout Button</small>
     </div>
    </div>
  </div>

  <!--Include the paypal JavaScript SDK -->
  <script src="https://www.paypal.com/sdk/js?client-id=AXy1VDLfMkt_g4Eh--PL56mUc-KzYMX809-NVJ0dWjWPO_vR6TdLc1Sz_36a37R7_-4xa9gSDCxB_8r-&currency=USD"></script>
  <script>
  paypal.Buttons({
    createOrder: function(data, actions){
      return actions.order.create({
        purchase_units:[{
          amount:{
            value:'<?php if(isset($_POST['id'])){echo $_POST['id'];} ?>'
          }
        }]
      });
    },
    onApprove:function(data,actions) {
      return actions.order.capture().then(function(details){
        alert('Transaction completed by'+details.payer.name.given_name+'!');
        document.getElementById("myform").submit()
      });
    }
    // return actions.order.capture().then(function(details){
    //         // Capture transaction details
    //         var txn_status = details.status;
    //         var resp_msg = ''; // Placeholder for response message, as PayPal SDK doesn't provide a response message in details

    //         // Check if PayPal provides a response message
    //         if (details.purchase_units && details.purchase_units[0] && details.purchase_units[0].payments && details.purchase_units[0].payments.captures && details.purchase_units[0].payments.captures[0].seller_receivable_breakdown && details.purchase_units[0].payments.captures[0].seller_receivable_breakdown.paypal_fee) {
    //             resp_msg = 'Payment successful'; // Placeholder message, you can customize this
    //         }

    //         // Redirect to paymentdone.php with transaction details
    //         window.location.href = './paymentdone.php?status=' + txn_status + '&resp_msg=' + resp_msg;
    //     });
    // }
    }).render('#paypal-button-container'); //PayPal button container
    </script>

    <!-- Jquery and Boostrap JavaScript -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="js/all.min.js"></script>

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="js/custom.js"></script>

  </body>
  </html>
 <?php } ?>

