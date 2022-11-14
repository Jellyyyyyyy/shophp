<?php

require_once '/usr/share/php/libphp-phpmailer/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function turnOnErrorReport() {
  // Turns on error reporting
  error_reporting(-1);
  ini_set('display_errors', 'On');
  set_error_handler("var_dump");
}

function sanitize_input($data) {
  // Sanitise given input
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function sendMail($emailToUse, $emailToSend, $subject, $body) {
  // Sends mail
  $mail = new PHPMailer(true);
    try {
      $mail -> SMTPDebug = false;
      $mail -> isSMTP();
      $mail -> Host = 'smtp.ionos.com;';
      $mail -> SMTPAuth = true;
      $mail -> Username = $emailToUse;
      $mail -> Password = 'sdOpF1$k123';
      $mail -> SMTPSecure = 'tls';
      $mail -> Port = 587;
      $mail -> setFrom($emailToUse, 'shoPHP');           
      $mail -> addAddress($emailToSend);
      $mail -> isHTML(true);

      $mail -> Subject = $subject;
      $mail -> Body = $body;
      $mail -> AltBody = $body;

      $mail -> send();

    } catch (Exception $e) {
      return false;
    }
  return true;
}

function getItems($category) {
  include_once "dbcon.inc.php";
  if ($conn->connect_error) {
    $getItemMsg = "Could not connect to server. Please try again later";
    return;
  } else {
    $query = $conn->prepare("SELECT * FROM items WHERE category=?");
    $query->bind_param("s", $category);
    $query->execute();
    $result = $query->get_result();
    $resultArr = array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $resultArr[] = $row;
      }
      return $resultArr;
    } else {
      return "No results found.";
    }
  }
}