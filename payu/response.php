<?php 
$status=$_POST["status"]; 
$firstname=$_POST["firstname"]; 
$amount=$_POST["amount"]; //Please use the amount value from database 
$txnid=$_POST["txnid"]; 
$posted_hash=$_POST["hash"]; 
$key=$_POST["key"]; 
$productinfo=$_POST["productinfo"]; 
$email=$_POST["email"]; 
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
           
            
     }          
?> 