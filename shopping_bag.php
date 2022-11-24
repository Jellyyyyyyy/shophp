<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CART</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/shopping_bag.css">
  <script>
  let totalCost = "10.00"

  function onVisaCheckoutReady() {
    V.init({
      apikey: "3V3OR5G8DJXTGQ4TQZYI21eZqnsETcg7z-49s08D7UMqfjrvE",
      encryptionKey: "BOOPY01VJDM2QI4M6B4P13kV-che-E8ZpBFvnM5iGXschQDrM",
      settings: {
        shipping: {
          acceptedRegions: ["SG"],
          collectShipping: "true",
        },
      },
      paymentRequest: {
        currencyCode: "SGD",
        subtotal: totalCost,
      },
    });
    V.on("payment.success", function(payment) {
      console.log(JSON.stringify(payment));
    });
    V.on("payment.cancel", function(payment) {
      console.log(JSON.stringify(payment));
    });
    V.on("payment.error", function(payment, error) {
      console.log(JSON.stringify(payment) + "\n" + JSON.stringify(error));
    });
  }
  </script>
</head>

<body>
  <?php include_once "include/nav.inc.php" ?>
  <main>
    <section id="description">
      <div class="jumbotron" id="displayJumbo">
        <div class="row">
          <div class="col-md-4">
            <h1 class="hugeText">CART</h1>
            <p class="paraText">Thank you for shopping with us! We hope you come back again!</p>
          </div>
          <div class="col-md-8"></div>
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
          <div class="row">
            <div class="col-md-5">
              <div class="productImg">
                <img src="images/login_page_photo.jpeg" alt="">
              </div>  
            </div>
            <div class="col-md-7">
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
          <div class="visaBtn">
            <img alt="Visa Checkout" class="v-button" role="button"
              src="https://sandbox.secure.checkout.visa.com/wallet-services-web/xo/button.png">
          </div>
        </div>
      </div>
      
      <script src="https://sandbox-assets.secure.checkout.visa.com/checkout-widget/resources/js/integration/v1/sdk.js">

      </script>
    </div>
    </div>
    <?php include_once "include/footer.inc.php" ?>
  </main>
</body>

</html>

