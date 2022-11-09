const noAccBtn = document.querySelector(".no-acc-btn");
const haveAccBtn = document.querySelector(".have-acc-btn");
const formDay = document.querySelector("[name=dob-day]");
const formYear = document.querySelector("[name=dob-year]");
const registerModal = document.querySelector(".register-container");
const registerOverlay = document.querySelector(".register-overlay");
const genderRadio = document.querySelectorAll(".gender");

// Register form DOB generator
function addOptions(
  form,
  textContent,
  value,
  selected = false,
  disabled = false
) {
  let optionEl = document.createElement("option");
  optionEl.textContent = textContent;
  optionEl.value = value;
  if (selected) {
    optionEl.setAttribute("selected", "");
  }
  if (disabled) {
    optionEl.setAttribute("disabled", "");
  }
  form.appendChild(optionEl);
}

addOptions(formDay, "Day", "", true, true);
for (let i = 1; i < 32; i++) {
  addOptions(formDay, i, i);
}

const date = new Date();
let currentYear = date.getFullYear();
addOptions(formYear, "Year", "", true, true);
for (let i = Number(currentYear); i > Number(currentYear) - 80; i--) {
  addOptions(formYear, i, i);
}

// Display register modal
noAccBtn.addEventListener("click", () => {
  registerModal.classList.remove("hide");
  registerOverlay.classList.add("active");
});

// Hide register modal
function hideRegisterModal() {
  registerModal.classList.add("hide");
  registerOverlay.classList.remove("active");
}

registerOverlay.addEventListener("click", hideRegisterModal);
haveAccBtn.addEventListener("click", hideRegisterModal);
// Escape press event
document.addEventListener("keydown", (e) => {
  if (e.key == "Escape" && !registerModal.classList.contains("hide")) {
    hideRegisterModal();
  }
});

// Radio checked implementation
[...genderRadio].forEach((gender) => {
  gender.addEventListener("click", () => {
    [...genderRadio].forEach((el) => (el.checked = false));
    gender.checked = true;
  });
});
