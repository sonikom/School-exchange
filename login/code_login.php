<?php
 $string = '';
 $password = '';
 $password2 = '';
 $first_name = '';
 $last_name = '';
 $pasport= 0;
 $email = '';
 $accaunt = 0;
 $email__moderator = '';
 $email_broker = '';
 
if (isset($_REQUEST['sub1'])) {
  
    
        
       // echo 'AAAAAAAAAAAAA';
    
//    if (isset($_SESSION['email_bad'])){
//        session_destroy();
//        //echo 'AAAAAAAAAAAAA';
//    }
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $con=  mysqli_connect($host, $user, $pass, $db);
        $sql = "SELECT f_logout_user('$email', '$password') AS 'logout_user'";
        $query = mysqli_query($con, $sql);
        $r = mysqli_fetch_assoc($query);
    //mysql_close();
    
    $con=  mysqli_connect($host, $user, $pass, $db);
        $sql1 = "SELECT f_logout_moderator('$email', '$password') AS 'logout_moderator';";
        $query1 = mysqli_query($con, $sql1);
        $r1 = mysqli_fetch_assoc($query1);
    //mysql_close($con);
    
    $con=  mysqli_connect($host, $user, $pass, $db);
        $sql2 = "SELECT f_logout_broker('$email', '$password') AS 'logout_broker'; ";    
        $query2 = mysqli_query($con, $sql2);
        $r2 = mysqli_fetch_assoc($query2);
    //mysql_close($con);
    
    
    if ($r1['logout_moderator'] == 1){
        $_SESSION['email_logout_moderator'] = $email;
        exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    }
    else if ($r['logout_user'] == 1){
        $_SESSION['email_logout_user'] = $email;
        exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    }
    else if ($r2['logout_broker'] == 1){
        $_SESSION['email_logout_broker'] = $email;
        exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    }
    else {
        $string = 'Неправильный логин или пароль';
        $_SESSION['email_bad'] = $email;
        header ('Location: ../Login/login.php');
    }
    //if (($r['logout_user'] != 1)  && ($r1['logout_moderator'] != 1) && ($r2['logout_broker'] != 1)  )

}

if (isset($_SESSION['email_logout_user'])){
    $email = $_SESSION['email_logout_user'];

    $con=  mysqli_connect($host, $user, $pass, $db);
    $sql_check_broker = "SELECT COUNT(ub.id) AS 'cou' FROM user_broker ub JOIN user u ON ub.user_id = u.id WHERE u.email = '$email';";
    $query_check_broker = mysqli_query($con, $sql_check_broker);
    $r_check_broker = mysqli_fetch_assoc($query_check_broker);
    
    if($r_check_broker['cou'] != 0){
        $_SESSION['email_logout_user_check_broker'] = 1;
    }

}

if (isset($_SESSION['email_logout_moderator'])){
    $email__moderator = $_SESSION['email_logout_moderator'];
}

if (isset($_SESSION['email_logout_broker'])){
    $email_broker = $_SESSION['email_logout_broker'];
}

if (isset($_REQUEST["exit"])){
    session_destroy();
    exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
}
?>

