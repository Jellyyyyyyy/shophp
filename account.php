<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/account.css">
  <script src="js/admin.js" defer></script>
</head>

<body>
  <?php
        include_once "include/nav.inc.php";
        include_once "include/dbcon.inc.php";
        ?>
  <main style="min-height: 85vh;">
    <div class="row w-100">
      <div class="formTitle">
        <h1>Edit Profile</h1>
        <p>
          To change your profile details, please fill in the respective fields below and click on the "Apply Changes"
          button for the changes to take into effect.
        </p>
      </div>


      <div class="changeDetails">
        <form action="process_account" method="post">
          <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" maxlength="45" name="fname" placeholder="Enter new first name"
              class="form-control">
          </div>
          <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" required maxlength="45" name="lname" placeholder="Enter new last name"
              class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Current(Old) Email:</label>
            <input type="email" id="email" required name="email" placeholder="Enter old email" class="form-control">
          </div>
          <div class="form-group">
            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" required name="new_email" placeholder="Enter new email"
              class="form-control">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" id="pwd" required name="pwd" placeholder="Enter password" class="form-control">
          </div>
          <div class="form-group">
            <label for="pwd_confirm">Confirm Password:</label>
            <input type="password" id="pwd_confirm" required name="pwd_confirm" placeholder="Confirm password"
              class="form-control">
          </div>
          <div class="form-check checkbox-xl">
            <label>
              <input type="checkbox" required name="agree">
              Agree to terms and conditions.
            </label>
          </div>
          <button type="submit" class="btn btn-dark">Apply Changes</button>
        </form>
      </div>

    </div>
  </main>
  <?php include_once "include/footer.inc.php"; ?>
</body>

</html>