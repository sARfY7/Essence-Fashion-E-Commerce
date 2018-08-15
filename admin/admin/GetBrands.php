<?php
    require("db_connection.php");
    $get_brands = "SELECT brands.id, brands.brand_name, product_category.prod_cat_name FROM brands INNER JOIN product_category ON brands.prod_cat_id = product_category.id";
    $get_brands_res = mysqli_query($conn, $get_brands);
    if (mysqli_num_rows($get_brands_res) > 0) {
        // output data of each row
        while($brand = mysqli_fetch_assoc($get_brands_res)) {
            echo '<tr>';
                echo '<td>'. $brand["id"] .'</td>';
                echo '<td>'. $brand["brand_name"] .'</td>';
                echo '<td>'. $brand["prod_cat_name"] .'</td>';
            echo '<tr>';	
        }
    } else {
        echo "0 results";
    }
?>