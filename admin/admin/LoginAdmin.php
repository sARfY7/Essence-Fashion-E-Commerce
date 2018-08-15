<?php
    require("db_connection.php");
    session_start();
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $hashed_pass = md5($pass);
        $validate_email = "SELECT id FROM admin WHERE email = '$email'";
        $validate_email_res = mysqli_query($conn, $validate_email);
        if (mysqli_num_rows($validate_email_res) > 0) {
            $validate_pass = "SELECT id FROM admin WHERE email = '$email' AND password = '$hashed_pass'";
            $validate_pass_res = mysqli_query($conn, $validate_pass);
            if (mysqli_num_rows($validate_pass_res) > 0) {
                $admin = mysqli_fetch_assoc($validate_email_res);
                $_SESSION["adminID"] = $admin["id"];
                header("location: home.php");
            } else {
                header("location: index.php?status=1");
            }
        } else {
            header("location: index.php?status=0");
        }
    }
    mysqli_close($conn);
?>