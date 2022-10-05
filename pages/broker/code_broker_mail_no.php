<?php 
if (isset($_REQUEST['refusal'])){
    $email_procesing = $_SESSION['email_procesing'];
    $status1 = $_SESSION['email_logout_broker'];
    $broker_procesing_id = $_SESSION['broker_procesing_id'];
    $con=  mysqli_connect($host, $user, $pass, $db);
    $sql6 = "DELETE FROM broker_procesing WHERE id = $broker_procesing_id;";
    $query6 = mysqli_query($con, $sql6);
//    echo 'FFFFF'.$sql6;
    //echo $sql_add;
    
    
    $to="$email_procesing";
    $subject="Школьная Биржа";
    $message = "Здравствуйте!К сожалению, мы не можем принять Вашу заявку.Была допущена ошибка при отправке документа.Пожалуйста, выберите еще раз Брокера. С уважением, Школьная Биржа";
    $m=  mail($to, $subject, $message);
     exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    
    
}                      
?>

