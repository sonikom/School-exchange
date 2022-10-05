<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start();?>
<?php include '../config.php';?>
<?php include '../login/code_login.php';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
	<head>
		<title>School exchange</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
                <link rel="stylesheet" href="../assets/css/main.css" />
                <link rel="stylesheet" href="../assets/css/style.css" />                
	</head>
	<body class="is-preload left-sidebar">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<header id="header" class="container">

						<!-- Logo -->
							<div id="logo">
                                                            <h1><a href="../index.php">Школьная Биржа</a></h1>
                                                             <h5 style='color:#627180; text-align:center'>проект Комаровой Сони</h5>
								<span></span>
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>  
                                                                <?php if (isset($_SESSION['email_logout_user'])){
                                                                    if (isset($_SESSION['email_logout_user_check_broker'])){?>
                                                                    <li>
                                                                        <a href="#">Личный кабинет</a>
									<ul>
                                                                            <li><a href="user/bank.php">Банк</a></li>
                                                                            <li><a href="user/offer.php">Мои заявки</a></li>
                                                                            <li><a href="user/archive.php">Мои продукты</a></li>

                                                                        <li>
                                                                        <a href="#">Предложения</a>
									<ul>
                                                                            <li><a href="user/customer.php">Хочу купить</a></li>
                                                                            <li><a href="user/seller.php">Хочу продать</a></li>
                                                                            <li><a href="user/cup_processing.php">Стакан</a></li>
                                                                            <li><a href="user/my_cup.php">Мои стаканы</a></li>
									
								    
                                                                            
									</ul>
                                                                        <li><a href="user/questions.php">Помощь</a></li>
                                                                        </li>
									</ul>
                                                                     </li>
                                                                    <?php }
                                                                          else{?>
                                                                    <li><a href="user/user_broker.php">Брокеры</a></li>
                                                                          <?php } ?>
								    
                                                                    
                                                                    
                                                                    <?php } ?>
                                                                    <?php if (isset($_SESSION['email_logout_broker'])){?>
                                                                    <li><a href="broker/broker.php">Работа</a></li>
                                                                    <li><a href="broker/broker_archive.php">Клиенты</a></li>
                                                                    <?php } ?>
                                                                    <?php if (isset($_SESSION['email_logout_moderator'])){?>
                                                                    <li><a href="moderator/moderator.php">Работа</a></li>
                                                                    <li><a href="moderator/moderator_archive.php">Клиенты</a></li>
                                                                     <?php } ?>
                                                                    <li><a href="start.php">Новости</a></li>
                                                                    
                                                                    <?php if (isset($_SESSION['email_logout_user'])){
                                                                    if (isset($_SESSION['email_logout_user_check_broker'])){?>
                                                                    <li><a href="graph/graph.php">Графики</a></li>
                                                                    <?php }} ?>
                                                                    
                                                                    <?php if (isset($_SESSION['email_logout_user'])){?>
                                                                    
                                                                    
								    <li>
                                                                        <form name="exit" method="get" action="../index.php">
                                                                        <input id='ex' name="exit" class="btn_exit" type="submit" value="Выход"/>
                                                                        </form>
                                                                    </li>
                                                                    <?php } ?>
                                                                    <?php if (isset($_SESSION['email_logout_moderator'])){?>
								    <li>
                                                                        <form name="exit" method="get" action="../index.php">
                                                                        <input  id='ex'  name="exit" class="btn_exit" type="submit" value="Выход"/>
                                                                        </form>
                                                                    </li>
                                                                    <?php } ?>
                                                                    <?php if (isset($_SESSION['email_logout_broker'])){?>
								    <li>
                                                                        <form name="exit" method="get" action="../index.php">
                                                                            <input id='ex' name="exit" class="btn_exit" type="submit" value="Выход"/>
                                                                        </form>   
                                                                    </li>
                                                                    <?php } ?>
								</ul>
							</nav>

					</header>
				</div>

			<!-- Main -->
				<div id="main-wrapper">
					<div class="container">
                                            
                                            
						<div class="row gtr-200" style='padding-top: 50px;'>
							<!--<div class="col-4 col-12-medium">-->
								<!--<div id="sidebar">-->

									 <!--Sidebar--> 
                                                                         
                                                                    <?php if (isset($_SESSION['email_logout_user'])){?>
                                                                    
                                                                    <?php } 
                                                                        else if (isset($_SESSION['email_logout_moderator'])){?>
								    
                                                                    <?php } 
                                                                         else if (isset($_SESSION['email_logout_broker'])){?>
								     
                                                                    <?php } else {?>
                                                                        <font color = "#FF0000"><p>
                                                                            <?php echo 'Вы ввели неправильный логин или пароль!<br/> Попробуйте ещё раз: <a href="../login/login.php">Войти</a>';?>
                                                                        </p></font>
                                                                     <?php } ?>    
                                                                         
                                                                         
                                                                         
                                                                    <?php if (isset($_SESSION['email_logout_user'])){
                                                                            if (isset($_SESSION['email_logout_user_check_broker'])){?>
										<section class='section_left'>
                                                                                    <h3>Доброй день!     Удачных торгов!</h3><br/>
                                                                                    
											
                                                                                        
                                                                                        <h4>Основные определения:</h4>
											<p>Биржа — организатор торгов товарами, валютой, ценными бумагами, производными и другими рыночными инструментами. Торговля ведётся стандартными контрактами или партиями (лотами), размер которых регламентируют нормативные документы биржи.</p>
                                                                                        <br/>
                                                                                        <p>Это место, где торгуются ценные бумаги по определенным правилам.</p>
                                                                                        <br/>
                                                                                        <p>Брокер является посредником между биржей и человеком или организацией, желающими покупать и продавать акции, облигации и другие финансовые инструменты на бирже.</p>
                                                                                        
										</section>

										
                                                                    <?php }
                                                                          else {?>
                                                                                <section class='section_left'>
                                                                                    <h3>Добро пожаловать!</h3><br/>
                                                                                    <h3>Теперь Вы участник проекта «Школьная Биржа»</h3>
											<p>Но для того чтобы получить доступ на Биржу, сначала необходимо выбрать брокера.</p>
                                                                                        
                                                                                        <h4>Кто такой брокер?</h4>
											<p>Брокер является посредником между биржей и человеком или организацией, желающими покупать и продавать акции, облигации и другие финансовые инструменты на бирже.</p>
<
										</section>

										<section class='section_right'>
                                                                                    <h3>Выберите себе брокера!</h3>
											<p>Выберите своего брокера в панели управления</p>
                                                                                        <p><img src="visor/Choose_broker.PNG"/></p>
										</section>
                                                                          <?php }  } ?>

								<!--</div>-->
							<!--</div>-->
<!--							<div class="col-8 col-12-medium imp-medium">
								<div id="content">

									 Content 
										<article>

										</article>

								</div>
							</div>-->
						</div>
					</div>
				</div>

			<!-- Footer -->
				<div id="footer-wrapper">
					<footer id="footer" class="container">
						
						<div class="row">
							<div class="col-12">
								<div id="copyright">
									<ul class="menu">
                                                                            <li style=''><img src="../images/asd-small-mono.png" width="80em"></img></li>
                                                                            <!--<li style='padding-bottom: 3em; vertical-align: middle;'>Проект Сони Комаровой</span></li>-->
                                                                            <li style='padding-bottom: 3em; vertical-align: middle;'> <a href="../../index.php">Школьная Биржа</a></li>                                                                           
									</ul>
								</div>
							</div>
						</div>
					</footer>
				</div>

			</div>

		<!-- Scripts -->

                        <script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.dropotron.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>