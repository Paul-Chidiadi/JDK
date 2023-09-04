const lists = document.querySelectorAll(".list");
const ord = document.querySelectorAll(".ord");
const all = document.querySelector("#all");
const comp = document.querySelector("#comp");
const pend = document.querySelector("#pend");

//Toggle for sidebar menus
lists.forEach((item) => {
  item.addEventListener("click", function () {
    lists.forEach((item) => {
      item.classList.remove("active");
      this.classList.add("active");
    });
  });
});
//Toggle for order menus
ord.forEach((item) => {
  item.addEventListener("click", function () {
    ord.forEach((item) => {
      item.classList.remove("active");
      this.classList.add("active");
    });
  });
});

//SIDEBAR SELCTORS
const orders = document.querySelector("#or");
const product = document.querySelector("#pr");
const customers = document.querySelector("#cu");
const settings = document.querySelector("#se");
//THE MENU LAYOUTS
const ordersLayout = document.querySelector("#orders");
const productLayout = document.querySelector("#products");
const customersLayout = document.querySelector("#customers");
const settingsLayout = document.querySelector("#settings");

orders.onclick = () => {
  ordersLayout.classList.add("active");
  productLayout.classList.remove("active");
  customersLayout.classList.remove("active");
  settingsLayout.classList.remove("active");
};
product.onclick = () => {
  ordersLayout.classList.remove("active");
  productLayout.classList.add("active");
  customersLayout.classList.remove("active");
  settingsLayout.classList.remove("active");
};
customers.onclick = () => {
  ordersLayout.classList.remove("active");
  productLayout.classList.remove("active");
  customersLayout.classList.add("active");
  settingsLayout.classList.remove("active");
};
settings.onclick = () => {
  ordersLayout.classList.remove("active");
  productLayout.classList.remove("active");
  customersLayout.classList.remove("active");
  settingsLayout.classList.add("active");
};

// GET CUSTOMERS FROM DATABASE
//This function will run frequently after every 600ms
setInterval(() => {
  let custom = document.querySelector("#customer");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../CRUD/update.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        custom.innerHTML = data;
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("customers=");
}, 600);

// UPDATE ADMIN DATA IN DATABASE
const form = document.querySelector("#update");
const change = document.querySelector("#change-password");
form.onsubmit = (e) => {
  e.preventDefault();
};
change.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../CRUD/update.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data) {
          let response = document.querySelector("#response");
          response.innerHTML = data;
          response.style.display = "block";
          setTimeout(() => {
            response.style.display = "none";
          }, 7000);
          if (data.indexOf("Success") > 0) {
            //clear inputs
            $("#confirm-password").val("");
            $("#new-password").val("");
            $("#current-password").val("");
          }
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};

// GET ORDERS FROM DATABASE
//This function will run frequently after every 60000ms
setInterval(() => {
  let sales = document.querySelector("#sales");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../CRUD/update.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        sales.innerHTML = data;
        all.classList.add("active");
        comp.classList.remove("active");
        pend.classList.remove("active");
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("all=");
}, 60000);
all.onclick = () => {
  let sales = document.querySelector("#sales");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../CRUD/update.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        sales.innerHTML = data;
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("all=");
};
comp.onclick = () => {
  let sales = document.querySelector("#sales");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../CRUD/update.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        sales.innerHTML = data;
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("comp=");
};
pend.onclick = () => {
  let sales = document.querySelector("#sales");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../CRUD/update.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        sales.innerHTML = data;
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("pend=");
};

let dropArea = document.getElementById("drop-area");
["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
  dropArea.addEventListener(eventName, preventDefaults, false);
});
function preventDefaults(e) {
  e.preventDefault();
  e.stopPropagation();
}
["dragenter", "dragover"].forEach((eventName) => {
  dropArea.addEventListener(eventName, highLight, false);
});
["dragleave", "drop"].forEach((eventName) => {
  dropArea.addEventListener(eventName, unhighLight, false);
});
function highLight(e) {
  dropArea.classList.add("highlight");
}
function unhighLight(e) {
  dropArea.classList.remove("highlight");
}
dropArea.addEventListener("drop", handleDrop, false);
let file;
function handleDrop(e) {
  let dt = e.dataTransfer;
  files = dt.files;

  handleFiles(files);
}
function handleFiles(files) {
  file = files[0];
}
// UPLOAD NEW PRODUCTS TO DATABASE
const formNew = document.querySelector("#new");
const news = document.querySelector("#upload-new");
formNew.onsubmit = (e) => {
  e.preventDefault();
};
news.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../CRUD/update.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data) {
          let response = document.querySelector("#response");
          response.innerHTML = data;
          response.style.display = "block";
          setTimeout(() => {
            response.style.display = "none";
          }, 7000);
          if (data.indexOf("Success") > 0) {
            //clear inputs
            $("#product-name").val("");
            $("#tryon").val("");
            $("#price").val("");
            file = "";
            console.log(file);
          }
        }
      }
    }
  };
  let formData = new FormData(formNew);
  formData.append("file", file);
  xhr.send(formData);
};

let dropzone = document.getElementById("drop-zone");
["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
  dropzone.addEventListener(eventName, preventDefaults, false);
});
function preventDefaults(e) {
  e.preventDefault();
  e.stopPropagation();
}
["dragenter", "dragover"].forEach((eventName) => {
  dropzone.addEventListener(eventName, highL, false);
});
["dragleave", "drop"].forEach((eventName) => {
  dropzone.addEventListener(eventName, unhighL, false);
});
function highL(e) {
  dropzone.classList.add("highlight");
}
function unhighL(e) {
  dropzone.classList.remove("highlight");
}
dropzone.addEventListener("drop", handle, false);
let imagee;
function handle(e) {
  let dt = e.dataTransfer;
  files = dt.files;

  andleFiles(files);
}
function andleFiles(files) {
  imagee = files[0];
}
// UPLOAD DEAL OF THE DAY PRODUCTS TO DATABASE
const formDay = document.querySelector("#day");
const day = document.querySelector("#upload-day");
formDay.onsubmit = (e) => {
  e.preventDefault();
};
day.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../CRUD/update.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data) {
          let response = document.querySelector("#response");
          response.innerHTML = data;
          response.style.display = "block";
          setTimeout(() => {
            response.style.display = "none";
          }, 7000);
          if (data.indexOf("Success") > 0) {
            //clear inputs
            $("#name").val("");
            $("#on").val("");
            $("#pric").val("");
            $("#discount-pric").val("");
          }
        }
      }
    }
  };
  let formData = new FormData(formDay);
  formData.append("file", imagee);
  xhr.send(formData);
};
