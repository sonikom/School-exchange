<?php 
if (isset($_REQUEST['add'])) {
                        $first = $_SESSION['first'];    
                        $middler = $_SESSION['middle'];
                        $last = $_SESSION['last'];
                        $pasport_procesing = $_SESSION['pasport_procesing'];
                        $email_procesing = $_SESSION['email_procesing'];
                        $password_processing = $_SESSION['password_processing'];
                    $con=  mysqli_connect($host, $user, $pass, $db);    
                        $sql6 = "DELETE FROM procesing WHERE pasport = '$pasport_procesing';";
                        $query6 = mysqli_query($con, $sql6);
                        
                    $con=  mysqli_connect($host, $user, $pass, $db);    
                        $sql5 = "SELECT f_add_accaunt('$first', '$middler', '$last', '$pasport_procesing', '$email_procesing', '$password_processing') AS 'add_accaunt';";
                        $query5 = mysqli_query($con, $sql5);
                        $r5 = mysqli_fetch_assoc($query5);
                        //echo '$sql5 ================= '.$sql5;
    
    $to="$email_procesing";
//    echo $to;
    $subject="Школьная Биржа";
    $message = "Здравствуйте, $first $last! Ваша заявка принята. Ваши данные: $pasport_procesing Ваш логин $email_procesing. Ваш пароль $password_processing.С уважением, Школьная Биржа.";
//    echo $message;
    $m=  mail($to, $subject, $message);
    exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
                    

                            
}

?>

