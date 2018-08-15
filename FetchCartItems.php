<?php
    require("db_connection.php");
    session_start();
    if (isset($_SESSION["userID"])) {
        $user_id = $_SESSION["userID"];
        $get_cart_items = "SELECT cart.prod_id, cart.prod_size, cart.prod_color, brands.brand_name, products.prod_name, products.prod_img, products.prod_price  FROM cart INNER JOIN products ON products.id = cart.prod_id INNER JOIN product_detail ON product_detail.prod_id = products.id INNER JOIN brands ON brands.id = product_detail.prod_brand_id  WHERE user_id = '$user_id'";
        $get_cart_items_res = mysqli_query($conn, $get_cart_items);
        $cart_item_count = mysqli_num_rows($get_cart_items_res);
        if ($cart_item_count > 0) {
            while($cart_item = mysqli_fetch_assoc($get_cart_items_res)) {
                // Single Cart Item
                echo '<div class="single-cart-item">';
                    echo '<a href="single-product-details.php?pid='. $cart_item["prod_id"] .'" class="product-image">';
                        echo '<img src="'. $cart_item["prod_img"] .'" class="cart-thumb" alt="">';
                        // Cart Item Desc
                        echo '<div class="cart-item-desc">';
                        echo '<span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>';
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
    } else {
        die("Please login before Adding to Cart");
    }
    mysqli_close($conn);
?>