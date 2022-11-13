<?php
if (empty($_POST)) header("Location /login"); // users should not be able to access this file
require_once 'include/functions.inc.php';
turnOnErrorReport();

$registerCode = $registerPassword = $registerCfmPassword = $adminKey = $privilegeKey = $privilegeLevel = $registerMsg = "";
$registerSuccess = "true";

function checkEmpty() {
  global $registerCode, $registerPassword, $registerCfmPassword, $adminKey, $privilegeKey, $registerMsg, $registerSuccess;

  $registerCode = sanitize_input($_POST["register-code"]);
  $registerPassword = password_hash(sanitize_input($_POST["password"]), PASSWORD_DEFAULT);
  $adminKey = sanitize_input($_POST["admin-key"]);
  $privilegeKey = sanitize_input($_POST["privilege-key"]);

  if (empty($_POST["register-code"])) {
    $registerMsg = "Register code is required.";
    $registerSuccess = "false";
    return;
  } else if (empty($_POST["password"])) {
    $registerMsg = "Password is required.";
    $registerSuccess = "false";
    return;
  } else if (empty($_POST["confirm-password"])) {
    $registerMsg = "Confirm password is required.";
    $registerSuccess = "false";
    return;
  } else if (empty($_POST["admin-key"])) {
    $registerMsg = "Admin key is required.";
    $registerSuccess = "false";
    return;
  } else if (empty($_POST["privilege-key"])) {
    $registerMsg = "Privilege key is required.";
    $registerSuccess = "false";
    return;
  } else if ($_POST["password"] != $_POST["confirm-password"]) {
    $registerMsg = "Passwords do not match";
    $registerSuccess = "false";
    return;
  } 
}

function registerAdmin() {
  global $registerCode, $registerPassword, $registerCfmPassword, $adminKey, $privilegeKey, $registerMsg, $registerSuccess, $privilegeLevel;

  // Create DB connection and get admin keys details
  include_once "include/dbcon.inc.php";
  include_once "include/admin.inc.php";

  // Check if admin and privilege keys are valid
  if ($adminKey !== $configAdminKey) {
    $registerMsg = "Invalid keys";
    $registerSuccess = "false";
    return;
  } else if ($privilegeKey !== $level1key) {
    if ($privilegeKey !== $level2key) {
      if ($privilegeKey !== $level3key) {
        $registerMsg = "Invalid Keys";
        $registerSuccess = "false;";
      } else {
        $privilegeLevel = 3;
      }
    } else {
      $privilegeLevel = 2;
    }
  } else {
    $privilegeLevel = 1;
  }

  if ($conn -> connect_error) {
    $registerMsg = "Connection Failed. Please try again later";
    $registerSuccess = "false";
  } else {
    $query = $conn -> prepare("INSERT INTO admins (adminCode, password, privilegelevel) VALUES (?, ?, ?);");
    $query -> bind_param("sss", $registerCode, $registerPassword, $privilegeLevel);
    if (!$query -> execute()) {
      $registerMsg = "An unexpected error has occured. Please contact server administrator";
      $registerSuccess = "false";
    }
    $query -> close();
  }
  $conn -> close();
}

checkEmpty();
if ($registerSuccess == "true") registerAdmin();

header("Location: /adlogin?registerSuccess=" . $registerSuccess . "&registerMsg=" . $registerMsg);