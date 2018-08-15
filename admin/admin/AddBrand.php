<?php
    require("db_connection.php");
    $brand_name = $_POST["brand-name"];
    $prod_id = $_POST["product-category"];
    $add_brand = "INSERT INTO brands(prod_cat_id, brand_name) VALUES('$prod_id', '$brand_name')";
    if (!empty($brand_name)) {
        if (mysqli_query($conn, $add_brand)) {
            echo "New Brand Added successfully";
        } else {
            echo "Brand Adding Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Please Enter a Brand Name";
    }
?>