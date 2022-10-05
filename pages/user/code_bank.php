<?php
$table_book_money = '';
$found_my_bank = '';
$email = $_SESSION['email_logout_user'];
    $con=  mysqli_connect($host, $user, $pass, $db);
    $sql = "SELECT f_found_my_bank('$email') AS 'found_my_bank';";
    $query = mysqli_query($con, $sql);
    $r = mysqli_fetch_assoc($query);
    $found_my_bank = $r['found_my_bank'];
    
    $con=  mysqli_connect($host, $user, $pass, $db);
    $sql_book_money = "CALL pr_book_money('$email');";
    $query_book_money = mysqli_query($con, $sql_book_money);
    while ($r_book_money = mysqli_fetch_assoc($query_book_money)) {
        $name = $r_book_money['name'];
        $price = $r_book_money['price']; 
        $quantity = $r_book_money['quantity'];
        $datetime = $r_book_money['datetime'];
        
            $table_book_money .= "<tr><td>$name</td><td>$price</td><td>$quantity</td><td>$datetime</td></tr>";
        
    }
       
?>
