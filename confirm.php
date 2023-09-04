<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JDK EYEWEARS|CONFIRM</title>

    <!--MAin CSS file-->
    <link rel="stylesheet" href="css/index.css" />
    <!--BOXICONS CSS-->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="body">

    <!-- HEADER SECTION -->
    <!-- <header>
        <nav class="navbar" id="navbar">
            <a href="index.php">
                <img class="logo" src="images/logo.png" alt="" />
            </a>
        </nav>
    </header> -->

    <!-- SCREENSHOT BUTTON -->
    <button id="screenshot" class="screenshot"><i class='bx bx-save'></i>Save Receipt</button>

    <?php
      include 'include/conn.php';
      $ref = $_GET['reference'];
      $url = "https://api.paystack.co/transaction/verify/$ref";
      if ($ref = "") {
          header('Location: cart.php');
      } else {
          $curl = curl_init();
        
          curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                  "Authorization: Bearer sk_test_5ca666dc2f228e0e0e93da8d02d0b18430828052",
                  "Cache-Control: no-cache",
              ),
          ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
      
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $result = json_decode($response);
          if ($result->data->status == 'success') {
            $date = $result->data->created_at;
            #collect items needed for database
            $email = $result->data->metadata->email;
            $price = $result->data->metadata->price;
            $name = $result->data->metadata->name;
            $phone = $result->data->metadata->phone;
            $address = $result->data->metadata->address;
            $products_info = $result->data->metadata->info;
            $orderNo = $result->data->metadata->order_No;
            $stat = "pending";
            echo $stat, $price, $address, $orderNo, $date;
            # Insert  all data into Database
            $sql = "INSERT INTO orders (order_number, email, address, phone, product_details, date, amount, status) 
            VALUES ('$orderNo', '$email', '$address', '$phone', '$products_info', '$date', '$price', '$stat')";
            $connt = mysqli_query($conn, $sql);
            if ($connt) {
              echo "
                <div class='confirm'>
                    <div class='mark'>
                        <i class='bx bx-check'></i>
                    </div>
                    <p>YOUR ORDER HAS BEEN CONFIRMED</p>
                    <div class='name'>
                        <h5>Hello $name,</h5>
                        <small>Your order has been confirmed and will be shipped shortly.</small>
                    </div>

                    <div class='det'>
                        <div class='part'>
                            <h5>Order Date</h5>
                            <small>$date</small>
                        </div>
                        <div class='part'>
                            <h5>Order No</h5>
                            <small>$orderNo</small>
                        </div>
                        <div class='part'>
                            <h5>Product Id</h5>
                            <small>$products_info</small>
                        </div>
                        <div class='part'>
                            <h5>Shipping Address</h5>
                            <small>$address</small>
                        </div>
                    </div>

                    <div class='product'>
                        <div class='sold'>
                            <div class='image'>
                            <img src='images/acetate.png' alt='' />
                            </div>
                            <div class='name'>
                            <p>Acetate</p>
                            <small>EYE-7239</small>
                            <small>#5000</small>
                            </div>
                        </div>
                        <div class='sold'>
                            <div class='image'>
                            <img src='images/acetate.png' alt='' />
                            </div>
                            <div class='name'>
                            <p>Acetate</p>
                            <small>EYE-7239</small>
                            <small>#5000</small>
                            </div>
                        </div>
                        <div class='sold'>
                            <div class='image'>
                            <img src='images/acetate.png' alt='' />
                            </div>
                            <div class='name'>
                            <p>Acetate</p>
                            <small>EYE-7239</small>
                            <small>#5000</small>
                            </div>
                        </div>
                    </div>

                    <div class='receipt'>
                        <hr>
                        <div class='col'>
                            <p>Subtotal</p>
                            <small>#11,000</small>
                        </div>
                        <div class='col'>
                            <p>Delivery Fee</p>
                            <small>#200</small>
                        </div>
                        <div class='col'>
                            <p>Total</p>
                            <small>#11,200</small>
                        </div>
                    </div>

                    <div class='regards'>
                        <small>We'll be sending a shipping confirmation email when the item has<br> been shipped successfully</small>
                        <h5>Thank you for shopping with us.</h5>
                        <p>Judikay</p>
                    </div>

                </div>
              ";
            } else {
              echo "problem with your code";
            }
          }else {
            echo 'Payment can not be processed, try again!';
          }
        }
      }

    ?>

    <!-- FOOTER SECTION -->
    <!-- <?php include_once 'include/footer.php'?> -->

    <script src="https://superal.github.io/canvas2image/canvas2image.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script>
      //CONRIRM PAGE JS SCRIPT
      document.getElementById("screenshot").addEventListener("click", function () {
        console.log("clicked");
        html2canvas(document.querySelector(".body"), {
          onrendered: function (canvas) {
            // document.body.appendChild(canvas);
            Canvas2Image.saveAsPNG(canvas);
          },
        });
      });
    </script>
  </body>
</html>