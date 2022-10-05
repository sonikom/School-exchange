<?php // content="text/plain; charset=utf-8"
$product_id = 0;
$who1 = 0;
$who2 = '';
$time = 0;


if (isset($_REQUEST['graph'])){

define ('GChart_DIR','gchart-0.1');
require_once (GChart_DIR.'/GChart.php');
require_once '../../config.php';

$count = count($_REQUEST['m']);
//    echo 'AAAAAA';
       for ($i = 1; $i < 4; $i++)
        {

            if (isset($_REQUEST['m'][$i]) and $_REQUEST['m'][$i] != "")
                $m[$i] = $_REQUEST['m'][$i];
            else 
                $m[$i] = 0;

//           echo '</br>m['.$i.']='.$m[$i];
        }

//        echo '<br>';
        
    switch ($m[1]){
        case 11:
            $product_id = 1;
            break;
        case 12:
            $product_id = 2;
            break;
        case 13:
            $product_id = 3;
            break;
        case 14:
            $product_id = 4;
            break;
        case 15:
            $product_id = 5;
            break;
        case 16:
            $product_id = 6;
            break;
        case 17:
            $product_id = 7;
            break;
        
    }
    
    switch ($m[2]){
        case 21:
            $who = 1;
            break;
        case 22:
            $who = 2;
            $i_email = $_SESSION['email_logout_user'];
            break;
        case 23:
            $who = 3;
            $i_email = $_SESSION['email_logout_user'];
            break;
        
    }
    
    switch ($m[3]){
        case 31:
            $time = 7;
            break;
        case 32:
            $time = 2;
            break;
        case 33:
            $time = 3;
            break;
        
    }

//while (mysqli_more_results($con) && mysqli_next_result($con)) $con->store_result();
//$user = 'root'; $pass = 'vertrigo';
//$dbh = new PDO('mysql:host=localhost;dbname=exchange;port=3306', $user, $pass);

while (mysqli_more_results($con) && mysqli_next_result($con)) $con->store_result();
$user = 'selenak_exch'; $pass = 'Agkomarov_1961';
$dbh = new PDO('mysql:host=localhost;dbname=selenak_exch;port=3306', $user, $pass);

//$sql1="SELECT u.id, u.last_name AS user, b.id AS id1, b.last_name AS brok
//  FROM user u JOIN user_broker ub ON u.id = ub.user_id
//  JOIN broker_tarif bt ON ub.broker_tarif_id = bt.id
//  JOIN brokers b ON bt.broker_id = b.id
//WHERE b.id=1";
//$sql2="SELECT u.id, u.last_name AS user, b.id AS id1, b.last_name AS brok
//  FROM user u JOIN user_broker ub ON u.id = ub.user_id
//  JOIN broker_tarif bt ON ub.broker_tarif_id = bt.id
//  JOIN brokers b ON bt.broker_id = b.id
//WHERE b.id=2";
//$numrows1 = $dbh->query($sql1)->rowCount();
//$numrows2 = $dbh->query($sql2)->rowCount();
//
//$array1=array();
//$array2=array();
//$array1[1]="user1";
//$array2[1]=$numrows1*10;
//$array1[2]="user2";
//$array2[2]=$numrows2*10;
// f_graph_user_seller

    $array1=array();
    $array2=array();
    $max_array = 0;
    
if ($who == 3){
    for ($i = 1; $i <= $time; $i++){
//    $i = 0;
    $new_time = -($time - $i);
    
    $sql_check_date_day_seller = "SELECT f_check_date_day_seller($new_time, $product_id, '$i_email') AS 'check_date_day_seller';";
//    echo '$sql_check_date_day_customer = '.$sql_check_date_day_customer;
    $query_check_date_day_seller = mysqli_query($con, $sql_check_date_day_seller);
    $r_check_date_day_seller = mysqli_fetch_assoc($query_check_date_day_seller);
    $check_date_day = $r_check_date_day_seller['check_date_day_seller'];
    
    
    
    $sql2 = "SELECT f_date_day($new_time) AS 'date_day';";
//    echo ' $sql2 = '.$sql2;
    $query2 = mysqli_query($con, $sql2);
    $r2 = mysqli_fetch_assoc($query2);
    $date_day = $r2['date_day'];
    
    if ($check_date_day == 0){
        $array2[$i] = 0;
//        echo '$check_date_day = 0<br/>';
    }
    else
    {
        $sql1 = "SELECT f_graph_user_seller($new_time, $product_id, '$i_email') AS 'graph_user_seller';";
//        echo 'graph_user_customer = '.$sql1;
        $query1 = mysqli_query($con, $sql1);
        $r1 = mysqli_fetch_assoc($query1);
        $colvo = $r1['graph_user_seller'];
        $array2[$i] = $colvo; 
//        echo '$check_date_day = 1<br/>';
        if ($array2[$i] > $max_array){
            $max_array = $array2[$i];
        }
    }
    
    
    $array1[$i] = "$date_day";
    
    
    $bar_v=new GChart_Bar_V($time * 80, 500);  
    $bar_v->set_bar_width(30,30,30);   
    $x_axis=new GChart_Axis(GChart_BOTTOM_X_AXIS,$array1); 
    $y_axis=new GChart_Axis(GChart_LEFT_Y_AXIS);  
    $y_axis->set_boundry(0, 100);  

    $s1=new GChart_DataSeries($array2,'Количество','11BC83');  
    $bar_v->add($s1);  
    $bar_v->add_axis($x_axis);  
    $bar_v->add_axis($y_axis);  
    
    
}
}    
    
if ($who == 2){
    for ($i = 1; $i <= $time; $i++){
//    $i = 0;
    $new_time = -($time - $i);
    
    $sql_check_date_day_customer = "SELECT f_check_date_day_customer($new_time, $product_id, '$i_email') AS 'check_date_day_customer';";
//    echo '$sql_check_date_day_customer = '.$sql_check_date_day_customer;
    $query_check_date_day_customer = mysqli_query($con, $sql_check_date_day_customer);
    $r_check_date_day_customer = mysqli_fetch_assoc($query_check_date_day_customer);
    $check_date_day = $r_check_date_day_customer['check_date_day_customer'];
    
    
    
    $sql2 = "SELECT f_date_day($new_time) AS 'date_day';";
//    echo ' $sql2 = '.$sql2;
    $query2 = mysqli_query($con, $sql2);
    $r2 = mysqli_fetch_assoc($query2);
    $date_day = $r2['date_day'];
    
    if ($check_date_day == 0){
        $array2[$i] = 0;
//        echo '$check_date_day = 0<br/>';
    }
    else
    {
        $sql1 = "SELECT f_graph_user_customer($new_time, $product_id, '$i_email') AS 'graph_user_customer';";
//        echo 'graph_user_customer = '.$sql1;
        $query1 = mysqli_query($con, $sql1);
        $r1 = mysqli_fetch_assoc($query1);
        $colvo = $r1['graph_user_customer'];
        $array2[$i] = $colvo; 
//        echo '$check_date_day = 1<br/>';
        if ($array2[$i] > $max_array){
            $max_array = $array2[$i];
        }
    }
    
    
    $array1[$i] = "$date_day";
    
    
    $bar_v=new GChart_Bar_V($time * 80, 500);  
    $bar_v->set_bar_width(30,30,30);   
    $x_axis=new GChart_Axis(GChart_BOTTOM_X_AXIS,$array1); 
    $y_axis=new GChart_Axis(GChart_LEFT_Y_AXIS);  
    $y_axis->set_boundry(0, 100);  

    $s1=new GChart_DataSeries($array2,'Количество','11BC83');  
    $bar_v->add($s1);  
    $bar_v->add_axis($x_axis);  
    $bar_v->add_axis($y_axis);  
    
    
}
}    
    
if ($who == 1){
for ($i = 1; $i <= $time; $i++){
//    $i = 0;
    $new_time = -($time - $i);
    $sql_check_date_day = "SELECT f_check_date_day($new_time, $product_id) AS 'check_date_day';";
    $query_check_date_day = mysqli_query($con, $sql_check_date_day);
    $r_check_date_day = mysqli_fetch_assoc($query_check_date_day);
    $check_date_day = $r_check_date_day['check_date_day'];
    
    
    
    $sql2 = "SELECT f_date_day($new_time) AS 'date_day';";
    $query2 = mysqli_query($con, $sql2);
    $r2 = mysqli_fetch_assoc($query2);
    $date_day = $r2['date_day'];
    
    if ($check_date_day == 0){
        $array2[$i] = 0;
    }
    else
    {
        $sql1 = "SELECT f_graph_all($new_time, $product_id) AS 'graph_all';";
        $query1 = mysqli_query($con, $sql1);
        $r1 = mysqli_fetch_assoc($query1);
        $colvo = $r1['graph_all'];
        $array2[$i] = $colvo; 
        
        if ($array2[$i] > $max_array){
            $max_array = $array2[$i];
        }
    }
    
    
    $array1[$i] = "$date_day";
    
    
    $bar_v=new GChart_Bar_V($time * 80, 500);  
    $bar_v->set_bar_width(30,30,30);   
    $x_axis=new GChart_Axis(GChart_BOTTOM_X_AXIS,$array1); 
    $y_axis=new GChart_Axis(GChart_LEFT_Y_AXIS);  
    $y_axis->set_boundry(0, 100);  

    $s1=new GChart_DataSeries($array2,'Количество','11BC83');  
    $bar_v->add($s1);  
    $bar_v->add_axis($x_axis);  
    $bar_v->add_axis($y_axis);  
    
    
}
}
?>
<?php 
echo '<img src="'.$bar_v->get_image_string().'">'; 
}
?>