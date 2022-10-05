<?php //
$first = '';
$middle = '';
$last = '';

$table_provesing = '';
$email_logout_broker = $_SESSION['email_logout_broker'];
    $sql2 = "  CALL pr_broker_archive('$email_logout_broker');";
    $query2 = mysqli_query($con, $sql2);
       
    while ($r2 = mysqli_fetch_assoc($query2)) {
        $first_name = $r2['first_name']; 
        $middle_name = $r2['middle_name'];
       // echo '<br/>middle_name == '.$middle_name;
        if ($middle_name == NULL){
            $middle_name = '';
        }
       // echo '<br/>NEW MIDDLE == '.$middle_name;
        $last_name = $r2['last_name'];
        $pasport = $r2['pasport'];
        $email = $r2['email'];
        $contract = $r2['contract'];
       // echo $status;
        
            $table_provesing .= "<tr><td>$last_name</td><td>$first_name</td><td>$middle_name</td><td>$pasport</td><td>$email</td><td>$contract</td></tr>";
        
        
        
    }
//}        


?>