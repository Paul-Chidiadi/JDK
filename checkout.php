<?php 

  #GET DETAILS FROM CART PAGE
  if (isset($_POST['order_productInfo'])) {
    $info = $_POST['order_productInfo'];
    $price = $_POST['order_total'];
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JDK EYEWEARS|CHECKOUT</title>

    <!--MAin CSS file-->
    <link rel="stylesheet" href="css/index.css" />
    <!--BOXICONS CSS-->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>

    <!-- WHATSAPP SECTION -->
    <a class="whatsapp" href="#" target="_blank" rel="noopener noreferrer"><i class="bx bxl-whatsapp"></i></a>

    <!-- RESPONSE POP UP -->
    <div class="response" id="response"></div>

    <!-- HEADER SECTION -->
    <header>
        <nav class="navbar" id="navbar">
            <a href="index.php">
                <img class="logo" src="images/logo.png" alt="" />
            </a>
        </nav>
    </header>

    <!-- CHECKOUT SECTION -->
    <div class="checkout">
        <div class="empty">
            <div>
                <img src="images/logo1.png" alt="">
            </div>
            <p>Fill in your details <br> Click on pay to proceed to make payment!</p>
            <form action="#" method="post" id="payForm">
                <input type="hidden" class="control" id="info" value="<?php echo $info;?>" disabled>
                <input type="hidden" class="control" id="price" value="<?php echo $price;?>" disabled>
                <input type="text" class="control" placeholder="Full Name" id="name">
                <input type="email" class="control" placeholder="Email" id="email">
                <input type="text" class="control" placeholder="Phone Number" id="phone">
                <input type="text" class="control" placeholder="Delivery Address" id="address">
                <input type="submit" id="pay" onclick="payWithPaystack()" class="btn" 
                  value="PAY <?php 
                    if (isset($_POST['order_productInfo'])) {
                      $price = $_POST['order_total'];
                      echo "NGN ".$price;
                    } else {
                    }
                    ?>"
                >
            </form>
        </div>
    </div>

    <!-- FOOTER SECTION -->
    <?php include_once 'include/footer.php'?>

    <script type="text/javascript" src="js/index.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
      const payForm = document.getElementById('payForm');
      payForm.addEventListener("submit", payWithPaystack, false);
      function payWithPaystack(e) {
        e.preventDefault();

        let handler = PaystackPop.setup({
          key: 'pk_test_b1cfb688df315b782cce521f4e260e251446d787', // Replace with your public key
          email: document.getElementById("email").value,
          amount: document.getElementById("price").value * 100,
          firstname: document.getElementById("name").value,
          ref: 'EYETXR-' + Math.floor((Math.random() * 10000) + 1),
          metadata: {
            price: document.getElementById("price").value,
            email: document.getElementById("email").value,
            name: document.getElementById("name").value,
            phone: document.getElementById("phone").value,
            address: document.getElementById("address").value,
            products_info: document.getElementById("info").value,
            order_No: 'JDK-' + Math.floor((Math.random() * 10000) + 1),
          },
          onClose: function(){
            window.location = "cart.php";
            alert('Transaction Cancelled.');
          },
          callback: function(response){
            let message = 'Payment complete! Reference: ' + response.reference;
            alert(message);
            window.location = "confirm.php?reference=" + response.reference;
          }
        });

        handler.openIframe();
      }
    </script>
    
    
  </body>
</html>