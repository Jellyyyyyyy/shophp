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
