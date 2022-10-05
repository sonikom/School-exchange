<?php 
if (isset($_REQUEST['add'])){
    $email_procesing = $_SESSION['email_procesing'];
    $contract_start = $_REQUEST['contract_start'];
    $contract_end = $_REQUEST['contract_end'];
    $_SESSION['contract_start'] = $contract_start;
    $_SESSION['contract_end'] = $contract_end;
    $contract_procesing = $_SESSION['contract_procesing'];
   $con=  mysqli_connect($host, $user, $pass, $db);
    $company_tarif = $_SESSION['company_tarif'];    
    $status1 = $_SESSION['email_logout_broker'];
    $broker_procesing_id = $_SESSION['broker_procesing_id'];
    $contract_start = $_SESSION['contract_start'];
    $contract_end = $_SESSION['contract_end'];
    
    $sql5 = "SELECT f_broker_tarif($company_tarif, '$status1') AS 'broker_tarif';";
    $query5 = mysqli_query($con, $sql5);
    $r5 = mysqli_fetch_assoc($query5);
    $broker_tarif = $r5['broker_tarif'];
    //echo $sql5;
    $sql6 = "DELETE FROM broker_procesing WHERE id = $broker_procesing_id;";
    $query6 = mysqli_query($con, $sql6);
    $sql7 = "SELECT u.id FROM user u WHERE u.email = '$email_procesing';";
    $query7 = mysqli_query($con, $sql7);
    $r7 = mysqli_fetch_assoc($query7);
    $user_id = $r7['id'];
  $con=  mysqli_connect($host, $user, $pass, $db);
    $sql_add = "INSERT IGNORE INTO user_broker(broker_tarif_id, user_id, contract, data_start, data_end)
                VALUES($broker_tarif, $user_id, '$contract_procesing', '$contract_start', '$contract_end');";
    $query_add = mysqli_query($con, $sql_add);
   // echo $sql_add;
    
    $to = "$email_procesing";
    $subject="Школьная Биржа";
    $message = "Здравствуйте! Ваша заявка принята! Дата начала договора:".$contract_start."Дата окончания договора:".$contract_end." Ваш стартовый капитал - 1000 соников! Начните торги! Перейдите по ссылке: http://selenak.beget.tech/ С уважением, Школьная Биржа";
    $m=  mail($to, $subject, $message);
    
    exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    
//                            echo "<br>m=$email_procesing";                             
}

?>

