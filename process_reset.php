<?php

  require '/usr/share/php/libphp-phpmailer/autoload.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
    

  error_reporting(-1);
  ini_set('display_errors', 'On');
  set_error_handler("var_dump");

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

    $username = sanitize_input($_POST["username"]);
    $fname = sanitize_input($_POST["fname"]);
    $lname = sanitize_input($_POST["lname"]) ?? NULL;
    $email = sanitize_input($_POST["email"]);
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

  function sendEmail(){
    global $username, $email, $errorMsg, $success, $token, $successMsg;

    $mail = new PHPMailer(true);
    try {
      $mail -> SMTPDebug = false;                                       
      $mail -> isSMTP();                                            
      $mail -> Host       = 'smtp.ionos.com;';                    
      $mail -> SMTPAuth   = true;                             
      $mail -> Username   = 'no-reply@shophp.shop';                 
      $mail -> Password   = 'sdOpF1$k123';                        
      $mail -> SMTPSecure = 'tls';                              
      $mail -> Port       = 587;  
    
      $mail -> setFrom('no-reply@shophp.shop', 'shoPHP');           
      $mail -> addAddress($email);
         
      $mail -> isHTML(true);                                  
      $mail -> Subject = 'shoPHP Account Verification';
      $mail -> Body    = 'Hi ' . $username . ',<br><br>Thank you for signing up with shoPHP. For your account security, please <a href="shophp.shop/verify?email=' . $email . '&token=' . $token . '">verify your email address</a>.';
      $mail -> AltBody = 'Hi ' . $username . ',<br><br>Thank you for signing up with shoPHP. For your account security, please <a href="shophp.shop/verify?email=' . $email . '&token=' . $token . '">verify your email address</a>.';
      $mail -> send();
      $successMsg =  "Verification email sent to " . $email . ". Please verify to log in.";
  } catch (Exception $e) {
      $errorMsg = "Verification email could not be sent. Please contact customer support to verify your account.";
      $success = "false";
  }
  }
  
  checkEmpty();
  if ($success == "true") {
    registerMember();
    if ($success == "true"){
      sendEmail();
    }
  }
  
  header('Location: /register?success=' . $success . '&errorMsg=' . $errorMsg . '&username=' . $username . '&fname=' . $fname . '&lname=' . $lname . '&token=' . $token . '&email=' . $email . '&successMsg=' . $successMsg);
    