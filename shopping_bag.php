<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/shopping_bag.css">
  <!-- <script src="js/.js" defer></script> -->
</head>

<body>
  <?php include_once "include/nav.inc.php" ?>
  <main>
    <section id="description">
      <div class="jumbotron" id="displayJumbo">
        <div class="row">
          <div class="col-md-4">
            <h1 class="hugeText">CHECKOUT</h1>
            <p class="paraText">Thank you for shopping with us! We hope you come back again!</p>
          </div>
        </div>
      </div>
    </section>
    <div class="fluid-container mb-4 h-100 w-100 cart-container">
      <!--<div class="title-text">
        <h1>Your bag total is $3000</h1>
        <button class="btn btn-dark mt-2">Check out</button>
      </div>-->
      <div class="items">
        <div class="item">
          <img src="images/login_page_photo.jpeg" alt="">
          <div class="item-details">
            <div class="item-name">
              <span>BAG OF AWESOMENESS</span>
            </div>
            <div class="item-quantity">
              <i class='bx bx-sm bx-tada-hover bx-minus-circle'></i>
              1
              <i class='bx bx-sm bx-tada-hover bx-plus-circle'></i>
            </div>
            <div class="item-price">S$100</div>
          </div>
        </div>
        <div class="item">
          <img src="images/login_page_photo.jpeg" alt="">
          <div class="item-details">
            <div class="item-name">BAG</div>
            <div class="item-quantity">
              <i class='bx bx-sm bx-tada-hover bx-minus-circle'></i>
              1
              <i class='bx bx-sm bx-tada-hover bx-plus-circle'></i>
            </div>
            <div class="item-price">S$100</div>
          </div>
        </div>
      </div>
      <div class="price-container">
        <div class="price-content">
          <div class="price-subcontent">
            <span>Subtotal</span>
            <span>S$100</span>
          </div>
          <div class="price-subcontent">
            <span>Shipping</span>
            <span>S$10</span>
          </div>
          <div class="price-subcontent total">
            <span>Your Total</span>
            <span>$110</span>
          </div>
          <span class="price-info">Includes GST of $0</span>
        </div>
      </div>
      <div class="checkout-btn">
        <button class="btn btn-dark mt-2">Check out</button>
      </div>
    </div>
  </main>
  <?php include_once "include/footer.inc.php" ?>
</body>

</html>