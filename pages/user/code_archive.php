<?php
$table_chek_archive = '';
$email = $_SESSION['email_logout_user'];
       
    $con=  mysqli_connect($host, $user, $pass, $db);
    $sql_chek_archive = "CALL pr_chek_archive('$email');";
    $query_chek_archive = mysqli_query($con, $sql_chek_archive);
    while ($r_chek_archive = mysqli_fetch_assoc($query_chek_archive)) {
        $name = $r_chek_archive['name']; 
        $quantity = $r_chek_archive['quantity'];
        
            $table_chek_archive .= "<tr><td>$name</td><td>$quantity</td></tr>";
        
    }
       
?>
