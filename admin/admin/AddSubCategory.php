<?php
    require("db_connection.php");
    $subcat_name = $_POST["subcat-name"];
    $cat_id = $_POST["category"];
    $add_subcat = "INSERT INTO subcategory(cat_id, subcat_name) VALUES('$cat_id', '$subcat_name')";
    if (!empty($subcat_name)) {
        if (mysqli_query($conn, $add_subcat)) {
            echo "New SubCategory Added successfully";
        } else {
            echo "SubCategory Adding Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Please Enter a SubCategory Name";
    }
?>