<?php
    require("db_connection.php");
    $subcat = $_GET["subcat"];
	$get_prod_cat = "SELECT id, prod_cat_name FROM product_category WHERE subcat_id = $subcat";
	$prod_cat_res = mysqli_query($conn, $get_prod_cat);
	if (mysqli_num_rows($prod_cat_res) > 0) {
		// output data of each row
		while($prod_cat = mysqli_fetch_assoc($prod_cat_res)) {
			echo '<option value="'. $prod_cat["id"] .'">'. $prod_cat["prod_cat_name"] .'</option>';
		}
	} else {
		echo "0 results";
	}
?>