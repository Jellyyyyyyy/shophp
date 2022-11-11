<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Verification</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/nav.css" />
  <link rel="stylesheet" href="css/verify.css">
  <script src="js/nav.js" defer></script>
</head>

<body>
  <?php 
    include_once 'include/nav.inc.php'
  ?>
  <section class="container-fluid register-container">
      <form action="process_reset" method="post" target="_self">
        <h3 class="fw-bold mb-3 form-header" style="letter-spacing: 1px">Reset Password</h3>
        <?php
        if (isset($_GET['resetsuccess'])) {
          $resetSuccess = $_GET['resetsuccess'];
          if ($registerSuccess == 'true') {
            $resetMsg = $_GET['successMsg'];
            echo '<div class="error-container mt-0 mb-1">';
            echo '<span class="error-text w-100">' . $registerMsg . "</span>";
            echo '<div class="arrow-down"></div>';
            echo '</div>';
          } else {
            $resetMsg = $_GET['errorMsg'];
            echo '<div class="error-container mt-0 mb-1">';
            echo '<span class="error-text w-100" style="color:red;">' . $registerMsg . "</span>";
            echo '<div class="arrow-down"></div>';
            echo '</div>';
          }
        }
        ?>
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