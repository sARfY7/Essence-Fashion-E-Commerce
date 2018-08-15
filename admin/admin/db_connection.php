<?php
    $server = "127.0.0.1";
    $user = "root";
    $pwd = "";
    $db = "essence";
    $conn = mysqli_connect($server, $user, $pwd, $db);
    if($conn === false){
        echo "ERROR: Could not connect. " . mysqli_connect_error();
    }
?>