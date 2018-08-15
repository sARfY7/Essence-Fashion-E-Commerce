<?php
    require("db_connection.php");
    $prod_cat_name = $_POST["prod-cat-name"];
    $subcat_id = $_POST["subcategory"];
    $add_prod_cat = "INSERT INTO product_category(subcat_id, prod_cat_name) VALUES('$subcat_id', '$prod_cat_name')";
    if (!empty($prod_cat_name)) {
        if (mysqli_query($conn, $add_prod_cat)) {
            echo "New Product Category Added successfully";
        } else {
            echo "Product Category Adding Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Please Enter a Product Category Name";
    }
?>