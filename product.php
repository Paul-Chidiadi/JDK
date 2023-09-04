<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JDK EYEWEARS|PRODUCTS</title>

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

    <!-- OUR PRODUCT SECTION -->
    <section class="goods">
      <div class="title">
        <h4>Our Products</h4>
      </div>
      <div class="category">
        <select name="" id="category">
          <option value="Men">Men</option>
          <option value="Women">Women</option>
          <option value="Aviators">Aviators</option>
          <option value="Sun Glasses">Sun Glasses</option>
          <option value="Acetate Frames">Acetate Frames</option>
          <option value="Cat Eye Frames">Cat Eye Frames</option>
          <option value="Anti Blue-Filter Frames">Anti Blue-FIlter Frames</option>
          <option value="Square Shaped Frames">Square Shaped Frames</option>
        </select>
      </div>

      <!--START OF SECTIONS OF PRODUCTS -->
      <div id="prod1" class="prod active">
        <!-- FETCH PRODUCTS -->
      </div>
      <div id="prod2" class="prod">
        <!-- FETCH MORE PRODUCTS -->
      </div>
      <div id="prod3" class="prod">
        <!-- FETCH MORE PRODUCTS -->
      </div>
      <div id="prod4" class="prod">
        <!-- FETCH MORE PRODUCTS -->
      </div>
      <div id="prod5" class="prod">
        <!-- FETCH MORE PRODUCTS -->
      </div>
      <!--END OF SECTIONS OF PRODUCTS -->

      <div class="counters">
        <ul>
          <i class="bx bxs-left-arrow"></i>
          <button id="one" class="list active">
            <p>1</p>
          </button>
          <button id="two" class="list">
            <p>2</p>
          </button>
          <button id="three" class="list">
            <p>3</p>
          </button>
          <button id="four" class="list">
            <p>4</p>
          </button>
          <button id="five" class="list">
            <p>5</p>
          </button>
          <i class="bx bxs-right-arrow"></i>
        </ul>
      </div>

    </section>

    <!-- FOOTER SECTION -->
    <?php include_once 'include/footer.php'?>

    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/goods.js"></script>
  </body>
</html>