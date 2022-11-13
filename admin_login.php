<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once "include/head.inc.php" ?>
  <title>Admin login</title>
  <link rel="stylesheet" href="css/admin_login.css">
</head>

<body>
  <?php include_once "include/nav.inc.php" ?>
  <main>
    <section class="vh-100" style="background-color: #666;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-5">
            <div class="card" style="border-radius: 1rem;">
              <div class=" d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form action="process_adminlogin" method="post" target="_self" class="admin-form-container">

                    <div class="d-flex align-items-center mb-3">
                      <span class="h1 fw-bold mb-0">shophp admin</span>
                    </div>

                    <h5 class="fw-normal mb-<?php echo isset($_GET["loginSuccess"]) ? '2' : '4' ?> "
                      style="letter-spacing: 1px;">Sign into your account</h5>

                    <?php 
                    if (isset($_GET["loginSuccess"])){
                      $_loginSuccess = $_GET["loginSuccess"];
                      $loginMsg = $_GET["loginMsg"];
                      if ($_loginSuccess == "false") {
                        echo '<div class="error-container my-2">';
                        echo '<h6>' . $loginMsg . '</h6>';
                        echo '</div>';
                      }
                    }
                    ?>

                    <div class="form-outline mb-4">
                      <input type="text" id="admin-code" name="admin-code" class="form-control form-control-lg" />
                      <label class="form-label" for="admin-code">Admin Code</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="admin-password" name="admin-password"
                        class="form-control form-control-lg" />
                      <label class="form-label" for="admin-password">Admin Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                    </div>
                    <a href="#!" style="color: #393f81;">Register administrator account</a>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>

</html>