<?php //
$first = '';
$middle = '';
$last = '';
$pasport_procesing = '';
$email_procesing = '';
$password_processing = '';
$table_procesing  = '';
$company_tarif = '';
$contract_start = '';
$contract_end = '';
$sql_add = '';
//if (isset($_REQUEST['work'])) {
    $email_broker = $_SESSION['email_logout_broker'];
$con=  mysqli_connect($host, $user, $pass, $db);
    $sql_broker = "SELECT f_broker_procesing('$email_broker') AS 'broker_procesing';";
   // echo $sql_broker;
//    echo $sql2;
    $query_broker = mysqli_query($con, $sql_broker);
    $r_broker = mysqli_fetch_assoc($query_broker);
    $company_id = $r_broker['broker_procesing'];

    $sql_broker_procesing = "CALL pr_broker_procesing($company_id);";
   // echo $sql_broker_procesing;
    $query_broker_procesing = mysqli_query($con, $sql_broker_procesing);
        
    while ($r_broker_procesing = mysqli_fetch_assoc($query_broker_procesing)) {
        $id = $r_broker_procesing['id'];
        $first_name = $r_broker_procesing['first_name']; 
        $middle_name = $r_broker_procesing['middle_name'];
        
//    if (($middle_name == 0) || $middle_name == ''){
//            $middle_name = '';
//            echo 'SSSSSS'.$middle_name;
//        }
        
        $last_name = $r_broker_procesing['last_name'];
        $tarif_name = $r_broker_procesing['name'];
        
        $status = $r_broker_procesing['broker_id'];
        //echo $status;
        if ($status == NULL){
            $status = 'Свободен';
            $table_procesing .= "<tr><td><div class='radio'><input class='radio_input' name ='radio' type ='radio' value='$id' id='$id' /><label class='radio_label' for='$id'></label></div></td><td>$last_name</td><td>$first_name</td><td>$middle_name</td><td>$tarif_name</td><td>$status</td></tr>";
        }
        else if ($status == $_SESSION['email_logout_broker']){
           $table_procesing .= "<tr BGCOLOR = '#98FB98'><td><div class='radio'><input class='radio_input' name ='radio' type ='radio' value='$id' id='$id' /><label class='radio_label' for='$id'></label></div></td><td>$last_name</td><td>$first_name</td><td>$middle_name</td><td>$tarif_name</td><td>$status</td></tr>"; 
        }      
        else {
            $table_procesing .= "<tr BGCOLOR = '#FFA07A'><td><div class='radio'><input class='radio_input' name ='radio' type ='radio' value='$id' id='$id' /><label class='radio_label' for='$id'></label></div></td><td>$last_name</td><td>$first_name</td><td>$middle_name</td><td>$tarif_name</td><td>$status</td></tr>";
        }
        
    }
//}        
if (isset($_REQUEST['status'])){ 
    $con=  mysqli_connect($host, $user, $pass, $db);
    $idishnik = $_REQUEST['radio'];
    //echo 'IDISHNIK'.$idishnik;
    $status1 = $_SESSION['email_logout_broker']; 
    //echo " status = ".$status1;
    $sql2 = "UPDATE broker_procesing bp SET bp.broker_id = '$status1' WHERE bp.id = $idishnik;";
     //echo $sql2;
    $query2 = mysqli_query($con, $sql2);
    // echo '</br><b>ОБНОВЛЕНО </b>'.  mysqli_affected_rows($con).' строк';

    $sql_add_broker = "SELECT  bp.id, u.first_name, u.middle_name, u.last_name, u.pasport, bp.contract, u.email FROM broker_procesing bp JOIN user u ON bp.user_id = u.id WHERE bp.id = '$idishnik';";
//    echo $sql4;
//    echo 'aaaaaaaaa';
    $query_add_broker = mysqli_query($con, $sql_add_broker);
    $r_add_broker = mysqli_fetch_assoc($query_add_broker);
    $broker_procesing_id = $r_add_broker['id'];
    $first = $r_add_broker['first_name'];
//    echo 'FIRST'.$first;
    $middle = $r_add_broker['middle_name'];
    if (($middle == NULL) || ($middle == 0))
        $middle = 'Не задано';
    $last = $r_add_broker['last_name'];
    $pasport_procesing = $r_add_broker['pasport'];
    $email_procesing = $r_add_broker['email'];
    $contract_procesing = $r_add_broker['contract'];
    $_SESSION['broker_procesing_id'] = $broker_procesing_id;
    $_SESSION['first'] = $first;
    $_SESSION['middle'] = $middle;
    $_SESSION['last'] = $last;
    $_SESSION['pasport_procesing'] = $pasport_procesing;
    $_SESSION['email_procesing'] = $email_procesing;
    $_SESSION['contract_procesing'] = $contract_procesing;
    
    
      
    $sql_company_tarif = "SELECT bp.company_tarif_id FROM broker_procesing bp WHERE bp.id = $idishnik;";
    $query_company_tarif = mysqli_query($con, $sql_company_tarif);
    $r_company_tarif = mysqli_fetch_assoc($query_company_tarif);
    $company_tarif = $r_company_tarif["company_tarif_id"];
    $_SESSION['company_tarif'] = $company_tarif;
    exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
     //close($con);
}

//if (isset($_REQUEST['add'])){
//    $contract_start = $_REQUEST['contract_start'];
//    $contract_end = $_REQUEST['contract_end'];
//    $_SESSION['contract_start'] = $contract_start;
//    $_SESSION['contract_end'] = $contract_end;
//    $contract_procesing = $_SESSION['contract_procesing'];
//   $con=  mysqli_connect($host, $user, $pass, $db);
//    $company_tarif = $_SESSION['company_tarif'];    
//    $status1 = $_SESSION['email_logout_broker'];
//    $broker_procesing_id = $_SESSION['broker_procesing_id'];
//    $contract_start = $_SESSION['contract_start'];
//    $contract_end = $_SESSION['contract_end'];
//    
//    $sql5 = "SELECT f_broker_tarif($company_tarif, '$status1') AS 'broker_tarif';";
//    $query5 = mysqli_query($con, $sql5);
//    $r5 = mysqli_fetch_assoc($query5);
//    $broker_tarif = $r5['broker_tarif'];
//    //echo $sql5;
//    $sql6 = "DELETE FROM broker_procesing WHERE id = $broker_procesing_id;";
//    $query6 = mysqli_query($con, $sql6);
//    $sql7 = "SELECT u.id FROM user u WHERE u.email = 's@list.ru';";
//    $query7 = mysqli_query($con, $sql7);
//    $r7 = mysqli_fetch_assoc($query7);
//    $user_id = $r7['id'];
//  $con=  mysqli_connect($host, $user, $pass, $db);
//    $sql_add = "INSERT IGNORE INTO user_broker(broker_tarif_id, user_id, contract, data_start, data_end)
//                VALUES($broker_tarif, $user_id, '$contract_procesing', '$contract_start', '$contract_end');";
//    $query_add = mysqli_query($con, $sql_add);
//    echo $sql_add;
//    $r6 = mysqli_fetch_assoc($query6);
//    exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
// }


?>