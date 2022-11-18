<?php
include_once "dbcon.inc.php";
session_start();
$loginSuccess = "true";
if (empty(isset($_SESSION["admin-token"]))) {
  $loginMsg = "Please login first.";
  $loginSuccess = "false";
} else {
  if ($conn->connect_error) {
      $loginMsg = "Connection to server failed. Please try again later.";
      $loginSuccess = "false";
    } else {
      $query = $conn -> prepare("SELECT * FROM admins WHERE token=?");
      $query -> bind_param("s", $_SESSION["admin-token"]);
      $query -> execute();
      $result = $query -> get_result();
      if ($result->num_rows > 0) {
        $row = $result -> fetch_assoc();
        $dbToken = $row["token"];
        if (!$_SESSION["admin-token"] == $dbToken) {
          $loginMsg = "Invalid token, please login.";
          $loginSuccess = "false";
        }
      } else {
          $loginMsg = "Invalid token, please login.";
          $loginSuccess = "false";
      }
    }
}

if ($loginSuccess !== "true") {
  header("Location: /adlogin?loginSuccess={$loginSuccess}&loginMsg={$loginMsg}");
}