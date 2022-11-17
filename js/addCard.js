let cartItems;

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
}

function addEvents() {
  cartItems = getCookie("cartItems").split(",");
  if (cartItems.length == 1) cartItems = [];
  const addToCart = document.querySelectorAll(".add-to-cart");
  [...addToCart].forEach((cart) => {
    cart.addEventListener("click", (e) => {
      let itemName =
        e.target.parentElement.parentElement.querySelector(
          "[data-item-name]"
        ).textContent;
      console.log(itemName);
      cartItems.push(itemName);
      console.log(cartItems);
      setCookie(`cartItems`, cartItems, 30);
    });
  });
}

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
