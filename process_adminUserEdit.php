<?php
session_start();
if (empty($_POST)) header("Location /adlogin"); // users should not be able to access this file
require_once 'include/functions.inc.php';
include_once 'include/dbcon.inc.php';
turnOnErrorReport();

$username = $userAction = $suspendDuration = "";
$userMsg = " has been ";
$userUpdateSuccess = "true";

function getAndValidateInputs() {
  global $username, $userAction, $suspendDuration, $userMsg, $userUpdateSuccess;

  if (empty($_POST["mng-username"])) {
    $userMsg = "Please enter a username or userID";
    $userUpdateSuccess = "false";
  } else if ($_POST["mng-user-action"] !== "suspend" && $_POST["mng-user-action"] !== "unsuspend" && $_POST["mng-user-action"] !== "delete") {
    $userMsg = "1Command not found";
    $userUpdateSuccess = "false";
  } else if ($_POST["mng-user-action"] == "suspend" && empty($_POST["mng-suspend-duration"])) {
    $userMsg = "Please enter the number of days to suspend the user";
    $userUpdateSuccess = "false";
  }

  $username = sanitize_input($_POST["mng-username"]);
  $userAction = sanitize_input($_POST["mng-user-action"]);
  $suspendDays = sanitize_input($_POST["mng-suspend-duration"]);

  // Changing days to date format
  $currentDate = date('Y-m-d H:i:s');
  $suspendDuration = date('Y-m-d H:i:s', strtotime($currentDate . " + {$suspendDays} days"));
}

function updateUser() {
  global $conn, $username, $userAction, $suspendDuration, $userMsg, $userUpdateSuccess;

  if ($conn->connect_error) {
    $userMsg = "Connection error. Please try again later";
    $userUpdateSuccess = "false";
  } else {
    if (ctype_digit($username)) {
      $query = $conn->prepare("SELECT * FROM users WHERE userID=?");
      $query->bind_param("i", $username);
    } else {
      $query = $conn->prepare("SELECT * FROM users WHERE username=?");
      $query->bind_param("s", $username);
    }

    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows > 0) {
      $userID = $result->fetch_assoc()["userID"];
      if ($userAction === "suspend") {
        $suspendQuery = $conn->prepare("UPDATE users SET banned=1,banExpiry=? WHERE userID=?");
        $suspendQuery->bind_param("si", $suspendDuration, $userID);
        $suspendQuery->execute();
        $suspendQuery->close();
      } else if ($userAction === "unsuspend") {
        $unsuspendQuery = $conn->prepare("UPDATE users SET banned=0,banExpiry=NULL WHERE userID=?");
        $unsuspendQuery->bind_param("i", $userID);
        $unsuspendQuery->execute();
        $unsuspendQuery->close();
      } else if ($userAction === "delete") {
        $deleteQuery = $conn->prepare("DELETE FROM users WHERE userID=?");
        $deleteQuery->bind_param("i", $userID);
        $deleteQuery->execute();
        $deleteQuery->close();
      } else {
        $userMsg = "Command not found";
        $userUpdateSuccess = "false";
      }
    } else {
      $userMsg = "User not found";
      $userUpdateSuccess = "false";
    }
  }
}

getAndValidateInputs();
if ($userUpdateSuccess === "true") {
  updateUser();
  $userMsg = $username . $userMsg . $userAction . "ed";
}

header("Location: /admin?mngUserSuccess={$userUpdateSuccess}&mngUserMsg={$userMsg}");