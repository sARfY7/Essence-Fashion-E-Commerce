<?php
    require("db_connection.php");
    $prod_cat = $_GET["prod-cat"];
	$get_brand = "SELECT id, brand_name FROM brands WHERE prod_cat_id = $prod_cat";
	$brand_res = mysqli_query($conn, $get_brand);
	if (mysqli_num_rows($brand_res) > 0) {
		// output data of each row
		while($brand = mysqli_fetch_assoc($brand_res)) {
			echo '<option value="'. $brand["id"] .'">'. $brand["brand_name"] .'</option>';
		}
	} else {
		echo '<option>No Brand Available</option>';
	}
?>