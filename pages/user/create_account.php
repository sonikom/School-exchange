<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start();?>
<?php include '../../config.php';?>
<?php include './code_add_user.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
	Verti by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>school_exchange</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
 		<link rel="stylesheet" href="../../assets/css/style.css" />               
	</head>
	<body class="is-preload homepage">
<!--            <input class="txt" type="text" value="asd"/><br/>
            <input class="cir" type="radio" value="asd" checked/>asd<br/>
            <input type="checkbox" value="qwe" id="asd"/>qwe<br/> 
            
            
             <div class="radio">
    <input class="radio_input" name="car" type="radio" id="honda">
    <label class="radio_label" for="honda">Honda</label>
</div>
<div class="radio">
    <input class="radio_input" name="car" type="radio" id="renault">
    <label class="radio_label" for="renault">Renault</label>
</div>-->
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<header id="header" class="container">

						<!-- Logo -->
							<div id="logo">
                                                            <h1><a href="../../index.php">Школьная Биржа</a></h1>
                                                             <h5 style='color:#627180; text-align:center'>проект Комаровой Сони</h5>
								<span></span>
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>
<!--                                                                    <li><a href="../../index.php">Главная</a></li>
									<li>
										<a href="#">Информация</a>
										<ul>
											<li><a href="#">О проекте</a></li>
											<li><a href="#">Помощь</a></li>
											<li><a href="#">Есть вопрос?</a></li>
										</ul>
									</li>-->
                                                                    <li class="current"><a href="create_account.php">Создание аккаунта</a></li>
                                                                        <!--<li><a href="../start.php">Новости</a></li>-->
									<li><a href="../../login/login.php">Войти</a></li>
								</ul>
							</nav>

					</header>
				</div>

			<!-- Features -->
				<div id="features-wrapper">
					<div class="container">
						<div class="row">
                                                    <?php if (isset($_SESSION['file_create'])){ ?>
                                                            <div class="container">
                                                                <div class="inner">
                                                                    <font color = "#FF0000"><p>
                                                                    <?php echo 'Вы успешно прошли регистрацию. Ваша заявка будет рассмотрена в ближайшее время.<br/> На почту '.$_SESSION['email_create'].' будет отправлено письмо с решением.<br/>' ?>
                                                                        </p></font>
                                                                </div>
                                                            </div>
                                                    <?php }
                                                    else{ ?>
							<div class="col-4 col-12-medium">

								<!-- Box -->
									<section class="box feature">
										
										<div class="inner">
											<header>
												<h2>Создайте учетную запись</h2>												
											</header>
                                                                                    <form name="step_1" method="get" action="create_account.php">
											<p>Email
                                                                                            <?php $email_num = '';
                                                                                                if(isset($_SESSION['email_create'])){
                                                                                                     $email_num = $_SESSION['email_create']; 
                                                                                                }
                                                                                                else {
                                                                                                  $email_num = '';  
                                                                                                } ?>
                                                                                                </br>
                                                                                                <input  name="m[4]" type="text" class="form-control validate" value="<?=$email_num?>">
                                                                                                <?php if (isset($_REQUEST['step_1'])){
                                                                                                    //echo 'EMAIL';
                                                                                                           if ($r_email['check'] != 0){
                                                                                                               echo '<font color = "#FF0000"><p>Данный email уже зарегистрирован</p></font>';
                                                                                                           }
                                                                                                } ?> 
                                                                                        </p>
                                                                                        <p>Пароль:
                                                                                            <?php $pass = '';                                          
                                                                                                if (isset($_SESSION['password_create']))
                                                                                                    $pass = $_SESSION['password_create'];                                        
                                                                                                else {
                                                                                                  $pass = '';  
                                                                                                }?> 
                                                                                       
                                                                                          <input value="<?= $pass?>" name="m[5]" type="text" class="form-control validate"/>
                                                                                        </p>
                                                                                        <p>Повторите пароль:
                                                                                            <?php $pass = '';                                          
                                                                                                if (isset($_SESSION['password_create']))
                                                                                                    $pass = $_SESSION['password_create'];                                        
                                                                                                else {
                                                                                                  $pass = '';  
                                                                                                }?> 
                                                                                       
                                                                                          <input value="<?= $pass?>"  name="m[6]" type="text" class="form-control validate"/>
                                                                                        </p>
                                                                                        <?php                                                                                           
                                                                                            if (isset($_REQUEST['step_1'])){
                                                                                                echo '';
                                                                                            if (isset($_SESSION['password_create'])){
                                                                                                echo '<font color = "#00FF00"><p>Пароли совпадают</p></font>';
                                                                                            }
                                                                                            else 
                                                                                            {
                                                                                               echo '<font color = "#FF0000"><p>Пароли не совпадают</p></font>';
                                                                                            }
                                                                                            } ?>
                                                                                        <br/>
                                                                                        <?php if ((isset($_SESSION['password_create'])) && (isset($_SESSION['email_create']))){}else{ ?>
                                                                                        <input name="step_1" type="submit" value="Далее"/>
                                                                                        <?php }?>
                                                                                    </form>

										</div>
									</section>

							</div>
                                                    <?php if ((isset($_SESSION['password_create'])) && (isset($_SESSION['email_create']))): ?>
							<div class="col-4 col-12-medium">	
                                                            <form name="step_2" method="get" action="create_account.php"> 
									<section class="box feature">									    	
										<div class="inner">
											<header>
												<h2>Данные</h2>												
											</header>
											<p>Имя
                                                                                            <?php $first = '';
                                                                                            if(isset($_SESSION['first_name_create'])){
                                                                                              $first = $_SESSION['first_name_create'];                                                
                                                                                            }
                                                                                            else {
                                                                                              $first = '';  
                                                                                            } ?>                                                                                                                             
                                                                                        <input name="m[0]" type="text" class="form-control validate" value="<?=$first?>"/>
                                                                                        </p>
                                                                                        <p>Отчество / второе имя
                                                                                            <?php $middle = '';
                                                                                            if(isset($_SESSION['middle_name_create'])){
                                                                                              $middle = $_SESSION['middle_name_create'];                                                
                                                                                            }
                                                                                            else {
                                                                                              $middle = '';  
                                                                                            } ?>                                                                                          
                                                                                            <input name="m[1]" type="text" class="form-control validate" value="<?=$middle?>"/>
                                                                                        </p>
                                                                                        <p>Фамилия
                                                                                            <?php $last = '';
                                                                                            if(isset($_SESSION['last_name_create'])){
                                                                                              $last = $_SESSION['last_name_create'];                                                
                                                                                            }
                                                                                            else {
                                                                                              $last = '';  
                                                                                            }?>
                                                                                       
                                                                                            <input name="m[2]" type="text" class="form-control validate" value="<?=$last?>"/>
                                                                                        </p>
                                                                                    <br/>
                                                                                    <?php if ((isset($_SESSION['password_create'])) && (isset($_SESSION['email_create']))  && (isset($_SESSION['first_name_create'])) && (isset($_SESSION['middle_name_create'])) && (isset($_SESSION['last_name_create']))){}else{?>
                                                                                    <input name="step_2" type="submit" class="btn btn-primary d-block mx-xl-auto" value="Далее"/>
                                                                                    <?php } ?>
										</div>
									</section>
                                                            </form>
							</div>
                                                    <?php endif; ?>
                                                    <?php if ((isset($_SESSION['password_create'])) && (isset($_SESSION['email_create']))  && (isset($_SESSION['first_name_create'])) && (isset($_SESSION['middle_name_create'])) && (isset($_SESSION['last_name_create']))): ?>        
							<div class="col-4 col-12-medium">	
                                                            <form name="create_account" method="post" action="create_account.php"  enctype="multipart/form-data">
									<section class="box feature">										
										<div class="inner">
											<header>
												<h2>Документы</h2>											
											</header>
											<p>Паспорт(серия и номер 'слитно')
                                                                                            <?php $pasport_num = '';
                                                                                            if (isset($_SESSION['pasport_create'])){
                                                                                                $pasport_num = $_SESSION['pasport_create']; 

                                                                                            }
                                                                                            else {
                                                                                              $pasport_num = '';  
                                                                                            } ?> 
                                                                                         
                                                                                            <input value="<?=$pasport_num?>" name="m[3]" type="text" class="form-control "/>
                                                                                            <br/>
                                                                                            <?php if ((isset($_REQUEST['create_account'])) && (isset($_SESSION['pasport_create']))  && ($_SESSION['pasport_create'] == 1)){ ?>
                                                                                            <font color = "#FF0000"><p>
                                                                                                <?php echo 'Данный паспорт уже зарегистрирован';?>
                                                                                            </p></font>
                                                                                            <br/>
                                                                                            <?php } ?>
                                                                                            <p>Вставьте файл<br/>расширение: jpg, png, gif<br/> размером не более 2 Мб</p>
                                                                                            <br/>
                                                                                            <input name="uploadfile" type="file"/>
                                                                                        </p>
                                                                                    <br/>
                                                                                    <input name="create_account" type="submit" value="Создать аккаунт"/>
										</div>
									</section>
                                                             </form>
							</div>
                                                    <?php endif; ?>
                                                  <?php } ?> 
						</div>
					</div>
				</div>

			

			<div id="footer-wrapper">
					<footer id="footer" class="container">
						
						<div class="row">
							<div class="col-12">
								<div id="copyright">
									<ul class="menu">
                                                                            <li style=''><img src="../../images/asd-small-mono.png" width="80em"></img></li>
                                                                            <!--<li style='padding-bottom: 3em; vertical-align: middle;'>Проект Сони Комаровой</span></li>-->
                                                                            <li style='padding-bottom: 3em; vertical-align: middle;'> <a href="../../index.php">Школьная Биржа</a></li>                                                                           
									</ul>
								</div>
							</div>
						</div>
					</footer>
				</div>

			</div>

		

			<script src="../../assets/js/jquery.min.js"></script>
			<script src="../../assets/js/jquery.dropotron.min.js"></script>
			<script src="../../assets/js/browser.min.js"></script>
			<script src="../../assets/js/breakpoints.min.js"></script>
			<script src="../../assets/js/util.js"></script>
			<script src="../../assets/js/main.js"></script>

	</body>
</html>