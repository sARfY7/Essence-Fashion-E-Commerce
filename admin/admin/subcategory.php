<?php
    require("db_connection.php");
    $cat = $_GET["cat"];
	$get_subcat = "SELECT id, subcat_name FROM subcategory WHERE cat_id = $cat";
	$subcat_res = mysqli_query($conn, $get_subcat);
	if (mysqli_num_rows($subcat_res) > 0) {
		// output data of each row
		while($subcat = mysqli_fetch_assoc($subcat_res)) {
			echo '<option value="'. $subcat["id"] .'">'. $subcat["subcat_name"] .'</option>';
		}
	} else {
		echo "0 results";
	}
?>