<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ACCESSORIES</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/pages.css" />
  <script src="js/addCard.js"></script>
</head>

<body>
  <?php include_once "include/nav.inc.php" ?>
  <section id="description">
    <div class="jumbotron" id="displayJumbo">
      <div class="row">
        <div class="col-md-4">
          <h1 class="hugeText">ACCESSORIES</h1>
          <p class="paraText">Feel like your outfits are too basic? Have no fear, accesories can help to spice up your
            outfits and take them to the next level!</p>
        </div>
      </div>
    </div>
  </section>
  <div class="main-container">
    <div class="grid-container">
      <template class="card-template">
        <div class="card col-md-4">
          <div class="icons">
            <i class='bx bx-sm bx-bookmark bx-tada-hover add-to-wishlist'></i>
            <i class='bx bx-sm bx-cart-add bx-tada-hover add-to-cart'></i>
          </div>
          <img data-item-image>
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
  </div>

  <script>
  <?php
    include_once "include/functions.inc.php";
    echo "window.addEventListener('load', () => {";
    foreach (getItems("accessories") as $item) {
      echo "addCard('{$item["image"]}', '{$item["category"]}', '{$item["stock"]}', '{$item["name"]}', '{$item["price"]}', '.grid-container');";
    }
    echo "addEvents();";
    echo "});";
    ?>
  </script>
  <?php
        include_once "include/footer.inc.php"
    ?>
</body>