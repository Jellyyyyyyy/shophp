<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once "include/head.inc.php" ?>
  <title>Admin login</title>
  <link rel="stylesheet" href="css/admin_login.css">
  <script src="js/adminLogin.js" defer></script>
</head>

<body>
  <?php include_once "include/nav.inc.php" ?>
  <main>
    <section class="vh-100" style="background-color: #666;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">

          <div class="card admin-login-card" style="border-radius: 1rem;">
            <div class=" d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form action="process_adminlogin" method="post" target="_self" class="admin-form-container">
                  <div class="d-flex align-items-center mb-3">
                    <span class="h1 fw-bold mb-0">shophp admin</span>
                  </div>

                  <h5
                    class="fw-normal mb-<?php echo isset($_GET["loginMsg"]) || !empty($_GET["loginMsg"]) ? '2' : '4' ?> "
                    style="letter-spacing: 1px;">Sign into your account</h5>

                  <?php 
                    if (isset($_GET["loginSuccess"])){
                      $loginSuccess = $_GET["loginSuccess"];
                      $loginMsg = $_GET["loginMsg"];
                      if ($loginSuccess == "false") {
                        echo '<div class="error-container my-2">';
                        echo '<h6>' . $loginMsg . '</h6>';
                        echo '</div>';
                      }
                    }
                    ?>

                  <div class="form-outline mb-4">
                    <input type="text" id="admin-code" name="admin-code" class="form-control form-control-lg"
                      required />
                    <label class="form-label" for="admin-code">Admin Code</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="admin-password" name="admin-password"
                      class="form-control form-control-lg" required />
                    <label class="form-label" for="admin-password">Admin Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  </div>
                  <a class="register-admin-acc" style="color: #393f81; cursor:pointer;">Register administrator
                    account</a>
                </form>

              </div>
            </div>
          </div>
          <div class="card admin-login-card hide" style="border-radius: 1rem;">
            <div class=" d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form action="process_adminregister" method="post" target="_self" class="admin-form-container">
                  <div class="d-flex align-items-center mb-3">
                    <span class="h1 fw-bold mb-0">shophp admin</span>
                  </div>

                  <h5
                    class="fw-normal mb-<?php echo isset($_GET["registerMsg"]) || !empty($_GET["registerMsg"]) ? '2' : '4' ?> "
                    style="letter-spacing: 1px;">Register an administrator</h5>

                  <?php 
                    if (isset($_GET["registerSuccess"])){
                      $registerSuccess = $_GET["registerSuccess"];
                      $registerMsg = $_GET["registerMsg"];
                      if ($registerSuccess == "false") {
                        echo '<div class="error-container my-2">';
                        echo '<h6>' . $registerMsg . '</h6>';
                        echo '</div>';
                      }
                    }
                    ?>

                  <div class="form-outline mb-4">
                    <input type="text" id="register-code" name="register-code" class="form-control form-control-lg"
                      required />
                    <label class="form-label" for="register-code">Register Code</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control form-control-lg"
                      required />
                    <label class="form-label" for="password">Register Password</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="confirm-password" name="confirm-password"
                      class="form-control form-control-lg" required />
                    <label class="form-label" for="confirm-password">Register confirm Password</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="admin-key" name="admin-key" class="form-control form-control-lg"
                      required />
                    <label class="form-label" for="admin-key">Admin key</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="privilege-key" name="privilege-key" class="form-control form-control-lg"
                      required />
                    <label class="form-label" for="privilege-key">Privilege Key</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Register</button>
                  </div>
                  <a class="login-admin-acc" style="color: #393f81; cursor:pointer;">Login to administrator
                    account</a>
                </form>

              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>
</body>

</html>