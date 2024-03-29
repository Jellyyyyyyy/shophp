<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forget Password</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/forgot.css">
</head>

<body>
  <?php 
  include_once "include/nav.inc.php";
  include_once "include/functions.inc.php";
  ?>
  <main>
    <section class="vh-100">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 text-black">
            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5 forgotForm">
              <form action="process_forget" method="post" target="_self" style="width: 23rem">
                <h3 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px">
                  Forgot Password
                </h3>
                
                <div class="form-outline mb-4 login-field">
                  <input type="text" id="forget_pwd" class="form-control form-control-lg" aria-label="send email"
                    name="forget_pwd" value="<?= $_GET["email"] ?? ''; ?>" required>
                  <label class="form-label login-email-label" for="forget_pwd">Email</label>
                </div>
                <div class="pt-1 mb-4">
                  <button class="btn btn-dark btn-lg btn-block submit-button" type="submit">
                    Send Email
                  </button>
                </div>
                <?php
                if (isset($_GET['forgetsuccess'])) {
                  $success = sanitize_input($_GET['success']);
                  $errorMsg = sanitize_input($_GET['errorMsg']);
                  if ($success == 'true') {
                    echo "<div class='reset-pw-mail'>". $errorMsg ."</div>";
                  } else {
                    echo "<div class='reset-pw-mail'>". $errorMsg ."</div>";
                  }
                }
                ?>
              </form>
            </div>
          </div>
          <div class="col-sm-6 px-0 d-none d-sm-block">
            <div class="login-img-overlay"></div>
            <img src="images/login_page_photo.jpeg" alt="Login image" class="w-100 vh-100"
              style="object-fit: cover; object-position: left">
          </div>
        </div>
      </div>
    </section>
  </main>
</body>

</html>