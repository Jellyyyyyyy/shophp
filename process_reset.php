<?php

$email = $pwd = $errorMsg = $successMsg = $resetToken = "";
$success = "true";

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function checkEmpty()
{
  global $email, $pwd, $errorMsg, $success, $resetToken;
  $resetToken = sanitize_input($_POST["resetToken"]);
  $email = sanitize_input($_POST["email"]);
  $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

  if (empty($_POST["email"])) {
    $errorMsg = "Email not found.";
    $success = "false";
    return;
  }
  if (empty($_POST["resetToken"])) {
    $errorMsg = "Send Reset password email again.";
    $success = "false";
    return;
  }
  if (empty($_POST["pwd"])) {
    $errorMsg = "Password is required.";
    $success = "false";
    return;
  } else if ($_POST["pwd"] != $_POST["confirm-pwd"]) {
    $errorMsg = "Passwords do not match.";
    $success = "false";
    return;
  }
}

function resetPass()
{
  global $email, $pwd, $errorMsg, $success, $resetToken, $verify;

  // Create DB connection
  $verify = 1;
  $config = parse_ini_file('../private/db-config.ini');
  $conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']);

  // Check connection
  if ($conn->connect_error) {
    $errorMsg = "Connection Failed. Please try again later";
    $success = "false";
  } else {
    // Prepare query and execute query
    $query = $conn->prepare("SELECT * FROM users WHERE email=?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    // Prepare query to update password
    if ($result->num_rows > 0) {
      $query->close();
      $resetQuery = $conn->prepare("UPDATE users SET password=? WHERE email=?");
      $resetQuery->bind_param("ss", $pwd, $email);
      $resetQuery->execute();
      $tokenQuery = $conn->prepare("UPDATE users SET token=? WHERE email=?");
      $tokenQuery->bind_param("ss", $resetToken, $email);
      $tokenQuery->execute();
      $verifyQuery = $conn->prepare("UPDATE users SET verified='1' WHERE email=?");
      $verifyQuery->bind_param("s", $email);
      $verifyQuery->execute();
    } else {
      $errorMsg = "Failed to reset";
      $success = "false";
    }
  }
  $conn->close();
}
checkEmpty();
if ($success == "true") {
  resetPass();
  $successMsg = "Your password has been successfully reset. Please click to login.";
}

header('Location: /reset?resetsuccess=' . $success . '&errorMsg=' . $errorMsg . '&successMsg=' . $successMsg . '&email=' . $email . '&resetToken' . $resetToken);
