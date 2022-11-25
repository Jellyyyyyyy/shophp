"use strict";

// Carousel variables
const radioBtns = document.querySelectorAll("input[type='radio']");
const labelBtns = document.querySelectorAll(".radio-label");
const banner = document.querySelector(".carousel");
const firstBanner = document.querySelector(".first");

// Card variables
const cardTemplate = document.querySelector(".card-template");

// Carousel Functions
const SwipeEventListener = window.SwipeEventListener.SwipeEventListener;
const { swipeArea, updateOptions } = SwipeEventListener({
  swipeArea: document.querySelector(".carousel"),
});
const arrows = document.querySelectorAll(".carousel .arrow");

let btnArray = [...radioBtns],
  radioArray = [...radioBtns],
  labelArray = [...labelBtns],
  arrowArray = [...arrows];

const NUMBER_OF_BANNERS = btnArray.length - 1;

let carouselInterval = setInterval(nextCarousel, 5000);

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function nextCarousel() {
  const currentActive = btnArray.filter((el) => el.checked == true)[0];
  let currentActiveIndex = btnArray.indexOf(currentActive);
  if (currentActiveIndex == NUMBER_OF_BANNERS) currentActiveIndex = -1;
  radioArray.forEach((check_btn) => (check_btn.checked = false));
  radioArray[currentActiveIndex + 1].checked = true;
  labelArray.forEach((label) => (label.style.background = "none"));
  labelArray[currentActiveIndex + 1].style.background = "#eee";
}

function previousCarousel() {
  const currentActive = btnArray.filter((el) => el.checked == true)[0];
  let currentActiveIndex = btnArray.indexOf(currentActive);
  if (currentActiveIndex == 0) currentActiveIndex = NUMBER_OF_BANNERS + 1;
  radioArray.forEach((check_btn) => (check_btn.checked = false));
  radioArray[currentActiveIndex - 1].checked = true;
  labelArray.forEach((label) => (label.style.background = "none"));
  labelArray[currentActiveIndex - 1].style.background = "#eee";
}

labelArray[0].style.background = "#eee";

radioArray.forEach((btn) => {
  btn.addEventListener("click", () => {
    let btnIndex = btnArray.indexOf(btn);
    radioArray.forEach((check_btn) => (check_btn.checked = false));
    btn.checked = true;
    labelArray.forEach((label) => (label.style.background = "none"));
    labelArray[btnIndex].style.background = "#eee";
  });
});

swipeArea.addEventListener("swipeLeft", () => {
  for (let btn in btnArray) {
    btn = Number(btn);
    if (btnArray[btn].checked == true && btn < NUMBER_OF_BANNERS) {
      btnArray[btn].checked = false;
      btnArray[btn + 1].checked = true;
      labelArray.forEach((label) => (label.style.background = "none"));
      labelArray[btn + 1].style.background = "#eee";
      clearInterval(carouselInterval);
      carouselInterval = setInterval(nextCarousel, 5000);
      break;
    } else if (btnArray[btn].checked == true && btn == NUMBER_OF_BANNERS) {
      btnArray[btn].checked = false;
      btnArray[0].checked = true;
      labelArray.forEach((label) => (label.style.background = "none"));
      labelArray[0].style.background = "#eee";
      clearInterval(carouselInterval);
      carouselInterval = setInterval(nextCarousel, 5000);
    }
  }
});

swipeArea.addEventListener("swipeRight", () => {
  for (let btn in btnArray) {
    btn = Number(btn);
    if (btnArray[btn].checked == true && btn > 0) {
      btnArray[btn].checked = false;
      btnArray[btn - 1].checked = true;
      labelArray.forEach((label) => (label.style.background = "none"));
      labelArray[btn - 1].style.background = "#eee";
      clearInterval(carouselInterval);
      carouselInterval = setInterval(nextCarousel, 5000);
      break;
    } else if (btnArray[btn].checked == true && btn == 0) {
      btnArray[btn].checked = false;
      btnArray[NUMBER_OF_BANNERS].checked = true;
      labelArray.forEach((label) => (label.style.background = "none"));
      labelArray[NUMBER_OF_BANNERS].style.background = "#eee";
      clearInterval(carouselInterval);
      carouselInterval = setInterval(nextCarousel, 5000);
      break;
    }
  }
});

arrowArray.forEach((arrow) => {
  arrow.addEventListener("click", () => {
    if (arrow.classList.contains("right-arrow")) {
      clearInterval(carouselInterval);
      carouselInterval = setInterval(nextCarousel, 5000);
      nextCarousel();
    } else if (arrow.classList.contains("left-arrow")) {
      clearInterval(carouselInterval);
      carouselInterval = setInterval(nextCarousel, 5000);
      previousCarousel();
    }
  });
});

// Card functions
const cards = [...document.querySelectorAll(".card")];
cards.forEach((card) => {
  const addToCartBtn = card.querySelector(".add-to-cart");
  const addToWishlistBtn = card.querySelector(".add-to-wishlist");
  const cardImg = card.querySelector(".card img");
  const textContainer = card.querySelector(".card .text-container");
  const itemName = card.querySelector("[data-item-name]");
  const loginState = document
    .querySelector("[data-login-state]")
    .getAttribute("data-login-state");

  let cartItems = getCookie("cartItems").split(",");
  const testEmptyString = cartItems.indexOf("");
  if (testEmptyString !== -1) cartItems.splice(testEmptyString, 1); // Removes empty string
  addToCartBtn.addEventListener("click", () => {
    cartItems.push(itemName.textContent);
    setCookie(`cartItems`, cartItems, 30);
    window.location.reload();
  });

  addToWishlistBtn.addEventListener("click", () => {
    // Add to wishlist
    if (loginState == "true") {
      wishlistItems = getCookie("wishlistItems").split(",");
      const testEmptyString = wishlistItems.indexOf("");
      if (testEmptyString !== -1) wishlistItems.splice(testEmptyString, 1); // Removes empty string
      wishlistItems.push(itemName.textContent);
      setCookie("wishlistItems", wishlistItems);
      window.location.reload();
    } else {
      alert("Please login to add to wishlist");
    }
  });
});

// Cookie functions
function setCookie(name, value, days) {
  const d = new Date();
  d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
  let expiryDate = d.toUTCString();
  document.cookie = `${name}=${value}; expires=${expiryDate}`;
}

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
