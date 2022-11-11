<!-- Start of nav bar -->
<?php session_start(); ?>
<aside class="logged-in-state" style="display: none" data-state="<?php echo isset($_SESSION['user']) ? 'true' : 'false' ?>"></aside>
<header class="nav-main">
  <nav>
    <!-- For mobile part -->
    <ul class="nav-menu-mobile">
      <li class="menu-icon-container">
        <div class="menu-icon">
          <span class="line-1"></span>
          <span class="line-2"></span>
        </div>
      </li>
      <li>
        <a href="home">
          <img src="images/shophp.jpeg" alt="shophp logo" />
        </a>
      </li>
      <li class="mobile-user-icon d-flex align-items-center justify-content-center">
        <a href="#"><i class="bx bx-user nav-user-icon"></i></a>
      </li>
    </ul>
    <!-- Main nav part -->
    <ul class="nav-menu">
      <li class="logo">
        <a href="home"><img class="nav-logo" src="images/shophp.jpeg" alt="shophp logo" /></a>
      </li>
      <li><a href="#">Trending</a></li>
      <li><a href="#">New</a></li>
      <li><a href="#">Clothing</a></li>
      <li><a href="#">Bags</a></li>
      <li><a href="#">Accessories</a></li>
      <li><a href="#">Sale</a></li>
      <li>
        <a href="#" class="nav-search-icon"><i class="bx bx-search-alt-2 nav-toggle-menu nav-search-icon"></i></a>
      </li>
      <li>
        <a id="nav-user" class="nav-user" style="cursor: pointer;">
          <i class="bx bx-user main-nav-user-icon"></i>
        </a>
      </li>
    </ul>
  </nav>
  <div class=" search-container hide">
    <i class="bx bx-search-alt-2"></i>
    <div class="seach-bar">
      <form action="">
        <input autofocus type="text" placeholder="Search shoPHP.shop..." spellcheck="false" autocomplete="off" id="search-field" />
      </form>
    </div>
    <i class="bx bx-x nav-toggle-menu"></i>
  </div>
</header>
<div class="overlay nav-toggle-menu"></div>
<!-- End of nav bar -->