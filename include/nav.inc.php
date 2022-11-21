<!-- Start of nav bar -->
<?php session_start(); ?>
<aside class="states" style="display: none" data-login-state="<?php echo isset($_SESSION['user']) ? 'true' : 'false' ?>"
  data-items-state="<?php echo isset($_COOKIE['cartItems']) && !empty($_COOKIE['cartItems']) ? 'true' : 'false' ?>">
</aside>
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
      <li id="mobileLogo">
        <a href="home">
          <img src="images/shophp.jpeg" alt="shophp logo" id="mobileShophp" />
        </a>
      </li>
      <li class="mobile-user-icon d-flex align-items-center justify-content-center">
        <a id="mobile-nav-user" class="nav-user" style="cursor:pointer;"><i
            class="bx bx-user nav-user-icon mobile-nav-user-icon"></i></a>
      </li>
    </ul>
    <!-- Main nav part -->
    <ul class="nav-menu">
      <li class="logo">
        <a href="home"><img class="nav-logo" src="images/shophp.jpeg" alt="shophp logo" /></a>
      </li>
      <li><a href="trending">Trending</a></li>
      <li><a href="newitems">New</a></li>
      <li><a href="clothing">Clothing</a></li>
      <li><a href="bags">Bags</a></li>
      <li><a href="accessories">Accessories</a></li>
      <li><a href="sale">Sale</a></li>
      <li>
        <a class="nav-search-icon"><i class="bx bx-search-alt-2 nav-toggle-menu nav-search-icon"
            style="cursor: pointer;"></i></a>
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
        <input autofocus type="text" placeholder="Search shoPHP.shop..." spellcheck="false" autocomplete="off"
          id="search-field" />
      </form>
    </div>
    <i class="bx bx-x nav-toggle-menu"></i>
  </div>
</header>
<div class="overlay nav-toggle-menu"></div>
<!-- End of nav bar -->