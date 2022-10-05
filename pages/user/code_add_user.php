<?php 
if (isset($_REQUEST["step_1"])){
//    session_destroy();
    $accaunt = 3;
    
    $count = count($_REQUEST['m']);
    
   for ($i = 4; $i < 7; $i++)
    {
      
        if (isset($_REQUEST['m'][$i]) and $_REQUEST['m'][$i] != "")
            $m[$i] = $_REQUEST['m'][$i];
        else 
            $m[$i] = 0;
        
//       echo '</br>m['.$i.']='.$m[$i];
        
    }

    echo '<br>';
    $sql_email = "SELECT COUNT(u.email) AS 'check' FROM user u WHERE u.email LIKE '$m[4]';";
    $query_email = mysqli_query($con, $sql_email);
    $r_email = mysqli_fetch_assoc($query_email);
//    echo $r_email['check'];
    if ($r_email['check'] == 0){
        $_SESSION['email_create'] = $m[4]; 
    }
    if ($m[5] == $m[6]){
        $_SESSION['password_create'] = $m[5]; 
    }
//     exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    
}

if (isset($_REQUEST["step_2"])){
    $accaunt = 3;
    
    $count = count($_REQUEST['m']);
    
   for ($i = 0; $i < 3; $i++)
    {
      
        if (isset($_REQUEST['m'][$i]) and $_REQUEST['m'][$i] != "")
            $m[$i] = $_REQUEST['m'][$i];
        else 
            $m[$i] = 0;
        
//       echo '</br>m['.$i.']='.$m[$i];
    }

    echo '<br>';

   
    $_SESSION['first_name_create']  = $m[0];
    $_SESSION['middle_name_create'] = $m[1];
//    echo 'SESSION["middle_name_create"] == '.$_SESSION['middle_name_create'];
    $_SESSION['last_name_create'] = $m[2];
    exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
}

if (isset($_REQUEST["create_account"])){
    $accaunt = 3;
    
    $count = count($_REQUEST['m']);
    
   for ($i = 3; $i < 4; $i++)
    {
      
        if (isset($_REQUEST['m'][$i]) and $_REQUEST['m'][$i] != "")
            $m[$i] = $_REQUEST['m'][$i];
        else 
            $m[$i] = 0;
        
//       echo '</br>m['.$i.']='.$m[$i];
    }

    echo '<br>';
    $sql_check_pasport = "SELECT f_pasport_create_acc('$m[3]') AS 'check_pasport';";
    $query_check_pasport = mysqli_query($con, $sql_check_pasport);
    $r_check_pasport = mysqli_fetch_assoc($query_check_pasport);
    $_SESSION['pasport_create'] = $r_check_pasport['check_pasport'];
    
    if ($r_check_pasport['check_pasport'] == 0){
      
        $_SESSION['pasport_create'] = $m[3];
        $uploaddir = '../../upload_pasport/';
    //    echo 'm3=='. $m[3];
    //    echo 'AAAAAAAAAAAa=='.$_FILES['uploadfile']['name'];
        $uploadfile = $uploaddir . basename($_FILES['uploadfile']['name']);
    //    echo 'NAME'.$uploadfile;
        $type_file =  substr($uploadfile, strpos($uploadfile,'.'), strlen($uploadfile)-1);
    //    echo 'TYPE'.$type_file;
        $type_file_2 =  $_FILES['uploadfile']['type'];
        $type_file_2 = substr($type_file_2, 6);
        $type_file_2 = '.'.$type_file_2;
    //    echo 'TYPE2 ===='.$type_file_2;


        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'],$uploaddir . $m[3]. $type_file_2)) {
            $uploadfile2 = $m[3].$type_file_2;
            $_SESSION['file_create'] = $uploadfile2;
        } 

        $first_name_create = $_SESSION["first_name_create"];
        $middle_name_create = $_SESSION["middle_name_create"];
//        echo 'middle_name_create == '.$middle_name_create;
        $last_name_create = $_SESSION["last_name_create"];
        if (isset($_SESSION["pasport_create"]))
            $pasport_create = $_SESSION["pasport_create"];
        else 
            $pasport_create = $m[3];
        $email_create = $_SESSION["email_create"];
        $password_create = $_SESSION["password_create"];
        
        
     

        $sql_create_acc = "SELECT f_createaccaunt('$first_name_create', '$middle_name_create', '$last_name_create', '$pasport_create', '$email_create', '$password_create', '$uploadfile2') AS 'accaunt';";
//        echo 'sql_create_acc'.$sql_create_acc;
        $query_create_acc = mysqli_query($con, $sql_create_acc);
        $r_create_acc = mysqli_fetch_assoc($query_create_acc);
        
        $fin = 'Вы успешно прошли регистрацию. Ваша заявка будет рассмотрена в ближайшее время. На почту '.$_SESSION['email_create'].' будет отправлено письмо с решением.';
        echo "<script>alert(\"$fin.\");</script>";
        session_destroy();
        
        exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    }
}
?>
