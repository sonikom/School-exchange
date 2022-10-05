<?php
$table_product = '';
$bad_int = '';
if (isset($_REQUEST["product_category"])){
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
    
    if (isset($_SESSION['$bad_int_seller'])){
        //echo 'DADA';
            if ($_SESSION['$bad_int_seller'] == 0){
                $_SESSION['$bad_int_seller'] = 3;
            }
        }
    
}
    if (isset($_REQUEST["seller_product"])){
        $id_product = $_REQUEST["radio_product"];
        $email = $_SESSION['email_logout_user'];
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_sale_chek_category = "SELECT f_sale_chek_category('$email', $id_product) AS 'sale_chek_category';";
        //echo $sql_sale_chek_category;
        $query_sale_chek_category = mysqli_query($con, $sql_sale_chek_category);
        $r_sale_chek_category = mysqli_fetch_assoc($query_sale_chek_category);
        $sale_chek_category = $r_sale_chek_category['sale_chek_category'];
        if ($sale_chek_category == 1){
        $sql_product = "SELECT p.name FROM product p WHERE p.id = $id_product;";
        $query_product = mysqli_query($con, $sql_product);
        $r_product = mysqli_fetch_assoc($query_product);
        $name_product = $r_product['name'];
        $_SESSION['id_product'] = $id_product;
        $_SESSION['name_product'] = $name_product;
        $_SESSION['sale_chek_category'] = $sale_chek_category;
        //echo '$sale_chek_category';
        }
        else{
            $_SESSION['sale_chek_category'] = $sale_chek_category;
        }
//        echo $_SESSION['name_product'];
        
        if (isset($_SESSION['$bad_int_seller'])){
        //echo 'DADA';
            if ($_SESSION['$bad_int_seller'] == 0){
                $_SESSION['$bad_int_seller'] = 4;
            }
            
            if ($_SESSION['$bad_int_seller'] == 3){
                $_SESSION['$bad_int_seller'] = 4;
            }
        }
        
    }
    
    if (isset($_REQUEST['exit_seller_product'])){
        $_SESSION['sale_chek_category'] = 2;
    }
    
    if (isset($_REQUEST["add_cup"])){
        setlocale(LC_ALL, 'Russian_Russia.1251');
        date_default_timezone_set('Europe/Moscow');
        $data = new DateTime('now');
        $d= $data->format('Y.m.d H:i:s');
        //echo 'd='.$d;
        $email = $_SESSION['email_logout_user'];
        $id_product = $_SESSION['id_product'];
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_seller_chek_quantity = "SELECT f_seller_chek_quantity('$email', $id_product) AS 'seller_chek_quantity';";
        $query_seller_chek_quantity = mysqli_query($con, $sql_seller_chek_quantity);
        $r_seller_chek_quantity  = mysqli_fetch_assoc($query_seller_chek_quantity);
        $quantity_chek = $r_seller_chek_quantity['seller_chek_quantity'];
//        echo 'CHEK'.$quantity_chek;
//        echo 'DATATIME: '.$data;
        $price = $_REQUEST["price"];
        $quantity = $_REQUEST["quantity"];
        $quantity += 0;
        if (is_int($quantity)){
            if($quantity_chek >= $quantity){
                $con=  mysqli_connect($host, $user, $pass, $db);
                $sql_add_seller = "SELECT f_add_seller_product('$email', $id_product, '$d', $quantity, $quantity_chek, $price) AS 'customer';";
//                echo "<br>sql=$sql_add_seller";
                $query_add_seller = mysqli_query($con, $sql_add_seller);
                echo "<script>alert(\"Ваш лот добавлен в стакан.\");</script>"; 
                $_SESSION['$bad_int_seller'] = 0;
            
            }
            else{
                $_SESSION['$bad_int_seller'] = 1;
            }
        }        
        else{
            $_SESSION['$bad_int_seller'] = 2;
        }
    }
    
//    echo 'AAAAAAAAA'.$_SESSION['category_content'];
    

?>
