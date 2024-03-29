<?php
session_start();
if (empty($_POST)) header("Location /adlogin"); // users should not be able to access this file
require_once 'include/functions.inc.php';
require_once 'include/dbcon.inc.php';
turnOnErrorReport();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$oldItem = $oldItemName = $oldItemCat = $oldItemDesc = $oldItemDetails = $oldItemMaterials = $oldItemPrice = $oldItemType = $oldItemStock = $oldItemImg = ""; // Old item variables
$newItemName = $newItemCat = $newItemDesc = $newItemDetails = $newItemMaterials = $newItemPrice = $newItemType = $newItemStock = $newItemImg = ""; // New item variables
$isEmptyName = $isEmptyCat = $isEmptyDesc = $isEmptyDetails = $isEmptyMaterials = $isEmptyType = $isEmptyType = $isEmptyStock = $isEmptyImg = "true"; // Empty flags 1 = empty, 0 = not empty
$oldTargetPath = $newTargetPath = $newImageFileType = ""; // Image file variables

$manageMsg = " updated successfully.";
$manageSuccess = "true";

$formItem = $manageAction = "";

function checkRequiredEmpty()
{
  global $formItem, $manageAction, $manageMsg, $manageSuccess;

  if (empty($_POST["manage-admin-key"])) {
    $manageMsg = "Admin key is required.";
    $manageSuccess = "false";
    return;
  } else if (empty($_POST["manage-chosen-item"])) {
    $manageMsg = "Please choose an item to edit.";
    $manageSuccess = "false";
    return;
  }

  $formItem = sanitize_input($_POST["manage-chosen-item"]);
  $manageAction = sanitize_input($_POST["manage-action"]);
}


function getItemFromForm()
{
  global $conn, $formItem, $manageMsg, $manageSuccess, $oldItem, $oldItemPrice, $oldItemType, $oldItemID, $oldItemName, $oldItemCat, $oldItemDesc, $oldItemDetails, $oldItemMaterials, $oldItemStock, $oldItemImg;

  if ($conn->connect_error) {
    $manageMsg = "Connection to server failed. Please try again later";
    $manageSuccess = "false";
  } else {
    $getItemQuery = $conn->prepare("SELECT * FROM items WHERE name=?;");
    $getItemQuery->bind_param("s", $formItem);
    $getItemQuery->execute();
    $result = $getItemQuery->get_result();
    if ($result->num_rows > 0) {
      $oldItem = $result->fetch_assoc();
      $oldItemID = $oldItem["itemID"];
      $oldItemName = $oldItem["name"];
      $oldItemCat = $oldItem["category"];
      $oldItemDesc = $oldItem["description"];
      $oldItemDetails = $oldItem["details"];
      $oldItemMaterials = $oldItem["materials"];
      $oldItemPrice = $oldItem["price"];
      $oldItemType = $oldItem["type"];
      $oldItemStock = $oldItem["stock"];
      $oldItemImg = $oldItem["image"];
    } else {
      $manageMsg = "Item not found. Please contact server administrator is this error persists.";
      $manageSuccess = "false";
    }
  }
  $getItemQuery->close();
}

function checkEmptyAndValidate()
{
  global $manageMsg, $manageSuccess, $newItemName, $newItemCat, $newItemDesc, $newItemDetails, $newItemMaterials, $newItemPrice, $newItemType, $newItemStock, $newItemImg, $isEmptyName, $isEmptyCat, $isEmptyDesc, $isEmptyDetails, $isEmptyMaterials, $isEmptyPrice, $isEmptyType, $isEmptyStock, $isEmptyImg, $oldItemStock, $oldItemImg, $oldTargetPath, $newTargetPath, $newImageFileType;

  // If empty set empty flags
  if (!empty($_POST["manage-item-name"])) {
    if (!ctype_alnum(str_replace(' ', '', $_POST["manage-item-name"]))) {
      $manageMsg = "Item name can only contain letters, numbers and spaces";
      $manageSuccess = "false";
      return;
    }
    $isEmptyName = "false";
    $newItemName = sanitize_input($_POST["manage-item-name"]);
  }

  if (!empty($_POST["manage-item-desc"])) {
    if (strpos($_POST["manage-item-desc"], "'") || strpos($_POST["manage-item-desc"], '"')) {
      $manageMsg = "Item description cannot contain apostrophes";
      $manageSuccess = "false";
      return;
    }
    $isEmptyDesc = "false";
    $newItemDesc = sanitize_input($_POST["manage-item-desc"]);
  }

  if (!empty($_POST["manage-item-details"])) {
    if (strpos($_POST["manage-item-details"], "'") || strpos($_POST["manage-item-details"], '"')) {
      $manageMsg = "Item's more details cannot contain apostrophes";
      $manageSuccess = "false";
      return;
    }
    $isEmptyDetails = "false";
    $newItemDetails = sanitize_input($_POST["manage-item-details"]);
  }

  if (!empty($_POST["manage-item-materials"])) {
    if (strpos($_POST["manage-item-materials"], "'") || strpos($_POST["manage-item-materials"], '"')) {
      $manageMsg = "Item materials cannot contain apostrophes";
      $manageSuccess = "false";
      return;
    }
    $isEmptyMaterials = "false";
    $newItemMaterials = sanitize_input($_POST["manage-item-materials"]);
  }

  if (!empty($_POST["manage-item-price"])) {
    if (!ctype_digit(str_replace('.', '', $_POST["manage-item-price"]))) {
      $manageMsg = "Item price can only contain numbers";
      $manageSuccess = "false";
      return;
    }
    $isEmptyPrice = "false";
    $newItemPrice = sanitize_input($_POST["manage-item-price"]);
  }

  if (!empty($_POST["manage-item-type"]) && $_POST["manage-item-type"] !== "no-change") {
    $isEmptyType = "false";
    $newItemType = sanitize_input($_POST["manage-item-type"]);
  }

  if (!empty($_POST["manage-item-category"]) && $_POST["manage-item-category"] !== "no-change") {
    $isEmptyCat = "false";
    $newItemCat = sanitize_input($_POST["manage-item-category"]);
  }

  if (isset($_FILES["manage-item-img"]) && $_FILES["manage-item-img"]['error'] != UPLOAD_ERR_NO_FILE) {
    $isEmptyImg = "false";
    $newItemImg = basename($_FILES["manage-item-img"]["name"]);
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
  }

  // Updating stocks/sizes
  $oldItemStock = explode(";", $oldItemStock);

  if (!empty($_POST["manage-item-size-XS"])) {
    $oldItemStock[0] = sanitize_input($_POST["manage-item-size-XS"]);
    $isEmptyStock = "false";
  }
  if (!empty($_POST["manage-item-size-S"])) {
    $oldItemStock[1] = sanitize_input($_POST["manage-item-size-S"]);
    $isEmptyStock = "false";
  }
  if (!empty($_POST["manage-item-size-M"])) {
    $oldItemStock[2] = sanitize_input($_POST["manage-item-size-M"]);
    $isEmptyStock = "false";
  }
  if (!empty($_POST["manage-item-size-L"])) {
    $oldItemStock[3] = sanitize_input($_POST["manage-item-size-L"]);
    $isEmptyStock = "false";
  }
  if (!empty($_POST["manage-item-size-XL"])) {
    $oldItemStock[4] = sanitize_input($_POST["manage-item-size-XL"]);
    $isEmptyStock = "false";
  }
  $oldItemStock = join(";", $oldItemStock);
  $newItemStock = $oldItemStock;

  include_once "include/admin.inc.php";
  if ($_POST["manage-admin-key"] !== $configAdminKey) {
    $manageMsg = "Invalid admin key:" . $oldItem;
    $manageSuccess = "false";
    return;
  }
}

function updateQueryStatement($dbItemColumn, $new)
{
  global $conn, $oldItemID;

  $updateQuery = $conn->prepare("UPDATE items SET {$dbItemColumn}=? WHERE itemID={$oldItemID}");
  $updateQuery->bind_param("s", $new);
  if (!$updateQuery->execute()) {
    $updateQuery->close();
    return "false";
  }
  $updateQuery->close();
  return "true";
}

function updateNewItem()
{
  global $manageMsg, $manageSuccess, $newItemName, $newItemType, $newItemPrice, $newItemCat, $newItemDesc, $newItemDetails, $newItemMaterials, $newItemStock, $isEmptyName, $isEmptyCat, $isEmptyDesc, $isEmptyDetails, $isEmptyMaterials, $isEmptyPrice, $isEmptyType, $isEmptyStock, $isEmptyImg, $oldTargetPath, $newTargetPath;

  // Update queries
  if ($isEmptyName == "false") {
    if (updateQueryStatement("name", $newItemName) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "updateFalse";
    };
  }
  if ($isEmptyCat === "false") {
    if (updateQueryStatement("category", $newItemCat) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "updateFalse";
    };
  }
  if ($isEmptyDesc === "false") {
    if (updateQueryStatement("description", $newItemDesc) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "updateFalse";
    };
  }
  if ($isEmptyDetails === "false") {
    if (updateQueryStatement("details", $newItemDetails) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "updateFalse";
    };
  }
  if ($isEmptyMaterials === "false") {
    if (updateQueryStatement("materials", $newItemMaterials) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "updateFalse";
    };
  }
  if ($isEmptyPrice === "false") {
    if (updateQueryStatement("price", $newItemPrice) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "updateFalse";
    };
  }
  if ($isEmptyType === "false") {
    if (updateQueryStatement("type", $newItemType) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "updateFalse";
    };
  }
  if ($isEmptyStock === "false") {
    if (updateQueryStatement("stock", $newItemStock) === "false") {
      $manageMsg = "Execution failed. Please try again later";
      $manageSuccess = "updateFalse";
    };
  }
  if ($isEmptyImg === "false") {
    if (rename($oldTargetPath, $oldTargetPath . "-DELETED")) {
      if (file_exists($newTargetPath)) {
        $manageMsg = "File already exists, please choose a different image name";
        $manageSuccess = "updateFalse";
        return;
      } else {
        if (move_uploaded_file($_FILES["manage-item-img"]["tmp_name"], $newTargetPath)) {
          if (updateQueryStatement("image", $newTargetPath) === "true") {
            return;
          }
        }
      }
      // If any of the above fails
    };
    $manageMsg = "Execution failed. Please try again later";
    $manageSuccess = "updateFalse";
  }
}

function restoreOld()
{
  global $conn, $manageMsg, $oldItemID, $oldItemName, $oldItemCat, $oldItemDesc, $oldItemDetails, $oldItemMaterials, $oldItemPrice, $oldItemType, $oldItemStock, $oldItemImg, $oldTargetPath, $newTargetPath;

  $restoreQuery = $conn->prepare("UPDATE items SET name='{$oldItemName}',category='{$oldItemCat}',description='{$oldItemDesc}',details='{$oldItemDetails}',materials='{$oldItemMaterials}',stock='{$oldItemStock}',image='{$oldItemImg}',type='{$oldItemType}',price='{$oldItemPrice}' WHERE itemID=?;");
  $restoreQuery->bind_param("s", $oldItemID);
  if (file_exists($newTargetPath)) {
    unlink($newTargetPath);
    $unlinked = "true";
  } else {
    $unlinked = "false";
  }
  if (!$restoreQuery->execute()) {
    $manageMsg .= "<br>Unable to restore old item. Please contact server administrator.";
  }
  if ($unlinked === "true") {
    if (!rename($oldTargetPath . '-DELETED', $oldTargetPath)) {
      $manageMsg .= "<br>Unable to restore old item image. Please contact server administrator.";
    }
  }
  $restoreQuery->close();
}

function deleteItem() {
  global $conn, $formItem, $manageMsg, $manageSuccess;
  $pQuery = $conn -> prepare("SELECT * FROM admins WHERE token=?");
  $pQuery -> bind_param("s", $_SESSION["admin-token"]);
  $pQuery -> execute();
  $pResult = $pQuery -> get_result();
  if ($pResult->num_rows > 0) {
    $pRow = $pResult -> fetch_assoc();
    $dbToken = $pRow["privilegelevel"];
  }
  if ($dbToken > 1) {
    $deleteQuery = $conn->prepare("DELETE FROM items WHERE name=?");
    $deleteQuery->bind_param("s", $formItem);
    if (!$deleteQuery->execute()) {
      $manageMsg = "Item could not be deleted. Please try again later.";
      $manageSuccess = "false";
    }
  } else {
    $manageMsg = "You do not have the privileges required to perform this function.";
    $manageSuccess = "false";
  }
} 


checkRequiredEmpty();
if ($manageSuccess === "true" && $manageAction === "edit") {
  getItemFromForm();
  if ($manageSuccess === "true") {
    CheckEmptyAndValidate();
    if ($manageSuccess === "true") {
      updateNewItem();
    }
  }
  if ($manageSuccess === "true") $manageMsg = $newItemName . $manageMsg;
} else if ($manageSuccess === "true" && $manageAction === "delete") {
  deleteItem();
  if ($manageSuccess === "true") $manageMsg = "Item has been deleted successfully.";
} else {
  $manageMsg = "An Unexpected error has occurred. Please contact a server adminstrator immediately.";
  $manageSuccess = "false";
}


if ($manageSuccess === "updateFalse") {
  restoreOld();
}

$conn->close();


header("Location: /admin?manageSuccess={$manageSuccess}&manageMsg={$manageMsg}");