<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CLOTHING</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/pages.css" />
  <script src="js/clothing.js" defer></script>
</head>

<body>
    <?php 
        include_once "include/nav.inc.php" 
    ?>
    <section id="description">
        <div class="jumbotron" id="displayJumbo">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="hugeText">CLOTHING</h1>
                    <p class="paraText">Everyday essentials in earth and minimalist colour tones help you look modern and chic.</p>
                </div>
            </div>
        </div>
    </section>
    <div class="main-container">
        <div class="grid-container">
            <template class="card-template">
                <div class="card col-md-4">
                    <div class="arrow-previous arrow">
                        <i class='bx bxs-left-arrow'></i>
                    </div>
                    <div class="imageDIV">
                        <img data-item-image>
                    </div>
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
        </div>
    </div>
    <script>
    <?php
        include_once "include/functions.inc.php";
        foreach (getItems("clothing") as $item) {
        foreach ($item as $key => $value) {
            if (strpos($value, "'") && $key !== "image") $item[$key] = str_replace("'", "&#39;", $item[$key]);
            if (strpos($value, '"') && $key !== "image") $item[$key] = str_replace('"', "&#34;", $item[$key]);
            if (strpos($value, ')') && $key !== "image") $item[$key] = str_replace(')', "&#41;", $item[$key]);
        }
        echo "addCard('{$item["image"]}', '{$item["category"]}', '{$item["stock"]}', '{$item["name"]}', '{$item["price"]}', '.grid-container');";
     }
     ?> 
    </script>
    <?php
        include_once "include/footer.inc.php"
    ?>
</body>

