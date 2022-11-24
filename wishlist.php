<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/pages.css">
  <script src="js/.js" defer></script>
</head>

<body>
  <?php 
  include_once "include/nav.inc.php";
  include_once "include/session.inc.php"; // checks if they are logged in
  ?>
  <main>
    <section id="description">
      <div class="jumbotron" id="displayJumbo">
        <div class="row">
          <div class="col-md-4">
            <h1 class="hugeText">WISHLIST</h1>
            <p class="paraText">Don't let your wallet stop your desire to look at clothes! Save your favourite items in your personal wishlist!</p>
          </div>
        </div>
      </div>
    </section>
    <div class="container" style="height: 10em;">
    </div>
  </main>
  <?php include_once "include/footer.inc.php" ?>
</body>

</html>