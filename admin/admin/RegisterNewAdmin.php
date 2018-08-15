<?php
    require("db_connection.php");
    $uname = trim($_POST["uname"]);
    $email = trim($_POST["email"]);
    $pass = trim($_POST["password"]);
    $cpass = trim($_POST["cpassword"]);
    $hashed_pass = "";
    if ($pass == $cpass) {
        $hashed_pass = md5($pass);
    } else {
        die("Passwords do not match");
    }

    $check_email = "SELECT id FROM admin WHERE email = '$email'";
    $check_email_res = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($check_email_res) > 0) {
        die("Email already registered");
    } else {
        $add_admin = "INSERT INTO admin(username, email, password) VALUES('$uname', '$email', '$hashed_pass')";
        if (mysqli_query($conn, $add_admin)) {
            echo "Admin registered successfully";
        } else {
            die("Admin Registration Error: <br>" . mysqli_error($conn));
        }
    }
?>