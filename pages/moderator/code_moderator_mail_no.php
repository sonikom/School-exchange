<?php 
if (isset($_REQUEST['refusal'])) {
                        $email_procesing = $_SESSION['email_procesing'];
                        $pasport_procesing = $_SESSION['pasport_procesing'];
                    $con=  mysqli_connect($host, $user, $pass, $db);    
                        $sql6 = "DELETE FROM procesing WHERE pasport = '$pasport_procesing';";
                        $query6 = mysqli_query($con, $sql6);
                        
                         $to="$email_procesing";
    $subject="Школьная Биржа";
    $message = "Здравствуйте!К сожалению, мы не можем принять Вашу заявку. Вы неправильно прошли регистрация. Пожалуйста, попробуйте ещё раз С уважением, Школьная Биржа.";
    $m=  mail($to, $subject, $message);
    exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
}                        
?>

