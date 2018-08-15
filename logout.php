<?php
    session_start();
    session_destroy();
    setcookie("userID", "", time() - 3600);
    header("location: index.php");
?>