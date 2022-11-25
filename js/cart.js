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

const incQuantity = document.querySelectorAll(".quantity-add");
const decQuantity = document.querySelectorAll(".quantity-minus");
const incTag =
  "<i class='bx bx-sm bx-tada-hover bx-minus-circle quantity-minus'></i>";
const decTag =
  "<i class='bx bx-sm bx-tada-hover bx-plus-circle quantity-add'></i>";
[...incQuantity].forEach((btn) => {
  btn.addEventListener("click", () => {
    const itemQuantity = btn.parentElement;
    const itemPrice = btn.parentElement.parentElement.parentElement
      .querySelector("[data-item-price]")
      .getAttribute("data-item-price");
    itemQuantity.innerHTML = `${incTag} ${
      Number(itemQuantity.textContent) + 1
    } ${decTag}`;
    itemPrice.textContent = Number(itemPrice.textContent) + itemPrice;

    cartItems = getCookie("cartItems").split(",");
    const testEmptyString = cartItems.indexOf("");
    if (testEmptyString !== -1) cartItems.splice(testEmptyString, 1); // Removes empty string
    cartItems.push(
      itemQuantity.previousElementSibling.querySelector("span").textContent
    );
    setCookie(`cartItems`, cartItems, 30);
  });
});
[...decQuantity].forEach((btn) => {
  btn.addEventListener("click", () => {
    const itemQuantity = btn.parentElement;
    const itemPrice = btn.parentElement.parentElement.parentElement
      .querySelector("[data-item-price]")
      .getAttribute("data-item-price");

    if (Number(itemQuantity.textContent) > 0) {
      itemQuantity.innerHTML = `${incTag} ${
        Number(itemQuantity.textContent) - 1
      } ${decTag}`;
      itemPrice.textContent =
        Number(itemPrice.textContent) - Number(itemPrice.textContent);

      cartItems = getCookie("cartItems").split(",");
      const testEmptyString = cartItems.indexOf("");
      if (testEmptyString !== -1) cartItems.splice(testEmptyString, 1); // Removes empty string
      const index = cartItems.indexOf(
        itemQuantity.previousElementSibling.querySelector("span").textContent
      );
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
