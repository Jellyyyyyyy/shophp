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

let btnArray = [...radioBtns],
  radioArray = [...radioBtns],
  labelArray = [...labelBtns];

const NUMBER_OF_BANNERS = btnArray.length - 1;

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
      break;
    } else if (btnArray[btn].checked == true && btn == NUMBER_OF_BANNERS) {
      btnArray[btn].checked = false;
      btnArray[0].checked = true;
      labelArray.forEach((label) => (label.style.background = "none"));
      labelArray[0].style.background = "#eee";
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
      console.log(btn);
      break;
    } else if (btnArray[btn].checked == true && btn == 0) {
      btnArray[btn].checked = false;
      btnArray[NUMBER_OF_BANNERS].checked = true;
      labelArray.forEach((label) => (label.style.background = "none"));
      labelArray[NUMBER_OF_BANNERS].style.background = "#eee";
      console.log(btn);
      break;
    }
  }
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

function addCard(imgSource, category, size, name, price) {
  const card = cardTemplate.content.cloneNode(true).children[0];
  const cardImg = card.querySelector("[data-item-image]");
  const cardCategory = card.querySelector("[data-item-category]");
  const cardSize = card.querySelector("[data-item-size]");
  const cardName = card.querySelector("[data-item-name]");
  const cardPrice = card.querySelector("[data-item-price]");

  cardImg.src = imgSource;
  cardCategory.textContent = category;
  cardSize.textContent = size;
  cardName.textContent = name;
  cardPrice.textContent = price;

  document.querySelector(".grid-container").appendChild(card);
}

function addCard2(imgSource, category, size, name, price) {
  const card = cardTemplate.content.cloneNode(true).children[0];
  const cardImg = card.querySelector("[data-item-image]");
  const cardCategory = card.querySelector("[data-item-category]");
  const cardSize = card.querySelector("[data-item-size]");
  const cardName = card.querySelector("[data-item-name]");
  const cardPrice = card.querySelector("[data-item-price]");

  cardImg.src = imgSource;
  cardCategory.textContent = category;
  cardSize.textContent = size;
  cardName.textContent = name;
  cardPrice.textContent = price;

  document.querySelector(".grid-container2").appendChild(card);
}
addCard(
  "images/index/pocketableLC.png",
  "unisex".toUpperCase(),
  "xs-xl".toUpperCase(),
  "Pocketable Coat",
  "$129.90"
);
addCard(
  "images/index/PaddedSB.png",
  "women".toUpperCase(),
  "xs-xl".toUpperCase(),
  "Padded Blouson",
  "$129.90"
);
addCard(
  "images/index/hybridDP.png",
  "men".toUpperCase(),
  "xs-xl".toUpperCase(),
  "Pocketable Coat",
  "$129.90"
);
addCard(
  "images/index/pocketableLC.png",
  "unisex".toUpperCase(),
  "xs-xl".toUpperCase(),
  "Pocketable Coat",
  "$129.90"
);

addCard2(
  "images/index/hybridDP.png",
  "men".toUpperCase(),
  "xs-xl".toUpperCase(),
  "Pocketable Coat",
  "$129.90"
);
addCard2(
  "images/index/pocketableLC.png",
  "unisex".toUpperCase(),
  "xs-xl".toUpperCase(),
  "Pocketable Coat",
  "$129.90"
);
addCard2(
  "images/index/hybridDP.png",
  "men".toUpperCase(),
  "xs-xl".toUpperCase(),
  "Pocketable Coat",
  "$129.90"
);
addCard2(
  "images/index/pocketableLC.png",
  "unisex".toUpperCase(),
  "xs-xl".toUpperCase(),
  "Pocketable Coat",
  "$129.90"
);



addArrowEvents();
const allCards = document.querySelectorAll(".grid-container .card");
[...allCards][0].style.opacity = "1";

const allCards2 = document.querySelectorAll(".grid-container2 .card");
[...allCards2][0].style.opacity = "1";