const cancelbtn = document.querySelector("#cancel");
const pop = document.querySelector("#pop");
const overlay = document.querySelector("#overlay");

//CANCEL FOR POP UP
cancelbtn.onclick = () => {
  pop.classList.remove("active");
  overlay.classList.remove("active");
};

const searchBar = document.querySelector("#type");
const searchBtn = document.querySelector("#searchBtn");
const popbody = document.querySelector("#listed");

//search btn to toggle active class
searchBtn.onclick = () => {
  if (searchBar.value !== "") {
    pop.classList.add("active");
    overlay.classList.add("active");
    //search list of products
    let searchTerm = searchBar.value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../CRUD/search.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          popbody.innerHTML = data;
        }
      }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
  } else {
    searchBar.focus();
  }
};
