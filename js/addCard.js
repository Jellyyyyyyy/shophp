// Card functions
function addArrowEvents() {
  const arrows = document.querySelectorAll(".card .arrow");
  const cards = document.querySelectorAll(".container .card");
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

function addCard(imgSource, category, size, name, price, elementContainer) {
  // Load cards into webpage
  const cardTemplate = document.querySelector(".card-template");
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

  document.querySelector(elementContainer).appendChild(card);
  addArrowEvents();
}
