<?php
    include '../include/conn.php';

    #PHP GET CUSTOMERS SECTION
    if (isset($_POST['customers'])) {
        $sql = $conn->query("SELECT * FROM customers");
        $result = "";
        if ($sql-> num_rows > 0) {
            while ($data = $sql->fetch_array()) {
                $result .= "
                    <tr>
                        <td>". $data['id']. "</td>
                        <td>". $data['name']. "</td>
                        <td>". $data['email']. "</td>
                    </tr>
                ";
            }
        }else {
            $result .= "No customers yet!";
        }
        exit($result);
    }

    #PHP GET ALL ORDERS SECTION
    if (isset($_POST['all'])) {
        $sql = $conn->query("SELECT * FROM orders");
        $result = "";
        if ($sql-> num_rows > 0) {
            while ($data = $sql->fetch_array()) {
                ($data['status'] === 'completed') ? $color = 'green' : $color = 'rgba(0, 0, 0, 0.5)';
                ($data['status'] === 'completed') ? $box = '0 0 0 0 #fff' : $box = '0px 1px 2px 0px rgba(0, 0, 0, 0.5)';
                ($data['status'] === 'completed') ? $href = '#' : $href = 'panel.php?id='.$data['order_number'];
                ($data['status'] === 'completed') ? $disable = 'disabled' : $disable = '';
                $result .= "
                    <tr>
                        <td>". $data['id']. "</td>
                        <td>". $data['order_number']. "</td>
                        <td>". $data['email']. "</td>
                        <td>". $data['address']. "</td>
                        <td>". $data['phone']. "</td>
                        <td>". $data['product_details']. "</td>
                        <td>". $data['date']. "</td>
                        <td>". $data['amount']. "</td>
                        <td><a class='btn' style='color: $color; box-shadow: $box;' href=$href $disable>". $data['status']. "</a></td>
                    </tr>
                ";
            }
        }else {
        }
        exit($result);
    }
    if (isset($_POST['comp'])) {
        $sql = $conn->query("SELECT * FROM orders WHERE status='completed'");
        $result = "";
        if ($sql-> num_rows > 0) {
            while ($data = $sql->fetch_array()) {
                ($data['status'] === 'completed') ? $color = 'green' : $color = 'rgba(0, 0, 0, 0.5)';
                ($data['status'] === 'completed') ? $box = '0 0 0 0 #fff' : $box = '0px 1px 2px 0px rgba(0, 0, 0, 0.5)';
                ($data['status'] === 'completed') ? $href = '#' : $href = 'panel.php?id='.$data['order_number'];
                ($data['status'] === 'completed') ? $disable = 'disabled' : $disable = '';
                $result .= "
                    <tr>
                        <td>". $data['id']. "</td>
                        <td>". $data['order_number']. "</td>
                        <td>". $data['email']. "</td>
                        <td>". $data['address']. "</td>
                        <td>". $data['phone']. "</td>
                        <td>". $data['product_details']. "</td>
                        <td>". $data['date']. "</td>
                        <td>". $data['amount']. "</td>
                        <td><a class='btn' style='color: $color; box-shadow: $box;' href=$href $disable>". $data['status']. "</a></td>
                    </tr>
                ";
            }
        }else {
        }
        exit($result);
    }
    if (isset($_POST['pend'])) {
        $sql = $conn->query("SELECT * FROM orders WHERE status='pending'");
        $result = "";
        if ($sql-> num_rows > 0) {
            while ($data = $sql->fetch_array()) {
                ($data['status'] === 'completed') ? $color = 'green' : $color = 'rgba(0, 0, 0, 0.5)';
                ($data['status'] === 'completed') ? $box = '0 0 0 0 #fff' : $box = '0px 1px 2px 0px rgba(0, 0, 0, 0.5)';
                ($data['status'] === 'completed') ? $href = '#' : $href = 'panel.php?id='.$data['order_number'];
                ($data['status'] === 'completed') ? $disable = 'disabled' : $disable = '';
                $result .= "
                    <tr>
                        <td>". $data['id']. "</td>
                        <td>". $data['order_number']. "</td>
                        <td>". $data['email']. "</td>
                        <td>". $data['address']. "</td>
                        <td>". $data['phone']. "</td>
                        <td>". $data['product_details']. "</td>
                        <td>". $data['date']. "</td>
                        <td>". $data['amount']. "</td>
                        <td><a class='btn' style='color: $color; box-shadow: $box;' href=$href $disable>". $data['status']. "</a></td>
                    </tr>
                ";
            }
        }else {
        }
        exit($result);
    }

    #PHP CRUD FOR CHANGE PASSWORD SECTION
    if (isset($_POST['current-password'])) {
        $current = $conn->real_escape_string($_POST['current-password']);
        $new = $conn->real_escape_string($_POST['new-password']);
        $confirm = $conn->real_escape_string($_POST['confirm-password']);

        if (!empty($current) && !empty($new) && !empty($confirm)) {
            if ($new === $confirm){
                $sql = $conn->query("SELECT password FROM admin");
                $data = $sql->fetch_array();
                $pass = $data['password'];
                if ($pass === $current) {
                    //update admin details
                    $sqlupdate = $conn->query("UPDATE admin SET password='$password'");            
                    if ($sqlupdate) {
                        exit('<font>Successful</font>');
                    }else {
                        exit('<font>Failed!</font>');
                    }
                } else {
                    exit('<font>Current password incorrect</font>');
                }
            } else {
                exit('<font>Passwords doesn`t match</font>');
            }
        }else {
            exit('<font>Empty Inputs!</font>');
        }
    }

    #PHP UPLOAD NEW PRODUCT SECTION
    if (isset($_POST['name'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $tryon = $conn->real_escape_string($_POST['tryon']);
        $category = $conn->real_escape_string($_POST['category']);
        $price = $conn->real_escape_string($_POST['price']);

        # GENERATING PRODUCT ID
        $code = "1234567890";
        $code = str_shuffle($code);
        $coded = substr($code, 0, 4);
        $productId = "EYE-".$coded;

        if (!empty($name) && !empty($tryon) && !empty($price) && !empty($_FILES['file'])) {
            $file = $_FILES['file'];
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            if($fileError === 0) {
                if($fileSize <= 4000000) {
                    $fileNewName = $productId.".".$fileActualExt;
                    $fileDestination = 'uploadsImg/'.$fileNewName;
                    $fileMove = '../uploadsImg/'.$fileNewName;

                    #INSERT INTO DATABASE
                    $sql = "INSERT INTO products (product_id, product_name, product_image, category, price, try_on)
                    VALUES ('$productId', '$name', '$fileDestination', '$category', '$price', '$tryon')";
                    if (mysqli_query($conn, $sql)) {
                        move_uploaded_file($fileTmpName, $fileMove);
                        exit('<font>Successful!</font>');
                    }else {
                        exit('<font>Failed!</font>');
                    }
                }else {
                    exit('<font>File too Large!</font>');
                }
            }else {
                exit('<font>Image Error, try Again!</font>');
            }
        }else {
            exit('<font>Empty Inputs!</font>');
        }
    }

    #PHP UPLOAD DEAL OF THE DAY PRODUCT SECTION
    if (isset($_POST['product-name'])) {
        $name = $conn->real_escape_string($_POST['product-name']);
        $tryon = $conn->real_escape_string($_POST['tryon']);
        $category = $conn->real_escape_string($_POST['category']);
        $price = $conn->real_escape_string($_POST['price']);
        $percent = $conn->real_escape_string($_POST['percent-discount']);
        $discount = $conn->real_escape_string($_POST['discount-price']);

        # GENERATING PRODUCT ID
        $code = "1234567890";
        $code = str_shuffle($code);
        $coded = substr($code, 0, 4);
        $productId = "EYE-".$coded;
        
        if (!empty($name) && !empty($tryon) && !empty($price) && !empty($discount) && !empty($_FILES['file'])) {
            $file = $_FILES['file'];
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            if($fileError === 0) {
                if($fileSize <= 4000000) {
                    $fileNewName = $productId.".".$fileActualExt;
                    $fileDestination = 'uploadsImg/'.$fileNewName;
                    $fileMove = '../uploadsImg/'.$fileNewName;

                    #INSERT INTO DATABASE
                    $sql = "INSERT INTO deal (product_id, product_name, product_image, category, price, percent_discount, discount_price, try_on)
                    VALUES ('$productId', '$name', '$fileDestination', '$category', '$price', '$percent', '$discount', '$tryon')";
                    if (mysqli_query($conn, $sql)) {
                        move_uploaded_file($fileTmpName, $fileMove);
                        exit('<font>Successful!</font>');
                    }else {
                        exit('<font>Failed!</font>');
                    }
                }else {
                    exit('<font>File too Large!</font>');
                }
            }else {
                exit('<font>Image Error, try Again!</font>');
            }
        }else {
            exit('<font>Empty Inputs!</font>');
        }
        
    }

?>