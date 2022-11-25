<?php include_once "include/session.inc.php"; // checks if they are logged in ?>
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
        <main style="min-height: 85vh; padding-bottom: 7px;">
            <div class="row w-100">
                <div class="text-content">
                    <h1>Profile page</h1>       
                    <h5>
                        To change your profile details, please fill in the respective fields below and click on the "Apply Changes" button for the changes to take into effect.
                    </h5>
                </div>


                <div class="editDetailsForm">
                    <form action="process_account.php" method="post">
                        <div class="form-group" style="padding: 7px 300px;">
                            <label for="fname">First Name:</label>
                            <input type="text" id="fname" maxlength="45" name="fname"
                                placeholder="Enter new first name" class="form-control">
                        </div>
                        <div class="form-group" style="padding: 7px 300px;">
                            <label for="lname">Last Name:</label>
                            <input type="text" id="lname" required maxlength="45" name="lname"
                                placeholder="Enter new last name" class="form-control">
                        </div>
                        <div class="form-group" style="padding: 7px 300px;">
                            <label for="old_email">Current(Old) Email:</label>
                            <input type="email" id="old_email" required name="email"
                                placeholder="Enter old email" class="form-control">
                        </div>
                        <div class="form-group" style="padding: 7px 300px;">
                            <label for="new_email">New Email:</label>
                            <input type="email" id="new_email" required name="new_email"
                                placeholder="Enter new email" class="form-control">
                        </div>
                        <div class="form-group" style="padding: 7px 300px;">
                            <label for="pwd">Password:</label>
                            <input type="password" id="pwd" required name="pwd"
                                placeholder="Enter password" class="form-control">
                        </div>
                        <div class="form-group" style="padding: 7px 300px;">
                            <label for="pwd_confirm">Confirm Password:</label>
                            <input type="password" id="pwd_confirm" required name="pwd_confirm"
                                placeholder="Confirm password" class="form-control">
                        </div>
                        <div class="form-group2" style="padding: 7px 300px;">
                            
                            <input type="checkbox" required name="agree" class="form-check-input" style="scale: 1.5;" id="account_checkbox">
                            <label for="account_checkbox">Agree to terms and conditions.</label>
                            
                        </div>
                        <div class="form-group2" style="padding: 7px 300px;">
                            <button type="submit" class="btn btn-primary" style="color:white; background-color: black;" title="Title">Apply Changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
        <?php include_once "include/footer.inc.php"; ?>
    </body>

</html>
