<?php

require_once '/usr/share/php/libphp-phpmailer/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function turnOnErrorReport()
{
  // Turns on error reporting
  error_reporting(-1);
  ini_set('display_errors', 'On');
  set_error_handler("var_dump");
}

function sanitize_input($data)
{
  // Sanitise given input
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function sendMail($emailToUse, $emailToSend, $subject, $body)
{
  // Sends mail
  $mail = new PHPMailer(true);
  try {
    $mail->SMTPDebug = false;
    $mail->isSMTP();
    $mail->Host = 'smtp.ionos.com;';
    $mail->SMTPAuth = true;
    $mail->Username = $emailToUse;
    $mail->Password = 'sdOpF1$k123';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom($emailToUse, 'shoPHP');
    $mail->addAddress($emailToSend);
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AltBody = $body;

    $mail->send();
  } catch (Exception $e) {
    return false;
  }
  return true;
}

function getItems($category) {
  global $conn;
  if ($conn->connect_error) {
    return "Could not connect to server. Please try again later";
  } else {
    if ($category === "new") {
      $result = $conn -> query("SELECT * FROM items ORDER BY itemID DESC LIMIT 50;");
    } else {
      $query = $conn->prepare("SELECT * FROM items WHERE category=?");
      $query->bind_param("s", $category);
      $query->execute();
      $result = $query->get_result();
      $resultArr = array();
    }

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $resultArr[] = json_encode($row);
      }
      return $resultArr;
    } else {
      return "No items found.";
    }
  }
}

function getWishlistFromDB() {
  global $conn;
  $user = $_SESSION["user"];
  
  if ($conn->connect_error) {
    return "Connection failed. Please try again later.";
  } else {
    $query = $conn->prepare("SELECT wishlist FROM users WHERE email=?");
    $query->bind_param("s", $user);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
    $wishlistItems = $row["wishlist"];
    $query->close();
    if ($wishlistItems) return $wishlistItems;
    else return "No items found"; 
  }
}

function addWishlistToDB() {
  global $conn, $cookieWishlist;
  $user = $_SESSION["user"];
  $cookieWishlist = $_COOKIE["wishlistItems"];

  if ($conn->connect_error) {
    return "Connection failed. Please try again later.";
  } else if ($cookieWishlist) {
    $query = $conn->prepare("UPDATE users SET wishlist=? WHERE email=?");
    $query->bind_param("ss", $cookieWishlist, $user);
    $query->execute();
    $query->close();
    return "true";
  } else {
    return "false";
  }
}