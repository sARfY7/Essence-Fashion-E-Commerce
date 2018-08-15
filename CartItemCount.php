<?php
    require("db_connection.php");
    session_start();
    if (isset($_SESSION["userID"])) {
        $user_id = $_SESSION["userID"];
        $get_cart_items = "SELECT id FROM cart WHERE user_id = '$user_id'";
        $get_cart_items_res = mysqli_query($conn, $get_cart_items);
        $cart_item_count = mysqli_num_rows($get_cart_items_res);
        echo $cart_item_count;
    } else {
        die("Please login before Adding to Cart");
    }
    mysqli_close($conn);
?>