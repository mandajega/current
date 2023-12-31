// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

//this is for heading and content part
const headings = document.getElementsByClassName('heading');

for (let heading of headings) {
  heading.addEventListener('click', function() {
    this.classList.toggle('open');
    const content = this.nextElementSibling;
    if (content.style.display === 'block') {
      content.style.display = 'none';
    } else {
      content.style.display = 'block';
    }
  });
}

//favourite
const favoriteButtons = document.querySelectorAll('.favorite-button');

    favoriteButtons.forEach(button => {
      button.addEventListener('click', toggleFavorite);
    });

    function toggleFavorite(icon) {
      const checkbox = icon.querySelector('input[type="checkbox"]');
      const heartIcon = icon.querySelector('i');
      checkbox.checked = !checkbox.checked;
  
      if (checkbox.checked) {
        heartIcon.classList.add('fas', 'fa-heart'); // Add a filled heart icon
      } else {
        heartIcon.classList.remove('fas', 'fa-heart'); // Remove the filled heart icon
      }
    }
