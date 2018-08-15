<?php
    require("db_connection.php");
    $last_id = "";

    $prod_name = $_POST["prod-name"];
    $prod_price = $_POST["prod-price"];
    $prod_color = $_POST["prod-color"];
    $prod_size = "";
    if (isset($_POST["prod-size"])) {
        $prod_size = $_POST["prod-size"];
    }
    $prod_cat_id = $_POST["product-category"];
    $brand_id = $_POST["brand"];

    $prod_img_file_name = "";
    $prod_hover_img_file_name = "";
    $prod_img_file_tmp = "";
    $prod_hover_img_file_tmp = "";
    $prod_img_file_ext = "";
    $prod_hover_img_file_ext = "";
    $prod_img_file_dest = "";
    $prod_hover_img_file_dest = "";

    if (empty($prod_name) || empty($prod_price) || empty($prod_cat_id) || empty($brand_id)) {
        die("Please Fill All Fields");
    }

    if (isset($_FILES['prod-img']) && isset($_FILES['prod-hover-img']) && isset($_FILES['product-images'])) {
        $errors= array();
        $prod_img_file_name = $_FILES['prod-img']['name'];
        $prod_hover_img_file_name = $_FILES['prod-hover-img']['name'];
        $prod_img_file_tmp = $_FILES['prod-img']['tmp_name'];
        $prod_hover_img_file_tmp = $_FILES['prod-hover-img']['tmp_name'];
        $temp_prod_img = explode('.',$_FILES['prod-img']['name']);
        $temp_prod_hover_img = explode('.',$_FILES['prod-hover-img']['name']);
        $prod_img_file_ext = strtolower(end($temp_prod_img));
        $prod_hover_img_file_ext = strtolower(end($temp_prod_hover_img));
        $prod_img_file_dest = "img/product-showcase-img/".$prod_img_file_name;
        $prod_hover_img_file_dest = "img/product-showcase-img/".$prod_hover_img_file_name;

        $expensions= array("jpeg","jpg","png");
        
        if (in_array($prod_img_file_ext,$expensions)=== false || in_array($prod_hover_img_file_ext,$expensions)=== false) {
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if (empty($errors)==true) {
           move_uploaded_file($prod_img_file_tmp, "../../img/product-showcase-img/".$prod_img_file_name);
           move_uploaded_file($prod_hover_img_file_tmp, "../../img/product-showcase-img/".$prod_hover_img_file_name);

           $add_prod = "INSERT INTO products(prod_cat_id, prod_name, prod_img, prod_hover_img, prod_price) VALUES('$prod_cat_id', '$prod_name', '$prod_img_file_dest', '$prod_hover_img_file_dest', '$prod_price')";
            if (!empty($prod_name) && !empty($prod_price) && count($prod_color) != 0 && count($prod_size) != 0) {
                if (mysqli_query($conn, $add_prod)) {
                    $last_id = mysqli_insert_id($conn);
                    $add_prod_detail = "INSERT INTO product_detail VALUES('$last_id', '$brand_id')";
                    if (mysqli_query($conn, $add_prod_detail)) {
                        echo "New Product Added successfully";
                        foreach ($prod_color as $color) {
                            $color = strtoupper($color);
                            $add_prod_color = "INSERT INTO product_colors VALUES('$last_id', '$color')";
                            mysqli_query($conn, $add_prod_color);
                        }
                        foreach ($prod_size as $size) {
                            $add_prod_size = "INSERT INTO product_sizes VALUES('$last_id', '$size')";
                            mysqli_query($conn, $add_prod_size);
                        }
                        for ($i=0; $i < count($_FILES["product-images"]["name"]); $i++) {
                            $product_images_file_name = $_FILES['product-images']['name'][$i];
                            $product_images_file_tmp = $_FILES['product-images']['tmp_name'][$i];
                            $temp_product_images = explode('.',$_FILES['product-images']['name'][$i]);
                            $product_images_file_ext = strtolower(end($temp_product_images));
                            $product_images_file_dest = "img/product-img/".$product_images_file_name; 
                            if (in_array($product_images_file_ext,$expensions) === false) {
                                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                            }
                            if (empty($errors) == true) {
                                move_uploaded_file($product_images_file_tmp, "../../img/product-img/".$product_images_file_name);
                                $add_product_images = "INSERT INTO product_images VALUES('$last_id', '$product_images_file_dest')";
                                mysqli_query($conn, $add_product_images);
                            }
                        }
                    } else {
                        echo "Product Adding Error: " . $add_prod_detail . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "Product Adding Error: " . $add_prod . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Please Enter a Product Name";
            }
        } else {
           print_r($errors);
        }
    }
?>