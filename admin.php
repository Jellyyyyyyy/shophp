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
  // include_once "include/dbcon.inc.php";
  ?>
  <main style="min-height: 85vh;">
    <div class="row w-100">
      <div class="col-3">
        <!-- Tab navs -->
        <div class="nav flex-column nav-tabs text-center" id="v-tabs-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link <?php echo isset($_GET["uploadSuccess"]) || empty($_GET) ? 'active' : '' ?>"
            id="v-tabs-upload-listing-tab" data-mdb-toggle="tab" href="#v-tabs-upload-listing" role="tab"
            aria-controls="v-tabs-upload-listing" aria-selected="true">Upload listing</a>
          <a class="nav-link <?php echo isset($_GET["manageSuccess"]) ? 'active' : '' ?>" id="v-tabs-manage-listing-tab"
            data-mdb-toggle="tab" href="#v-tabs-manage-listing" role="tab" aria-controls="v-tabs-manage-listing"
            aria-selected="false">Manage listing</a>
          <a class="nav-link" id="v-tabs-users-tab" data-mdb-toggle="tab" href="#v-tabs-users" role="tab"
            aria-controls="v-tabs-users" aria-selected="false">Manage users</a>
          <a class="nav-link" id="v-tabs-reviews-tab" data-mdb-toggle="tab" href="#v-tabs-reviews" role="tab"
            aria-controls="v-tabs-reviews" aria-selected="false">Manage reviews</a>
          <a class="nav-link" id="v-tabs-orders-tab" data-mdb-toggle="tab" href="#v-tabs-orders" role="tab"
            aria-controls="v-tabs-orders" aria-selected="false">Manage orders</a>
        </div>
        <!-- Tab navs -->
      </div>

      <div class="col-9">
        <!-- Tab content -->
        <div class="tab-content" id="v-tabs-tabContent">
          <div class="tab-pane fade <?php echo isset($_GET["uploadSuccess"]) || empty($_GET) ? 'active show' : '' ?>"
            id="v-tabs-upload-listing" role="tabpanel" aria-labelledby="v-tabs-upload-listing-tab">
            <form action="process_adminUpload" method="post" target="_self" enctype="multipart/form-data"
              style="width: 60%;">
              <h2>Upload item</h2>
              <?php
              if (isset($_GET['uploadSuccess'])) {
                $uploadSuccess = $_GET['uploadSuccess'];
                $uploadMsg = $_GET['uploadMsg'];
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
              <div class="form-outline mb-4 item-name">
                <input type="text" class="form-control form-control-lg" id="item-name" name="item-name"
                  value="<?php echo $_SESSION["itemname"] ?? '' ?>" maxlength="20" required>
                <label for="item-name" class="form-label item-name">Item name</label>
              </div>

              <div class="form-outline mb-4 item-desc">
                <textarea type="text" class="form-control form-control-lg " data-mdb-showcounter="true" id="item-desc"
                  name="item-desc" maxlength="500" style="height: 10rem;"
                  required><?php echo $_SESSION["itemdesc"] ?? '' ?></textarea>
                <label for="item-desc" class="form-label item-desc">Description</label>
                <div class="form-helper"></div>
              </div>

              <select class="form-select mb-4 item-category" name="item-category" aria-label="Item category" required>
                <option disabled selected>Category</option>
                <option value="clothing">Clothing</option>
                <option value="bags">Bags</option>
                <option value="accessories">Accessories</option>
              </select>

              <label class="form-label" for="item-size">Stock</label>
              <div class="d-flex flex-row justify-content-between">
                <div class="form-outline mb-4 me-3 item-size">
                  <input type="number" class="form-control form-control-lg" id="item-size-XS" name="item-size-XS" min=0
                    value="<?php echo $_SESSION["xs"] ?? '' ?>" required>
                  <label for="item-size-XS" class="form-label">XS</label>
                </div>
                <div class="form-outline mb-4 me-3 item-size">
                  <input type="number" class="form-control form-control-lg" id="item-size-S" name="item-size-S" min=0
                    value="<?php echo $_SESSION["s"] ?? '' ?>" required>
                  <label for="item-size-S" class="form-label">S</label>
                </div>
                <div class="form-outline mb-4 me-3 item-size">
                  <input type="number" class="form-control form-control-lg" id="item-size-M" name="item-size-M" min=0
                    value="<?php echo $_SESSION["m"] ?? '' ?>" required>
                  <label for="item-size-M" class="form-label">M</label>
                </div>
                <div class="form-outline mb-4 me-3 item-size">
                  <input type="number" class="form-control form-control-lg" id="item-size-L" name="item-size-L" min=0
                    value="<?php echo $_SESSION["l"] ?? '' ?>" required>
                  <label for="item-size-L" class="form-label">L</label>
                </div>
                <div class="form-outline mb-4 item-size">
                  <input type="number" class="form-control form-control-lg" id="item-size-XL" name="item-size-XL" min=0
                    value="<?php echo $_SESSION["xl"] ?? '' ?>" required>
                  <label for="item-size-XL" class="form-label">XL</label>
                </div>
              </div>

              <label for="item-img" class="form-label">Upload image</label>
              <input class="form-control mb-4" type="file" id="item-img" name="item-img" />

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

          <div class="tab-pane fade <?php echo isset($_GET["manageSuccess"]) ? 'show active' : '' ?>"
            id="v-tabs-manage-listing" role="tabpanel" aria-labelledby="v-tabs-manage-listing-tab">
            <?php
            // function putItemInSelect($category)
            // {
            //   global $conn;
            //   if ($conn->connect_error) {
            //     echo "<div>Connection to server failed. Please try again later.</div>";
            //   } else {
            //     $clothingQuery = $conn->prepare("SELECT * FROM items WHERE category=?");
            //     $clothingQuery->bind_param('s', $category);
            //     $clothingQuery->execute();
            //     $clothingResult = $clothingQuery->get_result();
            //     $clothingArr = array();
            //     if ($clothingResult->num_rows > 0) {
            //       while ($clothingRow = $clothingResult->fetch_assoc()) {
            //         $clothingArr[] = $clothingRow["name"];
            //       }
            //     } else {
            //       $clothingArr[] = "No items found";
            //     }
            //   }
            //   return $clothingArr;
            // }
            ?>

            <form action="process_adminItemEdit" method="post" target="_self" enctype="multipart/form-data"
              style="width: 60%;">
              <h2>Manage Listing</h2>
              <?php
              if (isset($_GET['manageSuccess'])) {
                $manageSuccess = $_GET['manageSuccess'];
                $manageMsg = $_GET['manageMsg'];
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
                <option selected value="edit">Edit</option>
                <option value="delete">Delete</option>
              </select>

              <select class="form-select mb-3" name="manage-chosen-item" aria-label="Item category" required>
                <option disabled selected>Choose Item</option>
                <optgroup label="Clothing">
                  <?php
                  // $clothings = putItemInSelect("clothing");
                  // if (gettype($clothings) == "array") {
                  //   foreach ($clothings as $item) {
                  //     echo "<option value='{$item}'>{$item}</option>";
                  //   }
                  // }
                  ?>
                </optgroup>
                <optgroup label="Bags">
                  <?php
                  // $bags = putItemInSelect("bags");
                  // if (gettype($bags) == "array") {
                  //   foreach ($bags as $item) {
                  //     echo "<option value='{$item}'>{$item}</option>";
                  //   }
                  // }
                  ?>
                </optgroup>
                <optgroup label="Accessories">
                  <?php
                  // $accessories = putItemInSelect("accessories");
                  // if (gettype($accessories) == "array") {
                  //   foreach ($accessories as $item) {
                  //     echo "<option value='{$item}'>{$item}</option>";
                  //   }
                  // }
                  ?>
                </optgroup>
              </select>

              <div class="edit-container">
                <h4 class="mb-2">Edit item</h4>
                <h6>Leave fields empty to make no changes</h6>
                <div class="form-outline mb-4">
                  <input type="text" class="form-control form-control-lg" id="manage-item-name" name="manage-item-name"
                    maxlength="20" value="<?php echo $_SESSION["manageItemName"] ?? '' ?>">
                  <label for="manage-item-name" class="form-label">Change Item name</label>
                </div>
                <div class="form-outline mb-4">
                  <textarea type="text" class="form-control form-control-lg " data-mdb-showcounter="true"
                    id="manage-item-desc" name="manage-item-desc" maxlength="500"
                    style="height: 10rem;"><?php echo $_SESSION["manageItemDesc"] ?? '' ?></textarea>
                  <label for="manage-item-desc" class="form-label">Change Description</label>
                  <div class="form-helper"></div>
                </div>
                <select class="form-select mb-4" name="manage-item-category" aria-label="Mangae Item category">
                  <option disabled selected>Change Category</option>
                  <option value="clothing">Clothing</option>
                  <option value="bags">Bags</option>
                  <option value="accessories">Accessories</option>
                  <option value="no-change">No change</option>
                </select>
                <label class="form-label" for="manage-item-size">Change Stock</label>
                <div class="d-flex flex-row justify-content-between">
                  <div class="form-outline mb-4 me-3">
                    <input type="number" class="form-control form-control-lg" id="manage-item-size-XS"
                      name="manage-item-size-XS" min=0 value="<?php echo $_SESSION["manageXs"] ?? '' ?>">
                    <label for="manage-item-size-XS" class="form-label">XS</label>
                  </div>
                  <div class="form-outline mb-4 me-3">
                    <input type="number" class="form-control form-control-lg" id="manage-item-size-S"
                      name="manage-item-size-S" min=0 value="<?php echo $_SESSION["manageS"] ?? '' ?>">
                    <label for="manage-item-size-S" class="form-label">S</label>
                  </div>
                  <div class="form-outline mb-4 me-3">
                    <input type="number" class="form-control form-control-lg" id="manage-item-size-M"
                      name="manage-item-size-M" min=0 value="<?php echo $_SESSION["manageM"] ?? '' ?>">
                    <label for="manage-item-size-M" class="form-label">M</label>
                  </div>
                  <div class="form-outline mb-4 me-3">
                    <input type="number" class="form-control form-control-lg" id="manage-item-size-L"
                      name="manage-item-size-L" min=0 value="<?php echo $_SESSION["manageL"] ?? '' ?>">
                    <label for="manage-item-size-L" class="form-label">L</label>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="number" class="form-control form-control-lg" id="manage-item-size-XL"
                      name="manage-item-size-XL" min=0 value="<?php echo $_SESSION["manageXl"] ?? '' ?>">
                    <label for="manage-item-size-XL" class="form-label">XL</label>
                  </div>
                </div>
                <label for="manage-item-img" class="form-label">Change image</label>
                <input class="form-control mb-4" type="file" id="manage-item-img" name="manage-item-img" />
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
          <div class="tab-pane fade" id="v-tabs-users" role="tabpanel" aria-labelledby="v-tabs-users-tab">
            <form action="process_adminUserEdit" method="post" target="_self" style="width: 60%;">
              <h2>Manage User</h2>
              <?php
              if (isset($_GET['mngUserSuccess'])) {
                $mngUserSuccess = $_GET['mngUserSuccess'];
                $mngUserMsg = $_GET['mngUserMsg'];
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
                <input type="text" class="form-control form-control-lg" id="mng-user-name" name="mng-user-name"
                  value="<?php echo $_SESSION["mngUserName"] ?? '' ?>" maxlength="20" required>
                <label for="mng-user-name" class="form-label">Username/UserID</label>
              </div>
              <select class="form-select mb-3 manage-user-action" name="manage-user-action"
                aria-label="Manage User Action">
                <option value="Suspend">Suspend</option>
                <option value="Unsuspend">Unsuspend</option>
                <option value="Delete">Delete</option>
              </select>
              <div class="form-outline mb-3 item-name">
                <input type="password" class="form-control form-control-lg" id="user-admin-key" name="user-admin-key"
                  required>
                <label for="user-admin-key" class="form-label">Admin key</label>
              </div>

              <div class="pt-1 mb-3">
                <button class="btn btn-dark btn-lg btn-block submit-button manage-user-btn" type="submit">
                  suspend account
                </button>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="v-tabs-reviews" role="tabpanel" aria-labelledby="v-tabs-reviews-tab">
            Manage reviews content
          </div>
          <div class="tab-pane fade" id="v-tabs-orders" role="tabpanel" aria-labelledby="v-tabs-orders-tab">
            Manage orders content
          </div>
        </div>
        <!-- Tab content -->
      </div>
    </div>
  </main>
  <?php include_once "include/footer.inc.php"; ?>
</body>

</html>