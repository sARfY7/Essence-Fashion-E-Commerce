<?php
    require("db_connection.php");
    session_start();
    $user = "";
    $user_id = "";
    if (isset($_SESSION["userID"])) {
        $user_id = $_SESSION["userID"];
        $get_user = "SELECT first_name, last_name, phone, email FROM users WHERE id = '$user_id'";
        $get_user_res = mysqli_query($conn, $get_user);
        $user = mysqli_fetch_assoc($get_user_res);
    } else {
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Account Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="vendor/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/account.css">
</head>

<body>
    <div class="contact-area">
        <div class="contact">
            <main>
                <section>
                    <div class="content">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/256492/_mLIxaKY_400x400.jpg" alt="Profile Image">

                        <aside>
                            <h1><?php echo $user["first_name"]. " " .$user["last_name"] ?></h1>
                            <p>Email: <?php echo $user["email"] ?></p>
                            <p>Phone: <?php echo $user["phone"] ?></p>
                        </aside>

                        <div class="home-log-out">
                            <a href="index.php"><i class="fa fa-home fa-2x"></i></a>
                            <a href="logout.php"><i class="fas fa-sign-out-alt fa-2x"></i></a>
                        </div>

                        <button>
                            <span>View Orders</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                <g class="nc-icon-wrapper" fill="#444444">
                                    <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path>
                                </g>
                            </svg>
                        </button>
                    </div>

                    <div class="title">
                        <p>Orders</p>
                    </div>
                </section>


            </main>

            <nav>
                <?php
                    $get_orders = "SELECT orders.id, orders.date, transactions.amount FROM orders INNER JOIN transactions ON orders.txn_id = transactions.id WHERE orders.user_id = '$user_id'";
                    $get_orders_res = mysqli_query($conn, $get_orders);
                    if (mysqli_num_rows($get_orders_res) > 0) {
                        while($order = mysqli_fetch_assoc($get_orders_res)) {
                ?>
                <a href="#" class="order">

                    <div class="content">
                        <h1>Order ID : <?php echo $order["id"] ?></h1>
                        <?php
                            $order_id = $order["id"];
                            $get_prod = "SELECT products.id, products.prod_name, products.prod_img, products.prod_price FROM ordered_products INNER JOIN products ON products.id = ordered_products.prod_id WHERE ordered_products.order_id = '$order_id'";
                            $get_prod_res = mysqli_query($conn, $get_prod);
                            if (mysqli_num_rows($get_prod_res) > 0) {
                                while($product = mysqli_fetch_assoc($get_prod_res)) {
                                    $order_date = date_create_from_format("Y-m-d G:i:s", $order["date"]);
                                    $order_date = date_format($order_date, 'D, M jS, Y');
                        ?>
                        <div class="product">
                            <div class="icon">
                                <img src="<?php echo $product["prod_img"] ?>" alt="">
                            </div>
                            <div class="name">
                                <span><?php echo $product["prod_name"] ?></span>
                            </div>
                            <div class="price">
                                <span>&#x20B9; <?php echo $product["prod_price"] ?></span>
                            </div>
                        </div>
                    <?php
                            }
                        } else {
                            echo "No Products";
                        }
                    ?>
                        <div class="date-total">
                            <div class="order-date">
                                <span>Order Date: <b><font color="black"><?php echo $order_date ?></font></b></span>
                            </div>
                            <div class="order-total">
                                <span>Order Total: &#x20B9; <b><font color="black"><?php echo $order["amount"] ?></font></b></span>
                            </div>
                        </div>
                    </div>
                    <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                        <g class="nc-icon-wrapper" fill="#444444">
                            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
                        </g>
                    </svg>
                </a>
                <?php
                        }
                    } else {
                        echo "No Orders";
                    }
                ?>

            </nav>
        </div>
    </div>
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/account.js"></script>
</body>

</html>