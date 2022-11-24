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
const manageUserAction = document.querySelector(".mng-user-action");
const manageSuspendDuration = document.querySelector(".mng-suspend-duration");
const manageUserBtn = document.querySelector(".mng-user-btn");

manageUserAction.addEventListener("change", () => {
  manageUserBtn.textContent = manageUserAction.value + " account";
  if (manageUserAction.value === "suspend") {
    manageSuspendDuration.classList.remove("hidden");
  } else {
    manageSuspendDuration.classList.add("hidden");
  }
});
