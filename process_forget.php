<?php
require_once 'include/functions.inc.php';
turnOnErrorReport();

$email = $errorMsg = $username = $resetToken = "";
$success = "true";

// Check email/username and password
function checkUser() {
  global $email, $errorMsg, $success, $resetToken;
  if (empty($_POST["forget_pwd"])) {
    $errorMsg = "Please enter a valid email";
    $success = "false";
    return;
  } else {
    $email = sanitize_input($_POST["forget_pwd"]);
  }
}

// Check if user in database
function authenticateUser() {
  global $email, $errorMsg, $username, $success, $resetToken;
  // Connect to database
  include_once "include/dbcon.inc.php";

  // Check connection
  if ($conn -> connect_error) {
    $errorMsg = "Connection to server failed. Please try again later.";
    $success = "false";
  } else {
    $resetToken = bin2hex(random_bytes(32)); // Generates token to reset password
    // Prepares and executes query
    $query = $conn -> prepare("SELECT * FROM users WHERE email=?;");
    $query -> bind_param("s", $email);
    if ($query -> execute()){
      $result = $query -> get_result();
      if ($result -> num_rows > 0) {
        $row = $result -> fetch_assoc();
        $username = $row["username"]; // For sending mail
      } else {
        $errorMsg =  "Reset password email has been sent to " . $email . " if that account exists.";
        $success = "false";
      }
    } else {
      $errorMsg = "Execution failed. Please try again later.";
      $success = "false";
    }
    $query -> close();
  }
  $conn -> close();
}

function sendEmail(){
  global $email, $username, $errorMsg, $success, $resetToken;

  $subject = 'shoPHP Reset Password';
  $body = '<h1 style="font-size: 30px;"> Hi ' . $username . ',</h1><p style="font-size: 16px;">To reset your password. Click here to <a href="shophp.shop/reset?email=' . $email . '&resetToken=' . $resetToken . '">Reset Password</a>.</p>';
  if (sendMail('no-reply@shophp.shop', $email, $subject, $body)) {
    $errorMsg =  "Reset password email has been sent to " . $email . " if that account exists.";
    $success = "false"; // To display error message
  } else {
    $errorMsg = "Reset password email could not be sent. Please contact customer support to reset your password or try again later.";
    $success = "false";
  }
}

checkUser();
if ($success == "true") {
  authenticateUser();
  if ($success == "true") {
      sendEmail();
  }
}
header('Location: /forget?forgetsuccess=' . $success . '&errorMsg=' . $errorMsg . '&email=' . $email);