<?php require("db_connection.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Essence - Fashion Ecommerce Site</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">
    <!--alerts CSS -->
    <link href="css/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>

</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="index.php">
                    <img src="img/core-img/logo.png" alt="">
                </a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap">
                            <span class="top"></span>
                            <span class="bottom"></span>
                        </div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <?php
                                $get_cat = "SELECT * FROM category";
                                $get_cat_res = mysqli_query($conn, $get_cat);
                                if (mysqli_num_rows($get_cat_res) > 0) {
                                    while($cat = mysqli_fetch_assoc($get_cat_res)) {
                                        echo '<li><a href="#">'. $cat["cat_name"] .'</a>';
                                        echo '<div class="megamenu">';
                                        $cat_id = $cat["id"];
                                        $get_subcat = "SELECT * FROM subcategory WHERE cat_id = \"$cat_id\"";
                                        $get_subcat_res = mysqli_query($conn, $get_subcat);
                                        if (mysqli_num_rows($get_subcat_res) > 0) {
                                            while($subcat = mysqli_fetch_assoc($get_subcat_res)) {
                                                echo '<ul class="single-mega cn-col-4">';
                                                echo '<li class="title">'. $subcat["subcat_name"] .'</li>';
                                                $subcat_id = $subcat["id"];
                                                $get_prod_cat = "SELECT * FROM product_category WHERE subcat_id = \"$subcat_id\"";
                                                $get_prod_cat_res = mysqli_query($conn, $get_prod_cat);
                                                if (mysqli_num_rows($get_prod_cat_res) > 0) {
                                                    while($prod_cat = mysqli_fetch_assoc($get_prod_cat_res)) {
                                                        echo '<li><a href="shop.php?prod-cat-id='. $prod_cat["id"] .'&prod-cat='. rawurlencode($prod_cat["prod_cat_name"]) .'&cat-id='. $cat["id"] .'">'. $prod_cat["prod_cat_name"] .'</a></li>';
                                                    }
                                                } else {
                                                    echo "0 Product Categories";
                                                }
                                                echo '</ul>';
                                            }
                                        } else {
                                            echo "0 SubCategories";
                                        }
                                    }
                                    echo '</div>';
                                    echo '</li>';
                                } else {
                                    echo "0 Categories";
                                }
                            ?>
                                <li>
                                    <a href="contact.php">Contact</a>
                                </li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <?php
                if (isset($_SESSION["userID"])) {
            ?>
            <script>
                window.onload = function () {
                    var xmlhr = new XMLHttpRequest();
                    xmlhr.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText == "Please login before Adding to Cart") {
                                window.location = "login.php";
                            } else {
                                document.getElementById('cart-item-count').innerHTML = this.responseText;
                                document.getElementById('cart-item-count-nav').innerHTML = this.responseText;
                                if (this.responseText != 0) {
                                    document.getElementById('checkout-button').innerHTML = '<a href="checkout.php" class="btn essence-btn">check out</a>';
                                }
                            }
                        }
                    };
                    xmlhr.open("GET", "CartItemCount.php", true);
                    xmlhr.send();
                }
            </script>
            <?php
                }
            ?>

            <script>
                function fill(Value) {   
                    $('#headerSearch').val(Value);   
                    $('#result').hide();
                }

                $(document).ready(function () {   
                    $("#headerSearch").keyup(function () {       
                        var name = $('#headerSearch').val();       
                        if (name == "") {           
                            $("#result").html("");       
                        } 
                        else {           
                            $.ajax({               
                                type: "POST",
                                url: "search.php",
                                data: {        
                                    search: name               
                                },
                                success: function (html) {                  
                                    $("#result").html(html).show();               
                                }           
                            });       
                        }   
                    });
                });                    
            </script>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <div class="search-area">
                    <form action="#" method="post">
                        <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                        <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                    <ul id="result">

                    </ul>
                </div>
                <!-- User Login Info -->
                <div class="user-login-info" id="user-login">
                    <a href="#">
                        <img src="img/core-img/user.svg" alt="">
                    </a>
                    <ul id="options">
                    <?php
                        if (isset($_SESSION["userID"])) {
                    ?>
                        <li><a href="account.php">Account</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                    <?php
                        } else {
                    ?>
                        <li><a href="login.php">Login</a></li>
                    <?php
                        }
                    ?>
                    </ul>
                </div>
                
                <script>
                    $('#options').css('opacity', '0');
                    $('#user-login').mouseenter(function () { 
                        $('#options').css({'opacity': '1', 'transition': '0.2s'});
                    });
                    $('#user-login').mouseleave(function () { 
                        $('#options').css({'opacity': '0', 'transition': '0.2s'});
                    });
                </script>

                <!-- Cart Area -->
                <?php
                    if (isset($_SESSION["userID"])) {
                ?>
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn">
                        <img src="img/core-img/bag.svg" alt="">
                        <span id="cart-item-count-nav">0</span>
                    </a>
                </div>
                <?php
                    }
                ?>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->