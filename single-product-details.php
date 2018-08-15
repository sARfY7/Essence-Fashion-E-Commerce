<?php
    require("db_connection.php");
    session_start();
    $prod_id = $_GET["pid"];
    $sql = "SELECT  products.prod_name,
                    products.prod_img,
                    products.prod_hover_img,
                    products.prod_price,
                    brands.brand_name
            FROM products
            INNER JOIN product_detail ON product_detail.prod_id = products.id
            INNER JOIN brands ON product_detail.prod_brand_id = brands.id
            WHERE products.id = \"$prod_id\"";
    $result = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_assoc($result);
?>

    <?php include("header.php") ?>
    <?php include("side-cart.php") ?>

    <!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <?php
                    $get_img = "SELECT * FROM product_images WHERE prod_id = \"$prod_id\"";
                    $get_img_res = mysqli_query($conn, $get_img);
                    if (mysqli_num_rows($get_img_res) > 0) {
                        while($image = mysqli_fetch_assoc($get_img_res)) {
                            echo '<img src="'. $image["image"] .'" alt="">';
                        }
                    } else {
                        echo '<img src="img/product-img/product-5.jpg" alt="">';
                    }
                ?>
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>
                <?php echo $row["brand_name"] ?>
            </span>
            <a href="cart.html">
                <h2>
                    <?php echo $row["prod_name"] ?>
                </h2>
            </a>
            <p class="product-price">&#x20B9;
                <?php echo $row["prod_price"] ?>
            </p>

            <script>
                function addToCart(product_id) {
                    var color = document.getElementById('productColor').value;
                    var size = document.getElementById('productSize').value;
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText == "Added to Cart successfully") {
                                swal("Yay!", this.responseText, "success");
                                // Get Cart Items
                                var xhr = new XMLHttpRequest();
                                xhr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        if(this.responseText == "Please login before Adding to Cart") {
                                            window.location = "login.php";
                                        } else {
                                            document.getElementById('cart-items').innerHTML = this.responseText;
                                        }
                                    }
                                };
                                xhr.open("GET", "FetchCartItems.php", true);
                                xhr.send();
                                // Get Cart Item Count
                                var xmlhr = new XMLHttpRequest();
                                xmlhr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        if(this.responseText == "Please login before Adding to Cart") {
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
                                // Get Cart Total
                                var xhttpr = new XMLHttpRequest();
                                xhttpr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById('cart-total').innerHTML = this.responseText;
                                    }
                                };
                                xhttpr.open("GET", "GetCartTotal.php", true);
                                xhttpr.send();
                            } else if(this.responseText == "Please login before Adding to Cart") {
                                window.location = "login.php";
                            } else if (this.responseText == "Product already in Cart") {
                                swal("Oops!", this.responseText, "error");
                            } else {
                                swal("Oops!", this.responseText, "error");
                            }
                        }
                    };
                    xhttp.open("POST", "AddToCart.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("prod-id=" + product_id + "&color=" + color + "&size=" + size);
                }

                function removeFromCart(product_id) {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.responseText == "Removed from Cart successfully") {
                                swal("Yay!", this.responseText, "success");
                                // Get Cart Items
                                var xhr = new XMLHttpRequest();
                                xhr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        if(this.responseText == "Please login before Adding to Cart") {
                                            window.location = "login.php";
                                        } else {
                                            document.getElementById('cart-items').innerHTML = this.responseText;
                                        }
                                    }
                                };
                                xhr.open("GET", "FetchCartItems.php", true);
                                xhr.send();
                                // Get Cart Item Count
                                var xmlhr = new XMLHttpRequest();
                                xmlhr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        if(this.responseText == "Please login before Adding to Cart") {
                                            window.location = "login.php";
                                        } else {
                                            document.getElementById('cart-item-count').innerHTML = this.responseText;
                                            document.getElementById('cart-item-count-nav').innerHTML = this.responseText;
                                            if (this.responseText == 0) {
                                                document.getElementById('checkout-button').innerHTML = '';
                                            }
                                        }
                                    }
                                };
                                xmlhr.open("GET", "CartItemCount.php", true);
                                xmlhr.send();
                                // Get Cart Total
                                var xhttpr = new XMLHttpRequest();
                                xhttpr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById('cart-total').innerHTML = this.responseText;
                                    }
                                };
                                xhttpr.open("GET", "GetCartTotal.php", true);
                                xhttpr.send();
                            } else if(this.responseText == "Please login before Adding to Cart") {
                                window.location = "login.php";
                            } else {
                                swal("Oops!", this.responseText, "error");
                            }
                    }
                    xhttp.open("POST", "RemoveFromCart.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("prod-id=" + product_id);
                }
            </script>

            <!-- Form -->
            <form class="cart-form clearfix" method="post">
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                        <?php
                        $get_size = "SELECT * FROM product_sizes WHERE prod_id = \"$prod_id\"";
                        $get_size_res = mysqli_query($conn, $get_size);
                        if (mysqli_num_rows($get_size_res) > 0) {
                            while($size = mysqli_fetch_assoc($get_size_res)) {
                                echo '<option value="'. $size["size"] .'">Size: '. $size["size"] .'</option>';
                            }
                        } else {
                            echo '<option value="">No Size Available</option>';
                        }
                    ?>
                    </select>
                    <select name="select" id="productColor">
                        <?php
                        $get_color = "SELECT * FROM product_colors WHERE prod_id = \"$prod_id\"";
                        $get_color_res = mysqli_query($conn, $get_color);
                        if (mysqli_num_rows($get_color_res) > 0) {
                            while($color = mysqli_fetch_assoc($get_color_res)) {
                                echo '<option value="'. $color["color"] .'">Color: '. $color["color"] .'</option>';
                            }
                        } else {
                            echo '<option value="">No Color Available</option>';
                        }
                    ?>
                    </select>
                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <button type="button" name="addtocart" onclick="return addToCart(<?php echo $prod_id ?>)" class="btn essence-btn">Add to cart</button>
                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="#">
                                <img src="img/core-img/logo2.png" alt="">
                            </a>
                        </div>
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <ul>
                                <li>
                                    <a href="contact.php">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                            <li>
                                <a href="#">Order Status</a>
                            </li>
                            <li>
                                <a href="#">Payment Options</a>
                            </li>
                            <li>
                                <a href="#">Shipping and Delivery</a>
                            </li>
                            <li>
                                <a href="#">Guides</a>
                            </li>
                            <li>
                                <a href="#">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#">Terms of Use</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_heading mb-30">
                            <h6>Subscribe</h6>
                        </div>
                        <div class="subscribtion_form">
                            <form action="#" method="post">
                                <input type="email" name="mail" class="mail" placeholder="Your email here">
                                <button type="submit" class="submit">
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest">
                                <i class="fa fa-pinterest" aria-hidden="true"></i>
                            </a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube">
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
    <!-- Sweet-Alert  -->
    <script src="js/sweetalert.min.js"></script>

    </body>

    </html>