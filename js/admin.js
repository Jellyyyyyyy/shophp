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
