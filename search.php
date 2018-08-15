<?php
    include("db_connection.php");
    if (isset($_POST['search'])) {
        $name = $_POST["search"];
        $query = "SELECT prod_name, id FROM products WHERE prod_name LIKE '%$name%' LIMIT 5";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<li><a href="single-product-details.php?pid='. $row["id"] .'">'. $row["prod_name"] .'</a></li>';
            }
        } else {
            echo "0 results";
        }
    }
?>