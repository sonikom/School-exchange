<?php 

// content="text/plain; charset=utf-8"

define ('GChart_DIR','gchart-0.1');
require_once (GChart_DIR.'/GChart.php');
require_once '../../config.php';


//while (mysqli_more_results($con) && mysqli_next_result($con)) $con->store_result();
//$user = 'root'; $pass = 'vertrigo';
//$dbh = new PDO('mysql:host=localhost;dbname=exchange;port=3306', $user, $pass);

while (mysqli_more_results($con) && mysqli_next_result($con)) $con->store_result();
$user = 'selenak_exch'; $pass = 'Agkomarov_1961';
$dbh = new PDO('mysql:host=localhost;dbname=selenak_exch;port=3306', $user, $pass);

$sql1="SELECT u.id, u.last_name AS user, b.id AS id1, b.last_name AS brok
  FROM user u JOIN user_broker ub ON u.id = ub.user_id
  JOIN broker_tarif bt ON ub.broker_tarif_id = bt.id
  JOIN brokers b ON bt.broker_id = b.id
WHERE b.id=1";
$sql2="SELECT u.id, u.last_name AS user, b.id AS id1, b.last_name AS brok
  FROM user u JOIN user_broker ub ON u.id = ub.user_id
  JOIN broker_tarif bt ON ub.broker_tarif_id = bt.id
  JOIN brokers b ON bt.broker_id = b.id
WHERE b.id=2";
$numrows1 = $dbh->query($sql1)->rowCount();
$numrows2 = $dbh->query($sql2)->rowCount();

$array1=array();
$array2=array();
$array1[1]="user1";
$array2[1]=$numrows1*10;
$array1[2]="user2";
$array2[2]=$numrows2*10;


    
    $bar_v=new GChart_Bar_V($time * 80, 500);  
    $bar_v->set_bar_width(30,30,30);   
    $x_axis=new GChart_Axis(GChart_BOTTOM_X_AXIS,$array1); 
    $y_axis=new GChart_Axis(GChart_LEFT_Y_AXIS);  
    $y_axis->set_boundry(0, 100);  

    $s1=new GChart_DataSeries($array2,'Количество','11BC83');  
    $bar_v->add($s1);  
    $bar_v->add_axis($x_axis);  
    $bar_v->add_axis($y_axis);  
    
    

?>
<?php 
echo '<img src="'.$bar_v->get_image_string().'">'; 

?>