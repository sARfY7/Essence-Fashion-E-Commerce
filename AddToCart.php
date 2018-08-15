<?php
    require("db_connection.php");
    session_start();
    if (isset($_SESSION["userID"])) {
        $user_id = $_SESSION["userID"];
        $prod_id = $_POST["prod-id"];
        $color = $_POST["color"];
        $size = $_POST["size"];
        $check = "SELECT id FROM cart WHERE prod_id = '$prod_id' AND user_id = '$user_id'";
        $check_res = mysqli_query($conn, $check);
        if (mysqli_num_rows($check_res) > 0) {
            echo "Product already in Cart";
        } else {
            $add_prod = "INSERT INTO cart(user_id, prod_id, prod_size, prod_color) VALUES('$user_id', '$prod_id', '$size', '$color')";
            if (mysqli_query($conn, $add_prod)) {
                echo "Added to Cart successfully";
            } else {
                die("Add to Cart Error: <br>" . mysqli_error($conn));
            }
        }
    } else {
        die("Please login before Adding to Cart");
    }
    mysqli_close($conn);
?>