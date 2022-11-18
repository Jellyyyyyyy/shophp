<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BAGS</title>
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
          <h1 class="hugeText">BAGS</h1>
          <p class="paraText">What good is a killer outfit if you can't bring out your items with ease? Here are some
            stylish bags that will complement your outfit and provide you with some storage space simultaneously.</p>
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
    $bags = getItems("bags");
    if (!is_array($bags)) {
      echo "appendHtmlChild('h1', 'No items found', '.main-container');";
      echo "});";
    } else {
      foreach ($bags as $item) {
        echo "addCard('{$item["image"]}', '{$item["category"]}', '{$item["stock"]}', '{$item["name"]}', '{$item["price"]}', '.grid-container');";
      }
      echo "addEvents();";
      echo "});";
    }
    ?>
  </script>
  <?php include_once "include/footer.inc.php" ?>
</body>
</html>