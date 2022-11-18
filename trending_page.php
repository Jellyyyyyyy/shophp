<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TRENDING</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/pages.css" />
  <script src="js/trending.js" defer></script>
</head>

<body>
  <?php 
        include_once "include/nav.inc.php" 
    ?>
  <section id="description">
    <div class="jumbotron" id="displayJumbo">
      <div class="row">
        <div class="col-md-4">
          <h1 class="hugeText">TRENDING</h1>
          <p class="paraText">From oversized jackets to wide fit pants, check out the hottest items that people have
            been buying this season!</p>
        </div>
      </div>
    </div>
  </section>
  <div class="container" style="height: 10em;">
  </div>
  <?php include_once "include/footer.inc.php" ?>
</body>