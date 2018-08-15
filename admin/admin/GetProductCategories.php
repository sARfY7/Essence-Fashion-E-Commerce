<?php
    require("db_connection.php");
    $get_prod_cats = "SELECT product_category.id, product_category.prod_cat_name, subcategory.subcat_name FROM product_category INNER JOIN subcategory ON product_category.subcat_id = subcategory.id";
    $get_prod_cats_res = mysqli_query($conn, $get_prod_cats);
    if (mysqli_num_rows($get_prod_cats_res) > 0) {
        // output data of each row
        while($prod_cat = mysqli_fetch_assoc($get_prod_cats_res)) {
            echo '<tr>';
                echo '<td>'. $prod_cat["id"] .'</td>';
                echo '<td>'. $prod_cat["prod_cat_name"] .'</td>';
                echo '<td>'. $prod_cat["subcat_name"] .'</td>';
            echo '<tr>';	
        }
    } else {
        echo "0 results";
    }
?>