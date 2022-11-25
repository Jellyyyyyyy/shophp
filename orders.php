<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COMING SOON...</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/pages.css">
  <script src="js/.js" defer></script>
</head>

<body>
  <?php 
  include_once "include/nav.inc.php";
  include_once "include/session.inc.php"; // checks if they are logged in
  ?>
  <main style="height: 50em;">
    <section id="description">
      <div class="jumbotron" id="displayJumbo">
        <div class="row">
          <div class="col-md-4">
            <h1 class="hugeText">ORDERS</h1>
            <p class="paraText">Thank you for ordering! Your items are on the way!</p>
          </div>
        </div>
      </div>
    </section>
    <div class="comgSoon" style="display: flex; text-align: center;">
      <h1 style="font-weight: 700; padding-top: 3em;">FEATURE COMING SOON...</h1>
    </div>
  </main>
  <?php include_once "include/footer.inc.php" ?>
</body>

</html>