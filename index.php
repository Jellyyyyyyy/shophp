<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>shoPHP</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/index.css">
  <script src="js/index.js" defer></script>
</head>

<body>
  <?php include_once "include/nav.inc.php" ?>
  <main>
    <div class="carousel">
      <div class="left-arrow arrow">
        <i class='bx bx-chevron-left'></i>
      </div>
      <div class="slides">
        <input type="radio" name="radio-btn-1" id="radio1" checked>
        <input type="radio" name="radio-btn-2" id="radio2">
        <input type="radio" name="radio-btn-3" id="radio3">
        <div class="radio-btns">
          <label for="radio1" class="radio-label"></label>
          <label for="radio2" class="radio-label"></label>
          <label for="radio3" class="radio-label"></label>
        </div>
        <div class="banner first" id="banner1">
          <h3 class="banner-text-top">DISCOVER YOUR STYLE.</h3>
          <h1 class="banner-text-main">STREETWEAR</h1>
          <a href="#" class="banner-link">
            <h3 class="banner-text-bottom">CHECK OUT STREETWEAR ITEMS HERE</h3>
          </a>
        </div>
        <div class="banner" style="background-image: url('/images/index/streetwearcoup.jpg');" id="banner2">
          <h3 class="banner-text-top">DISCOVER YOUR STYLE.</h3>
          <h1 class="banner-text-main">STREETWEAR</h1>
          <a href="#" class="banner-link">
            <h3 class="banner-text-bottom">CHECK OUT STREETWEAR ITEMS HERE</h3>
          </a>
        </div>
        <div class="banner" style="background-image: url('/images/index/streetwearkids.jpg');" id="banner3">
          <h3 class="banner-text-top">DISCOVER YOUR STYLE.</h3>
          <h1 class="banner-text-main">STREETWEAR</h1>
          <a href="#" class="banner-link">
            <h3 class="banner-text-bottom">CHECK OUT STREETWEAR ITEMS HERE</h3>
          </a>
        </div>
      </div>
      <div class="right-arrow arrow">
        <i class='bx bx-chevron-right'></i>
      </div>
    </div>


    <section id="recentProducts">
      <div class="descriptionBar">
        <h2 class="sectionHeader">NEW RELEASES</h2>
        <a class="viewAll" href="newitems">
          <h2 class="sectionHeader">VIEW ALL</h2>
        </a>
      </div>
      <div class="main-container">
        <div class="grid-container">
          <?php 
          include_once "include/dbcon.inc.php";
          include_once "include/functions.inc.php";
          $cards = getItems("new", 4);
          if ($cards !== "No items found.") {
            foreach ($cards as $card) {
              $card = json_decode($card, true);
              $stock = refineSize($card["stock"]);

              echo "
              <div class='card col-md-4'>
                <div class='icons'>
                  <i class='bx bx-sm bx-bookmark bx-tada-hover add-to-wishlist' title='Add to wishlist'></i>
                  <i class='bx bx-sm bx-cart-add bx-tada-hover add-to-cart' title='Add to cart'></i>
                </div>
                <img src='{$card['image']}' alt='{$card['name']}'>
                <div class='text-container'>
                  <div class='category-container'>
                    <span>{$card['category']}</span>
                    <span>{$stock}</span>
                  </div>
                  <span data-item-name>{$card['name']}</span>
                  <span>$" . "{$card['price']}</span>
                </div>
              </div>";
              }
            }
          ?>
        </div>
      </div>
    </section>
    <section id="displayWindow">
      <div class="jumbotron" id="displayJumbo">
        <div class="container streetwearTitle">
          <div class="row">
            <div class="col-md-6" id="swTitle">
              <h1 class="hugeText">STREETWEAR LOOKBOOKS</h1>
              <p class="lookbookDesc">We know it can be hard to get into streetwear without inspiration. Here are some
                of our favourites to
                keep your outfit ideas fresh!</p>
            </div>
            <div class="col-md-6" id="inspoPics">
              <div id="carouselExampleInterval" class="carousel slide" data-mdb-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active" data-mdb-interval="3000">
                    <a href="https://instagram.com/handdongs?igshid=YmMyMTA2M2Y=">
                      <img src="/images/index/handong.jpeg" class="d-block w-100" alt="handong">
                    </a>
                  </div>
                  <div class="carousel-item" data-mdb-interval="3000">
                    <a href="https://instagram.com/vansatthemetgala?igshid=YmMyMTA2M2Y=">
                      <img src="/images/index/christianvui.jpeg" class="d-block w-100" alt="christianvui">
                    </a>
                  </div>
                  <div class="carousel-item" data-mdb-interval="3000">
                    <a href="https://instagram.com/timdessaint?igshid=YmMyMTA2M2Y=">
                      <img src="/images/index/timdessaint.jpeg" class="d-block w-100" alt="timdessaint">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <section id="trendingItems">
      <div class="descriptionBar">
        <h2 class="sectionHeader">TRENDING ITEMS</h2>
        <h2 class="sectionHeader"><a class="viewAll" href="trending">VIEW ALL</a></h2>
      </div>
      <div class="main-container">
        <div class="grid-container">
          <?php 
          include_once "include/dbcon.inc.php";
          include_once "include/functions.inc.php";
          $cards = getItems("trending", 4);
          if ($cards !== "No items found.") {
            foreach ($cards as $card) {
              $card = json_decode($card, true);
              $stock = refineSize($card["stock"]);

              echo "
              <div class='card col-md-4'>
                <div class='icons'>
                  <i class='bx bx-sm bx-bookmark bx-tada-hover add-to-wishlist' title='Add to wishlist'></i>
                  <i class='bx bx-sm bx-cart-add bx-tada-hover add-to-cart' title='Add to cart'></i>
                </div>
                <img src='{$card['image']}' alt='{$card['name']}'>
                <div class='text-container'>
                  <div class='category-container'>
                    <span>{$card['category']}</span>
                    <span>{$stock}</span>
                  </div>
                  <span data-item-name>{$card['name']}</span>
                  <span>$" . "{$card['price']}</span>
                </div>
              </div>";
              }
            }
          ?>
        </div>
      </div>
    </section>
  </main>
  <?php include_once "include/footer.inc.php" ?>
</body>


</html>