<?php

  $email = $pwd = $confirmPwd = $errorMsg = $successMsg = "";
  $success = "true";

  function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function checkEmpty() {
    global $email, $pwd, $errorMsg, $success;

    $email = sanitize_input($_GET["email"]);
    $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    
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

  function resetPass() {
    global $email, $pwd, $errorMsg, $success;

    // Create DB connection
    $config = parse_ini_file('../private/db-config.ini');
    $conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Check connection
    if ($conn -> connect_error) {
      $errorMsg = "Connection Failed. Please try again later";
      $success = "false";
    } else {
      // Prepare query
      $query = $conn -> prepare("SELECT email, password, verified FROM users WHERE email=? AND verified='1';");
      
      // Bind and execute query
      $query -> bind_param("s", $email);
      $result = $query -> get_result();
      if ($result -> num_rows > 0) {
        $row = $result -> fetch_assoc();
        $query -> close();
        $updateQuery = $conn -> prepare("UPDATE users SET password=? WHERE email=?");
        $updateQuery -> bind_param("ss", $pwd, $email);
        $updateQuery -> execute();
      }
    }
    $conn -> close();
  }
  checkEmpty();
  if ($success == "true") {
    resetPass();
  }
  
  header('Location: /reset?resetsuccess=' . $success . '&errorMsg=' . $errorMsg . '&email=' . $email . '&successMsg=' . $successMsg);
    