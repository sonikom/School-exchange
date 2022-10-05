<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start();?>
<?php include './config.php';?>
<?php include './login/code_login.php';?>
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
		<link rel="stylesheet" href="assets/css/main.css" />
 		<link rel="stylesheet" href="assets/css/style.css" />               
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
								<h1><a href="index.php">Школьная Биржа</a></h1>
                                                                 <h5 style='color:#627180; text-align:center'>проект Комаровой Сони</h5>
								<span></span>
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									<!--<li class="current"><a href="index.html">Главная</a></li>-->
<!--									<li><a href="#">Что такое биржа?</a></li>-->
                                                                        								
									<?php if (isset($_SESSION['email_logout_user'])){
                                                                                if (isset($_SESSION['email_logout_user_check_broker'])){?>?>
                                                                        <li>
                                                                            <a href="#">Личный кабинет</a>
                                                                            <ul>
                                                                                <li><a href="pages/user/bank.php">Банк</a></li>
                                                                                <li><a href="pages/user/offer.php">Мои заявки</a></li>
                                                                                <li><a href="pages/user/archive.php">Мои продукты</a></li>
                                                                                



                                                                            <li>
                                                                                <a href="#">Предложения</a>
                                                                            <ul>
                                                                                <li><a href="pages/user/customer.php">Хочу купить</a></li>
                                                                                <li><a href="pages/user/seller.php">Хочу продать</a></li>
                                                                                <li><a href="pages/user/cup_processing.php">Стакан</a></li>
                                                                                <li><a href="pages/user/my_cup.php">Мои стаканы</a></li>

                                                                            </ul>
                                                                            </li>
                                                                                <li><a href="pages/user/questions.php">Помощь</a></li>
                                                                            </ul>
                                                                        
								        </li>
                                                                        <li><a href="pages/start.php">Новости</a></li>
                                                                        
                                                                        <?php }
                                                                        else{?>
                                                                        <li><a href="pages/user/user_broker.php">Брокеры</a></li>
                                                                        <?php } }?>
                                                                        <?php if (isset($_SESSION['email_logout_broker'])){?>
                                                                        <li><a href="pages/broker/broker.php">Работа</a></li>
                                                                        <li><a href="pages/broker/broker_archive.php">Клиенты</a></li>
                                                                        <?php } ?>
                                                                        <?php if (isset($_SESSION['email_logout_moderator'])){?>
                                                                        <li><a href="pages/moderator/moderator.php">Работа</a></li>
                                                                        <li><a href="pages/moderator/moderator_archive.php">Клиенты</a></li>
                                                                        <?php } ?>
                                                                        
                                                                        <?php if (isset($_SESSION['email_logout_user'])){?>
                                                                        <li><a href="pages/graph/graph.php">Графики</a></li>
                                                                        <?php } ?>
                                                                        <?php if ((isset($_SESSION['email_logout_broker'])) || (isset($_SESSION['email_logout_moderator'])) || (isset($_SESSION['email_logout_user']))){?>
                                                                        <li>
                                                                            <form name="exit" method="get" action="index.php">
                                                                            <input id="ex" name="exit" class="btn_exit" type="submit" value="Выход"/>
                                                                            </form>
                                                                        </li>
                                                                        <?php } 
                                                                        else {?>
                                                                        <li><a href="login/login.php">Войти</a></li>
                                                                        <?php } ?>
								</ul>
							</nav>

					</header>
				</div>

			<!-- Banner -->
				<div id="features-wrapper">
					<div id="banner" class="box container">
<!--						<div class="row">-->
							<div class="col-7 col-12-medium">
                                                            <h3 align="center">Добро пожаловать!</h3>
                                                        </div>

                                                        <div class="col-4 col-12-medium">
                                                            <p class="">Школьная биржа - это эмулятор настоящей биржи, предназначенный для обучения школьников и студентов.</p>
							</div>
							
<!--						</div>-->
					</div>
				</div>

			<!-- Features -->
				<div id="features-wrapper">
					<div class="container">
						<div class="row">
                                                        <div class="col-4 col-12-medium">

								<!-- Box -->
									<section class="box feature">
										<div class="inner">
											<header>
												<h2>Важно</h2>
											</header>
											<p>Формировать этот профиль и вообще заниматься инвестициями Вы можете самостоятельно или через профессионального управляющего. Самостоятельные инвестиции потребуют участия посредника - брокера, ведь только он допущен на биржу.</p>
										</div>
									</section>

							</div>			
							
							<div class="col-4 col-12-medium">

								<!-- Box -->
									<section class="box feature">
										<div class="inner">
											<header>
												<h2>Историческая справка</h2>
												
											</header>
											<p>Как только Петр I вернулся из Амстердама, он велел строить биржу в Санкт-Петербурге. В 1705 году она открылась, и так началась история российского фондового рынка.</p>
										</div>
									</section>

							</div>
                                                        <div class="col-4 col-12-medium">

								<!-- Box -->
									<section class="box feature">
										<div class="inner">
											<header>
												<h2>Что такое биржа?</h2>
												
											</header>
											<p>Это место, где торгуются ценные бумаги по определенным правилам.</p>
										</div>
									</section>

							</div>
                                                        
						</div>
					</div>
				</div>

			<!-- Main -->
				

			<!-- Footer -->
				<div id="footer-wrapper">
					<footer id="footer" class="container">
						
						<div class="row">
							<div class="col-12">
								<div id="copyright">
									<ul class="menu">
                                                                            <li style=''><img src="images/asd-small-mono.png" width="80em"></img></li>
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

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>