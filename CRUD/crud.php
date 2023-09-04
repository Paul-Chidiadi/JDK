<?php
    include '../include/conn.php';

    #START CHECK PRODUCTS 
    if (isset($_POST['check'])) {
        $category = $conn->real_escape_string($_POST['check']);
        $sql = $conn->query("SELECT * FROM products WHERE category='$category' LIMIT 8 OFFSET 8");
        $result = "";
        if ($sql-> num_rows > 0) {
            $result .= "yes";
        }else {
            $result .= "No more products found!";
        }
        exit($result);
    }
    if (isset($_POST['check3'])) {
        $category = $conn->real_escape_string($_POST['check3']);
        $sql = $conn->query("SELECT * FROM products WHERE category='$category' LIMIT 8 OFFSET 16");
        $result = "";
        if ($sql-> num_rows > 0) {
            $result .= "yes";
        }else {
            $result .= "No more products found!";
        }
        exit($result);
    }
    if (isset($_POST['check4'])) {
        $category = $conn->real_escape_string($_POST['check4']);
        $sql = $conn->query("SELECT * FROM products WHERE category='$category' LIMIT 8 OFFSET 24");
        $result = "";
        if ($sql-> num_rows > 0) {
            $result .= "yes";
        }else {
            $result .= "No more products found!";
        }
        exit($result);
    }
    if (isset($_POST['check5'])) {
        $category = $conn->real_escape_string($_POST['check5']);
        $sql = $conn->query("SELECT * FROM products WHERE category='$category' LIMIT 8 OFFSET 32");
        $result = "";
        if ($sql-> num_rows > 0) {
            $result .= "yes";
        }else {
            $result .= "No more products found!";
        }
        exit($result);
    }
    #END CHECK PRODUCTS

    #PHP GET PRODUCTS SECTION 1
    if (isset($_POST['category'])) {
        $category = $conn->real_escape_string($_POST['category']);
        $sql = $conn->query("SELECT * FROM products WHERE category ='$category' LIMIT 8");
        $result = "";
        if ($sql-> num_rows > 0) {
            while ($data = $sql->fetch_array()) {
                $result .= "
                    <div class='set'>
                        <div class='image'>
                            <img src='". $data['product_image']. "' alt='' />
                            <a href='". $data['try_on']. "' target='_blank' rel='noopener noreferrer'>Try on</a>
                        </div>
                        <div class='name'>
                            <p>". $data['product_name']. "</p>
                            <img src='images/love.png' alt='' />
                        </div>
                        <small>NGN". $data['price']. "</small>
                        <section>
                            <a href='add.php?id=". $data['product_id']. "' target='_blank' rel='noopener noreferrer'>BUY NOW</a>
                        </section>
                    </div>
                ";
            }
        }else {
            $result .= "No products found!";
        }
        exit($result);
    }

    #PHP GET PRODUCTS SECTION 2
    if (isset($_POST['cate2'])) {
        $category = $conn->real_escape_string($_POST['cate2']);
        $sql = $conn->query("SELECT * FROM products WHERE category='$category' LIMIT 8 OFFSET 8");
        $result = "";
        if ($sql-> num_rows > 0) {
            while ($data = $sql->fetch_array()) {
                $result .= "
                    <div class='set'>
                        <div class='image'>
                            <img src='". $data['product_image']. "' alt='' />
                            <a href='". $data['try_on']. "' target='_blank' rel='noopener noreferrer'>Try on</a>
                        </div>
                        <div class='name'>
                            <p>". $data['product_name']. "</p>
                            <img src='images/love.png' alt='' />
                        </div>
                        <small>NGN". $data['price']. "</small>
                        <section>
                            <a href='add.php?id=". $data['product_id']. "' target='_blank' rel='noopener noreferrer'>BUY NOW</a>
                        </section>
                    </div>
                ";
            }
        }else {
            $result .= "No more products found!";
        }
        exit($result);
    }

    #PHP GET PRODUCTS SECTION 3
    if (isset($_POST['cate3'])) {
        $category = $conn->real_escape_string($_POST['cate3']);
        $sql = $conn->query("SELECT * FROM products WHERE category='$category' LIMIT 8 OFFSET 16");
        $result = "";
        if ($sql-> num_rows > 0) {
            while ($data = $sql->fetch_array()) {
                $result .= "
                    <div class='set'>
                        <div class='image'>
                            <img src='". $data['product_image']. "' alt='' />
                            <a href='". $data['try_on']. "' target='_blank' rel='noopener noreferrer'>Try on</a>
                        </div>
                        <div class='name'>
                            <p>". $data['product_name']. "</p>
                            <img src='images/love.png' alt='' />
                        </div>
                        <small>NGN". $data['price']. "</small>
                        <section>
                            <a href='add.php?id=". $data['product_id']. "' target='_blank' rel='noopener noreferrer'>BUY NOW</a>
                        </section>
                    </div>
                ";
            }
        }else {
            $result .= "No more products found!";
        }
        exit($result);
    }

    #PHP GET PRODUCTS SECTION 4
    if (isset($_POST['cate4'])) {
        $category = $conn->real_escape_string($_POST['cate4']);
        $sql = $conn->query("SELECT * FROM products WHERE category='$category' LIMIT 8 OFFSET 24");
        $result = "";
        if ($sql-> num_rows > 0) {
            while ($data = $sql->fetch_array()) {
                $result .= "
                    <div class='set'>
                        <div class='image'>
                            <img src='". $data['product_image']. "' alt='' />
                            <a href='". $data['try_on']. "' target='_blank' rel='noopener noreferrer'>Try on</a>
                        </div>
                        <div class='name'>
                            <p>". $data['product_name']. "</p>
                            <img src='images/love.png' alt='' />
                        </div>
                        <small>NGN". $data['price']. "</small>
                        <section>
                            <a href='add.php?id=". $data['product_id']. "' target='_blank' rel='noopener noreferrer'>BUY NOW</a>
                        </section>
                    </div>
                ";
            }
        }else {
            $result .= "No more products found!";
        }
        exit($result);
    }

    #PHP GET PRODUCTS SECTION 5
    if (isset($_POST['cate5'])) {
        $category = $conn->real_escape_string($_POST['cate5']);
        $sql = $conn->query("SELECT * FROM products WHERE category='$category' LIMIT 8 OFFSET 32");
        $result = "";
        if ($sql-> num_rows > 0) {
            while ($data = $sql->fetch_array()) {
                $result .= "
                    <div class='set'>
                        <div class='image'>
                            <img src='". $data['product_image']. "' alt='' />
                            <a href='". $data['try_on']. "' target='_blank' rel='noopener noreferrer'>Try on</a>
                        </div>
                        <div class='name'>
                            <p>". $data['product_name']. "</p>
                            <img src='images/love.png' alt='' />
                        </div>
                        <small>NGN". $data['price']. "</small>
                        <section>
                            <a href='add.php?id=". $data['product_id']. "' target='_blank' rel='noopener noreferrer'>BUY NOW</a>
                        </section>
                    </div>
                ";
            }
        }else {
            $result .= "No more products found!";
        }
        exit($result);
    }



?>