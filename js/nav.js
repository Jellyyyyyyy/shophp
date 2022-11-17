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

// Get cookie function
function getCookie(cookieName) {
  let name = cookieName + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

// Count duplicate items function
function getQuantityOfItems(arr) {
  const counts = {};
  arr.forEach(function (x) {
    counts[x] = (counts[x] || 0) + 1;
  });
  return counts;
}

// Generating Popover for bag
const states = document.querySelector("[data-login-state]");
let loginClass, loginText, loginHref, hideState, cartItemsString;

if (states.getAttribute("data-login-state") === "true") {
  loginClass = "bx-log-out";
  loginText = "Log out";
  loginHref = "process_logout";
} else {
  loginClass = "bx-user-circle";
  loginText = "Sign in";
  loginHref = "login";
}

if (states.getAttribute("data-items-state") === "true") {
  cartItems = getCookie("cartItems").split(",");
  hideState = "hide";

  cartItemsString = "";
  uniqueItems = [...new Set(cartItems)];
  let itemsQuantity = getQuantityOfItems(cartItems);
  let offset = 0;

  if (uniqueItems.length > 3) {
    for (let i = 0; i < 3; i++) {
      let numberOfItem = itemsQuantity[uniqueItems[i]];
      if (numberOfItem > 1) {
        cartItemsString += `<div class="cart-items-content"><span>${uniqueItems[i]}</span><span> x${numberOfItem}</span></div>\n`;
        offset += numberOfItem - 1;
      } else {
        cartItemsString += `<span class="cart-items-content">${uniqueItems[i]}</span>`;
      }
    }
    cartItemsString += `<span class="cart-items-footer">${
      cartItems.length - 3 - offset
    } more items in your bag</span>`;
  } else {
    for (let item of uniqueItems) {
      let numberOfItem = itemsQuantity[item];
      if (numberOfItem > 1) {
        cartItemsString += `<div class="cart-items-content"><span>${item}</span><span>${numberOfItem}</span></div>\n`;
      } else {
        cartItemsString += `<span class="cart-items-content">${item}</span>`;
      }
    }
  }
}

const popoverContent = `
  <div class='pop-content user-card-container'>
    <div class='cart-items user-card-header'>
      ${cartItemsString ?? ""}
      <h6 class='pop-content user-card-header ${hideState}'>Your bag is empty.</h6>
    </div>
    <ul class='pop-content user-card-body'>
      <li><a href='cart'><i class='bx bx-shopping-bag'></i><span>Bag ${
        cartItems ? `(${cartItems.length})` : ""
      }</span></a></li>
      <li><a href='wishlist'><i class='bx bx-bookmark'></i><span>Wishlist</span></a></li>
      <li><a href='orders'><i class='bx bx-package'></i><span>Orders</span></a></li>
      <li><a href='profile'><i class='bx bx-cog'></i><span>Account</span></a></li>
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
