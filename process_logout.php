<?php
if (isset($_COOKIE["wishlistItems"])) {
  // Clear wishlist items so does not get carried to next user
  unset($_COOKIE["wishlistItems"]);
  setcookie("wishlistItems", "", time()-3600);
}
session_start();
session_unset();
session_destroy();
header("Location: /home");