<?php
    require_once("db_connection.php");
    session_start();
    $user_id = "";
    if (isset($_SESSION["userID"])) {
        $user_id = $_SESSION["userID"];
        $get_total = "SELECT * FROM total WHERE user_id = '$user_id'";
        $get_total_res = mysqli_query($conn, $get_total);
        if (mysqli_num_rows($get_total_res) > 0) {
            $total = mysqli_fetch_assoc($get_total_res);
            echo '<li><span>subtotal:</span> <span>&#x20B9; '. $total["total"] .'</span></li>';
            echo '<li><span>delivery:</span> <span>';
            if ($total["total"] >= 500) {
                echo 'FREE';
            } else {
                echo '&#x20B9; 50';
            }
            echo '</span></li>';
            echo '<li><span>total:</span> <span>&#x20B9; ';
            if ($total["total"] >= 500) {
                echo $total["total"];
            } else {
                echo $total["total"] - 50;
            }
            echo '</span></li>';
        } else {
            echo '<li><span>subtotal:</span> <span>&#x20B9; 0</span></li>';
            echo '<li><span>delivery:</span> <span>FREE</span></li>';
            echo '<li><span>total:</span> <span>&#x20B9; 0</span></li>';
        }
    }
    mysqli_close($conn);
?>