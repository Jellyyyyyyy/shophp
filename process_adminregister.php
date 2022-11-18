<?php
if (empty($_POST)) header("Location /login"); // users should not be able to access this file
require_once 'include/functions.inc.php';
turnOnErrorReport();
session_start();

$registerAdminName = $registerCode = $registerPassword = $adminKey = $privilegeKey = $privilegeLevel = "";
$registerMsg = "Registration successful!";
$registerSuccess = "true";

function checkEmpty() {
  global $registerAdminName, $registerCode, $registerPassword, $adminKey, $privilegeKey, $registerMsg, $registerSuccess;

  $registerAdminName = sanitize_input($_POST["admin-name"]);
  $registerCode = sanitize_input($_POST["register-code"]);
  $registerPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $adminKey = sanitize_input($_POST["admin-key"]);
  $privilegeKey = sanitize_input($_POST["privilege-key"]);

  if (empty($_POST["admin-name"])) {
    $registerMsg = "Admin name is required.";
    $registerSuccess = "false";
    return;
  } else if (empty($_POST["register-code"])) {
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
  global $registerAdminName, $registerCode, $registerPassword, $adminKey, $privilegeKey, $registerMsg, $registerSuccess, $privilegeLevel;

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
        $registerSuccess = "false";
        return;
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
    $query = $conn -> prepare("INSERT INTO admins (name, adminCode, password, privilegelevel) VALUES (?, ?, ?, ?);");
    $query -> bind_param("ssss", $registerAdminName, $registerCode, $registerPassword, $privilegeLevel);
    if (!$query -> execute()) {
      if (strpos($query->error, "userscol")) {
        $registerMsg = "That register code is taken. Please use another one";
      } else {
        $registerMsg = "An unexpected error has occured. Please contact server administrator";
        // $registerMsg = $query->error;
      }
      $registerSuccess = "false";
    }
    $query -> close();
  }
  $conn -> close();
}

checkEmpty();
if ($registerSuccess == "true") registerAdmin();

if ($registerSuccess == "false") {
  $_SESSION["registerAdminName"] = $_POST["admin-name"];
  $_SESSION["registerCode"] = $_POST["register-code"];
  $_SESSION["registerPassword"] = $_POST["password"];
  $_SESSION["registerCfmPassword"] = $_POST["confirm-password"];
  $_SESSION["registerAdminkey"] = $_POST["admin-key"];
  $_SESSION["registerPrivilege"] = $_POST["privilege-key"];
} else if ($registerSuccess == "true") {
  if (isset($_SESSION["registerCode"])) {
    unset($_SESSION["registerCode"]);
    unset($_SESSION["registerPassword"]);
    unset($_SESSION["registerCfmPassword"]);
    unset($_SESSION["registerAdminkey"]);
    unset($_SESSION["registerPrivilege"]);
  }
}

header("Location: /adlogin?registerSuccess=" . $registerSuccess . "&registerMsg=" . $registerMsg);