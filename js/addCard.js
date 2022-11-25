var cartItems;

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
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
  const wishlistCardBtn = card.querySelector(".add-to-wishlist");

  // Refine stock
  const stock = itemJSON.stock;
  let stockStr = "";
  const stockArr = stock.split(";");
  if (Number(stockArr[0]) > 0) stockStr = "XS";
  else if (Number(stockArr[1]) > 0) stockStr = "S";
  else if (Number(stockArr[2]) > 0) stockStr = "M";
  else if (Number(stockArr[3]) > 0) stockStr = "L";
  else if (Number(stockArr[4])) stockStr = "XL";

  if (Number(stockArr[4]) > 0) stockStr += "-XL";
  else if (Number(stockArr[3]) > 0) stockStr += "-L";
  else if (Number(stockArr[2]) > 0) stockStr += "-M";
  else if (Number(stockArr[1]) > 0) stockStr += "-S";
  else if (Number(stockArr[0])) stockStr += "-XS";

  let stockTest = stockStr.split("-");
  if (stockTest[0] === stockTest[1]) stockStr = stockTest[0];

  // Adding content
  cardImg.src = itemJSON.image;
  cardImg.alt = itemJSON.name;
  cardCategory.textContent = itemJSON.type;
  cardSize.textContent = stockStr;
  cardName.textContent = itemJSON.name;
  cardPrice.textContent = "$" + itemJSON.price;

  // Add add-to-wishlist event
  const loginState = document
    .querySelector("[data-login-state]")
    .getAttribute("data-login-state");
  if (loginState == "true") {
    // Add to wishlist
    wishlistItems = getCookie("wishlistItems").split(",");
    const testEmptyString = wishlistItems.indexOf("");
    if (testEmptyString !== -1) wishlistItems.splice(testEmptyString, 1); // Removes empty string
    wishlistCardBtn.addEventListener("click", () => {
      wishlistItems.push(itemJSON.name);
      setCookie("wishlistItems", wishlistItems);
      window.location.reload();
    });
  } else {
    // Show toaster popup at top center
    wishlistCardBtn.addEventListener("click", () => {
      alert("Please login to add to wishlist");
    });
  }

  // Add add-to-cart event
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
      const existingModal = document.querySelector(".item-modal");
      const modalOverlay = document.querySelector(".modal-overlay");
      if (!existingModal) {
        let modal = createModal(itemJSON);
        await sleep(100);
        modal.classList.remove("hide");
        modalOverlay.classList.remove("hide");
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
  const sizeSelect = modal.querySelector("[data-size-select]");

  modalImg.src = itemJSON.image;
  modalImg.alt = itemJSON.name;
  modalName.textContent = itemJSON.name;
  modalPrice.textContent = "$" + itemJSON.price;
  modalDesc.textContent = itemJSON.description;
  modalDetails.textContent = itemJSON.details;
  modalMaterials.textContent = itemJSON.materials;

  // Adding size options
  let stockArr = itemJSON.stock.split(";");
  for (let [index, size] of stockArr.entries()) {
    const sizesArr = ["XS", "S", "M", "L", "XL"];
    if (Number(size) > 0) {
      const selectOption = document.createElement("option");
      selectOption.value = sizesArr[index];
      selectOption.textContent = sizesArr[index];
      sizeSelect.appendChild(selectOption);
    }
  }

  // Events in modal
  closeModal.addEventListener("click", async () => {
    const existingModal = document.querySelector(".item-modal");
    const modalOverlay = document.querySelector(".modal-overlay");
    modal.classList.add("hide");
    modalOverlay.classList.add("hide");
    document.body.classList.remove("no-scroll");
    await sleep(100);
    document.body.removeChild(existingModal);
  });

  const collapseBtns = modal.querySelectorAll(".more-details");
  const collapseBtnsArr = [...collapseBtns];
  collapseBtnsArr.forEach((btn) => {
    btn.addEventListener("click", (collapse) => {
      collapseBtnsArr.forEach((el) =>
        el.getAttribute("aria-expanded") == "true" ? el.click() : null
      );
      btn.click();
    });
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

async function closeModal() {
  const modal = document.querySelector(".item-modal");
  const modalOverlay = document.querySelector(".modal-overlay");
  modal.classList.add("hide");
  modalOverlay.classList.add("hide");
  document.body.classList.remove("no-scroll");
  await sleep(100);
  document.body.removeChild(modal);
}

document.addEventListener("keydown", async (e) => {
  if (e.key === "Escape") {
    if (document.querySelector(".item-modal")) {
      closeModal();
    }
  }
});

const modalOverlay = document.querySelector(".modal-overlay");
modalOverlay.addEventListener("click", () => {
  closeModal();
});
