"use strict";
let menuClicked = false;
let menu;

function transformSubmitBack() {
  let sButton = document.getElementById('submitButton');
  sButton.innerHTML = '';
  sButton.innerText = 'Senden';
}

function transformSubmit() {
  let sButton = document.getElementById('submitButton');
  sButton.innerHTML = '<i class="fa fa-check" aria-hidden="true"></i>';
  setTimeout(transformSubmitBack, 3000)
}

function closeMenu() {
  menu = Array.from(document.getElementsByClassName("nav-item"));
  menu.forEach((item) => {
    item.style.display = "none";
  });
  menuImg.src = "./assets/burger.png";
  menuClicked = false;
}

function menuToggle() {
  menu = Array.from(document.getElementsByClassName("nav-item"));
  menuClicked = !menuClicked;
  if (menuClicked) {
    menu.forEach((item) => {
      item.style.display = "block";
      item.addEventListener("click", closeMenu);
    });
    menuImg.src = "./assets/close.png";
  } else {
    closeMenu();
  }
}
