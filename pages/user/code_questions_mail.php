<?php 
if (isset($_REQUEST['admin_mail'])) {
                        $email_user = $_SESSION['email_logout_user'];                        
                        $admin_mail = $_REQUEST['text_admin_mail'];
                        
                        
                        echo "<script>alert(\"Ваш лот добавлен в стакан.$admin_mail\");</script>";
    
    $to="school.exchange.spb@gmail.com";
//    echo $to;
    $subject="$email_user";
    $message = "$admin_mail. Отправитель: $email_user";
//    echo $message;
    $m=  mail($to, $subject, $message);
                    
    echo "<script>alert(\"Ваше сообщение отправлено!\");</script>";
                            
}

?>

