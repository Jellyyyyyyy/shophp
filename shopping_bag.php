<?php 
include_once "include/functions.inc.php";
include_once "include/dbcon.inc.php";
if (isset($_COOKIE["cartItems"]) && !empty($_COOKIE["cartItems"])) {
  $itemsArr = explode(",", $_COOKIE["cartItems"]);
  $uniqueItemsArr = array_unique($itemsArr);
  $itemQuantity = array_count_values($itemsArr);
  $totalCost = 10;
  foreach ($itemsArr as $item) {
    $priceQuery = $conn->prepare("SELECT * FROM items WHERE name=?");
    $priceQuery->bind_param("s", $item);
    $priceQuery->execute();
    $result = $priceQuery->get_result();
    if ($result->num_rows > 0) {
      $itemDetails = $result->fetch_assoc();
      $totalCost += $itemDetails["price"];
  }
}
$priceQuery->close();
}
?>
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
  function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
    let expiryDate = d.toUTCString();
    document.cookie = `${name}=${value}; expires=${expiryDate}`;
  }
  let totalCost = "<?= $totalCost ?>"

  function onVisaCheckoutReady() {
    let postPayment;
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
      postPayment = JSON.stringify(payment);
      setCookie("postpayment", postPayment)
      window.location.pathname = "/postpayment"
    });
    V.on("payment.cancel", function(payment) {
      postPayment = JSON.stringify(payment);
    });
    V.on("payment.error", function(payment, error) {
      postPayment = JSON.stringify(payment) + "\n" + JSON.stringify(error);
    });
  }
  </script>
  <script src="js/cart.js" defer></script>
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

    <div class="fluid-container h-100 w-100 cart-container">
      <div class="items">

        <?php 
        include_once "include/functions.inc.php";
        include_once "include/dbcon.inc.php";
        if (isset($_COOKIE["cartItems"]) && !empty($_COOKIE["cartItems"])) {
          foreach ($uniqueItemsArr as $item) {
            $query = $conn->prepare("SELECT * FROM items WHERE name=?");
            $query->bind_param("s", $item);
            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows > 0) {
              $itemDetails = $result->fetch_assoc();
              echo "<div class='item'>
                      <aside style='display: none;' data-item-price='{$itemDetails['price']}'></aside>
                      <img src='{$itemDetails["image"]}' alt='{$itemDetails["name"]}'>
                      <div class='item-details'>
                        <div class='item-name'>
                          <span>{$itemDetails["name"]}</span>
                        </div>
                        <div class='item-quantity'>
                          <i class='bx bx-sm bx-tada-hover bx-minus-circle quantity-minus'></i>
                          {$itemQuantity[$itemDetails['name']]}
                          <i class='bx bx-sm bx-tada-hover bx-plus-circle quantity-add'></i>
                        </div>
                        <div class='size'>
                          <select class='select'>
                            <option value='XS'>XS</option>
                            <option value='S'>S</option>
                            <option value='M'>M</option>
                            <option value='L'>L</option>
                            <option value='XL'>XL</option>
                          </select>
                        </div>
                        <div class='item-price' data-item-price>$" . $itemDetails["price"] * $itemQuantity[$itemDetails['name']] . "</div>
                      </div>
                    </div>";
            }
          }
        } else {
          echo "<span>No items found</span>";
        }
        ?>
      </div>

      <div class="price-container">
        <div class="price-content">
          <div class="price-subcontent">
            <span>Subtotal</span>
            <span data-subtotal></span>
          </div>
          <div class="price-subcontent">
            <span>Shipping</span>
            <span>$10</span>
          </div>
          <div class="price-subcontent total">
            <span>Your Total</span>
            <span data-total></span>
          </div>
          <span class="price-info" data-gst>Includes GST of $0</span>
          <div class="visaBtn">
            <img alt="Visa Checkout" class="v-button" role="button"
              src="https://sandbox.secure.checkout.visa.com/wallet-services-web/xo/button.png">
          </div>
        </div>
      </div>

      <script src="https://sandbox-assets.secure.checkout.visa.com/checkout-widget/resources/js/integration/v1/sdk.js">

      </script>
    </div>
    <?php include_once "include/footer.inc.php" ?>
  </main>
</body>

</html>