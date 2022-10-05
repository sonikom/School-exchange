<?php //
$first = '';
$middle = '';
$last = '';

$table_provesing = '';

    $sql2 = "SELECT * FROM v_moderator_archive";
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
       // echo $status;
        
            $table_provesing .= "<tr><td>$first_name</td><td>$middle_name </td><td>$last_name</td><td>$pasport</td><td>$email</td></tr>";
        
        
        
    }
//}        


?>