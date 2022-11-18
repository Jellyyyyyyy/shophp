<?php
require_once 'include/functions.inc.php';
turnOnErrorReport();

$username = $fname = $lname = $email = $dob = $gender = $pwd = $confirmPwd = $registerMsg = $token = "";
$registerSuccess = "true";

function checkEmpty() {
  global $username, $fname, $lname, $email, $dob, $gender, $pwd, $registerMsg, $registerSuccess;

  $username = sanitize_input($_POST["username"]);
  $fname = sanitize_input($_POST["fname"]);
  $lname = sanitize_input($_POST["lname"]);
  $email = sanitize_input($_POST["email"]);
  $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
  
  if (empty($_POST["username"])) {
    $registerMsg = "Username is required.";
    $registerSuccess = "false";
    return;
  } else if (empty($_POST["fname"])) {
    $registerMsg = "First Name is required.";
    $registerSuccess = "false";
    return;
  } else if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $registerMsg = "Please enter a valid email address.";
    $registerSuccess = "false";
    return;
  } else if (empty($_POST["pwd"])) {
    $registerMsg = "Password is required.";
    $registerSuccess = "false";
    return;
  } else if ($_POST["pwd"] != $_POST["confirm-pwd"]) {
    $registerMsg = "Passwords do not match.";
    $registerSuccess = "false";
    return;
  } else if (isset($_POST["terms-of-service"])) {
    $registerMsg = "Please agree to the terms of service.";
    $registerSuccess = "false";
    return;
  }

  // Setting date of birth 
  if ($_POST["dob-day"] == "Day" || $_POST["dob-month"] == "Month" || $_POST["dob-month"] == "Year") {
    $dob = NULL;
  } else {
    $dob = $_POST["dob-day"] . '/' . $_POST["dob-month"] . '/' . $_POST["dob-year"];
    $dob = sanitize_input($dob);
  }

  // Setting gender
  if (isset($_POST["maleGender"])) $gender = "male";
  else if (isset($_POST["femaleGender"])) $gender = "female";
  else if (isset($_POST["othersGender"])) $gender = "others";
  else $gender = NULL;
}

function registerMember() {
  global $username, $fname, $lname, $email, $dob, $gender, $pwd, $registerMsg, $registerSuccess, $token;

  // Create DB connection
  include_once "include/dbcon.inc.php";
  
  // Check connection
  if ($conn -> connect_error) {
    $registerMsg = "Connection Failed. Please try again later";
    $registerSuccess = "false";
  } else {
    $token = bin2hex(random_bytes(32)); // Generates token to verify email
    // Prepare query
    $query = $conn -> prepare("INSERT INTO users (username, fname, lname, email, DOB, gender, password, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
    
    // Bind and execute query
    $query -> bind_param("ssssssss", $username, $fname, $lname, $email, $dob, $gender, $pwd, $token);
    if (!$query -> execute()) {
      if (strpos($query->error, "email")) {
        $registerMsg = "Email is already in use.";
      } else if (strpos($query->error, "userscol")) {
        $registerMsg = "Username is taken.";
      } else {
        $registerMsg = "An unexpected error has occurred. Please contact support or try again later";
      }
      $registerSuccess = "false";
    }
    
  }
  $conn -> close();
}

function sendEmail(){
  global $username, $email, $registerMsg, $registerSuccess, $token;

  $subject = 'shoPHP Account Verification';
  $body = '<h1 style="font-size: 30px;"> Hi ' . $username . ',</h1> <p style="font-size: 16px;">Thank you for signing up with shoPHP. For your account security, please <a href="shophp.shop/verify?email=' . $email . '&token=' . $token . '">verify your email address</a>.</p>';
  if (sendMail('no-reply@shophp.shop', $email, $subject, $body)) {
    $registerMsg =  "Verification email sent to " . $email . ". Please verify to log in. If you do not receive the email verification email, please reset your password to do so.";
  } else {
    $registerMsg = "Verification email could not be sent. Please contact customer support to verify your account.";
    $registerSuccess = "false";
  }
}

checkEmpty();
if ($registerSuccess == "true") {
  registerMember();
  if ($registerSuccess == "true"){
    sendEmail();
  }
}


header('Location: /login?registerSuccess=' . $registerSuccess . '&registerMsg=' . $registerMsg . '&username=' . $username . '&fname=' . $fname . '&lname=' . $lname . '&email=' . $email);
  