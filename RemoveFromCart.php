<?php
    require("db_connection.php");
    session_start();
    if (isset($_SESSION["userID"])) {
        $user_id = $_SESSION["userID"];
        $prod_id = $_POST["prod-id"];
        $remove_prod = "DELETE FROM cart WHERE prod_id = '$prod_id' AND user_id = '$user_id'";
        if (mysqli_query($conn, $remove_prod)) {
            echo "Removed from Cart successfully";
        } else {
            die("Remove from Cart Error: <br>" . mysqli_error($conn));
        }
    } else {
        die("Please login before Removing from Cart");
    }
    mysqli_close($conn);
?>