<?php
    require("db_connection.php");
    session_start();
    $get_cart_items_checkout_res = "";
    $cart_item_count_checkout = "";
    $get_total_checkout_res = "";
    $total_checkout = "";
    $amount = "";
    if (isset($_SESSION["userID"])) {
        $user_id = $_SESSION["userID"];
        $get_cart_items_checkout = "SELECT cart.prod_id, products.prod_name, products.prod_price  FROM cart INNER JOIN products ON products.id = cart.prod_id  WHERE user_id = '$user_id'";
        $get_cart_items_checkout_res = mysqli_query($conn, $get_cart_items_checkout);
        $cart_item_count_checkout = mysqli_num_rows($get_cart_items_checkout_res);

        $get_total_checkout = "SELECT * FROM total WHERE user_id = '$user_id'";
        $get_total_checkout_res = mysqli_query($conn, $get_total_checkout);
        if (mysqli_num_rows($get_total_checkout_res) > 0) {
            $total_checkout = mysqli_fetch_assoc($get_total_checkout_res);
            $amount = ($total_checkout["total"] >= 500)?$total_checkout["total"]:$total_checkout["total"] + 50;
        }
        $cookie_name = "userID";
		$cookie_value = $user_id;
		setcookie($cookie_name, $cookie_value);
    } else {
        header("location: login.php");
    }
?>

<?php
    // Merchant key here as provided by Payu
    $MERCHANT_KEY = "1aheTQIM";

    // Merchant Salt as provided by Payu
    $SALT = "rDct8EBzYc";

    // End point - change to https://secure.payu.in for LIVE mode
    $PAYU_BASE_URL = "https://sandboxsecure.payu.in";

    $action = '';

    $posted = array();
    if(!empty($_POST)) {
        //print_r($_POST);
    foreach($_POST as $key => $value) {    
        $posted[$key] = $value; 
    
    }
    }

    $formError = 0;

    if(empty($posted['txnid'])) {
    // Generate random transaction id
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    } else {
    $txnid = $posted['txnid'];
    }
    $hash = '';
    // Hash Sequence
    $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    if(empty($posted['hash']) && sizeof($posted) > 0) {
    if(
            empty($posted['key'])
            || empty($posted['txnid'])
            || empty($posted['amount'])
            || empty($posted['firstname'])
            || empty($posted['email'])
            || empty($posted['phone'])
            || empty($posted['productinfo'])
            || empty($posted['surl'])
            || empty($posted['furl'])
        || empty($posted['service_provider'])
    ) {
        $formError = 1;
    } else {
        //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
    $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';  
    foreach($hashVarsSeq as $hash_var) {
        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
        $hash_string .= '|';
        }

        $hash_string .= $SALT;


        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAYU_BASE_URL . '/_payment';
    }
    } elseif(!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
    }
?>
    <?php include("header.php") ?>
    <?php include("side-cart.php") ?>
    <script>
        window.onload = function() {
            var hash = '<?php echo $hash ?>';
            if(hash == '') {
                return;
            }
            var payuForm = document.forms.payuForm;
            payuForm.submit();
        }
    </script>


    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading mb-30">
                            <h5>Billing Address</h5>
                        </div>

                        <?php if($formError) { ?>
  
                            <span style="color:red">Please fill all mandatory fields.</span>
                            <br/>
                            <br/>
                        <?php } ?>

                        <form action="<?php echo $action; ?>" method="post" name="payuForm">
                            <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                            <input type="hidden" name="hash" value="<?php echo $hash ?>" />
                            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                            <input type="hidden" name="amount" value="<?php echo $amount ?>" />
                            <input type="hidden" name="productinfo" value="<?php echo "Nil" ?>">
                            <input name="surl" type="hidden" value="http://localhost/essence/response.php" size="64" />
                            <input name="furl" type="hidden" value="http://localhost/essence/response.php" size="64" />
                            <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                            <input type="hidden" name="curl" value="" />
                            <input type="hidden" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
                            <input type="hidden" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
                            <input type="hidden" name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" />
                            <input type="hidden" name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" />
                            <input type="hidden" name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" />
                            <input type="hidden" name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" />
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstname">First Name
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>"
                                    />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastname">Last Name
                                        <span></span>
                                    </label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>"
                                    />
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="email">Email Address
                                        <span>*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>"
                                    />
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="phone">Phone No
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>"
                                    />
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="country">Country
                                        <span></span>
                                    </label>
                                    <input type="text" class="form-control" name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>"
                                    />
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="address1">Address 1
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>"
                                    />
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="address2">Address 2
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>"
                                    />
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="zipcode">Zipcode
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>"
                                    />
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="city">Town/City
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>"
                                    />
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="state">State
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>"
                                    />
                                </div>
                            </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                            <p>The Details</p>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li>
                                <span>Product</span>
                                <span>Total</span>
                            </li>
                            <?php
                                if ($cart_item_count_checkout > 0) {
                                    while($cart_item = mysqli_fetch_assoc($get_cart_items_checkout_res)) {
                                        echo '<li><span>'. $cart_item["prod_name"] .'</span> <span>&#x20B9; '. $cart_item["prod_price"] .'</span></li>';
                                    }
                                } else {
                                    echo '<li><span>Nothing in Cart</span> </li>';
                                }
                            ?>
                                <?php
                                if (mysqli_num_rows($get_total_checkout_res) > 0) {
                                    echo '<li><span>subtotal:</span> <span>&#x20B9; '. $total_checkout["total"] .'</span></li>';
                                    echo '<li><span>delivery:</span> <span>';
                                    if ($total_checkout["total"] >= 500) {
                                        echo 'FREE';
                                    } else {
                                        echo '&#x20B9; 50';
                                    }
                                    echo '</span></li>';
                                    echo '<li><span>total:</span> <span>&#x20B9; ';
                                    if ($total_checkout["total"] >= 500) {
                                        echo $total_checkout["total"];
                                    } else {
                                        echo $total_checkout["total"] + 50;
                                    }
                                    echo '</span></li>';
                                } else {
                                    echo '<li><span>subtotal:</span> <span>&#x20B9; 0</span></li>';
                                    echo '<li><span>delivery:</span> <span>FREE</span></li>';
                                    echo '<li><span>total:</span> <span>&#x20B9; 0</span></li>';
                                }
                            ?>
                        </ul>
                        <?php if(!$hash) { ?>
                                <input class="btn essence-btn" type="submit" value="Place Order" />
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->

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

    </body>

    </html>