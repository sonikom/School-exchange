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
            $table_product .= "<tr><td><div class='radio'><input class='radio_input' name ='radio_product' type ='radio' value='$id' id='$id' /><label class='radio_label' for='$id'>$name</label></div></td><td>$content</td></tr>";
//            echo 'AAAAAAAAA';
        }
        else {
            $table_product .= "<tr><td width=15%><div class='radio'><input class='radio_input' name ='radio_product' type ='radio' value='$id' id='$id' /><label class='radio_label' for='$id'>$name</label></div></td><td>$content</td></tr>";
//            echo 'BBBBBBB';
            
        }
        
    }
}
    if (isset($_REQUEST["customer_product"])){
        $id_product = $_REQUEST["radio_product"];
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_product = "SELECT p.name FROM product p WHERE p.id = $id_product;";
        $query_product = mysqli_query($con, $sql_product);
        $r_product = mysqli_fetch_assoc($query_product);
        $name_product = $r_product['name'];
        $_SESSION['id_product'] = $id_product;
        $_SESSION['name_product'] = $name_product;
//        echo $_SESSION['name_product'];
        
        if (isset($_SESSION['$bad_int'])){
            if ($_SESSION['$bad_int'] == 0){
                $_SESSION['$bad_int'] = 3;
               // echo 'DD'.$_SESSION['$bad_int'];
            }
        }
        
    }
    
    if (isset($_REQUEST["add_cup"])){
        setlocale(LC_ALL, 'Russian_Russia.1251');
        date_default_timezone_set('Europe/Moscow');
        $data = new DateTime('now');
        $d= $data->format('Y.m.d H:i:s');
//        echo 'd='.$d;
        $email = $_SESSION['email_logout_user'];
        //echo $email;
        $id_product = $_SESSION['id_product'];
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_chek_customer_bank = "SELECT f_chek_customer_money('$email') AS 'chek_customer_bank';";
       // echo $sql_chek_customer_bank;
        $query_chek_customer_bank = mysqli_query($con, $sql_chek_customer_bank);
        $r_chek_customer_bank = mysqli_fetch_assoc($query_chek_customer_bank);
        $chek_customer_bank = $r_chek_customer_bank['chek_customer_bank'];
        //echo $chek_customer_bank;
        $price = $_REQUEST["price"];
        $quantity = $_REQUEST["quantity"];
        $quantity += 0;
        if (is_int($quantity)){
            if ($chek_customer_bank >= ($price * $quantity)){
            $con=  mysqli_connect($host, $user, $pass, $db);
            $sql_add_customer = "SELECT f_add_customer_product('$email', $id_product, '$d', $quantity , $price) AS 'customer';";
           // echo "<br>sql=$sql_add_customer";
            $query_add_customer = mysqli_query($con, $sql_add_customer);
            
          echo "<script>alert(\"Ваш лот добавлен в стакан.\");</script>"; 
            //echo "<script>alert(\"$sql_add_customer\");</script>"; 
            $_SESSION['$bad_int'] = 0;
            }
            else {
                $_SESSION['$bad_int'] = 2;
            }
        }
        else{
            $_SESSION['$bad_int'] = 1;
        }
    }
    
//    echo 'AAAAAAAAA'.$_SESSION['category_content'];
    

?>
