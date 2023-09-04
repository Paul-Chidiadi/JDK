<?php
  include 'include/conn.php';

  #INSERT CUSTOMER DETAILS TO DATABASE
  if (isset($_POST['send'])) {
    $email = $conn->real_escape_string($_POST['emailPHP']);
    $name = $conn->real_escape_string($_POST['namePHP']);

    if (!empty($email) && !empty($name)) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          #INSERT INTO DATABASE
          $sql = "INSERT INTO customers (email, name) VALUES ('$email', '$name')";
          if (mysqli_query($conn, $sql)) {
            exit('<font>Subscription Successful</font>');
          } else {
            exit('<font>Subscription Failed</font>');
          }
      }else {
        exit('<font>Email not Valid!</font>');
      }
    }else{
      exit('<font>Empty Inputs!</font>');
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JDK EYEWEARS</title>

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
      <div class='cancelbtn' id='cancel'>
        <i class='bx bx-x'></i>
      </div>
      <div class='pop-body'>
        <div id="listed" class="prod">
          <!-- SEARCHED ITEMS APPEAR HERE -->        
        </div>
      </div>
    </div>
    <!-- Overlays on the background when pop up is active -->
    <div id='overlay' class='' ></div>

    <!-- RESPONSE POP UP -->
    <div class="response" id="response"></div>

    <!-- HERO SECTION -->
    <section class="hero">
      <div class="col one">
        <h1 class="big">
          Shop The Latest In Fashion <span>EYEWEAR</span> at Our Online Store.
        </h1>
        <small>
          Our collection of super stylish, acetate and bluelight blocking
          glasses are designed to fit your unique style and define vision.Shop
          now and see the world in a whole new way.
        </small>
        <a class="btn" href="product.php">SHOP NOW</a>
      </div>
      <div class="col">
        <div>
          <!-- hero image here -->
        </div>
      </div>
    </section>

    <!-- COLLECTION SECTION -->
    <section class="collection">
      <h4>New Collections</h4>
      <div class="glasses">
        <div class="col">
          <div>
            <img src="images/acetate.png" alt="" />
          </div>
          <p>Acetate Glasses</p>
        </div>
        <div class="col">
          <div>
            <img src="images/anti-blue.png" alt="" />
          </div>
          <p>Anti-blue Filter Frames</p>
        </div>
        <div class="col">
          <div>
            <img src="images/sun.png" alt="" />
          </div>
          <p>Sun Glasses</p>
        </div>
      </div>
      <a href="product.php" class="see">See More</a>
    </section>

    <!-- INFO SECTION -->
    <section class="info">
      <img src="images/assurance.png" alt="" />
    </section>

    <!-- OUR PRODUCT SECTION -->
    <section class="collection">
      <h4>Our Products</h4>
      <div id="prod" class="prod">
        <!-- PRODUCTS WILL DYNAMICALLY APPEAR HERE -->
      </div>
      <a href="product.php" class="see">See More</a>
    </section>

    <!-- DEALS SECTION -->
    <section id="deal" class="deals">
      <!-- DEAL OF THE DAY WILL DYNAMICALLY APPEAR HERE -->
      <?php
        $sqlDeal = $conn->query("SELECT * FROM deal");
        $dataDeal = $sqlDeal->fetch_array();
      ?>
      <div class='green'></div>
      <div class='time'>
        <h3>Deal of the Day</h3>
        <small
            >Get amazing deals from our flash<br />
            sales today.</small
        >
        <div class='box'>
            <div>
                <p id='hour'></p>
                <small>Hours</small>
            </div>
            <div>
                <p id='min'></p>
                <small>Minutes</small>
            </div>
            <div>
                <p id='sec'></p>
                <small>Seconds</small>
            </div>
        </div>
        <a class='btn' href="add.php?idDeal=<?php echo $dataDeal['product_id']; ?>" target='_blank' rel='noopener noreferrer'>SHOP NOW</a>
      </div>
      <div class='img'>
          <a href='<?php echo $dataDeal['try_on']; ?>' target='_blank' rel='noopener noreferrer'>Try on</a>
          <img src='<?php echo $dataDeal['product_image']; ?>' alt='' />
          <div class='discount'>
              <h3><?php echo $dataDeal['percent_discount'];?></h3>
              <h4>NGN <?php echo $dataDeal['price']; ?></h4>
              <h5>NGN <?php echo $dataDeal['discount_price']; ?></h5>
          </div>
      </div>
    </section>

    <!-- TESTIMONIAL SECTION -->
    <section class="test">
      <h3>Testimonials</h3>
      <div class="image">
        <img src="images/test.png" alt="" />
      </div>
    </section>

    <!-- NEWSLETTER SECTION -->
    <section class="news">
      <div class="col1">
        <img src="images/logo1.png" alt="" />
      </div>
      <div class="col2">
        <h3>Subscribe to Our News Letter</h3>
        <form action="#" id="letter">
          <input type="text" class="control" id="name" placeholder="Full Name" />
          <input type="email" class="control" id="email" placeholder="email" />
          <input type="button" id="submit" class="btn" value="Subscribe" />
        </form>
      </div>
    </section>

    <!-- FOOTER SECTION -->
    <?php include_once 'include/footer.php'?>

    <script type="text/javascript" src="js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
          $("#letter").on("submit", function (e) {
              e.preventDefault();
          });
          $("#submit").on("click", function () {
              let email = $('#email').val();
              let name = $('#name').val();

              $.ajax({
                  url: "index.php",
                  method: "POST",
                  data: {
                      send: 1,
                      emailPHP: email,
                      namePHP: name
                  },
                  success: function (response) {
                      if(response) {
                          $("#response").html(response);
                          $("#response").css("display", "block");
                          setTimeout(() => {
                            $('#email').val("");
                            $('#name').val("");
                            $("#response").css("display", "none");
                          }, 7000);
                      }
                  },
                  dataType: "text",
              })
          })
      })
    </script>
  </body>
</html>
