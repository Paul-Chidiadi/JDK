<?php
  include 'include/conn.php';
    session_start();

    // # if user is not logged in take them back to admin.php
    // if (!isset($_SESSION['loggedIN'])) {
    //     header('Location: admin.php');
    //     exit();
    // }

    if (isset($_GET['id'])) {
        $orderId = $_GET['id'];
        $respnse = "";
        $sqlUpdate = $conn->query("UPDATE orders SET status='completed' WHERE order_number='$orderId'");
        if ($sqlUpdate) {
            $respnse = "SUCCESS";
        } else {
            $respnse = "FAILED!";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JDK EYEWEARS|ADMIN</title>

    <!--MAin CSS file-->
    <link rel="stylesheet" href="css/panel.css" />
    <!--BOXICONS CSS-->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- BOOTSTRAP STYLESHEET -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    </head>
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
  </head>
  <body>
     <!-- WRAPPER -->
     <div class="wrapper">
            <!-- SIDEBAR -->
            <div class="sidebar">
                <img class="logo" src="images/logo1.png" alt="">
                <ul>
                    <li id="or" class="list active">
                        <i class='bx bxs-cart-alt'></i>
                        <a href="#">Orders</a>
                    </li>
                    <li id="pr" class="list">
                        <i class='bx bxs-shopping-bag'></i>
                        <a href="#">Products</a>
                    </li>
                    <li id="cu" class="list">
                        <i class='bx bxs-user'></i>
                        <a href="#">Customers</a>
                    </li>
                    <li id="se" class="list">
                        <i class='bx bxs-cog'></i>
                        <a href="#">Settings</a>
                    </li>
                </ul>
                <div id="logg" class="logg">
                    <i class='bx bxs-exit'></i>
                    <a href="logout.php">Log out</a>
                </div>
            </div>

            <!-- RESPONSE POP UP -->
            <div class="response" id="response"></div>

            <!-- MAIN CONTENT -->
            <div class="main">
                <!-- Orders -->
                <section id="orders" class="menu active">
                    <div class="title">
                        <h4>ORDERS</h4>
                    </div>
                    <div class="status">
                        <p id="all" class="ord active">ALL ORDERS</p>
                        <p id="comp" class="ord">COMPLETED</p>
                        <p id="pend" class="ord">PENDING</p>
                    </div>
                    <div class="order">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ORDER ID</th>
                                    <th>EMAIL</th>
                                    <th>ADDRESS</th>
                                    <th>PHONE</th>
                                    <th>PRODUCT DETAILS</th>
                                    <th>DATE</th>
                                    <th>AMOUNT</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <!-- RESPONSE POP UP -->
                            <div id="respnse" style="color: green; width: 100%; text-align: center; font-size: 13px; font-weight: bold;">
                                <?php
                                    if (isset($_GET['id'])) {
                                        echo $respnse;
                                    }else {

                                    }
                                ?> 
                            </div>
                            <tbody id="sales">
                                <!-- GET ORDERS FROM DATABASE-->
                                <?php
                                    $sql = $conn->query("SELECT * FROM orders");
                                    if ($sql-> num_rows > 0) {
                                        while ($data = $sql->fetch_array()) {
                                            ($data['status'] === 'completed') ? $color = 'green' : $color = 'rgba(0, 0, 0, 0.5)';
                                            ($data['status'] === 'completed') ? $box = '0 0 0 0 #fff' : $box = '0px 1px 2px 0px rgba(0, 0, 0, 0.5)';
                                            ($data['status'] === 'completed') ? $href = '#' : $href = 'panel.php?id='.$data['order_number'];
                                            ($data['status'] === 'completed') ? $disable = 'disabled' : $disable = '';
                                            echo "
                                                <tr>
                                                    <td>". $data['id']. "</td>
                                                    <td>". $data['order_number']. "</td>
                                                    <td>". $data['email']. "</td>
                                                    <td>". $data['address']. "</td>
                                                    <td>". $data['phone']. "</td>
                                                    <td>". $data['product_details']. "</td>
                                                    <td>". $data['date']. "</td>
                                                    <td style='text-align: center;'>". $data['amount']. "</td>
                                                    <td><a class='btn' style='color: $color; box-shadow: $box;' href=$href $disable>". $data['status']. "</a></td>
                                                </tr>
                                            ";
                                        }
                                    }else {
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Products -->
                <section id="products" class="menu">
                    <div class="title">
                        <h4>UPLOAD PRODUCTS</h4>
                    </div>
                    <div class="add">
                        <h5><i class='bx bx-upload'></i> Add New Product</h5>
                        <form action="#" method="post" id="new">
                            <div class="col">
                                <div class="sect">
                                    <div>
                                        <Label>Product name</Label>
                                        <input type="text" class="control" name="name" id="product-name" placeholder="product name">
                                    </div>
                                    <div>
                                        <Label>Try On Link</Label>
                                        <input type="text" class="control" name="tryon" id="tryon" placeholder="try on link">
                                    </div>
                                </div>
                                <div class="sect">
                                    <div>
                                        <label>Category</label>
                                        <select name="category" id="category" class="control">
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
                                    <div>
                                        <label>Price</label>
                                        <input type="number" class="control" name="price" id="price" placeholder="price">
                                    </div>
                                </div>
                                <input type="button" class="btn" name="upload-new" id="upload-new" value="Add Product">
                            </div>
                            <div id="drop-area" class="side">
                                <i class='bx bxs-file'></i>
                                <p>Drag and drop images files here</p>
                                <input type="file" id="free" onchange="handleFiles(this.files)">
                                <label class="button" for="free">Select an image</label>
                            </div>
                        </form>
                    </div>

                    <div class="add">
                        <h5><i class='bx bx-upload'></i> Add Deal of the day</h5>
                        <form action="#" method="post" id="day">
                            <div class="col">
                            <div class="sect">
                                    <div>
                                        <Label>Product name</Label>
                                        <input type="text" class="control" name="product-name" id="name" placeholder="product name">
                                    </div>
                                    <div>
                                        <Label>Try On Link</Label>
                                        <input type="text" class="control" name="tryon" id="on" placeholder="try on link">
                                    </div>
                                </div>
                                <div class="sect">
                                    <div>
                                        <label>Category</label>
                                        <select name="category" id="category" class="control">
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
                                    <div>
                                        <label>Price</label>
                                        <input type="number" class="control" name="price" id="pric" placeholder="price">
                                    </div>
                                </div>
                                <div class="sect">
                                    <div>
                                        <label>% Discount</label>
                                        <select name="percent-discount" id="percent-discount" class="control">
                                            <option value="10%">10%</option>
                                            <option value="20%">20%</option>
                                            <option value="30%">30%</option>
                                            <option value="40%">40%</option>
                                            <option value="50%">50%</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label>Current slashed Price</label>
                                        <input type="number" class="control" name="discount-price" id="discount-pric" placeholder="discount price">
                                    </div>
                                </div>
                                <input type="button" class="btn" name="upload-day" id="upload-day" value="Add Product">
                            </div>
                            <div id="drop-zone" class="side">
                                <i class='bx bxs-file'></i>
                                <p>Drag and drop images files here</p>
                                <input type="file" id="Elem" onchange="andleFiles(this.files)">
                                <label class="button" for="Elem">Select an image</label>
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Customers -->
                <section id="customers" class="menu">
                    <div class="title">
                        <h4>CUSTOMERS</h4>
                    </div>
                    <div class="order">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                </tr>
                            </thead>
                            <tbody id="customer">
                                <!-- GET CUSTOMERS DATA INFO -->
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Settings -->
                <section id="settings" class="menu">
                    <div class="title">
                        <h4>SETTINGS</h4>
                    </div>
                    <div class="add">
                        <h5><i class='bx bx-upload'></i> Change Password</h5>
                        <form action="#" method="post" id="update">
                            <div class="col">
                                <div>
                                    <Label>Current Password</Label>
                                    <input type="password" class="control" name="current-password" id="current-password" placeholder="current password">
                                </div>
                                <div>
                                    <Label>New Password</Label>
                                    <input type="password" class="control" name="new-password" id="new-password" placeholder="new password">
                                </div>
                                <div>
                                    <Label>Confirm New Password</Label>
                                    <input type="password" class="control" name="confirm-password" id="confirm-password" placeholder="confirm password">
                                </div>
                                <input type="button" class="btn" id="change-password" value="Change Password">
                            </div>
                        </form>
                    </div>
                </section>

            </div>
        </div>

    <script type="text/javascript" src="js/panel.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>    
    <script src="js/jquery.dataTables.min.js" ></script>
    <script src="js/dataTables.bootstrap.min.js" ></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.table').DataTable();
        });
        setInterval(() => {
            $("#respnse").css("display", "none");
        }, 5000);
    </script>

  </body>
</html>