<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accessories</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/pages.css" />
  <script src="js/addCard.js"></script>
</head>

<body>
  <?php 
        include_once "include/nav.inc.php" 
    ?>
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

  <div class="container" style="height: 10em;">
    <template class="card-template">
      <div class="card col-md-4">
        <div class="arrow-previous arrow">
          <i class='bx bxs-left-arrow'></i>
        </div>

        <img data-item-image>
        <div class="text-container">
          <div class="category-container">
            <span data-item-category>UNISEX</span>
            <span data-item-size>XS-XL</span>
          </div>
          <span data-item-name>Pocketable Coat</span>
          <span data-item-price>$129.90</span>
        </div>
        <div class="arrow-next arrow">
          <i class='bx bxs-right-arrow'></i>
        </div>
      </div>
    </template>

    <script>
    // Load cards into webpage
    const cardTemplate = document.querySelector(".card-template");
    // Card functions
    function addArrowEvents() {
      const arrows = document.querySelectorAll(".card .arrow");
      const cards = document.querySelectorAll(".grid-container .card");
      let arrowArray = [...arrows],
        cardArray = [...cards],
        currentCard = 0;

      arrowArray.forEach((arrow) => {
        arrow.addEventListener("click", () => {
          cardArray.forEach((card) => (card.style.opacity = "0"));

          if (arrow.classList.contains("arrow-next")) {
            currentCard++;
            if (currentCard > cardArray.length - 1) currentCard = 0;
          } else if (arrow.classList.contains("arrow-previous")) {
            currentCard--;
            if (currentCard < 0) currentCard = cardArray.length - 1;
          }
          cardArray[currentCard].style.opacity = "1";
        });
      });
    }

    function addCard(imgSource, category, size, name, price) {
      const card = cardTemplate.content.cloneNode(true).children[0];
      const cardImg = card.querySelector("[data-item-image]");
      const cardCategory = card.querySelector("[data-item-category]");
      const cardSize = card.querySelector("[data-item-size]");
      const cardName = card.querySelector("[data-item-name]");
      const cardPrice = card.querySelector("[data-item-price]");

      cardImg.src = imgSource;
      cardCategory.textContent = category;
      cardSize.textContent = size;
      cardName.textContent = name;
      cardPrice.textContent = price;

      document.querySelector(".grid-container").appendChild(card);
    }
    <?php 
      include_once "include/functions.inc.php";
      foreach (getItems("bags") as $item) {
          echo "addCard('{$item["image"]}', '{$item["category"]}', '{$item["stock"]}', '{$item["name"]}', '{$item["price"]}', '.container');";
      }
    ?>
    </script>
  </div>
  <?php include_once "include/footer.inc.php" ?>
</body>