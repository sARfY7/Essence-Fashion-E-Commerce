<?php
    require_once("db_connection.php");
    $user_id = "";
    $cart_item_count = "";
    if (isset($_SESSION["userID"])) {
        $user_id = $_SESSION["userID"];
        $get_cart_items = "SELECT cart.prod_id, cart.prod_size, cart.prod_color, brands.brand_name, products.prod_name, products.prod_img, products.prod_price  FROM cart INNER JOIN products ON products.id = cart.prod_id INNER JOIN product_detail ON product_detail.prod_id = products.id INNER JOIN brands ON brands.id = product_detail.prod_brand_id  WHERE user_id = '$user_id'";
        $get_cart_items_res = mysqli_query($conn, $get_cart_items);
        $cart_item_count = mysqli_num_rows($get_cart_items_res);

        $get_total = "SELECT * FROM total WHERE user_id = '$user_id'";
        $get_total_res = mysqli_query($conn, $get_total);
    }
?>
    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""> <span id="cart-item-count"><?php echo $cart_item_count ?></span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list" id="cart-items">
                <?php
                    if ($cart_item_count > 0) {
                        while($cart_item = mysqli_fetch_assoc($get_cart_items_res)) {
                            // Single Cart Item
                            echo '<div class="single-cart-item">';
                                echo '<a href="#" class="product-image">';
                                    echo '<img src="'. $cart_item["prod_img"] .'" class="cart-thumb" alt="">';
                                    // Cart Item Desc
                                    echo '<div class="cart-item-desc">';
                                    echo '<span class="product-remove" onclick="removeFromCart('. $cart_item["prod_id"] .')"><i class="fa fa-close" aria-hidden="true"></i></span>';
                                        echo '<span class="badge">'. $cart_item["brand_name"] .'</span>';
                                        echo '<h6>'. $cart_item["prod_name"] .'</h6>';
                                        echo '<p class="size">Size: '. $cart_item["prod_size"] .'</p>';
                                        echo '<p class="color">Color: '. $cart_item["prod_color"] .'</p>';
                                        echo '<p class="price">&#x20B9; '. $cart_item["prod_price"] .'</p>';
                                    echo '</div>';
                                echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        // Single Cart Item
                        echo '<div class="single-cart-item">';
                            echo '<h6>Cart is Empty';
                        echo '</div>';
                    }
                ?>
            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">
                <h2>Summary</h2>
                <ul class="summary-table" id="cart-total">
                <?php
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
                ?>
                </ul>
                <div class="checkout-btn mt-100" id="checkout-button">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Right Side Cart End ##### -->