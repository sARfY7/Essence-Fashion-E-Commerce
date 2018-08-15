<?php
    require("db_connection.php");
    session_start();
    $prod_cat_id = "";
    $prod_cat_name = "";
    $category_id = "";
    $sql = "";
    if (isset($_GET["prod-cat-id"]) && isset($_GET["prod-cat"]) && isset($_GET["cat-id"])) {
        $prod_cat_id = $_GET["prod-cat-id"];
        $prod_cat_name = rawurldecode($_GET["prod-cat"]);
        $category_id = $_GET["cat-id"];
        $sql = "SELECT  products.prod_name,
                    products.id,
                    products.prod_img,
                    products.prod_hover_img,
                    products.prod_price,
                    brands.brand_name,
                    product_category.prod_cat_name
            FROM products
            INNER JOIN product_detail ON product_detail.prod_id = products.id
            INNER JOIN brands ON product_detail.prod_brand_id = brands.id
            INNER JOIN product_category ON products.prod_cat_id = product_category.id
            WHERE product_category.id = \"$prod_cat_id\"";
        if (isset($_GET["sort"])) {
            $sort = $_GET["sort"];
            if ($sort == "desc") {
                $sql = "SELECT  products.prod_name,
                                products.id,
                                products.prod_img,
                                products.prod_hover_img,
                                products.prod_price,
                                brands.brand_name,
                                product_category.prod_cat_name
                FROM products
                INNER JOIN product_detail ON product_detail.prod_id = products.id
                INNER JOIN brands ON product_detail.prod_brand_id = brands.id
                INNER JOIN product_category ON products.prod_cat_id = product_category.id
                WHERE product_category.id = \"$prod_cat_id\"
                ORDER BY products.prod_price DESC";
            } elseif ($sort == "asc") {
                $sql = "SELECT  products.prod_name,
                                products.id,
                                products.prod_img,
                                products.prod_hover_img,
                                products.prod_price,
                                brands.brand_name,
                                product_category.prod_cat_name
                FROM products
                INNER JOIN product_detail ON product_detail.prod_id = products.id
                INNER JOIN brands ON product_detail.prod_brand_id = brands.id
                INNER JOIN product_category ON products.prod_cat_id = product_category.id
                WHERE product_category.id = \"$prod_cat_id\"
                ORDER BY products.prod_price ASC";
            }
        }
    } else {
        $sql = "SELECT  products.prod_name,
                    products.id,
                    products.prod_img,
                    products.prod_hover_img,
                    products.prod_price,
                    brands.brand_name,
                    product_category.prod_cat_name
            FROM products
            INNER JOIN product_detail ON product_detail.prod_id = products.id
            INNER JOIN brands ON product_detail.prod_brand_id = brands.id
            INNER JOIN product_category ON products.prod_cat_id = product_category.id";
            if (isset($_GET["sort"])) {
                $sort = $_GET["sort"];
                if ($sort == "desc") {
                    $sql = "SELECT  products.prod_name,
                                    products.id,
                                    products.prod_img,
                                    products.prod_hover_img,
                                    products.prod_price,
                                    brands.brand_name,
                                    product_category.prod_cat_name
                    FROM products
                    INNER JOIN product_detail ON product_detail.prod_id = products.id
                    INNER JOIN brands ON product_detail.prod_brand_id = brands.id
                    INNER JOIN product_category ON products.prod_cat_id = product_category.id
                    WHERE product_category.id = \"$prod_cat_id\"
                    ORDER BY products.prod_price DESC";
                } elseif ($sort == "asc") {
                    $sql = "SELECT  products.prod_name,
                                    products.id,
                                    products.prod_img,
                                    products.prod_hover_img,
                                    products.prod_price,
                                    brands.brand_name,
                                    product_category.prod_cat_name
                    FROM products
                    INNER JOIN product_detail ON product_detail.prod_id = products.id
                    INNER JOIN brands ON product_detail.prod_brand_id = brands.id
                    INNER JOIN product_category ON products.prod_cat_id = product_category.id
                    WHERE product_category.id = \"$prod_cat_id\"
                    ORDER BY products.prod_price ASC";
                }
    }
}
    
    
    $result = mysqli_query($conn, $sql);
    $prod_count = mysqli_num_rows($result); 
?>

<?php include("header.php") ?>
<?php include("side-cart.php") ?>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2><?php echo $prod_cat_name ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Catagories</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                    <?php
                                        $get_subcat = "SELECT * FROM subcategory WHERE cat_id = '$category_id'";
                                        $get_subcat_res = mysqli_query($conn, $get_subcat);
                                        if (mysqli_num_rows($get_subcat_res) > 0) {
                                            while($subcat = mysqli_fetch_assoc($get_subcat_res)) {
                                                // Single Item
                                                echo '<li data-toggle="collapse" data-target="#'. strtolower($subcat["subcat_name"]) .'">';
                                                echo '<a href="#">'. $subcat["subcat_name"] .'</a>';
                                                echo '<ul class="sub-menu collapse show" id="'. strtolower($subcat["subcat_name"]) .'">';
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
                                                echo '</li>';
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Filter by</h6>
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Price</p>

                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="49" data-max="360" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="49" data-value-max="360" data-label-result="Range:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Range: $49.00 - $360.00</div>
                                </div>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget color mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Color</p>
                            <div class="widget-desc">
                                <ul class="d-flex">
                                    <li><a href="#" class="color1"></a></li>
                                    <li><a href="#" class="color2"></a></li>
                                    <li><a href="#" class="color3"></a></li>
                                    <li><a href="#" class="color4"></a></li>
                                    <li><a href="#" class="color5"></a></li>
                                    <li><a href="#" class="color6"></a></li>
                                    <li><a href="#" class="color7"></a></li>
                                    <li><a href="#" class="color8"></a></li>
                                    <li><a href="#" class="color9"></a></li>
                                    <li><a href="#" class="color10"></a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget brands mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Brands</p>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href="#">Asos</a></li>
                                    <li><a href="#">Mango</a></li>
                                    <li><a href="#">River Island</a></li>
                                    <li><a href="#">Topshop</a></li>
                                    <li><a href="#">Zara</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span><?php echo $prod_count ?></span> products found</p>
                                    </div>
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                            <select name="select" id="sortByselect">
                                                <option value="value">Highest Rated</option>
                                                <option value="value">Newest</option>
                                                <option value="value"><a href="shop.php?prod-cat-id=<?php echo $prod_cat_id ?>&prod-cat=<?php echo $prod_cat_name ?>&cat-id=<?php echo $category_id ?>&sort=desc">Price: $$ - $</a></option>
                                                <option value="value"><a href="shop.php?prod-cat-id=<?php echo $prod_cat_id ?>&prod-cat=<?php echo $prod_cat_name ?>&cat-id=<?php echo $category_id ?>&sort=asc">Price: $ - $$</a></option>
                                            </select>
                                            <input type="submit" class="d-none" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php
                                if ($prod_count > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        // Single Product
                                        echo '<div class="col-12 col-sm-6 col-lg-4">';
                                            echo '<div class="single-product-wrapper">';
                                                // Product Image
                                                echo '<div class="product-img">';
                                                    echo '<a href="single-product-details.php?pid='. $row["id"] .'">';
                                                    echo '<img src="'. $row["prod_img"] .'" alt="">';
                                                    // Hover Thumb
                                                    echo '<img class="hover-img" src="'. $row["prod_hover_img"] .'" alt="">';
                                                    echo '</a>';
                                                echo '</div>';
                                                // Product Description
                                                echo '<div class="product-description">';
                                                    echo '<span>'. $row["brand_name"] .'</span>';
                                                    echo '<a href="single-product-details.php?pid='. $row["id"] .'">';
                                                        echo '<h6>'. $row["prod_name"] .'</h6>';
                                                    echo '</a>';
                                                    echo '<p class="product-price">&#x20B9; '. $row["prod_price"] .'</p>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo "0 results";
                                }
                            ?>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">21</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="#"><img src="img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Payment Options</a></li>
                            <li><a href="#">Shipping and Delivery</a></li>
                            <li><a href="#">Guides</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Use</a></li>
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
                                <button type="submit" class="submit"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
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