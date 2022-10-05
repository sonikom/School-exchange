<?php
$table_seller_cup = '';
$table_customer_cup = '';
$my_cust_price = '';
$my_sell_price = '';
$table_product = '';
if (isset($_REQUEST["product_cup_category"])){
//    $email = $_SESSION['email_logout_user'];
//    session_destroy();
//    $_SESSION['email_logout_user'] = $email;
    $count = count($_REQUEST['m']);
//    echo 'AAAAAA';
       for ($i = 1; $i < 2; $i++)
        {

            if (isset($_REQUEST['m'][$i]) and $_REQUEST['m'][$i] != "")
                $m[$i] = $_REQUEST['m'][$i];
            else 
                $m[$i] = 0;

//           echo '</br>m['.$i.']='.$m[$i];
        }

//        echo '<br>';
        
    switch ($m[1]){
        case 11:
            $_SESSION["category"] = '1';
            
            
            
            break;
        case 12:
            $_SESSION["category"] = '2';
            break;
        case 13:
            $_SESSION["category"] = '3';
            break;
    }
    $id_categori = $_SESSION["category"];
    $con=  mysqli_connect($host, $user, $pass, $db);
    $sql = "SELECT p.id, p.name, p.content, c.content AS 'category' FROM product p JOIN categoty c ON p.category_id = c.id WHERE c.id = $id_categori;";
    $query = mysqli_query($con, $sql);
    while ($r = mysqli_fetch_assoc($query)) {
        $id = $r['id'];
        $name = $r['name'];
        $content = $r['content']; 
        $_SESSION['category_content'] = $r['category'];
        if ($id == 1){
            $table_product .= "<tr><td><div class='radio'><input class='radio_input' name ='radio_product' type ='radio' value='$id' id='$id' /><label class='radio_label' for='$id'>$name</label></div></td></tr>";
//            echo 'AAAAAAAAA';
        }
        else {
            $table_product .= "<tr><td width=15%><div class='radio'><input class='radio_input' name ='radio_product' type ='radio' value='$id' id='$id' /><label class='radio_label' for='$id'>$name</label></div></td></tr>";
//            echo 'BBBBBBB';
            
        }
        
    }
}
    if (isset($_REQUEST["cup_product"])){
        $id_product = $_REQUEST["radio_product"];
        $_SESSION['add_my_cup'] = $id_product;
        $email = $_SESSION['email_logout_user'];
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_sort_cup_seller = "CALL pr_sort_cup_seller($id_product);";
        $query_sort_cup_seller = mysqli_query($con, $sql_sort_cup_seller);
        while ($r_sort_cup_seller = mysqli_fetch_assoc($query_sort_cup_seller)){
            $seller_quantity = $r_sort_cup_seller['quantity'];
            $seller_price = $r_sort_cup_seller['price'];
            
            $con=  mysqli_connect($host, $user, $pass, $db);
            $sql_my_seller_price = "SELECT f_my_seller_price('$email', $id_product, $seller_price) AS 'my_seller_price';";
            //echo $sql_my_seller_price;
            $query_my_seller_price = mysqli_query($con, $sql_my_seller_price);
            $r_my_seller_price = mysqli_fetch_assoc($query_my_seller_price);
            $my_seller_price = $r_my_seller_price['my_seller_price'];
            
            
            if ($my_seller_price == 0){
                $my_sell_price = '';
            }
            else {
                $my_sell_price = $my_seller_price;
            }
            
            
                
            
            $table_seller_cup .= "<tr><td>$seller_price</td><td>$seller_quantity</td><td>$my_sell_price</td></tr>";
        }
        
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_sort_cup_customer = "CALL pr_sort_cup_customer($id_product);";
        $query_sort_cup_customer = mysqli_query($con, $sql_sort_cup_customer);
        while ($r_sort_cup_customer = mysqli_fetch_assoc($query_sort_cup_customer)){
            $customer_quantity = $r_sort_cup_customer['quantity'];
            $customer_price = $r_sort_cup_customer['price'];
            
            $con=  mysqli_connect($host, $user, $pass, $db);
            $sql_my_customer_price = "SELECT f_my_customer_price('$email', $id_product, $customer_price) AS 'my_customer_price';";
//            echo '<br/>SQL = '.$sql_my_customer_price;
            
            $query_my_customer_price = mysqli_query($con, $sql_my_customer_price);
            $r_my_customer_price = mysqli_fetch_assoc($query_my_customer_price);
            $my_customer_price = $r_my_customer_price['my_customer_price'];
            //echo 'MY= '.$my_customer_price;
            
            if ($my_customer_price == 0){
                $my_cust_price = '';
            }
            else {
                $my_cust_price = $my_customer_price;
            }
            
            $table_customer_cup .= "<tr><td>$customer_price</td><td>$customer_quantity</td><td>$my_cust_price</td></tr>";
        }
        
       
       
        
//        echo $_SESSION['name_product'];
        
    }
    
    if (isset($_REQUEST['f_processing_cup'])){
       $id_product = $_SESSION['add_my_cup'];
       $con=  mysqli_connect($host, $user, $pass, $db);
            $sql_demo = "SELECT f_cup_processing($id_product);";
           // echo '<br/>SQL = '.$sql_demo;
            
            $query_demo = mysqli_query($con, $sql_demo);
            
            
        $email = $_SESSION['email_logout_user'];
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_sort_cup_seller = "CALL pr_sort_cup_seller($id_product);";
        $query_sort_cup_seller = mysqli_query($con, $sql_sort_cup_seller);
        while ($r_sort_cup_seller = mysqli_fetch_assoc($query_sort_cup_seller)){
            $seller_quantity = $r_sort_cup_seller['quantity'];
            $seller_price = $r_sort_cup_seller['price'];
            
            $con=  mysqli_connect($host, $user, $pass, $db);
            $sql_my_seller_price = "SELECT f_my_seller_price('$email', $id_product, $seller_price) AS 'my_seller_price';";
            $query_my_seller_price = mysqli_query($con, $sql_my_seller_price);
            $r_my_seller_price = mysqli_fetch_assoc($query_my_seller_price);
            $my_seller_price = $r_my_seller_price['my_seller_price'];
            
            
            if ($my_seller_price == 0){
                $my_sell_price = '';
            }
            else {
                $my_sell_price = $my_seller_price;
            }
            
            
                
            
            $table_seller_cup .= "<tr><td>$seller_price</td><td>$seller_quantity</td><td>$my_sell_price</td></tr>";
        }
        
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_sort_cup_customer = "CALL pr_sort_cup_customer($id_product);";
        $query_sort_cup_customer = mysqli_query($con, $sql_sort_cup_customer);
        while ($r_sort_cup_customer = mysqli_fetch_assoc($query_sort_cup_customer)){
            $customer_quantity = $r_sort_cup_customer['quantity'];
            $customer_price = $r_sort_cup_customer['price'];
            
            $con=  mysqli_connect($host, $user, $pass, $db);
            $sql_my_customer_price = "SELECT f_my_customer_price('$email', $id_product, $customer_price) AS 'my_customer_price';";
//            echo '<br/>SQL = '.$sql_my_customer_price;
            
            $query_my_customer_price = mysqli_query($con, $sql_my_customer_price);
            $r_my_customer_price = mysqli_fetch_assoc($query_my_customer_price);
            $my_customer_price = $r_my_customer_price['my_customer_price'];
            //echo 'MY= '.$my_customer_price;
            
            if ($my_customer_price == 0){
                $my_cust_price = '';
            }
            else {
                $my_cust_price = $my_customer_price;
            }
            
            $table_customer_cup .= "<tr><td>$customer_price</td><td>$customer_quantity</td><td>$my_cust_price</td></tr>";
        }
        
       
       
        
//        echo $_SESSION['name_product'];
        
    
            
    }
    


    
//    echo 'AAAAAAAAA'.$_SESSION['category_content'];
    

    
if (isset($_REQUEST["my_cup"])){
    $con=  mysqli_connect($host, $user, $pass, $db);
            $id_product = $_SESSION['add_my_cup'];
            $sql_add_my_cup = "SELECT f_add_my_cup('$email', $id_product) AS 'add_my_cup';";
//            echo '<br/>SQL = '.$sql_my_customer_price;            
            $query_add_my_cup = mysqli_query($con, $sql_add_my_cup);
            
            $email = $_SESSION['email_logout_user'];
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_sort_cup_seller = "CALL pr_sort_cup_seller($id_product);";
        $query_sort_cup_seller = mysqli_query($con, $sql_sort_cup_seller);
        while ($r_sort_cup_seller = mysqli_fetch_assoc($query_sort_cup_seller)){
            $seller_quantity = $r_sort_cup_seller['quantity'];
            $seller_price = $r_sort_cup_seller['price'];
            
            $con=  mysqli_connect($host, $user, $pass, $db);
            $sql_my_seller_price = "SELECT f_my_seller_price('$email', $id_product, $seller_price) AS 'my_seller_price';";
            $query_my_seller_price = mysqli_query($con, $sql_my_seller_price);
            $r_my_seller_price = mysqli_fetch_assoc($query_my_seller_price);
            $my_seller_price = $r_my_seller_price['my_seller_price'];
            
            
            if ($my_seller_price == 0){
                $my_sell_price = '';
            }
            else {
                $my_sell_price = $my_seller_price;
            }
            
            
                
            
            $table_seller_cup .= "<tr><td>$seller_price</td><td>$seller_quantity</td><td>$my_sell_price</td></tr>";
        }
        
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_sort_cup_customer = "CALL pr_sort_cup_customer($id_product);";
        $query_sort_cup_customer = mysqli_query($con, $sql_sort_cup_customer);
        while ($r_sort_cup_customer = mysqli_fetch_assoc($query_sort_cup_customer)){
            $customer_quantity = $r_sort_cup_customer['quantity'];
            $customer_price = $r_sort_cup_customer['price'];
            
            $con=  mysqli_connect($host, $user, $pass, $db);
            $sql_my_customer_price = "SELECT f_my_customer_price('$email', $id_product, $customer_price) AS 'my_customer_price';";
//            echo '<br/>SQL = '.$sql_my_customer_price;
            
            $query_my_customer_price = mysqli_query($con, $sql_my_customer_price);
            $r_my_customer_price = mysqli_fetch_assoc($query_my_customer_price);
            $my_customer_price = $r_my_customer_price['my_customer_price'];
            //echo 'MY= '.$my_customer_price;
            
            if ($my_customer_price == 0){
                $my_cust_price = '';
            }
            else {
                $my_cust_price = $my_customer_price;
            }
            
            $table_customer_cup .= "<tr><td>$customer_price</td><td>$customer_quantity</td><td>$my_cust_price</td></tr>";
        }
        
       
       
        
    
}

if (isset($_SESSION['add_my_cup'])){

$email = $_SESSION['email_logout_user'];
$id_product = $_SESSION['add_my_cup'];

$con=  mysqli_connect($host, $user, $pass, $db);
        $sql_check_my_cup = "SELECT mc.id  FROM my_cup mc JOIN user u ON mc.user_id = u.id WHERE u.email = '$email' AND mc.product_id = $id_product;";
        $query_check_my_cup = mysqli_query($con, $sql_check_my_cup);
        $r_check_my_cup = mysqli_fetch_assoc($query_check_my_cup);
        $check_my_cup = $r_check_my_cup['id'];
        
        if ($check_my_cup != 0){
            $_SESSION['check_my_cup'] = $check_my_cup;
        }
        else {
            $_SESSION['check_my_cup'] = 0;
        }
            
}    
    
?>
