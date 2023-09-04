// HOME PAGE JS SCRIPT
const menuBtn = document.querySelector("#menubtn");
const menu = document.querySelector("#menu");
const help = document.querySelector("#help");

// toggling menu btn
menuBtn.addEventListener("click", () => {
  menuBtn.classList.toggle("active");
  menu.classList.toggle("active");
});
// toggling help drop down
help.addEventListener("click", (e) => {
  e.preventDefault();
  help.classList.toggle("active");
});

//GET CURRENT DATE
let currentDate = new Date();
let cDay = currentDate.getDate();
let cMonth = currentDate.getMonth() + 1;
let cYear = currentDate.getFullYear();
let year = cMonth + " " + cDay + " " + cYear;
let time = "24:00:00";
// Set the date we're counting down to
var countDownDate = new Date(`${year + " " + time}`).getTime();

// Update the count down every 1 second
var x = setInterval(function () {
  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  hours < 10 ? (hours = "0" + hours) : (hours = hours);
  minutes < 10 ? (minutes = "0" + minutes) : (minutes = minutes);
  seconds < 10 ? (seconds = "0" + seconds) : (seconds = seconds);

  // Output the result in an element with id="demo"
  document.getElementById("hour").innerHTML = hours;
  document.getElementById("min").innerHTML = minutes;
  document.getElementById("sec").innerHTML = seconds;

  // If the count down is over, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("hour").innerHTML = "EX";
    document.getElementById("min").innerHTML = "PIR";
    document.getElementById("sec").innerHTML = "ED";
  }
}, 1000);

// PRODUCT PAGE JS SCRIPT
const lists = document.querySelectorAll(".list");

//Toggle for counters
lists.forEach((item) => {
  item.addEventListener("click", function () {
    lists.forEach((item) => {
      item.classList.remove("active");
      this.classList.add("active");
    });
  });
});

// GET PRODUCTS FROM DATABASE
//This function will run frequently after every 600ms
setInterval(() => {
  let prod = document.querySelector("#prod");
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "../CRUD/prod.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        prod.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 5000);
