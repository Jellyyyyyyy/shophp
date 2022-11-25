<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CLOTHING</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/pages.css">
  <script src="js/addCard.js" defer></script>
</head>

<body>
  <?php 
  include_once "include/nav.inc.php";
  include_once "include/functions.inc.php";
  include_once "include/dbcon.inc.php";
  
  if (!empty(isset($_SESSION["user"]))) {
    addWishlistToDB();
    $wishlist = getWishlistFromDB();
    if ($wishlist !== "No items found") {
      setcookie("wishlistItems", $wishlist);
    }
  }
  ?>
  <main>
    <section id="description">
      <div class="jumbotron" id="displayJumbo">
        <div class="row">
          <div class="col-md-4">
            <h1 class="hugeText">CLOTHING</h1>
            <p class="paraText">Everyday essentials in earth and minimalist colour tones help you look modern and chic.
            </p>
          </div>
        </div>
      </div>
    </section>
    <div class="grid-container">
      <template class="card-template">
        <div class="card col-md-4">
          <div class="icons">
            <i class='bx bx-sm bx-bookmark bx-tada-hover add-to-wishlist' data-mdb-toggle="tooltip"
              title="Add to wishlist"></i>
            <i class='bx bx-sm bx-cart-add bx-tada-hover add-to-cart' data-mdb-toggle="tooltip" title="Add to cart"></i>
          </div>
          <img data-item-image onerror="this.onerror=null;this.src='images/no_image_found.jpg'">
          <div class="text-container">
            <div class="category-container">
              <span data-item-category></span>
              <span data-item-size></span>
            </div>
            <span data-item-name></span>
            <span data-item-price></span>
          </div>
        </div>
      </template>
    </div>
    <div class="modal-overlay hide"></div>
  </main>
  <template data-modal-template>
    <div class="fluid-container item-modal hide">
      <i class='bx bx-x bx-lg close-modal' style="cursor: pointer;"></i>
      <img class="col-6" src="images/index/handong.jpeg" data-modal-img>
      <div class="col-6 item-content">
        <div class="item-text mb-2">
          <span data-modal-name></span>
          <span style="font-weight: bold;" data-modal-price></span>
          <span class="pre-wrap-text" data-modal-desc></span>
        </div>
        <div class="item-more-details mb-2">
          <button class="btn mb-3 more-details details-btn" type="button" data-mdb-toggle="collapse"
            data-mdb-target="#details" aria-expanded="false" aria-controls="details">
            Details
            <i class='bx bx-chevron-down'></i>
          </button>
          <div class="pre-wrap-text collapse my-3" id="details" data-modal-details>
          </div>
          <button class="btn mb-3 more-details materials-btn" type="button" data-mdb-toggle="collapse"
            data-mdb-target="#materials" aria-expanded="false" aria-controls="materials">
            Materials
            <i class='bx bx-chevron-down'></i>
          </button>
          <div class="pre-wrap-text collapse my-3" id="materials" data-modal-materials>
          </div>
          <button class="btn mb-3 more-details policy-btn" type="button" data-mdb-toggle="collapse"
            data-mdb-target="#return-policy" aria-expanded="false" aria-controls="return-policy">
            Return Policy
            <i class='bx bx-chevron-down'></i>
          </button>
          <div class="collapse my-3" id="return-policy">
            See our return/refund policy <a href="returnpolicy">here</a>.
          </div>
        </div>
        <div class="item-actions">
          <div class="form-outline w-50 mx-2">
            <input type="number" class="form-control form-control-lg active item-quantity" id="item-quantity"
              name="item-quantity" maxlength="2" value="1" min="0">
            <label for="item-quantity" class="form-label quantity-label">Quantity</label>
          </div>
          <select class="form-select w-25" name="item-size" aria-label="item size" data-size-select>
          </select>
          <button class="btn btn-dark add-to-cart">Add to cart</button>
        </div>
      </div>
    </div>
  </template>

  <script>
  <?php
    echo "window.addEventListener('load', () => {";
    $clothing = getItems("clothing");
    if (!is_array($clothing)) {
      echo "let child = document.createElement('h1');";
      echo "child.textContent = '{$clothing}';";
      echo "document.querySelector('main').appendChild(child);";
      echo "});";
    } else {
      foreach ($clothing as $item) {
        echo "addCard($item, '.grid-container');";
      }
      echo "});";
    }
    ?>
  </script>
  <?php include_once "include/footer.inc.php" ?>
</body>

</html>