"use strict";

const searchText = document.getElementById("search-text");
const searchInput = document.getElementById("search-input");

function move_up() {
  if (!searchInput.value) {
    searchText.classList.remove("move-up");
  } else {
    searchText.classList.add("move-up");
  }
}
