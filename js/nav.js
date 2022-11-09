"use strict";

const navMain = document.querySelector(".nav-main");
const toggleMenu = document.getElementsByClassName("nav-toggle-menu");
const searchContainer = document.querySelector(".search-container");
const navMenu = document.querySelector(".nav-menu");
const overlay = document.querySelector(".overlay");
const searchField = document.getElementById("search-field");

// For mobile
const mobileMenuIconContainer = document.querySelector(".menu-icon-container");
const userIcon = document.querySelector(".nav-user-icon");

[...toggleMenu].forEach((el) => {
  el.addEventListener("click", () => {
    searchContainer.classList.toggle("hide");
    navMenu.classList.toggle("hide");
    overlay.classList.toggle("show");
    searchField.focus();
  });
});

mobileMenuIconContainer.addEventListener("click", () => {
  mobileMenuIconContainer.classList.toggle("open");
  navMain.classList.toggle("active");
  userIcon.classList.toggle("hide");
  searchContainer.classList.toggle("hide");
});
