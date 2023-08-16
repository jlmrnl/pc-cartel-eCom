<?php include 'db_connection.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include 'assets.php'?>
  <?php include 'background.php'?>
  <title>PC Cartel - Confirmed</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<?php include 'navbar.php' ?>
<div class="container-sm mx-auto t-3">
  <center>
  <h1 class="display-1">Thank you!</h1>
  <h3 class="display-7"><Order> order information will be sent to your mobile number</h3>
</center>
</div>
<?php include 'footer.php' ?>
</body>
</html>


<?php
  // Check if the form is submitted
  if(isset($_POST['submit'])) {
    // Retrieve the form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $mobile_number = $_POST['mobile_number'];
    $order_id = $_POST['order_id'];

    // Update the order status in the database
    $stmt = $conn->prepare("UPDATE orders SET status='confirmed' WHERE id=:order_id");
    $stmt->bindParam(":order_id", $order_id);
    $stmt->execute();

    // Display the thank you message
    echo "<h1>Thank You!</h1>";
    echo "<p>Your order has been confirmed.</p>";
  }

