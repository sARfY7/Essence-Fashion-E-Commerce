<?php
    require("db_connection.php");
    $get_subcats = "SELECT subcategory.id, subcategory.subcat_name, category.cat_name FROM subcategory INNER JOIN category ON subcategory.cat_id = category.id";
    $get_subcats_res = mysqli_query($conn, $get_subcats);
    if (mysqli_num_rows($get_subcats_res) > 0) {
        // output data of each row
        while($subcat = mysqli_fetch_assoc($get_subcats_res)) {
            echo '<tr>';
                echo '<td>'. $subcat["id"] .'</td>';
                echo '<td>'. $subcat["subcat_name"] .'</td>';
                echo '<td>'. $subcat["cat_name"] .'</td>';
            echo '<tr>';	
        }
    } else {
        echo "0 results";
    }
?>