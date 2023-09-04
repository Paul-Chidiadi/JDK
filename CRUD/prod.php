<?php
    include '../include/conn.php';

    $sqlProd = $conn->query("SELECT * FROM products LIMIT 8");
    $output = "";
    if ($sqlProd->num_rows > 0) {
        while ($data = $sqlProd->fetch_array()) {
            $output .= "
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
    }else{
        $output .= "No product is availble";
    }
    exit($output);

?>