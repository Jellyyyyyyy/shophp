<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Verification</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/verify.css">
</head>

<body>
  <?php include_once 'include/nav.inc.php' ?>
  <section class="container">
      <form action="process_reset" method="post" target="_self">
        <h3 class="fw-bold mb-3 form-header" style="letter-spacing: 1px">Reset Password</h3>
        <?php
        if (isset($_GET['resetsuccess'])) {
          $resetSuccess = $_GET['resetsuccess'];
          if ($resetSuccess == 'true') {
            $resetMsg = $_GET['successMsg'];
            echo '<div class="error-container mt-0 mb-1">';
            echo '<span class="error-text w-100">' . $resetMsg . "<a href=login>Login here</a></span>";
            echo '<div class="arrow-down"></div>';
            echo '</div>';
          } else {
            $resetMsg = $_GET['errorMsg'];
            echo '<div class="error-container mt-0 mb-1">';
            echo '<span class="error-text w-100" style="color:red;">' . $resetMsg . "</span>";
            echo '<div class="arrow-down"></div>';
            echo '</div>';
          }
        }
        ?>
        <div class="form-outline mb-4" style="display: none">
          <input type="email" id="email" name="email" class="form-control form-control-lg" value = "<?php echo($_GET["email"]) ?>"/>
        </div>
        <div class="form-outline mb-4" style="display: none">
          <input type="name" id="resetToken" name="resetToken" class="form-control form-control-lg" value = "<?php echo($_GET["resetToken"]) ?>"/>
        </div>
        <div class="form-outline mb-4">
          <input type="password" id="pwd" name="pwd" class="form-control form-control-lg" required />
          <label class="form-label" for="pwd">Password</label>
        </div>
        <div class="form-outline mb-4">
          <input type="password" id="confirm-pwd" name="confirm-pwd" class="form-control form-control-lg" minlength="8" required />
          <label class="form-label" for="confirm-pwd">Confirm Password</label>
        </div>
        <div class="pt-1 mb-4">
          <button class="btn btn-dark btn-lg btn-block submit-button" type="submit">
            Reset
          </button>
        </div>
      </form>
    </section>
</body>

</html>