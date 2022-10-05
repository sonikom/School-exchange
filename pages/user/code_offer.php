<?php
$table_offer_cusromer = '';
$table_offer_seller = '';

$email = $_SESSION['email_logout_user'];
$p = 1;    
    $con=  mysqli_connect($host, $user, $pass, $db);
    $sql_book_money = "CALL pr_book_money('$email');";
    $query_book_money = mysqli_query($con, $sql_book_money);
    while ($r_book_money = mysqli_fetch_assoc($query_book_money)) {
        $id = $r_book_money['id'];
        $name = $r_book_money['name'];
        $price = $r_book_money['price'];   
        $quantity = $r_book_money['quantity'];
        $datetime = $r_book_money['datetime'];
            
            $radio_book_money = 'radio_book_money'.$p;
            $table_offer_cusromer .= "<tr><td><input  name ='radio_book_money' type ='radio' value='$id' id='$id' /></td><td>$name</td><td>$price</td><td>$quantity</td><td>$datetime</td></tr>";
        
        $p++;
    }
    
    if (isset($_REQUEST['offer_customer'])){        
        $id_book_money = $_REQUEST["radio_book_money"];
        $con=  mysqli_connect($host, $user, $pass, $db);
//        $sql_offer_customer = "DELETE FROM seller_product WHERE id = $id_book_money;";
        $sql_offer_customer = "SELECT f_del_offer_customer($id_book_money, '$email');";
        //echo $sql_offer_customer;
        $query_offer_customer = mysqli_query($con, $sql_offer_customer);
        exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
        
    }
    
    
    $k = 1;
    
    $con=  mysqli_connect($host, $user, $pass, $db);
    $sql_book_product = "CALL pr_book_product('$email');;";
    $query_book_product = mysqli_query($con, $sql_book_product);
    while ($r_book_product = mysqli_fetch_assoc($query_book_product)) {
        $id = $r_book_product['id'];
        $name = $r_book_product['name'];
        $price = $r_book_product['price']; 
        $quantity = $r_book_product['quantity'];
        $datetime = $r_book_product['datetime'];
            
            $radio_offer_seller = 'radio_offer_seller'.$id;
            
            $table_offer_seller .= "<tr><td><input name ='radio_offer_seller' type ='radio' value='$id' id='$id' /></div></td><td>$name</td><td>$price</td><td>$quantity</td><td>$datetime</td></tr>";
        $k++;
    }
    
    if (isset($_REQUEST['offer_seller'])){        
        $id_offer_seller = $_REQUEST["radio_offer_seller"];
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_offer_seller = "SELECT f_del_offer_seller($id_offer_seller, '$email');";
        
        $query_offer_seller = mysqli_query($con, $sql_offer_seller);
        exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    
        
    }
    
?>
