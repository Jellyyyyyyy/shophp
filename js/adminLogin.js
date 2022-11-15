const loginBtn = document.querySelector(".login-admin-acc");
const registerBtn = document.querySelector(".register-admin-acc");
const adminCard = document.querySelectorAll(".admin-login-card");

[loginBtn, registerBtn].forEach((btn) => {
  btn.addEventListener("click", () => {
    [...adminCard].forEach((el) => el.classList.toggle("hide"));
  });
});
