const editContainer = document.querySelector(".edit-container");
const deleteContainer = document.querySelector(".delete-container");
const manageActionForm = document.querySelector(".manage-action");

manageActionForm.addEventListener("change", () => {
  editContainer.classList.toggle("hide");
  deleteContainer.classList.toggle("hide");
});
