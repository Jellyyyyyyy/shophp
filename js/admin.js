// Manage listing
const editContainer = document.querySelector(".edit-container");
const manageActionForm = document.querySelector(".manage-action");
const manageSubmitItemBtn = document.querySelector(".manage-item-submit-btn");

manageActionForm.addEventListener("change", () => {
  editContainer.classList.toggle("hide");
  manageSubmitItemBtn.textContent !== "Delete"
    ? (manageSubmitItemBtn.textContent = manageSubmitItemBtn.textContent =
        "Delete")
    : (manageSubmitItemBtn.textContent = "Make Changes");
});

// Manage user
const manageUserAction = document.querySelector(".manage-user-action");
const manageUserBtn = document.querySelector(".manage-user-btn");

manageUserAction.addEventListener("change", () => {
  manageUserBtn.textContent = manageUserAction.value + " account";
});
