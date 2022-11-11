<?php

  $username = $fname = $lname = $email = $pwd = $confirmPwd = $errorMsg = $token = $successMsg = "";
  $success = "true";

  function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function checkEmpty() {
    global $username, $fname, $lname, $email, $pwd, $errorMsg, $success, $token;

    $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(32));
    
    if (empty($_POST["username"])) {
      $errorMsg = "Username is required.";
      $success = "false";
      return;
    } else if (empty($_POST["fname"])) {
      $errorMsg = "First Name is required.";
      $success = "false";
      return;
    }  else if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $errorMsg = "Please enter a valid email address.";
      $success = "false";
      return;
    } else if (empty($_POST["pwd"])) {
      $errorMsg = "Password is required.";
      $success = "false";
      return;
    } else if ($_POST["pwd"] != $_POST["confirm-pwd"]) {
      $errorMsg = "Passwords do not match.";
      $success = "false";
      return;
    } else if (isset($_POST["terms-of-service"])) {
      $errorMsg = "Please agree to the terms of service.";
      $success = "false";
      return;
    }
  }

  function registerMember() {
    global $username, $fname, $lname, $email, $pwd, $errorMsg, $success, $token;

    // Create DB connection
    $config = parse_ini_file('../private/db-config.ini');
    $conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Check connection
    if ($conn -> connect_error) {
      $errorMsg = "Connection Failed. Please try again later";
      $success = "false";
    } else {
      // Prepare query
      $query = $conn -> prepare("INSERT INTO shophp_users (username, user_fname, user_lname, user_email, user_pwd, user_token) VALUES (?, ?, ?, ?, ?, ?);");
      
      // Bind and execute query
      $query -> bind_param("ssssss", $username, $fname, $lname, $email, $pwd, $token);
      if (!$query -> execute()) {
        if (strpos($query->error, "email")) {
          $errorMsg = "Email is already in use.";
        } else if (strpos($query->error, "userscol")) {
          $errorMsg = "Username is taken.";
        }
        $success = "false";
      }
      
    }
    $conn -> close();
  }
  
function createNewPassword() {

  // Variables
  $email = $pwd = $titleMsg = '';
  $loginLink = '<a href="/login">Login</a>';
  $registerLink = '<a href="/register">Register</a>';

  // Start connection
  $config = parse_ini_file('../private/db-config.ini');
  $conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']);

  // Getting data from link
  if ((isset($_GET['email']) && !empty($_GET['email']))) {
    $email = sanitize_input($_GET['email']);
    $query = $conn -> prepare("SELECT user_email, verified FROM shophp_users WHERE user_email=? AND verified='1';");

    // Binding and executing query
    $query -> bind_param("ss", $email, $token);
    $query -> execute();
    $result = $query -> get_result();
    
    if ($result -> num_rows > 0) {
      $row = $result -> fetch_assoc();
      $userToken = $row['user_token'];
      $query -> close();

      if ($token == $userToken) {
        $updateQuery = $conn -> prepare("UPDATE shophp_users SET verified='1' WHERE user_email=?;");
        $updateQuery -> bind_param("s", $email);
        $updateQuery -> execute();
        echo "<span class='message-text'>Account verified!<br>Click here to " . $loginLink . "</span>";
      }
    } else {
      echo "<span class='message-text'>Account not found or already verified.<br>Click here to " . $loginLink . " or " . $registerLink . "</span>";
    }
    $updateQuery -> close();
  } else {
    echo "<span class='message-text'>Account not found or already verified.<br>Click here to " . $loginLink . " or " . $registerLink . "</span>";
  } $conn -> close();
}
  
  checkEmpty();
  if ($success == "true") {
    registerMember();
    if ($success == "true"){
      sendEmail();
    }
  }
  
  header('Location: /register?success=' . $success . '&errorMsg=' . $errorMsg . '&username=' . $username . '&fname=' . $fname . '&lname=' . $lname . '&token=' . $token . '&email=' . $email . '&successMsg=' . $successMsg);
    