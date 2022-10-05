<?php
    $table_company = '';
    $table_tarif = '';
    $con=  mysqli_connect($host, $user, $pass, $db);
    $sql_company = "SELECT * FROM v_choose_company v;";
//    echo $sql2;
    $query_company = mysqli_query($con, $sql_company);
       
    while ($r_company = mysqli_fetch_assoc($query_company)) {
        $id_company = $r_company['id'];
        $name_company = $r_company['name']; 
        
        if ($id_company == 1){
            $table_company .= "<tr><td><input name ='choose_company' type ='radio' value='$id_company' id='$id_company' /></td><td>$name_company</td></tr>";
        
        }
        else {
            $table_company .= "<tr><td><input name ='choose_company' type ='radio' value='$id_company' id='$id_company'/></td><td>$name_company</td></tr>";
        }
        
    }
    
    if (isset($_REQUEST["company"])){
        
       $idishnik = $_REQUEST["choose_company"];
       $_SESSION['id_company'] = $idishnik;
       $con=  mysqli_connect($host, $user, $pass, $db);
       $sql_tarif = "CALL pr_choose_tarif($idishnik);";
       
      // echo 'DDDDD'.$sql_tarif;
       
       $query_tarif = mysqli_query($con, $sql_tarif);
       //echo 'DDDDD'.$query_tarif;
       while ($r_tarif = mysqli_fetch_assoc($query_tarif)){
           $name_tarif = $r_tarif['name'];
           $content = $r_tarif['content'];
           $id_tarif = $r_tarif['id'];
           if ($id_tarif == 1){
              $table_tarif .= "<tr><td><input name ='choose_tarif' type ='radio' value='$id_tarif' id='$id_tarif'/></td><td>$name_tarif</td><td>$content</td></tr>";             
           }
            else {
              $table_tarif .= "<tr><td><input name ='choose_tarif' type ='radio' value='$id_tarif' id='$id_tarif'/></td><td>$name_tarif</td><td>$content</td></tr>";             

            }
       }
           
    
    }
    
    if (isset($_REQUEST["tarif"])){
       
       $tarif = $_REQUEST["choose_tarif"];
       $_SESSION['tarif'] = $tarif;
     
    }
    
    
    if (isset($_REQUEST["broker_user_add"])){
       $email_logout_user =  $_SESSION['email_logout_user'];
       $con=  mysqli_connect($host, $user, $pass, $db);
       $sql_tarif = "SELECT u.pasport, u.id FROM user u WHERE  u.email = '$email_logout_user';";
       $query_tarif = mysqli_query($con, $sql_tarif);
       $r_contract = mysqli_fetch_assoc($query_tarif);
       $pasport = $r_contract['pasport'];
       $id_user = $r_contract['id'];
       $finish_tarif = $_SESSION['tarif'];
       $name_contract = $pasport.'_'.$_SESSION['tarif'];
       
       $uploaddir = '../../upload_contract/';
       
        
    //    echo 'm3=='. $m[3];
    //    echo 'AAAAAAAAAAAa=='.$_FILES['uploadfile']['name'];
        $uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
    //    echo 'NAME'.$uploadfile;
        $type_file =  substr($uploadfile, strpos($uploadfile,'.'), strlen($uploadfile)-1);
    //    echo 'TYPE'.$type_file;
        $type_file_2 =  $_FILES['uploadfile']['type'];
        $type_file_2 = substr($type_file_2, 6);
        $type_file_2 = '.'.$type_file_2;
    //    echo 'TYPE2 ===='.$type_file_2;


        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'],$uploaddir . $name_contract. $type_file_2)) {
            $uploadfile2 = $name_contract.$type_file_2;
            $_SESSION['file_create'] = $uploadfile2;
        } 
        $con=  mysqli_connect($host, $user, $pass, $db);
        $sql_broker_procesing = "INSERT IGNORE INTO broker_procesing(user_id, company_tarif_id, contract)
        VALUES($id_user, $finish_tarif, '$uploadfile2');";
        
        $query_broker_procesing = mysqli_query($con, $sql_broker_procesing);
//        $r_broker_procesing = mysqli_fetch_assoc($query_broker_procesing);
//        exit("<meta http-equiv='refresh' content='0; url=$_SERVER[PHP_SELF]'>");
    }
    
    
    
?>

