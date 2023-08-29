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

$(document).ready(function () {
  $('form').submit(function (event) {
      event.preventDefault(); // Prevent form submission
      var formData = $(this).serialize();
      
      $.ajax({
          type: 'POST',
          url: 'fetch_doctors.php',
          data: formData,
          success: function (response) {
              $('.doctor-table').html(response); // Update the table contents
          }
      });
  });
});
