// script.js

// Get the clickable div element
const clickableDiv = document.getElementById("clickableDiv");

// Add a click event listener
clickableDiv.addEventListener("click", function () {
    // Navigate to loginPage.html
    window.location.href = "loginPage.html";
});
// carousel.js

// Get all carousel items
const carouselItems = document.querySelectorAll('.carousel-item');

// Initialize index to track the current item
let currentIndex = 0;

// Function to change the current item
function changeItem() {
    // Hide all items
    carouselItems.forEach(item => item.style.display = 'none');

    // Show the current item
    carouselItems[currentIndex].style.display = 'block';

    // Increment index or reset to 0
    currentIndex = (currentIndex + 1) % carouselItems.length;
}

// Call changeItem every 0.5 seconds
setInterval(changeItem, 500);
import {
    Input,
    Ripple,
    initTE,
  } from "tw-elements";
  
  initTE({ Input, Ripple });