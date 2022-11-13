<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>shoPHP</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/index.css" />
  <script src="js/index.js" defer></script>
</head>

<body>
  <header class="head">
    <?php include_once "include/nav.inc.php" ?>
  </header>
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
        <div class="banner first">
          <h3 class="banner-text-top">DISCOVER YOUR STYLE.</h3>
          <h1 class="banner-text-main">STREETWEAR</h1>
          <a href="#" id="link">
            <h3 class="banner-text-bottom">CHECK OUT STREETWEAR ITEMS HERE</h3>
          </a>
        </div>
        <div class="banner" style="background-image: url('/images/index/streetwearcoup.jpg');">
          <h3 class="banner-text-top">DISCOVER YOUR STYLE.</h3>
          <h1 class="banner-text-main">STREETWEAR</h1>
          <a href="#" id="link">
            <h3 class="banner-text-bottom">CHECK OUT STREETWEAR ITEMS HERE</h3>
          </a>
        </div>
        <div class="banner" style="background-image: url('/images/index/streetwearkids.jpg');">
          <h3 class="banner-text-top">DISCOVER YOUR STYLE.</h3>
          <h1 class="banner-text-main">STREETWEAR</h1>
          <a href="#" id="link">
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
        <a id="viewAll" href="#"><h2 class="sectionHeader">VIEW ALL</h2></a>
      </div>
      <div class="main-container">
        <div class="grid-container">
        </div>
      </div>
    </section>
    <section id="displayWindow">
      <div class="jumbotron" id="displayJumbo">
        <div class="container streetwearTitle">
          <div class="row">
            <div class="col-md-6" id="swTitle">
              <h1 class="hugeText">STREETWEAR LOOKBOOKS</h1>
              <p>We know it can be hard to get into streetwear without inspiration. Here are some of our favourites to keep your outfit ideas fresh!</p>
            </div>
            <div class="col-md-6" id="inspoPics">
              <div id="carouselExampleInterval" class="carousel slide" data-mdb-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active" data-mdb-interval="3000">
                    <a href="https://instagram.com/handdongs?igshid=YmMyMTA2M2Y=">
                      <img src="/images/index/handong.jpeg" class="d-block w-100" alt="handong"></img>
                    </a>
                  </div>
                  <div class="carousel-item" data-mdb-interval="3000">
                    <a href="https://instagram.com/vansatthemetgala?igshid=YmMyMTA2M2Y=">
                      <img src="/images/index/christianvui.jpeg" class="d-block w-100" alt="christianvui"></img>
                    </a>
                  </div>
                  <div class="carousel-item" data-mdb-interval="3000">
                    <a href="https://instagram.com/timdessaint?igshid=YmMyMTA2M2Y=">
                      <img src="/images/index/timdessaint.jpeg" class="d-block w-100" alt="timdessaint"></img>
                    </a>
                  </div>
                </div>
                <!--<button class="carousel-control-prev" data-mdb-target="#carouselExampleInterval" type="button" data-mdb-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" data-mdb-target="#carouselExampleInterval" type="button" data-mdb-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>-->
              </div>
              <!--<img src="/images/index/handong.jpeg"></img>-->
            </div>
          </div>
        </div>
        
      </div>
    </section>
    <section id="trendingItems">
        <div class="descriptionBar">
          <h2 class="sectionHeader">TRENDING ITEMS</h2>
          <h2 class="sectionHeader"><a id="viewAll" href="#">VIEW ALL</a></h2>
        </div>
        <div class="main-container">
          <div class="grid-container2">
          </div>
        </div>
    </section>
  </main>


  <template class="card-template">
    <div class="card col-md-3">
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

  <section id="carou">
    
  </section>
</body>

<?php include_once "include/footer.inc.php" ?>
</html>