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

//checklist script

// Get references to the buttons and checklist
var itemInput = document.getElementById("item-input");
var addButton = document.getElementById("add-button");
var removeButton = document.getElementById("remove-button");
var checkboxList = document.getElementById("checkbox-list");

// Add event listeners
addButton.addEventListener("click", addButtonClicked);
removeButton.addEventListener("click", removeButtonClicked);

// Event handler for "Add" button click
function addButtonClicked() {
  var newItem = itemInput.value.trim();
  if (newItem !== "") {
    var li = document.createElement("li");
    var checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    li.appendChild(checkbox);
    li.appendChild(document.createTextNode(newItem));
    checkboxList.appendChild(li);
    itemInput.value = "";
  }
}

// Event handler for "Remove" button click
function removeButtonClicked() {
  var checkboxes = checkboxList.getElementsByTagName("input");
  for (var i = checkboxes.length - 1; i >= 0; i--) {
    if (checkboxes[i].checked) {
      checkboxes[i].parentNode.remove();
    }
  }
}