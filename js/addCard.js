var cartItems;

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function appendHtmlChild(element, value, elementContainer) {
  let child = document.createElement(element);
  child.textContent = value;
  document.querySelector(elementContainer).appendChild(child);
}

function addCard(itemJSON, target) {
  const cardTemplate = document.querySelector(".card-template");
  const card = cardTemplate.content.cloneNode(true).children[0];
  const cardContainer = card.querySelector(".text-container");
  const cardImg = card.querySelector("[data-item-image]");
  const cardCategory = card.querySelector("[data-item-category]");
  const cardSize = card.querySelector("[data-item-size]");
  const cardName = card.querySelector("[data-item-name]");
  const cardPrice = card.querySelector("[data-item-price]");
  const cardCartBtn = card.querySelector(".add-to-cart");

  // Adding content
  cardImg.src = itemJSON.image;
  cardCategory.textContent = itemJSON.category;
  cardSize.textContent = itemJSON.stock;
  cardName.textContent = itemJSON.name;
  cardPrice.textContent = "$" + itemJSON.price;

  // Add top cart event
  cartItems = getCookie("cartItems").split(",");
  const testEmptyString = cartItems.indexOf("");
  if (testEmptyString !== -1) cartItems.splice(testEmptyString, 1); // Removes empty string
  cardCartBtn.addEventListener("click", () => {
    cartItems.push(itemJSON.name);
    setCookie(`cartItems`, cartItems, 30);
    window.location.reload();
  });

  // Click card event
  [cardImg, cardContainer].forEach((el) => {
    el.addEventListener("click", async () => {
      let existingModal = document.querySelector(".item-modal");
      if (!existingModal) {
        let modal = createModal(itemJSON);
        await sleep(100);
        modal.classList.remove("hide");
        document.body.classList.add("no-scroll");
      } else {
        document.body.removeChild(existingModal);
        let modal = createModal(itemJSON);
        modal.classList.remove("hide");
        document.body.classList.add("no-scroll");
      }
    });
  });

  document.querySelector(target).appendChild(card);
}

function createModal(itemJSON) {
  const modalTemplate = document.querySelector("[data-modal-template]");
  const modal = modalTemplate.content.cloneNode(true).children[0];
  const modalImg = modal.querySelector("[data-modal-img]");
  const modalName = modal.querySelector("[data-modal-name]");
  const modalPrice = modal.querySelector("[data-modal-price]");
  const modalDesc = modal.querySelector("[data-modal-desc]");
  const modalDetails = modal.querySelector("[data-modal-details]");
  const modalMaterials = modal.querySelector("[data-modal-materials]");
  const closeModal = modal.querySelector(".close-modal");

  modalImg.src = itemJSON.image;
  modalName.textContent = itemJSON.name;
  modalPrice.textContent = "$" + itemJSON.price;
  modalDesc.textContent = itemJSON.description;
  modalDetails.textContent = itemJSON.details;
  modalMaterials.textContent = itemJSON.materials;

  // Events in modal
  closeModal.addEventListener("click", async () => {
    let existingModal = document.querySelector(".item-modal");
    modal.classList.add("hide");
    document.body.classList.remove("no-scroll");
    await sleep(100);
    document.body.removeChild(existingModal);
  });

  document.body.insertBefore(modal, document.querySelector("footer"));
  return modal;
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

document.addEventListener("keydown", async (e) => {
  console.log(e);
  if (e.key === "Escape") {
    if (document.querySelector(".item-modal")) {
      const modal = document.querySelector(".item-modal");
      modal.classList.add("hide");
      document.body.classList.remove("no-scroll");
      await sleep(100);
      document.body.removeChild(modal);
    }
  }
});
