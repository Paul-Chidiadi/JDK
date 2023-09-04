<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JDK EYEWEARS|CART</title>

    <!--MAin CSS file-->
    <link rel="stylesheet" href="css/index.css" />
    <!--BOXICONS CSS-->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>

    <!-- HEADER SECTION -->
    <?php include_once 'include/header.php'?>

    <!-- WHATSAPP SECTION -->
    <a class="whatsapp" href="#" target="_blank" rel="noopener noreferrer"><i class="bx bxl-whatsapp"></i></a>

    <!-- POP SECTION -->
    <div id='pop' class='pop'>
      <div class='pop-body'>
        <div id="listed" class="prod">
          <!-- SEARCHED ITEMS APPEAR HERE -->        
        </div>
      </div>
      <div class='cancelbtn' id='cancel'>
        <i class='bx bx-x'></i>
      </div>
    </div>
    <!-- Overlays on the background when pop up is active -->
    <div id='overlay' class='' ></div>

    <!-- CART ITEMS SECTION -->
    <div class="cart">
        <div class="empty">
            <div><i class="bx bxs-cart-alt"></i></div>
            <p>Your cart is empty! <br> Browse our categories and discover our best deals!</p>
            <a href="product.php" class="btn">Start Shopping</a>
        </div>

        <div class="full">
            <div id="items" class="items">
                <!-- DISPLAY CART ITEMS HERE -->
            </div>
            
            <div class="sum">
                <h5>CART SUMMARY</h5>
                <div>
                    <div class="col">
                        <p>Subtotal</p>
                        <p id="sub">0.00</p>
                    </div>
                    <div class="col">
                        <p>Delivery Fee</p>
                        <p id="defee">0.00</p>
                    </div>
                    <div class="col">
                        <p>Total</p>
                        <p id="total">0.00</p>
                    </div>
                </div>
                <hr>
                <form action="checkout.php" method="post" id="checkForm">
                    <input type="hidden" id="products_info" name="order_productInfo">
                    <input type="hidden" id="totalPrice" name="order_total"> 
                    <button class="btn" id="checkout">CHECKOUT</button>
                </form>
            </div>
        </div>

    </div>

    <!-- FOOTER SECTION -->
    <?php include_once 'include/footer.php'?>

    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/cart.js"></script>
    
  </body>
</html>