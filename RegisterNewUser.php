<?php
    require("db_connection.php");
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $email = trim($_POST["email"]);
    $pass = trim($_POST["password"]);
    $cpass = trim($_POST["cpassword"]);
    $hashed_pass = "";
    $phone = trim($_POST["phone"]);
    if ($pass == $cpass) {
        $hashed_pass = md5($pass);
    } else {
        die("Passwords do not match");
    }

    $check_email = "SELECT id FROM users WHERE email = '$email'";
    $check_email_res = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($check_email_res) > 0) {
        die("Email already registered");
    } else {
        $add_user = "INSERT INTO users(first_name, last_name, email, password, phone) VALUES('$fname', '$lname', '$email', '$hashed_pass', '$phone')";
        if (mysqli_query($conn, $add_user)) {
            echo "User registered successfully";
            echo "<button type='button' onclick='document.location.href = \"index.php\"'>Home</button>";
        } else {
            die("User Registration Error: <br>" . mysqli_error($conn));
        }
    }
?>