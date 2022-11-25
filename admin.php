<?php //include_once "include/checkAdminLogin.inc.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/admin.css">
  <script src="js/admin.js" defer></script>
</head>

<body>
  <?php
  include_once "include/nav.inc.php";
  include_once "include/dbcon.inc.php";
  ?>
  <main style="min-height: 85vh;">
    <div class="mobile-overlay">
      <p>Please only access admin page on desktop.</p>
    </div>
    <div class="everytElse">
      <div class="row w-100">
        <div class="col-3">
          <!-- Tab navs -->
          <div class="nav flex-column nav-tabs text-center" id="v-tabs-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link <?= isset($_GET["uploadSuccess"]) || empty($_GET) ? 'active' : '' ?>"
              id="v-tabs-upload-listing-tab" data-mdb-toggle="tab" href="#v-tabs-upload-listing" role="tab"
              aria-controls="v-tabs-upload-listing" aria-selected="true">Upload listing</a>
            <a class="nav-link <?= isset($_GET["manageSuccess"]) ? 'active' : '' ?>" id="v-tabs-manage-listing-tab"
              data-mdb-toggle="tab" href="#v-tabs-manage-listing" role="tab" aria-controls="v-tabs-manage-listing"
              aria-selected="false">Manage listing</a>
            <a class="nav-link" id="v-tabs-users-tab" data-mdb-toggle="tab" href="#v-tabs-users" role="tab"
              aria-controls="v-tabs-users" aria-selected="false">Manage users</a>
            <a class="nav-link" id="v-tabs-orders-tab" data-mdb-toggle="tab" href="#v-tabs-orders" role="tab"
              aria-controls="v-tabs-orders" aria-selected="false">Manage orders</a>
          </div>
          <!-- Tab navs -->
        </div>

        <div class="col-9">
          <!-- Tab content -->
          <div class="tab-content" id="v-tabs-tabContent">
            <div class="tab-pane fade <?= isset($_GET["uploadSuccess"]) || empty($_GET) ? 'active show' : '' ?>"
              id="v-tabs-upload-listing" role="tabpanel" aria-labelledby="v-tabs-upload-listing-tab">
              <form action="process_adminUpload" method="post" target="_self" enctype="multipart/form-data"
                style="width: 60%;">
                <h2>Upload item</h2>
                <?php
                include_once "include/functions.inc.php";
                if (isset($_GET['uploadSuccess'])) {
                  $uploadSuccess = sanitize_input($_GET['uploadSuccess']);
                  $uploadMsg = sanitize_input($_GET['uploadMsg']);
                  if ($uploadSuccess == "true") {
                    echo '<div class="msg-container" style="background: rgba(45, 197, 45, 0.665);border: 2px solid rgb(23, 210, 23);">';
                    echo "<span> {$uploadMsg} </span>";
                    echo '</div>';
                  } else {
                    echo '<div class="msg-container" style="background: rgba(255, 43, 43, 0.707);border: 1px solid rgb(255, 0, 0);">';
                    echo "<span> {$uploadMsg} </span>";
                    echo '</div>';
                  }
                }
                ?>
                <div class="form-outline mb-4">
                  <input type="text" class="form-control form-control-lg" id="item-name" name="item-name"
                    value="<?= $_SESSION["itemname"] ?? '' ?>" maxlength="20" required>
                  <label for="item-name" class="form-label">Item name</label>
                </div>

                <div class="form-outline mb-4">
                  <textarea class="form-control form-control-lg " data-mdb-showcounter="true" id="item-desc"
                    name="item-desc" maxlength="500" style="height: 10rem;"
                    required><?= $_SESSION["itemdesc"] ?? '' ?></textarea>
                  <label for="item-desc" class="form-label">Description</label>
                  <div class="form-helper"></div>
                </div>

                <div class="form-outline mb-4">
                  <textarea class="form-control form-control-lg " data-mdb-showcounter="true" id="item-details"
                    name="item-details" maxlength="200"
                    style="height: 7rem;"><?= $_SESSION["itemdetails"] ?? '' ?></textarea>
                  <label for="item-details" class="form-label">More details (Not required)</label>
                  <div class="form-helper"></div>
                </div>

                <div class="form-outline mb-4">
                  <textarea class="form-control form-control-lg " data-mdb-showcounter="true" id="item-materials"
                    name="item-materials" maxlength="200" style="height: 7rem;"
                    required><?= $_SESSION["itemmaterials"] ?? '' ?></textarea>
                  <label for="item-materials" class="form-label">Materials</label>
                  <div class="form-helper"></div>
                </div>

                <select class="form-select mb-3 item-category" name="item-category" aria-label="Item category" required>
                  <option value="" disabled <?= !isset($_SESSION["itemcat"]) ? 'selected' : '' ?>>Category</option>
                  <option <?= isset($_SESSION["itemcat"]) && $_SESSION["itemcat"] === "clothing" ? 'selected' : '' ?>
                    value="clothing">Clothing</option>
                  <option <?= isset($_SESSION["itemcat"]) && $_SESSION["itemcat"] === "bags" ? 'selected' : '' ?>
                    value="bags">Bags</option>
                  <option <?= isset($_SESSION["itemcat"]) && $_SESSION["itemcat"] === "accessories" ? 'selected' : '' ?>
                    value="accessories">Accessories</option>
                </select>

                <div class="form-outline mb-3">
                  <input type="tel" class="form-control form-control-lg" id="item-price" name="item-price"
                    value="<?= $_SESSION["itemprice"] ?? '' ?>" maxlength="10" required>
                  <label for="item-price" class="form-label">Price (S$)</label>
                </div>

                <select class="form-select mb-3" name="item-type" aria-label="Item type" required>
                  <option value="" disabled <?= !isset($_SESSION["itemtype"]) ? 'selected' : '' ?>>Type</option>
                  <option <?= isset($_SESSION["itemtype"]) && $_SESSION["itemtype"] === "unisex" ? 'selected' : '' ?>
                    value="unisex">Unisex</option>
                  <option <?= isset($_SESSION["itemtype"]) && $_SESSION["itemtype"] === "men" ? 'selected' : '' ?>
                    value="men">Men</option>
                  <option <?= isset($_SESSION["itemtype"]) && $_SESSION["itemtype"] === "women" ? 'selected' : '' ?>
                    value="women">Women</option>
                </select>

                <label class="form-label" for="item-size-XS">Stock</label>
                <div class="d-flex flex-row justify-content-between">
                  <div class="form-outline mb-4 me-3 item-size">
                    <input type="number" class="form-control form-control-lg" id="item-size-XS" name="item-size-XS" min=0
                      value="<?= $_SESSION["xs"] ?? '' ?>">
                    <label for="item-size-XS" class="form-label">XS</label>
                  </div>
                  <div class="form-outline mb-4 me-3 item-size">
                    <input type="number" class="form-control form-control-lg" id="item-size-S" name="item-size-S" min=0
                      value="<?= $_SESSION["s"] ?? '' ?>">
                    <label for="item-size-S" class="form-label">S</label>
                  </div>
                  <div class="form-outline mb-4 me-3 item-size">
                    <input type="number" class="form-control form-control-lg" id="item-size-M" name="item-size-M" min=0
                      value="<?= $_SESSION["m"] ?? '' ?>">
                    <label for="item-size-M" class="form-label">M</label>
                  </div>
                  <div class="form-outline mb-4 me-3 item-size">
                    <input type="number" class="form-control form-control-lg" id="item-size-L" name="item-size-L" min=0
                      value="<?= $_SESSION["l"] ?? '' ?>">
                    <label for="item-size-L" class="form-label">L</label>
                  </div>
                  <div class="form-outline mb-4 item-size">
                    <input type="number" class="form-control form-control-lg" id="item-size-XL" name="item-size-XL" min=0
                      value="<?= $_SESSION["xl"] ?? '' ?>">
                    <label for="item-size-XL" class="form-label">XL</label>
                  </div>
                </div>

                <label for="item-img" class="form-label">Upload image</label>
                <input class="form-control mb-4" type="file" id="item-img" name="item-img">

                <div class="form-outline mb-4 item-name">
                  <input type="password" class="form-control form-control-lg" id="admin-key" name="admin-key" required>
                  <label for="admin-key" class="form-label">Admin key</label>
                </div>

                <div class="pt-1 mb-4">
                  <button class="btn btn-dark btn-lg btn-block submit-button" type="submit">
                    Upload
                  </button>
                </div>
              </form>
            </div>

            <div class="tab-pane fade <?= isset($_GET["manageSuccess"]) ? 'show active' : '' ?>"
              id="v-tabs-manage-listing" role="tabpanel" aria-labelledby="v-tabs-manage-listing-tab">
              <?php
              function putItemInSelect($category)
              {
                global $conn;
                if ($conn->connect_error) {
                  echo "<div>Connection to server failed. Please try again later.</div>";
                } else {
                  $query = $conn->prepare("SELECT * FROM items WHERE category=?");
                  $query->bind_param('s', $category);
                  $query->execute();
                  $result = $query->get_result();
                  $arr = array();
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $arr[] = $row["name"];
                    }
                  } else {
                    $arr[] = "No items found";
                  }
                }
                return $arr;
              }
              ?>

              <form action="process_adminItemEdit" method="post" target="_self" enctype="multipart/form-data"
                style="width: 60%;">
                <h2>Manage Listing</h2>
                <?php
                if (isset($_GET['manageSuccess'])) {
                  $manageSuccess = sanitize_input($_GET['manageSuccess']);
                  $manageMsg = sanitize_input($_GET['manageMsg']);
                  if ($manageSuccess == "true") {
                    echo '<div class="msg-container" style="background: rgba(45, 197, 45, 0.665);border: 2px solid rgb(23, 210, 23);">';
                    echo "<span> {$manageMsg} </span>";
                    echo '</div>';
                  } else {
                    echo '<div class="msg-container" style="background: rgba(255, 43, 43, 0.707);border: 1px solid rgb(255, 0, 0);">';
                    echo "<span> {$manageMsg} </span>";
                    echo '</div>';
                  }
                }
                ?>
                <select class="form-select mb-3 manage-action" name="manage-action" aria-label="Item category" required>
                  <option value="" disabled>Select an action</option> 
                  <option value="edit">Edit</option>
                  <option value="delete">Delete</option>
                </select>

                <select class="form-select mb-3" name="manage-chosen-item" aria-label="Item category" required>
                  <option value="" disabled selected>Choose Item</option>
                  <optgroup label="Clothing">
                    <?php
                    $clothings = putItemInSelect("clothing");
                    if (gettype($clothings) == "array") {
                      if ($clothings[0] == "No items found") echo "<option disabled>No items found</option>";
                      else {
                        foreach ($clothings as $item) {
                          echo "<option value='{$item}'>{$item}</option>";
                        }
                      }
                    }
                    ?>
                  </optgroup>
                  <optgroup label="Bags">
                    <?php
                    $bags = putItemInSelect("bags");
                    if (gettype($bags) == "array") {
                      if ($bags[0] == "No items found") echo "<option disabled>No items found</option>";
                      else {
                        foreach ($bags as $item) {
                          echo "<option value='{$item}'>{$item}</option>";
                        }
                      }
                    }
                    ?>
                  </optgroup>
                  <optgroup label="Accessories">
                    <?php
                    $accessories = putItemInSelect("accessories");
                    if (gettype($accessories) == "array") {
                      if ($accessories[0] == "No items found") echo "<option disabled>No items found</option>";
                      else {
                        foreach ($accessories as $item) {
                          echo "<option value='{$item}'>{$item}</option>";
                        }
                      }
                    }
                    ?>
                  </optgroup>
                </select>

                <div class="edit-container">
                  <h4 class="mb-2">Edit item</h4>
                  <h6>Leave fields empty to make no changes</h6>
                  <div class="form-outline mb-4">
                    <input type="text" class="form-control form-control-lg" id="manage-item-name" name="manage-item-name"
                      maxlength="20" value="<?= $_SESSION["manageItemName"] ?? '' ?>">
                    <label for="manage-item-name" class="form-label">Change Item name</label>
                  </div>
                  <div class="form-outline mb-4">
                    <textarea class="form-control form-control-lg " data-mdb-showcounter="true" id="manage-item-desc"
                      name="manage-item-desc" maxlength="500"
                      style="height: 10rem;"><?= $_SESSION["manageItemDesc"] ?? '' ?></textarea>
                    <label for="manage-item-desc" class="form-label">Change Description</label>
                    <div class="form-helper"></div>
                  </div>
                  <div class="form-outline mb-4">
                    <textarea class="form-control form-control-lg " data-mdb-showcounter="true" id="manage-item-details"
                      name="manage-item-details" maxlength="200"
                      style="height: 7rem;"><?= $_SESSION["manageItemDetails"] ?? '' ?></textarea>
                    <label for="manage-item-details" class="form-label">Change More Details</label>
                    <div class="form-helper"></div>
                  </div>
                  <div class="form-outline mb-4">
                    <textarea class="form-control form-control-lg " data-mdb-showcounter="true" id="manage-item-materials"
                      name="manage-item-materials" maxlength="200"
                      style="height: 7rem;"><?= $_SESSION["manageItemMaterials"] ?? '' ?></textarea>
                    <label for="manage-item-materials" class="form-label">Change Materials</label>
                    <div class="form-helper"></div>
                  </div>
                  <select class="form-select mb-4" name="manage-item-category" aria-label="Mangae Item category">
                    <option disabled selected>Change Category</option>
                    <option value="clothing">Clothing</option>
                    <option value="bags">Bags</option>
                    <option value="accessories">Accessories</option>
                    <option value="no-change">No change</option>
                  </select>
                  <div class="form-outline mb-3">
                    <input type="tel" class="form-control form-control-lg" id="manage-item-price" name="manage-item-price"
                      value="<?= $_SESSION["manageItemPrice"] ?? '' ?>" maxlength="10">
                    <label for="manage-item-price" class="form-label">Price (S$)</label>
                  </div>
                  <select class="form-select mb-3" name="manage-item-type" aria-label="Item type">
                    <option disabled selected>Type</option>
                    <option value="Unisex">Unisex</option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                  </select>
                  <label class="form-label" for="manage-item-size-XS">Change Stock</label>
                  <div class="d-flex flex-row justify-content-between">
                    <div class="form-outline mb-4 me-3">
                      <input type="number" class="form-control form-control-lg" id="manage-item-size-XS"
                        name="manage-item-size-XS" min=0 value="<?= $_SESSION["manageXs"] ?? '' ?>">
                      <label for="manage-item-size-XS" class="form-label">XS</label>
                    </div>
                    <div class="form-outline mb-4 me-3">
                      <input type="number" class="form-control form-control-lg" id="manage-item-size-S"
                        name="manage-item-size-S" min=0 value="<?= $_SESSION["manageS"] ?? '' ?>">
                      <label for="manage-item-size-S" class="form-label">S</label>
                    </div>
                    <div class="form-outline mb-4 me-3">
                      <input type="number" class="form-control form-control-lg" id="manage-item-size-M"
                        name="manage-item-size-M" min=0 value="<?= $_SESSION["manageM"] ?? '' ?>">
                      <label for="manage-item-size-M" class="form-label">M</label>
                    </div>
                    <div class="form-outline mb-4 me-3">
                      <input type="number" class="form-control form-control-lg" id="manage-item-size-L"
                        name="manage-item-size-L" min=0 value="<?= $_SESSION["manageL"] ?? '' ?>">
                      <label for="manage-item-size-L" class="form-label">L</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="number" class="form-control form-control-lg" id="manage-item-size-XL"
                        name="manage-item-size-XL" min=0 value="<?= $_SESSION["manageXl"] ?? '' ?>">
                      <label for="manage-item-size-XL" class="form-label">XL</label>
                    </div>
                  </div>
                  <label for="manage-item-img" class="form-label">Change image</label>
                  <input class="form-control mb-4" type="file" id="manage-item-img" name="manage-item-img">
                </div>
                <div class="form-outline mb-4 item-name">
                  <input type="password" class="form-control form-control-lg" id="manage-admin-key"
                    name="manage-admin-key" required>
                  <label for="manage-admin-key" class="form-label">Admin key</label>
                </div>
                <div class="pt-1 mb-4">
                  <button class="btn btn-dark btn-lg btn-block submit-button manage-item-submit-btn" type="submit">
                    Make Changes
                  </button>
                </div>
              </form>
            </div>
            <div class="tab-pane fade <?= isset($_GET["mngUserSuccess"]) ? 'show active' : '' ?>" id="v-tabs-users"
              role="tabpanel" aria-labelledby="v-tabs-users-tab">
              <form action="process_adminUserEdit" method="post" target="_self" style="width: 60%;">
                <h2>Manage User</h2>
                <?php
                if (isset($_GET['mngUserSuccess'])) {
                  $mngUserSuccess = sanitize_input($_GET['mngUserSuccess']);
                  $mngUserMsg = sanitize_input($_GET['mngUserMsg']);
                  if ($mngUserSuccess == "true") {
                    echo '<div class="msg-container" style="background: rgba(45, 197, 45, 0.665);border: 2px solid rgb(23, 210, 23);">';
                    echo "<span> {$mngUserMsg} </span>";
                    echo '</div>';
                  } else {
                    echo '<div class="msg-container" style="background: rgba(255, 43, 43, 0.707);border: 1px solid rgb(255, 0, 0);">';
                    echo "<span> {$mngUserMsg} </span>";
                    echo '</div>';
                  }
                }
                ?>
                <div class="form-outline mb-3">
                  <input type="text" class="form-control form-control-lg" id="mng-username" name="mng-username"
                    value="<?= $_SESSION["mngUserName"] ?? '' ?>" maxlength="20" required>
                  <label for="mng-username" class="form-label">Username/UserID</label>
                </div>
                <select class="form-select mb-3 mng-user-action" id="mng-user-action" name="mng-user-action"
                  aria-label="Manage User Action">
                  <option value="suspend">Suspend</option>
                  <option value="unsuspend">Unsuspend</option>
                  <option value="delete">Delete</option>
                </select>
                <div class="form-outline mb-3 item-name mng-suspend-duration">
                  <input type="number" class="form-control form-control-lg" id="mng-suspend-duration"
                    name="mng-suspend-duration">
                  <label for="mng-suspend-duration" class="form-label">Days of Account Suspension (leave black for
                    indefinite)</label>
                </div>
                <div class="form-outline mb-3 item-name">
                  <input type="password" class="form-control form-control-lg" id="user-admin-key" name="user-admin-key"
                    required>
                  <label for="user-admin-key" class="form-label">Admin key</label>
                </div>

                <div class="pt-1 mb-3">
                  <button class="btn btn-dark btn-lg btn-block submit-button mng-user-btn" id="mng-user-btn"
                    type="submit">
                    suspend account
                  </button>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="v-tabs-orders" role="tabpanel" aria-labelledby="v-tabs-orders-tab">
              Manage orders content
            </div>
          </div>
          <!-- Tab content -->
        </div>
      </div>
    </div>
  </main>
  <?php include_once "include/footer.inc.php"; ?>
</body>

</html>