<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page not found</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/error404.css">
  <script src="js/error404.js" defer></script>
</head>

<body>
  <?php include_once "include/nav.inc.php" ?>
  <main class="error-main">
    <section>
      <h4>The page you're looking for can't be found.</h4>
    </section>
    <form action="search" method="post" target="_self" class="main-search-container">
      <i class='bx bx-search-alt-2 search-icon'></i>
      <input class="search-input" id="search" name="search-field" type="text" onchange="move_up()"
        autocomplete="off" aria-label="search">
      <label class="search-text" id="search-text" for="search">Search shoPHP products...</label>
    </form>
  </main>
  <?php include_once "include/footer.inc.php" ?>
</body>

</html>