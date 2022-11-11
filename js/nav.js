const navMain = document.querySelector(".nav-main");
const toggleMenu = document.getElementsByClassName("nav-toggle-menu");
const searchContainer = document.querySelector(".search-container");
const navMenu = document.querySelector(".nav-menu");
const overlay = document.querySelector(".overlay");
const searchField = document.getElementById("search-field");

// For mobile
const mobileMenuIconContainer = document.querySelector(".menu-icon-container");
const userIcon = document.querySelector(".nav-user-icon");

[...toggleMenu].forEach((el) => {
  el.addEventListener("click", () => {
    searchContainer.classList.toggle("hide");
    navMenu.classList.toggle("hide");
    overlay.classList.toggle("show");
    searchField.focus();
  });
});

mobileMenuIconContainer.addEventListener("click", () => {
  mobileMenuIconContainer.classList.toggle("open");
  navMain.classList.toggle("active");
  userIcon.classList.toggle("hide");
  searchContainer.classList.toggle("hide");
});

// Generating Popover for bag
const loginState = document.querySelector("[data-state]");
let loginClass;
let loginText;
let loginHref;

if (loginState.getAttribute("data-state") === "true") {
  loginClass = "bx-log-out";
  loginText = "Log out";
  loginHref = "process_logout";
} else {
  loginClass = "bx-user-circle";
  loginText = "Sign in";
  loginHref = "login";
}

const popoverContent = `
  <div class='pop-content user-card-container'>
    <h6 class='pop-content user-card-header'>Your bag is empty.</h6>
    <ul class='pop-content user-card-body'>
      <li><a href='#'><i class='bx bx-shopping-bag'></i><span>Bag</span></a></li>
      <li><a href='#'><i class='bx bx-bookmark'></i><span>Wishlist</span></a></li>
      <li><a href='#'><i class='bx bx-package'></i><span>Orders</span></a></li>
      <li><a href='#'><i class='bx bx-cog'></i><span>Account</span></a></li>
      <li><a href='${loginHref}'><i class='bx ${loginClass}'></i><span>${loginText}</span></a></li>
    </ul>
  </div>
  `;

const navUserPopup = document.getElementById("nav-user");
const navUserIcon = document.querySelector(".main-nav-user-icon");
const popover = new mdb.Popover(navUserPopup, {
  html: true,
  container: "body",
  trigger: "manual",
  toggle: "popover",
  placement: "bottom",
  content: popoverContent,
});

document.addEventListener("click", (e) => {
  try {
    const popoverGenerated = document.querySelector(".popover");
    const popContent = document.querySelectorAll(".pop-content");
    if (e.target === navUserIcon || e.target === navUserPopup) {
      popover.toggle();
    } else if (
      [...popoverGenerated.childNodes].includes(e.target) ||
      [...popContent].includes(e.target) ||
      e.target === popoverGenerated
    ) {
    } else {
      popover.hide();
    }
  } catch {}
});
