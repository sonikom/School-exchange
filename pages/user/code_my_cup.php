<?php
$table_seller_cup = '';
$table_customer_cup = '';
$my_cust_price = '';
$my_sell_price = '';
$table_product = '';
$table_my_cup_seller = '';
$table_my_cup_customer = '';
$table_fin = '';

//    $email = $_SESSION['email_logout_user'];
//    session_destroy();
//    $_SESSION['email_logout_user'] = $email;

    $email = $_SESSION['email_logout_user'];
    $con=  mysqli_connect($host, $user, $pass, $db);
    $sql_table_my_cup = "SELECT mc.product_id FROM my_cup mc JOIN user u ON mc.user_id = u.id WHERE u.email = '$email';";
    $query_table_my_cup = mysqli_query($con, $sql_table_my_cup);
    /////////////////////////////////////////////////////
    $kol=1;
    while ($r_table_my_cup = mysqli_fetch_assoc($query_table_my_cup)) {
      $table_seller_cup = '';
      $table_customer_cup = '';
      $table_my_cup_seller = '';
      $table_my_cup_customer = '';
        $id_product = $r_table_my_cup["product_id"];
        //echo $id_product.'-';
//        echo $id_product.'+';     
       
        $email = $_SESSION['email_logout_user'];
       $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_sort_cup_seller = "CALL pr_sort_cup_seller($id_product);";
        //echo '$sql_sort_cup_seller ===='.$sql_sort_cup_seller.'<br/>';
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
            
            
                
            
            $table_seller_cup .= "<tr ><td style='padding: 0 0 0 1em;'>$seller_price</td><td>$seller_quantity</td><td>$my_sell_price</td></tr>";
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
        
        
        $sql_my_cup_customer = "SELECT cp.id, cp.quantity, cp.price, cp.datetime
                                    FROM customer_product cp JOIN user_broker ub ON cp.user_broker_id = ub.id JOIN user u ON ub.user_id = u.id
                                    WHERE (cp.product_id = $id_product)  AND (cp.quantity > 0) AND (u.email = '$email')
                                    ORDER BY cp.price DESC, cp.datetime ASC;";
        $query_my_cup_customer = mysqli_query($con, $sql_my_cup_customer);
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        while ($r_my_cup_customer = mysqli_fetch_assoc($query_my_cup_customer)){
            $id_my_cup_customer = $r_my_cup_customer["id"];
            $quantity = $r_my_cup_customer["quantity"];
            $price = $r_my_cup_customer["price"];
            $datetime = $r_my_cup_customer["datetime"];
            
            $name_customer='radio_my_cup_customer'.'_'.$kol;
            $for_cus='forcus'.$kol;
            $name_input_customer = 'my_cup_customer'.$kol;
//            $table_my_cup_customer .= "<tr><td><div class='radio'><input class='radio_input' name='$name_customer' type ='radio' value='$id_my_cup_customer' id='$id_my_cup_customer' /><label class='radio_label' for='$id_my_cup_customer'></label></div></td><td>$name_customer</td><td>$id_my_cup_customer</td><td>$price</td><td>$quantity</td><td>$datetime</td></tr>";

             $table_my_cup_customer .= "<tr><td><input name='$name_customer' type ='radio' value='$id_my_cup_customer' id='$id_my_cup_customer' /></td><td>$price</td><td>$quantity</td><td>$datetime</td></tr>";

        }
        
        $name_form_cus='my_cup_customer'.'_'.$kol;
        $form_customer_start = "<form name='$name_form_cus' method='get' action='my_cup.php'>";
        $form_customer_fin = "<tr><td colspan='4'><input name='$name_input_customer' type='submit' value='Снять заявку'/></td></tr>                                                    
                                                </form>";
        
        $sql_my_cup_seller = "SELECT sp.id, sp.price, sp.quantity, sp.datetime
                                FROM seller_product sp JOIN user_broker ub ON sp.user_broker_id = ub.id JOIN user u ON ub.user_id = u.id
                                WHERE (sp.product_id = $id_product)  AND (sp.quantity > 0) AND (u.email = '$email')
                                ORDER BY sp.price DESC, sp.datetime DESC;";
        $query_my_cup_seller = mysqli_query($con, $sql_my_cup_seller);
        
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!11
        while ($r_my_cup_seller = mysqli_fetch_assoc($query_my_cup_seller)){
            $id_my_cup_seller = $r_my_cup_seller["id"];
            $quantity = $r_my_cup_seller["quantity"];
            $price = $r_my_cup_seller["price"];
            $datetime = $r_my_cup_seller["datetime"];
            $name_sel='radio_my_cup_seller'.'_'.$kol;
            $for_sel='forsel'.$kol;
            $name_input_seller = 'my_cup_seller'.$kol;
//            $table_my_cup_seller .= "<tr><td><div class='radio'><input class='radio_input' name ='$name_sel' type ='radio' value='$id_my_cup_seller' id='$id_my_cup_seller' /><label class='radio_label' for='$id_my_cup_seller'></label></div></td><td>$id_my_cup_seller</td><td>$name_sel</td><td>$price</td><td>$quantity</td><td>$datetime</td></tr>";

            $table_my_cup_seller .= "<tr><td><input name ='$name_sel' type ='radio' value='$id_my_cup_seller' id='$id_my_cup_seller' /></td><td>$price</td><td>$quantity</td><td>$datetime</td></tr>";

        }
        
        $name_form_sel='my_cup_seller'.'_'.$kol;
        $form_seller_start = "<form name='$name_form_sel' method='get' action='my_cup.php'>";
        $form_seller_fin = "<tr><td colspan='4'><input name='$name_input_seller' type='submit' value='Снять заявку'/></td></tr>                                                    
                                                </form>";
        
        
        
        
        $sql_name = "SELECT p.name
                                FROM product p
                                WHERE p.id =  $id_product;";
        $query_name = mysqli_query($con, $sql_name);
        $r_name = mysqli_fetch_assoc($query_name);
        $name = $r_name["name"];
        
//        $table_in='=aaaaaa+';
        $table_fin .='<tr><td colspan="2"  style="text-align: center; font-weight: 800; font-size: 12pt;">'.$name.'</td></tr>'
                . '<tr><td><table><tr><td>Цена за лот</td><td>Общее количество лотов</td><td>Мое количество лотов</td></tr>'.$table_seller_cup.'<tr HEIGHT="1px"  bgcolor="#32CD32"><td colspan="3"></td></tr>'.$table_customer_cup.'</table>'.'</td>'
                       . '<td><table><tr><td></td><td>Цена за лот</td><td>Мое количество лотов</td><td>Дата и время</td></tr>'.$form_seller_start.$table_my_cup_seller.$form_seller_fin.'<tr HEIGHT="1px"  bgcolor="#32CD32"><td colspan="4"></td></tr>'.$form_customer_start.$table_my_cup_customer.$form_customer_fin
                        .'</table></td></tr>';
        
        
        
    $kol++;        
    }

    
  $i = 0;  
  $my_cup_seller = '';
  $my_cup_customer = '';
$con=  mysqli_connect($host, $user, $pass, $db);
    $sql_check_my_cup = "SELECT COUNT(mc.product_id)AS 'check_my_cup' FROM my_cup mc JOIN user u ON mc.user_id = u.id WHERE u.email = '$email';";
    $query_check_my_cup = mysqli_query($con, $sql_check_my_cup);
    $r_check_my_cup = mysqli_fetch_assoc($query_check_my_cup);
    $check_my_cup = $r_check_my_cup['check_my_cup'];
    
    if ($check_my_cup != 0){
        for ($i = 1; $i <= $check_my_cup; $i++){
        $my_cup_seller = 'radio_my_cup_seller_'.$i;  
        $name_input_seller = 'my_cup_seller'.$i;
    if (isset($_REQUEST["$name_input_seller"])){        
        $id_my_cup_seller = $_REQUEST["$my_cup_seller"];
        $con=  mysqli_connect($host, $user, $pass, $db);
//        $sql_offer_customer = "DELETE FROM seller_product WHERE id = $id_book_money;";
        $sql_offer_customer = "SELECT f_del_offer_seller($id_my_cup_seller, '$email');";
        //echo $sql_offer_customer;
        $query_offer_customer = mysqli_query($con, $sql_offer_customer);
        exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    
        
    }
    
    $my_cup_customer = 'radio_my_cup_customer_'.$i;
    $name_input_customer = 'my_cup_customer'.$i;
    
    if (isset($_REQUEST["$name_input_customer"])){        
        $id_my_cup_customer = $_REQUEST["$my_cup_customer"];
        $con=  mysqli_connect($host, $user, $pass, $db);
//        $sql_offer_customer = "DELETE FROM seller_product WHERE id = $id_book_money;";
        $sql_offer_customer = "SELECT f_del_offer_customer($id_my_cup_customer, '$email');";
        echo $sql_offer_customer;
        $query_offer_customer = mysqli_query($con, $sql_offer_customer);
        exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    
        
    }
    
    
        }
    }
    
       
        
//        echo $_SESSION['name_product'];
  
?>
