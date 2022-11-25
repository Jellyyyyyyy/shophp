<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once "include/head.inc.php" ?>
  <title>Post Payment</title>
  <link rel="stylesheet" href="css/legacy.css">
</head>

<body>
  <?php include_once "include/nav.inc.php" ?>
  <main style="min-height: 80vh;">
    <?php
    if (isset($_COOKIE["postpayment"])) {
      $postPayment = json_decode($_COOKIE["postpayment"], true);
      echo '<p style="color:#000; font-size:50px">Thank you for shopping with shoPHP</p><br>';
    } else {
      echo '<p style="color:#000; font-size:50px;">You shouldn\'t be here</p>';
    }
    ?>
  </main>
  <?php include_once "include/footer.inc.php" ?>
</body>

</html>