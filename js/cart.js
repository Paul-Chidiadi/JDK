const img = document.querySelector("#image");
const namie = document.querySelector("#name");
const price = document.querySelector("#price");
const prodId = document.querySelector("#id");
const addBtn = document.querySelector("#addbtn");

//Declaring the HTML elements for cart.php page
const tbody = document.querySelector("#items");
// get the elements from cart.php
let subTotal = document.querySelector("#sub");
let delivery = document.querySelector("#defee");
let total = document.querySelector("#total");
let allProductsInfo = document.querySelector("#products_info");
let totalPrice = document.querySelector("#totalPrice");

// Storing products added to cart on the user's device local storage USING INDEXEDDB

// Create an instance of a db object for us to store the open database in
let db;
// Open our database
const openRequest = window.indexedDB.open("eyewear_db", 1);
// error handler signifies that the database didn't open successfully
openRequest.addEventListener("error", () =>
  console.error("Database failed to open")
);

// success handler signifies that the database opened successfully
openRequest.addEventListener("success", () => {
  console.log("Database opened successfully");

  // Store the opened database object in the db variable. This is used a lot below
  db = openRequest.result;

  // Run the displayData() and getAllCarItems() function to get the notes already in the IDB
  displayData();
  getAllCartItems();
});

// Set up the database tables if this has not already been done
openRequest.addEventListener("upgradeneeded", (e) => {
  // Grab a reference to the opened database
  db = e.target.result;

  // Create an objectStore to store our notes in (basically like a single table)
  // including a auto-incrementing key
  const objectStore = db.createObjectStore("eyewear", {
    keyPath: "id",
    autoIncrement: true,
  });

  // Define what data items the objectStore will contain
  objectStore.createIndex("image", "image", { unique: false });
  objectStore.createIndex("name", "name", { unique: false });
  objectStore.createIndex("price", "price", { unique: false });
  objectStore.createIndex("prodId", "prodId", { unique: false });

  console.log("Database setup complete");
});

// Create a cick event handler so that when addbtn is clicked the addData() function is run
addBtn.addEventListener("click", addData);

// Define the addData() function
function addData(e) {
  // prevent default - we don't want the anchor tag to click in the conventional way
  e.preventDefault();

  // grab the values from the fields and store them in an object ready for being inserted into the DB
  const newItem = {
    image: img.getAttribute("src"),
    name: namie.textContent,
    price: price.textContent,
    prodId: prodId.value,
  };

  // open a read/write db transaction, ready for adding the data
  const transaction = db.transaction(["eyewear"], "readwrite");

  // call an object store that's already been added to the database
  const objectStore = transaction.objectStore("eyewear");

  // Make a request to add our newItem object to the object store
  const addRequest = objectStore.add(newItem);

  addRequest.addEventListener("success", () => {
    console.log("newItems added.");
  });

  // Report on the success of the transaction completing, when everything is done
  transaction.addEventListener("complete", () => {
    console.log("Transaction completed: database modification finished.");

    //animation for cart number to drop down when new item is added
    const top = document.querySelector(".top");
    top.style.display = "none";
    setTimeout(() => {
      top.style.display = "block";
    }, 1200);
    getAllCartItems();
    displayData();
  });

  transaction.addEventListener("error", () =>
    console.log("Transaction not opened due to error")
  );
}

// Define the displayData() function
function displayData() {
  // Here we empty the contents of the table body (tbody) element each time the display is updated
  // If you didn't do this, you'd get cart duplicates listed each time a new cart is added
  while (tbody.firstChild) {
    tbody.removeChild(tbody.firstChild);
  }

  // Open our object store and then get a cursor - which iterates through all the
  // different data items in the store
  const objectStore = db.transaction("eyewear").objectStore("eyewear");
  objectStore.openCursor().addEventListener("success", (e) => {
    // Get a reference to the cursor
    const cursor = e.target.result;

    // If there is still another data item to iterate through, keep running this code
    if (cursor) {
      document.querySelector(".empty").style.display = "none";
      document.querySelector(".full").style.display = "flex";
      // Create an item bodyto put each data item inside when displaying it
      // structure the HTML fragment, and append it inside the tbody

      //item row
      const item = document.createElement("div");
      item.classList.add("item");
      //content row
      const content = document.createElement("div");
      content.classList.add("content");
      //image row
      const image = document.createElement("div");
      image.classList.add("image");
      //bg row
      const bg = document.createElement("div");
      bg.classList.add("bg");
      //image
      const imge = document.createElement("img");
      //name
      const nam = document.createElement("p");
      //price
      const pric = document.createElement("p");

      tbody.appendChild(item);
      item.appendChild(content);
      content.appendChild(image);
      content.appendChild(pric);
      image.appendChild(bg);
      image.appendChild(nam);
      bg.appendChild(imge);

      // Put the data from the cursor inside the table body data(td)
      imge.setAttribute("src", cursor.value.image);
      nam.textContent = cursor.value.name;
      pric.textContent = cursor.value.price;

      //Loop through all price to get its content
      pric.classList.add("row");
      let rows = document.querySelectorAll(".row");
      let priceArray = Array.from(rows).map((items) => {
        return parseInt(items.innerHTML.slice(3));
      });
      //sum the contents of the array
      let sum = 0;
      for (let i = 0; i < priceArray.length; i++) {
        sum += priceArray[i];
      }
      //defee
      let defee = parseInt(delivery.textContent);
      // let total be the sum of subtotal and defee
      let totals = defee + sum;
      // display sum in subtotal field
      subTotal.textContent = "NGN " + sum;
      // display totals in total field
      total.textContent = "NGN " + totals;
      // display totals in price field
      totalPrice.value = totals;

      // Store the ID of the data item inside an attribute on the item, so we know
      // which item it corresponds to. This will be useful later when we want to delete items
      item.setAttribute("data-note-id", cursor.value.id);

      // Create a button and place it inside each item
      const deleteBtn = document.createElement("i");
      deleteBtn.textContent = "remove";
      deleteBtn.classList.add("bx");
      deleteBtn.classList.add("bx-trash");
      item.appendChild(deleteBtn);

      // Set an event handler so that when the button is clicked, the deleteItem()
      // function is run
      deleteBtn.addEventListener("click", deleteItem);

      // Iterate to the next item in the cursor
      cursor.continue();
    } else {
      // Again, if list item is empty, display a 'No notes stored' message
      if (!tbody.firstChild) {
        document.querySelector(".empty").style.display = "flex";
        document.querySelector(".full").style.display = "none";

        //if list is empy set these to zero
        subTotal.textContent = "NGN" + 0;
        total.textContent = "NGN" + 0;
        totalPrice.value = 0;
      }

      // if there are no more cursor items to iterate through, say so
      console.log("Notes all displayed");
    }
  });
}

// Define the deleteItem() function
function deleteItem(e) {
  // retrieve the name of the task we want to delete. We need
  // to convert it to a number before trying to use it with IDB; IDB key
  // values are type-sensitive.
  const noteId = Number(e.target.parentNode.getAttribute("data-note-id"));

  // open a database transaction and delete the task, finding it using the id we retrieved above
  const transaction = db.transaction(["eyewear"], "readwrite");
  const objectStore = transaction.objectStore("eyewear");
  const deleteRequest = objectStore.delete(noteId);

  // report that the data item has been deleted
  transaction.addEventListener("complete", () => {
    // delete the parent of the button
    // which is the list item, so it is no longer displayed
    e.target.parentNode.parentNode.removeChild(e.target.parentNode);
    console.log(`Note ${noteId} deleted.`);

    // call the displayData function again so we call update subTotal, tax and total when an item is deleted
    // and so we can redisplay the cart items
    getAllCartItems();
    displayData();
  });
}

// Get an array with all the data in objectStore
function getAllCartItems() {
  const request = db.transaction("eyewear").objectStore("eyewear").getAll();

  request.onsuccess = () => {
    const items = request.result;
    console.log(items);

    //get number of items in cart
    document.querySelector(".cartNum").textContent = items.length;
    // display all the products in allProductsInfo
    let productInformation = items.map(function (item) {
      return item.prodId;
    });
    allProductsInfo.value = productInformation;
    // allProductsInfo.value = JSON.stringify(items);
    const top = document.querySelector(".top");
    top.style.display = "none";
    setTimeout(() => {
      top.style.display = "block";
    }, 1200);
  };
  request.onerror = (err) => {
    console.error(`Error to ge all items: ${err}`);
  };
}
