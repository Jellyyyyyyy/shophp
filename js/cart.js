const itemPrices = [...document.querySelectorAll("[data-item-price]")];
const subtotal = document.querySelector("[data-subtotal]");
const cartTotal = document.querySelector("[data-total]");
const gst = document.querySelector("[data-gst]");

for (let i = 0; i < itemPrices.length; i++) {
  itemPrices[i] = Number(itemPrices[i].textContent.substring(1));
}

subtotal.textContent = "$".concat(
  itemPrices.reduce((sum, price) => Number(sum) + Number(price), 0)
);
cartTotal.textContent = "$".concat(
  Number(subtotal.textContent.substring(1)) + 10
);
gst.textContent = `Includes GST of $${(
  (Number(cartTotal.textContent.substring(1)) / 107) *
  7
).toFixed(2)}`;

cartItems = getCookie("cartItems").split(",");
const testEmptyString = cartItems.indexOf("");
if (testEmptyString !== -1) cartItems.splice(testEmptyString, 1); // Removes empty string
const items = document.querySelectorAll(".item");
items.forEach((item) => {
  const incQuantity = item.querySelector(".quantity-add");
  const decQuantity = item.querySelector(".quantity-minus");
  const itemQuantity = item.querySelector(".item-quantity span");
  const itemName = item.querySelector(".item-name span");
  const individualItemPrice = item
    .querySelector("[data-item-price]")
    .getAttribute("data-item-price");
  const totalItemPrice = item.querySelector(".item-price");

  incQuantity.addEventListener("click", () => {
    itemQuantity.textContent = Number(itemQuantity.textContent) + 1;
    totalItemPrice.textContent = "$".concat(
      Number(totalItemPrice.textContent.substring(1)) +
        Number(individualItemPrice.textContent)
    );
    cartItems.push(itemName.textContent);
    setCookie(`cartItems`, cartItems, 30);
  });

  decQuantity.addEventListener("click", () => {
    if (itemQuantity.textContent > 0) {
      itemQuantity.textContent = Number(itemQuantity.textContent) - 1;
      totalItemPrice.textContent = "$".concat(
        Number(totalItemPrice.textContent.substring(1)) -
          Number(individualItemPrice.textContent)
      );
      const index = cartItems.indexOf(itemName.textContent);
      cartItems.pop(index);
      setCookie(`cartItems`, cartItems, 30);
    }
  });
});

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
