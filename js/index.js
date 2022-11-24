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
function addArrowEvents() {
  const arrows = document.querySelectorAll(".card .arrow");
  const cards = document.querySelectorAll(".grid-container .card");
  let arrowArray = [...arrows],
    cardArray = [...cards],
    currentCard = 0;

  arrowArray.forEach((arrow) => {
    arrow.addEventListener("click", () => {
      cardArray.forEach((card) => (card.style.opacity = "0"));

      if (arrow.classList.contains("arrow-next")) {
        currentCard++;
        if (currentCard > cardArray.length - 1) currentCard = 0;
      } else if (arrow.classList.contains("arrow-previous")) {
        currentCard--;
        if (currentCard < 0) currentCard = cardArray.length - 1;
      }
      cardArray[currentCard].style.opacity = "1";
    });
  });
}

addArrowEvents();
const allCards = document.querySelectorAll(".grid-container .card");
[...allCards][0].style.opacity = "1";
