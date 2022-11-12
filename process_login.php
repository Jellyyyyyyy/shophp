<?php
require_once 'include/functions.inc.php';
turnOnErrorReport();

$emailOrUser = $pwd = $loginMsg = "";
$loginSuccess = "true";

// Check email/username and password
function checkUser()
{
  global $emailOrUser, $loginMsg, $loginSuccess;
  if (empty($_POST["login-email-field"])) {
    $loginMsg = "Please enter a valid email/username";
    $loginSuccess = "false";
    return;
  } else {
    $emailOrUser = sanitize_input($_POST["login-email-field"]);
  }

  if (empty($_POST["login-password-field"])) {
    $loginMsg = "Please enter your password";
    $loginSuccess = "false";
    return;
  }
}

// Check if user in database
function authenticateUser()
{
  global $emailOrUser, $pwd, $loginMsg, $loginSuccess;
  // Connect to database
  include_once "include/dbcon.inc.php";

  // Check connection
  if ($conn->connect_error) {
    $loginMsg = "Connection to server failed. Please try again later.";
    $loginSuccess = "false";
  } else {
    // Prepares and executes query
    $query = $conn->prepare("SELECT * FROM users WHERE email=? OR username=?;");
    $query->bind_param("ss", $emailOrUser, $emailOrUser);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc(); // Get row
      $verified = $row["verified"]; // Get verified bool from row
      $pwd = $row["password"]; // Get password from row

      // Check if user password matches
      if (!password_verify($_POST["login-password-field"], $pwd)) {
        $loginMsg = "Your login credentials don't match an account in our system.";
        $loginSuccess = "false";
      }

      // Check if user acount is verified
      if ($verified != '1') {
        $loginMsg = "Please verify your account before logging in";
        $loginSuccess = "false";
      }
    } else {
      $loginMsg = "Your login credentials don't match an account in our system.";
      $loginSuccess = "false";
    }
    if ($loginSuccess == "true") {
      $currentTime = time();
      if (isset($_POST['rememberme']) && $_POST['rememberme'] == '1') {
        session_set_cookie_params(2592000, "/");
        ini_set('session.gc_maxlifetime', 2592000);
        ini_set('session.cookie_lifetime', 2592000);
        session_id(md5($emailOrUser . $currentTime));
        session_start();
        $_SESSION["user"] = $emailOrUser;
        session_write_close();
      } else {
        session_set_cookie_params(0);
        session_id(md5($emailOrUser . $currentTime));
        session_start();
        $_SESSION["user"] = $emailOrUser;
        session_write_close();
      }
    }

    $query->close();
  }
  $conn->close();
}

checkUser();
if ($loginSuccess == "true") {
  authenticateUser();
}

header('Location: /login?loginSuccess=' . $loginSuccess . '&loginMsg=' . $loginMsg . '&user=' . $emailOrUser);