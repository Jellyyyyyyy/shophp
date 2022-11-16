<?php
session_start();
if (empty($_POST)) header("Location /login"); // users should not be able to access this file
require_once 'include/functions.inc.php';
require_once 'include/dbcon.inc.php';
turnOnErrorReport();
mysqli_report(MYSQLI_REPORT_ALL);

$oldItem = $oldItemName = $oldItemCat = $oldItemDesc = $oldItemStock = $oldItemImg = ""; // Old item variables
$newItemName = $newItemCat = $newItemDesc = $newItemStock = $newItemImg = ""; // New item variables
$isEmptyName = $isEmptyCat = $isEmptyDesc = $isEmptyStock = $isEmptyImg = "true"; // Empty flags 1 = empty, 0 = not empty
$oldTargetPath = $newTargetPath = $newImageFileType = ""; // Image file variables

$manageMsg = "";
$manageSuccess = "true";

$formItem = sanitize_input($_POST["manage-chosen-item"]);
$manageAction = sanitize_input($_POST["manage-action"]);

function getItemFromForm() {
  global $conn, $formItem, $manageMsg, $manageSuccess, $oldItem, $oldItemID, $oldItemName, $oldItemCat, $oldItemDesc, $oldItemStock, $oldItemImg;

  if ($conn->connect_error) {
    $manageMsg = "Connection to server failed. Please try again later";
    $manageSuccess = "false";
  } else {
    $getItemQuery = $conn -> prepare("SELECT * FROM items WHERE name=?;");
    $getItemQuery -> bind_param("s", $formItem);
    $getItemQuery -> execute();
    $result = $getItemQuery -> get_result();
    if ($result->num_rows > 0) {
      $oldItem = $result -> fetch_assoc();
      $oldItemID = $oldItem["itemID"];
      $oldItemName = $oldItem["name"];
      $oldItemCat = $oldItem["category"];
      $oldItemDesc = $oldItem["description"];
      $oldItemStock = $oldItem["stock"];
      $oldItemImg = $oldItem["image"];
    } else {
      $manageMsg = "Item not found. Please contact server administrator is this error persists.";
      $manageSuccess = "false";
    }
  }
  $getItemQuery -> close();
  var_dump($_FILES);
}

function checkEmptyAndValidate() {
  global $manageMsg, $manageSuccess, $newItemName, $newItemCat, $newItemDesc, $newItemStock, $newItemImg, $isEmptyName, $isEmptyCat, $isEmptyDesc, $isEmptyStock, $isEmptyImg, $oldItemStock, $oldItemImg, $oldTargetPath, $newTargetPath, $newImageFileType;

  // If empty set empty flags
  if (!empty($_POST["manage-item-name"])) {
    $isEmptyName = "false";
    $newItemName = sanitize_input($_POST["manage-item-name"]);
  }
  if (!empty($_POST["manage-item-desc"])) {
    $isEmptyDesc = "false";
    $newItemDesc = sanitize_input($_POST["manage-item-desc"]);
  }
  if (!empty($_POST["manage-item-category"])) {
    $isEmptyCat = "false";
    $newItemCat = sanitize_input($_POST["manage-item-img"]);
  }
  if (isset($_FILES["manage-item-img"]) && $_FILES["manage-item-img"]['error'] != UPLOAD_ERR_NO_FILE) {
    $isEmptyImg = "false";
    $newItemImg = basename($_FILES["item-img"]["name"]);
  }

  // Updating stocks/sizes
  if (!empty($_POST["manage-item-size-XS"])) {
    $oldItemStock[0] = sanitize_input($_POST["manage-item-size-XS"]);
    $isEmptyStock = "false";
  }
  if (!empty($_POST["manage-item-size-S"])) {
    $oldItemStock[2] = sanitize_input($_POST["manage-item-size-S"]);
    $isEmptyStock = "false";
  }
  if (!empty($_POST["manage-item-size-M"])) {
    $oldItemStock[4] = sanitize_input($_POST["manage-item-size-M"]);
    $isEmptyStock = "false";
  }
  if (!empty($_POST["manage-item-size-L"])) {
    $oldItemStock[6] = sanitize_input($_POST["manage-item-size-L"]);
    $isEmptyStock = "false";
  }
  if (!empty($_POST["manage-item-size-XL"])) {
    $oldItemStock[8] = sanitize_input($_POST["manage-item-size-XL"]);
    $isEmptyStock = "false";
  }
  $newItemStock = $oldItemStock;

  // Image validating
  $oldTargetPath = $oldItemImg;
  $newTargetPath = "images/items_imgs/" . $newItemImg;
  $newImageFileType = strtolower(pathinfo($newTargetPath, PATHINFO_EXTENSION));

  $check = getimagesize($_FILES["manage-item-img"]["tmp_name"]);
  if ($check == false) {
    $manageMsg = "File is not an image";
    $manageSuccess = "false";
    return;
  } else if (($_FILES["manage-item-img"]["size"] > 524288000)) {
    $manageMsg = "File is too large. Please reduce the file size"; // Max 500MB
    $manageSuccess = "false";
    return;
  } else if ($newImageFileType != "jpg" && $newImageFileType != "png" && $newImageFileType != "jpeg") {
    $manageMsg = "Only JPG, PNG and JPEG files are allowed";
    $manageSuccess = "false";
    return;
  }

  include_once "include/admin.inc.php";
  if ($_POST["manage-admin-key"] !== $configAdminKey) {
    $manageMsg = "Invalid admin key:";
    $manageSuccess = "false";
    return;
  }
}

function updateQueryStatement($dbItemColumn, $new) {
  global $conn, $manageMsg, $manageSuccess, $newItemName, $newItemCat, $newItemDesc, $newItemStock, $newItemImg, $isEmptyName, $isEmptyCat, $isEmptyDesc, $isEmptyStock, $isEmptyImg, $oldItemID, $oldItemName, $oldItemCat, $oldItemDesc, $oldItemStock, $oldItemImg, $oldTargetPath, $newTargetPath, $newImageFileType;

  $updateQuery = $conn -> prepare("UPDATE items SET {$dbItemColumn}=? WHERE itemID={$oldItemID}");
  $updateQuery -> bind_param("s", $new);
  if (!$updateQuery -> execute()) {
    $manageMsg = "Execution failed. Please try again later.";
    $manageSuccess = "false";
    $updateQuery -> close();
    return "false";
  }
  $updateQuery -> close();
  return "true";
}

function restoreOld() {
  global $conn, $manageMsg, $manageSuccess, $newItemName, $newItemCat, $newItemDesc, $newItemStock, $newItemImg, $isEmptyName, $isEmptyCat, $isEmptyDesc, $isEmptyStock, $isEmptyImg, $oldItemID, $oldItemName, $oldItemCat, $oldItemDesc, $oldItemStock, $oldItemImg, $oldTargetPath, $newTargetPath, $newImageFileType;

  $restoreQuery = $conn -> prepare("UPDATE items SET name={$oldItemName},category={$oldItemCat},description={$oldItemDesc},stock={$oldItemStock},image={$oldTargetPath} WHERE itemID=?;");
  $restoreQuery -> bind_param("s", $oldItemID);
  try {
    unlink($newTargetPath);
    $unlinked = "true";
  } catch (Exception $e) {
    $unlinked = "false";
  }
  if (!$restoreQuery->execute()){
    $manageMsg .= "<br>Unable to restore old item. Please contact server administrator.";
  }
  if ($unlinked === "true") {
    if (!rename($oldTargetPath . '-DELETED', $oldTargetPath)) {
      $manageMsg .= "<br>Unable to restore old item image. Please contact server administrator.";
    }
  }
  $restoreQuery -> close();
}

function updateNewItem() {
  global $conn, $manageMsg, $manageSuccess, $newItemName, $newItemCat, $newItemDesc, $newItemStock, $newItemImg, $isEmptyName, $isEmptyCat, $isEmptyDesc, $isEmptyStock, $isEmptyImg, $oldItemName, $oldItemCat, $oldItemDesc, $oldItemStock, $oldItemImg, $oldTargetPath, $newTargetPath, $newImageFileType;

  // Update queries
  if ($isEmptyName == "false") {
   if (updateQueryStatement("name", $oldItemName, $newItemName) === "false") {
    $manageMsg = "Execution failed. Please try again later";
    $manageSuccess = "false";
    };
  }
  if ($isEmptyCat === "false") {
    if (updateQueryStatement("category", $newItemCat) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "false";
    };
  }
  if ($isEmptyDesc === "false") {
    if (updateQueryStatement("description", $newItemDesc) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "false";
    };
  }
  if ($isEmptyStock === "false") {
    if (updateQueryStatement("stock", $newItemStock) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "false";
    };
  }
  if ($isEmptyImg === "false") {
    if (!rename($oldTargetPath, $oldTargetPath . "-DELETED") && !move_uploaded_file($_FILES["manage-item-img"]["tmp_name"], $newTargetPath)) {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "false";
    };
  }
   
}

getItemFromForm();
if ($manageSuccess === "true") {
  CheckEmptyAndValidate();
  if ($manageSuccess === "true") {
    updateNewItem();
  }
}

if ($manageSuccess === "false") {
  restoreOld();
}

$conn -> close();

header("Location: /admin?manageSuccess={$manageSuccess}&manageMsg={$manageMsg}");