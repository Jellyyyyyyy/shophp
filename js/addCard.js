function addCard(imgSource, category, size, name, price, elementContainer) {
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
}
