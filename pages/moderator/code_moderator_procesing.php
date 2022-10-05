<?php //
$first = '';
$middle = '';
$last = '';
$pasport_procesing = '';
$email_procesing = '';
$password_processing = '';
$table_provesing = '';
//if (isset($_REQUEST['work'])) {
    $sql2 = "SELECT * FROM v_process v";
//    echo $sql2;
    $query2 = mysqli_query($con, $sql2);
       
    while ($r2 = mysqli_fetch_assoc($query2)) {
        $id = $r2['id'];
        $first_name = $r2['first_name']; 
        $middle_name = $r2['middle_name'];
       // echo '<br/>middle_name == '.$middle_name;
        if ($middle_name == NULL){
            $middle_name = '';
        }
       // echo '<br/>NEW MIDDLE == '.$middle_name;
        $last_name = $r2['last_name'];
        $pasport = $r2['pasport'];
        $status = $r2['status'];
       // echo $status;
        if ($status == NULL){
            $status = 'Свободен';
            $table_provesing .= "<tr><td><div class='radio'><input class='radio_input' name ='radio' type ='radio' value='$id' id='$id' /><label class='radio_label' for='$id'></label></div></td><td>$last_name $first_name  $middle_name </td><td>$pasport</td><td>$status</td></tr>";
        }
        else{ 
            if ($status == $_SESSION['email_logout_moderator']){
                $table_provesing .= "<tr BGCOLOR = '#98FB98'><td><div class='radio'><input class='radio_input' name ='radio' type ='radio' value='$id' id='$id' /><label class='radio_label' for='$id'></label></div></td><td>$last_name $first_name  $middle_name </td><td>$pasport</td><td>$status</td></tr>"; 
            }      
            else {
                $table_provesing .= "<tr BGCOLOR = '#FFA07A'><td><div class='radio'><input class='radio_input' name ='radio' type ='radio' value='$id' id='$id' /><label class='radio_label' for='$id'></label></div></td><td>$last_name $first_name  $middle_name </td><td>$pasport</td><td>$status</td></tr>";
            }
        }
        
        
    }
//}        
if (isset($_REQUEST['status'])){ 
    $idishnik = $_REQUEST['radio'];
    $status1 = $_SESSION['email_logout_moderator']; 
   // echo " status = ".$status1;
    $sql3 = "UPDATE procesing p SET p.status = '$status1' WHERE p.id = $idishnik;";
//    echo $sql3;
    $query2 = mysqli_query($con, $sql3);
    $sql4 = "SELECT p.id, p.first_name, p.middle_name, p.last_name, p.pasport, p.email, p.password, p.file FROM procesing p WHERE p.id = $idishnik;";
//    echo $sql4;
//    echo 'aaaaaaaaa';
    $query3 = mysqli_query($con, $sql4);
    $r3 = mysqli_fetch_assoc($query3);
    $first = $r3['first_name'];
//    echo 'FIRST'.$first;
    $middle = $r3['middle_name'];
    if (($middle == NULL))
        $middle = 'Не задано';
    $last = $r3['last_name'];
    $pasport_procesing = $r3['pasport'];
    $email_procesing = $r3['email'];
    $password_processing = $r3['password'];
    $_SESSION['first'] = $first;
    $_SESSION['middle'] = $middle;
    $_SESSION['last'] = $last;
    $_SESSION['pasport_procesing'] = $pasport_procesing;
    $_SESSION['email_procesing'] = $email_procesing;
    $_SESSION['password_processing'] = $password_processing;
    exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    
}

//if (isset($_REQUEST['add'])){
//    $first = $_SESSION['first'];    
//    $middler = $_SESSION['middle'];
//    $last = $_SESSION['last'];
//    $pasport_procesing = $_SESSION['pasport_procesing'];
//    $email_procesing = $_SESSION['email_procesing'];
//    $password_processing = $_SESSION['password_processing'];
//    $sql5 = "SELECT f_add_accaunt('$first', '$middler', '$last', '$pasport_procesing', '$email_procesing', '$password_processing') AS 'add_accaunt';";
//    $query5 = mysqli_query($con, $sql5);
//    $r5 = mysqli_fetch_assoc($query5);
//    $sql6 = "DELETE FROM procesing WHERE pasport = '$pasport_procesing';";
//    $query6 = mysqli_query($con, $sql6);
////    $r6 = mysqli_fetch_assoc($query6);
////     exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
//}


?>