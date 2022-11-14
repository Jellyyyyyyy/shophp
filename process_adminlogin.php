<?php
if (empty($_POST)) header("Location /login"); // users should not be able to access this file
require_once 'include/functions.inc.php';
turnOnErrorReport();

$adminCode = $dbAdminPassword = $loginMsg = "";
$loginSuccess = "true";

// Check email/username and password
function checkUser()
{
  global $adminCode, $loginMsg, $loginSuccess;
  if (empty($_POST["admin-code"])) {
    $loginMsg = "Please enter an admin code";
    $loginSuccess = "false";
    return;
  } else {
    $adminCode = sanitize_input($_POST["admin-code"]);
  }

  if (empty($_POST["admin-password"])) {
    $loginMsg = "Please enter your password";
    $loginSuccess = "false";
    return;
  }
}

// Check if user in database
function authenticateAdmin()
{
  global $adminCode, $dbAdminPassword, $loginMsg, $loginSuccess;
  // Connect to database
  include_once "include/dbcon.inc.php";

  // Check connection
  if ($conn->connect_error) {
    $loginMsg = "Connection to server failed. Please try again later.";
    $loginSuccess = "false";
  } else {
    // Prepares and executes query
    $query = $conn->prepare("SELECT * FROM admins WHERE adminCode=?;");
    $query->bind_param("s", $adminCode);
    $query->execute();
    $result = $query -> get_result();

    if ($result->num_rows > 0) {
      $row = $result -> fetch_assoc(); // Get row
      $dbAdminPassword = $row["password"]; // Get password from row
      $token = bin2hex(random_bytes(32));

      // Check if user password matches
      if (!password_verify($_POST["admin-password"], $dbAdminPassword)) {
        $loginMsg = "Invalid Credentials";
        $loginSuccess = "false";
      } else {
        $query -> close();
        $updateTokenQuery = $conn -> prepare("UPDATE admins SET token=? WHERE adminCode=?;");
        $updateTokenQuery -> bind_param("ss", $token, $adminCode);
        $updateTokenQuery -> execute();
        $updateTokenQuery -> close();
      }
    } else {
      $loginMsg = "Invalid Credentials";
      $loginSuccess = "false";
    }
    if ($loginSuccess == "true") {
      $currentTime = time();
      session_set_cookie_params(0);
      session_id(md5($adminCode . $currentTime));
      session_start();
      $_SESSION["admin_token"] = $token;
      session_write_close();
      }
  }
  $conn->close();
}

checkUser();
if ($loginSuccess == "true") {
  authenticateAdmin();
}

header('Location: /adlogin?loginSuccess=' . $loginSuccess . '&loginMsg=' . $loginMsg);
exit();