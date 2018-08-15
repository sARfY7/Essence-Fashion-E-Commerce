<?php
      require("db_connection.php");
      $last_id = '';
      if (isset($_COOKIE["userID"])) {
            session_start();
		$_SESSION["userID"] = $_COOKIE["userID"];
		$user_id = $_COOKIE["userID"];
            $status=$_POST["status"]; 
            $firstname=$_POST["firstname"]; 
            $amount=$_POST["amount"]; //Please use the amount value from database 
            $txnid=$_POST["txnid"]; 
            $posted_hash=$_POST["hash"]; 
            $key=$_POST["key"]; 
            $productinfo=$_POST["productinfo"]; 
            $email=$_POST["email"];
            $txn_date = $_POST["addedon"];
            $address1 = $_POST["address1"];
            $address2 = $_POST["address2"];
            $zipcode = $_POST["zipcode"];
            $delivery_address = $address1. " " .$address2. " " .$zipcode;
            $salt="rDct8EBzYc"; //Please change the value with the live salt for production environment 
            //Validating the reverse hash 
            If (isset($_POST["additionalCharges"])) { 
                  $additionalCharges=$_POST["additionalCharges"]; 
                  $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key; 
                  
                              } 
            else {    
                  $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key; 
                  } 
            $hash = hash("sha512", $retHashSeq); 
            
                  if ($hash != $posted_hash) { 
                  echo "Transaction has been tampered. Please try again"; 
            } 
            else { 
                        
                  echo "<h3>Thank You, " . $firstname .".Your order status is ". $status .".</h3>"; 
                  echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
                  echo "<br><a href='index.php'>Go Home</a>";

                  // Adding Transaction

			$add_txn = "INSERT INTO transactions VALUES('$txnid', '$user_id', '$status', '$amount', '$email')";
                  mysqli_query($conn, $add_txn);
                  
                  if ($status == "success") {
                        // Getting Total Cart Value 

                        $get_total ="SELECT * FROM total WHERE user_id = \"$user_id\"";
                        $get_total_res = mysqli_query($conn, $get_total);
                        $get_total_row = mysqli_fetch_assoc($get_total_res);
                        $cart_total = $get_total_row["total"];
                        if ($cart_total != 0) {
                              // Adding Order

                              $add_order = "INSERT INTO orders(user_id, firstname, email, txn_id, delivery_address, date) VALUES('$user_id', '$firstname', '$email', '$txnid', '$delivery_address', '$txn_date')";
                              mysqli_query($conn, $add_order);
                              $last_id = mysqli_insert_id($conn);

                              // Getting Ordered Products from Cart

                              $fetch_cart ="SELECT * FROM cart WHERE user_id = \"$user_id\"";
                              $fetch_cart_res = mysqli_query($conn, $fetch_cart);
                              if (mysqli_num_rows($fetch_cart_res) > 0) {
                                    while($fetch_cart_row = mysqli_fetch_assoc($fetch_cart_res)) {

                                          // Adding Ordered Products

                                          $prod_id = $fetch_cart_row["prod_id"];
                                          $prod_size = $fetch_cart_row["prod_size"];
                                          $prod_color = $fetch_cart_row["prod_color"];
                                          $add_prod = "INSERT INTO ordered_products(order_id, prod_id, prod_size, prod_color) VALUES('$last_id', '$prod_id', '$prod_size', '$prod_color')";
                                          mysqli_query($conn, $add_prod);
                                    }
                              }

                              // Empty Cart

                              $empty_cart = "DELETE FROM cart WHERE user_id = \"$user_id\"";
                              mysqli_query($conn, $empty_cart);

                              }
                        }
                              
            }
      } else {
            echo "Cookie not set";
      }       
?> 