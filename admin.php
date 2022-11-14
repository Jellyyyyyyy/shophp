<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/admin.css">
  <script src="js/admin.js"></script>
</head>

<body>
  <?php include_once "include/nav.inc.php" ?>
  <main>
    <div class="row w-100">
      <div class="col-3">
        <!-- Tab navs -->
        <div class="nav flex-column nav-tabs text-center" id="v-tabs-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="v-tabs-upload-listing-tab" data-mdb-toggle="tab" href="#v-tabs-upload-listing"
            role="tab" aria-controls="v-tabs-upload-listing" aria-selected="true">Upload listing</a>
          <a class="nav-link" id="v-tabs-manage-listing-tab" data-mdb-toggle="tab" href="#v-tabs-manage-listing"
            role="tab" aria-controls="v-tabs-manage-listing" aria-selected="false">Manage listing</a>
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
          <div class="tab-pane fade show active" id="v-tabs-upload-listing" role="tabpanel"
            aria-labelledby="v-tabs-upload-listing-tab">
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
                  value="<?php echo $_SESSION["itemname"] ?? '' ?>" required>
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
                <option disabled selected value="category" disabled>Category</option>
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
          <div class="tab-pane fade" id="v-tabs-manage-listing" role="tabpanel"
            aria-labelledby="v-tabs-manage-listing-tab">
            <form action="" style="width: 60%;">
              <h2>Upload item</h2>
              <div class="form-outline mb-4 item-name">
                <input type="text" class="form-control form-control-lg" id="item-name" name="item-name" required>
                <label for="item-name" class="form-label item-name">Item name</label>
              </div>

              <div class="form-outline mb-4 item-desc">
                <textarea type="text" class="form-control form-control-lg " data-mdb-showcounter="true" id="item-desc"
                  name="item-name" maxlength="500" required style="height: 10rem;"></textarea>
                <label for="item-desc" class="form-label item-desc">Description</label>
                <div class="form-helper"></div>
              </div>

              <select class="form-select mb-4 item-category" name="item-category" aria-label="Item category">
                <option selected value="category" disabled>Category</option>
                <option value="clothing">Clothing</option>
                <option value="bags">Bags</option>
                <option value="accessories">Accessories</option>
              </select>

              <h5>Stock</h5>
              <div class="d-flex flex-row justify-content-between">
                <div class="form-outline mb-4 item-size">
                  <input type="number" class="form-control form-control-lg" id="item-size-XS" name="item-size-XS"
                    required>
                  <label for="item-size-XS" class="form-label">XS</label>
                </div>
                <div class="form-outline mb-4 item-size">
                  <input type="number" class="form-control form-control-lg" id="item-size-S" name="item-size-S"
                    required>
                  <label for="item-size-S" class="form-label">S</label>
                </div>
                <div class="form-outline mb-4 item-size">
                  <input type="number" class="form-control form-control-lg" id="item-size-M" name="item-size-M"
                    required>
                  <label for="item-size-M" class="form-label">M</label>
                </div>
                <div class="form-outline mb-4 item-size">
                  <input type="number" class="form-control form-control-lg" id="item-size-L" name="item-size-L"
                    required>
                  <label for="item-size-L" class="form-label">L</label>
                </div>
                <div class="form-outline mb-4 item-size">
                  <input type="number" class="form-control form-control-lg" id="item-size-XL" name="item-size-XL"
                    required>
                  <label for="item-size-XL" class="form-label">XL</label>
                </div>
              </div>

              <label for="item-img" class="form-label">Upload images</label>
              <input class="form-control mb-4" type="file" id="item-img" name="item-img" multiple />

              <div class="pt-1 mb-4">
                <button class="btn btn-dark btn-lg btn-block submit-button" type="submit">
                  Upload
                </button>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="v-tabs-users" role="tabpanel" aria-labelledby="v-tabs-users-tab">
            Manage users content
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
  <?php include_once "include/footer.inc.php" ?>
</body>

</html>