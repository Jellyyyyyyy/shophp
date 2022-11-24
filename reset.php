<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Verification</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/reset.css">
</head>

<body>
  <main>
    <?php include_once 'include/nav.inc.php' ?>
    <section class="container" id="formBoxes">
      <form action="process_reset" method="post" target="_self">
        <h3 class="mb-3 form-header" style="letter-spacing: 1px">Reset Password</h3>
        <?php
        include_once "include/functions.inc.php";
        if (isset($_GET['resetsuccess'])) {
          $resetSuccess = sanitize_input($_GET['resetsuccess']);
          if ($resetSuccess == 'true') {
            $resetMsg = sanitize_input($_GET['successMsg']);
            echo '<div class="error-container mt-0 mb-1">';
            echo '<span class="error-text w-100">' . $resetMsg . "<a href=login>Login here</a></span>";
            echo '<div class="arrow-down"></div>';
            echo '</div>';
          } else {
            $resetMsg = sanitize_input($_GET['errorMsg']);
            echo '<div class="error-container mt-0 mb-1">';
            echo '<span class="error-text w-100" style="color:red;">' . $resetMsg . "</span>";
            echo '<div class="arrow-down"></div>';
            echo '</div>';
          }
        }
        ?>
        <div class="form-outline mb-4" style="display: none">
          <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?= ($_GET["email"]) ?>">
        </div>
        <div class="form-outline mb-4" style="display: none">
          <input type="text" id="resetToken" name="resetToken" class="form-control form-control-lg" value="<?= ($_GET["resetToken"]) ?>">
        </div>
        <div class="form-outline mb-4">
          <input type="password" id="pwd" name="pwd" class="form-control form-control-lg" required>
          <label class="form-label" for="pwd">Password</label>
        </div>
        <div class="form-outline mb-4">
          <input type="password" id="confirm-pwd" name="confirm-pwd" class="form-control form-control-lg" minlength="8" required>
          <label class="form-label" for="confirm-pwd">Confirm Password</label>
        </div>
        <div class="pt-1 mb-4">
          <button class="btn btn-dark btn-lg btn-block submit-button" type="submit">
            Reset
          </button>
        </div>
      </form>
    </section>
  </main>
</body>

</html>