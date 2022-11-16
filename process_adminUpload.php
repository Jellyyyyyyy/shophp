<?php
session_start();
if (empty($_POST)) header("Location /login"); // users should not be able to access this file
require_once 'include/functions.inc.php';
turnOnErrorReport();

$itemName = $itemDesc = $itemCat = $itemStock = $targetPath = $adminKey = "";
$uploadMsg = "Item has been uploaded successfully";
$uploadSuccess = "true";

function checkEmptyAndValidate() {
  global $itemName, $itemDesc, $itemCat, $uploadMsg, $uploadSuccess, $itemStock, $targetPath, $imageFileType;

  // Check empty
  if (empty($_POST["item-name"])) {
    $uploadMsg = "Item name is required";
    $uploadSuccess = "false";
    return;
  } else if (empty($_POST["item-desc"])) {
    $uploadMsg = "Item must have a description";
    $uploadSuccess = "false";
    return;
  } else if (empty($_POST["item-category"])) {
    $uploadMsg = "Please select a category for the item";
    $uploadSuccess = "false";
    return;
  } else if (empty($_POST["admin-key"])) {
    $uploadMsg = "Please provide an admin key";
    $uploadSuccess = "false";
    return;
  } else if (!isset($_FILES["item-img"]) && $_FILES["item-img"]['error'] == UPLOAD_ERR_NO_FILE) {
    $uploadMsg = "The item must have an image";
    $uploadSuccess = "false";
    return;
  } 

  if (empty($_POST["item-size-XS"])) {
    if (empty($_POST["item-size-S"])) {
      if (empty($_POST["item-size-M"])) {
        if (empty($_POST["item-size-L"])) {
          if (empty($_POST["item-size-XL"])) {
            $uploadMsg = "Item needs to have at least 1 stock available";
            $uploadSuccess = "false";
            return;
          }
        }
      }
    }
  }

  $itemName = sanitize_input($_POST["item-name"]);
  $itemDesc = sanitize_input($_POST["item-desc"]);
  $itemCat = sanitize_input($_POST["item-category"]);
  $itemStock = sanitize_input($_POST["item-size-XS"] . ';' . $_POST["item-size-S"] . ';' . $_POST["item-size-M"] . ';' . $_POST["item-size-L"] . ';' . $_POST["item-size-XL"]);
  $adminKey = sanitize_input($_POST["admin-key"]);
  
  $itemImg = basename($_FILES["item-img"]["name"]);
  $targetPath = "images/items_imgs/" . $itemImg;
  $imageFileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
  
  $check = getimagesize($_FILES["item-img"]["tmp_name"]);
  if ($check == false) {
    $uploadMsg = "File is not an image";
    $uploadSuccess = "false";
    return;
  } else if (file_exists($targetPath)) {
    $uploadMsg = "File already exists, please choose a different image name";
    $uploadSuccess = "false";
    return;
  } else if (($_FILES["item-img"]["size"] > 524288000)) {
    $uploadMsg = "File is too large. Please reduce the file size";
    $uploadSuccess = "false";
    return;
  } else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $uploadMsg = "Only JPG, PNG and JPEG files are allowed";
    $uploadSuccess = "false";
    return;
  }
  include_once "include/admin.inc.php";
  if ($adminKey !== $configAdminKey) {
    $uploadMsg = "Invalid admin key:";
    $uploadSuccess = "false";
    return;
  }
}

function uploadItem() {
  global $itemName, $itemDesc, $itemCat, $uploadMsg, $uploadSuccess, $itemStock, $targetPath, $imageFileType;

  // Create DB connection
  include_once "include/dbcon.inc.php";

  if ($conn->connect_error) {
    $uploadMsg = "Connection to server failed. Please try again later.";
    $uploadSuccess = "false";
  } else {
    $query = $conn -> prepare("INSERT INTO items (name, description, image, category, stock) VALUES (?, ?, ?, ?, ?);");
    $query -> bind_param("sssss", $itemName, $itemDesc, $targetPath, $itemCat, $itemStock);
    if (!$query -> execute()) {
      $query -> close();
      $uploadMsg = "Execution failed: Please try again later.";
      $uploadSuccess = "false";
    } else {
      if(!move_uploaded_file($_FILES["item-img"]["tmp_name"], $targetPath)) {
        $uploadMsg = "Upload image failed. Please try again later.";
        $uploadSuccess = "false";
        $deleteQuery = $conn -> prepare("DELETE FROM items WHERE name=?");
        $deleteQuery -> bind_param("s", $itemName);
        $deleteQuery -> execute();
        $deleteQuery -> close();
      }
    }
  }
  $conn -> close();
}

checkEmptyAndValidate();
if ($uploadSuccess == "true") {
  uploadItem();
}

$_SESSION["itemname"] = $_POST["item-name"];
$_SESSION["itemdesc"] = $_POST["item-desc"];
$_SESSION["xs"] = $_POST["item-size-XS"];
$_SESSION["s"] = $_POST["item-size-S"];
$_SESSION["m"] = $_POST["item-size-M"];
$_SESSION["l"] = $_POST["item-size-L"];
$_SESSION["xl"] = $_POST["item-size-XL"];

header("Location: /admin?uploadSuccess=" . $uploadSuccess . "&uploadMsg=" . $uploadMsg);