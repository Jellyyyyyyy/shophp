<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/login.css">
  <script src="js/login.js" defer></script>
</head>

<body>
  <?php include_once "include/nav.inc.php";
  // Redirects logged in back to home page
  !empty(isset($_SESSION["user"])) ? header("Location: /home") : "";
  ?>
  <main>
    <section class="login-container vh-100">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 text-black">
            <div
              class="form-container d-flex align-items-center justify-content-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
              <form action="process_login" method="post" target="_self" style="width: 23rem">
                <h3 class="fw-bold mb-2 pb-3" style="letter-spacing: 1px">
                  Log in
                </h3>
                <?php
                if (isset($_GET['loginSuccess'])) {
                  $loginSuccess = $_GET['loginSuccess'];
                  $loginMsg = $_GET['loginMsg'];
                  if ($loginSuccess == 'true') {
                    echo '<p>SUCCESS</p>';
                  } else {
                    echo '<div class="fail-message">';
                    echo '<span class=fail-text>' . $loginMsg . '</span>';
                    echo '<div class="arrow-down"></div>';
                    echo '</div>';
                  }
                }
                ?>
                <div class="form-outline mb-4 login-field">
                  <input type="text" id="login-email-field" class="form-control form-control-lg"
                    name="login-email-field" value="<?php echo $_GET["user"] ?? ''; ?>" required>
                  <label class="form-label login-email-label" for="login-email-field">Email/Username</label>
                </div>

                <div class="form-outline mb-3 login-field">
                  <input type="password" id="login-password-field" class="form-control form-control-lg"
                    name="login-password-field" required>
                  <label class="form-label login-password-label" for="login-password-field">Password</label>
                </div>

                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" value="1" name="rememberme" id="rememberme">
                  <label class="form-check-label" for="rememberme">Remember me</label>
                </div>

                <div class="pt-1 mb-4">
                  <button class="btn btn-dark btn-lg btn-block submit-button" type="submit">
                    Login
                  </button>
                </div>
                <p class="small mb-5 pb-lg-2">
                  <a class="text-muted" href="forget">Forgot password?</a>
                </p>
                <p>
                  Don't have an account?
                  <a class="link-info no-acc-btn" style="cursor: pointer;">Register here</a>
                </p>
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

    <section class="container-fluid register-container <?php echo isset($_GET['registerSuccess']) ? '' : 'hide' ?>">
      <form action="process_register" method="post" target="_self">
        <h3 class="fw-bold mb-3 form-header" style="letter-spacing: 1px">Create an account</h3>
        <?php
        if (isset($_GET['registerSuccess'])) {
          $registerSuccess = $_GET['registerSuccess'];
          $registerMsg = $_GET['registerMsg'];
          if ($registerSuccess == 'true') {
            echo '<div class="error-container mt-0 mb-1">';
            echo '<span class="error-text w-100">' . $registerMsg . "</span>";
            echo '<div class="arrow-down"></div>';
            echo '</div>';
          } else {
            echo '<div class="error-container mt-0 mb-1">';
            echo '<span class="error-text w-100" style="color:red;">' . $registerMsg . "</span>";
            echo '<div class="arrow-down"></div>';
            echo '</div>';
          }
        }
        ?>
        <div class="form-outline mb-4">
          <input type="text" id="username" name="username" class="form-control form-control-lg" autocomplete="off"
            value="<?php echo $_GET["username"] ?? ''; ?>" required>
          <label class="form-label" for="username">Username</label>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3 pb-2">
            <div class="form-outline">
              <input type="text" id="fname" name="fname" class="form-control form-control-lg"
                value="<?php echo $_GET["fname"] ?? ''; ?>" required>
              <label class="form-label" for="fname">First
                name</label>
            </div>
          </div>
          <div class="col-md-6 mb-3 pb-2">
            <div class="form-outline">
              <input type="text" id="lname" name="lname" class="form-control form-control-lg"
                value="<?php echo $_GET["lname"] ?? ''; ?>">
              <label class="form-label" for="lname">Last
                name</label>
            </div>
          </div>
        </div>

        <div class="form-outline mb-4">
          <input type="email" id="email" name="email" class="form-control form-control-lg"
            value="<?php echo $_GET["email"] ?? ''; ?>" required>
          <label class="form-label" for="email">Email</label>
        </div>

        <div class="row">
          <div class="col-md-6 mb-4">
            <h6 class="mb-2 pb-1">Birthday: </h6>
            <div class="dob-select d-flex align-items-center">
              <select class="form-select select-bday" title="Day" name="dob-day" aria-label="Birthday Day">
              </select>

              <select class="form-select select-bday" name="dob-month" aria-label="Birthday Month">
                <option selected value="Month" disabled>Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
              <select class="form-select select-bday" name="dob-year" aria-label="Birthday Year">
              </select>
            </div>
          </div>

          <div class="col-md-6 mb-4 mt-2">
            <h6 class="mb-2 pb-1">Gender: </h6>
            <div class="d-flex justify-content-between">
              <div class="form-check form-check-inline">
                <input class="form-check-input gender" type="radio" name="maleGender" id="maleGender" value="option1"
                  checked>
                <label class="form-check-label" for="maleGender">Male</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input gender" type="radio" name="femaleGender" id="femaleGender"
                  value="option2">
                <label class="form-check-label" for="femaleGender">Female</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input gender" type="radio" name="othersGender" id="othersGender"
                  value="option3">
                <label class="form-check-label" for="othersGender">Others</label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-outline mb-4">
          <input type="password" id="pwd" name="pwd" class="form-control form-control-lg" required>
          <label class="form-label" for="pwd">Password</label>
        </div>

        <div class="form-outline mb-4">
          <input type="password" id="confirm-pwd" name="confirm-pwd" class="form-control form-control-lg" minlength="8"
            required>
          <label class="form-label" for="confirm-pwd">Confirm Password</label>
        </div>

        <div class="form-check d-flex justify-content-center mb-3">
          <input class="form-check-input me-2" type="checkbox" value="" id="terms-of-service" required>
          <label class="form-check-label" for="terms-of-service">
            I agree to the
            <a href="#!" class="text-body"><u>Terms of service</u></a>
          </label>
        </div>

        <div class="pt-1 mb-4">
          <button class="btn btn-dark btn-lg btn-block submit-button" type="submit">
            Register
          </button>
        </div>
        <p class="text-center text-muted mt-2 mb-0">
          Already have an account?
          <a class="link-info have-acc-btn" style="cursor: pointer;">Login here</a>
        </p>
      </form>
    </section>
    <div class="register-overlay <?php echo isset($_GET['registerSuccess']) ? 'active' : '' ?>"></div>
  </main>

</body>

</html>