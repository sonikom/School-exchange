<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start();?>
<?php include '../../config.php';?>
<?php include '../../login/code_login.php';?>
<?php include './code_tarif.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
	<head>
		<title>School exchange</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
 		<link rel="stylesheet" href="../../assets/css/style.css" />               
	</head>
	<body class="is-preload homepage">
<!--            
            <input class="txt" type="text" value="asd"/><br/>
            <input class="cir" type="radio" value="asd" checked/>asd<br/>
            <input type="checkbox" value="qwe" id="asd"/>qwe<br/> 
            
            
             <div class="radio">
    <input class="radio_input" name="car" type="radio" id="honda">
    <label class="radio_label" for="honda">Honda</label>
</div>
<div class="radio">
    <input class="radio_input" name="car" type="radio" id="renault">
    <label class="radio_label" for="renault">Renault</label>
</div>
            -->
            
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<header id="header" class="container">

						<!-- Logo -->
							<div id="logo">
                                                            <h1><a href="../../index.php">Школьная Биржа</a></h1>
                                                             <h5 style='color:#627180; text-align:center'>проект Комаровой Сони</h5>
								<!--<span>by HTML5 UP</span>-->
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>
                                                                    <?php if (isset($_SESSION['email_logout_user'])){
                                                                    if (isset($_SESSION['email_logout_user_check_broker'])){?>
                                                                    <li>
                                                                        <a href="#">Личный кабинет</a>
									<ul>
                                                                          
                                                                            <li><a href="bank.php">Банк</a></li>
                                                                            <li><a href="offer.php">Мои заявки</a></li>
                                                                            <li><a href="archive.php">Мои продукты</a></li>

									

									
                                                                        <li>
                                                                            <a href="#">Предложения</a>
									<ul>
                                                                            <li><a href="customer.php">Хочу купить</a></li>
                                                                            <li><a href="seller.php">Хочу продать</a></li>
                                                                            <li class="current"><a href="cup_processing.php">Стакан</a></li>
                                                                            <li><a href="my_cup.php">Мои стаканы</a></li>
                                                                        </ul>
                                                                        </li>
                                                                        <li><a href="questions.php">Помощь</a></li>
                                                                        </ul>
                                                                        
								    </li>
                                                                    <?php } ?>
<!--									<li>
										<a href="#">Информация</a>
										<ul>
											<li><a href="#">О проекте</a></li>
											<li><a href="#">Помощь</a></li>
											<li><a href="#">Есть вопрос?</a></li>
										</ul>
									</li>-->
                                                                    <li class="current"><a href="user_broker.php">Брокеры</a></li>
                                                                        <li><a href="../start.php">Новости</a></li>
									                                                                       
								    <li><a href="../graph/graph.php">Графики</a></li>
                                                                    
								    <li>
                                                                        <form name="exit" method="get" action="../../index.php">
                                                                        <input id = "ex"name="exit" class="btn_exit" type="submit" value="Выход"/>
                                                                        </form>
                                                                    </li>
                                                                    <?php } ?>
								</ul>
							</nav>

					</header>
				</div>

			

			
				<div id="features-wrapper">
					<div class="container">
						<div class="row">
                                                    
							
                                                  
                                                    <?php if (isset($_REQUEST["company"])){ ?>
							<div class="col-8 col-12-medium">

								<!-- Box -->
									<section class="box feature">
										<!--<a href="#" class="image featured"><img src="images/pic02.jpg" alt="" /></a>-->
										<div class="inner">
											<header>
												<h2>Тарифы</h2>												
											</header>
                                                                                    <p>
                                                                                        <form name="company" method="get" action="user_broker.php">
                                                                                            <table>
                                                                                                <?php echo $table_tarif; ?>                            
                                                                                            </table> 
                                    
                                                                                            <input name="tarif"  type="submit" value="Выбрать"/>
                                                                                        </form>
                                                                                    </p>
										</div>
									</section>
                                                                
                                                                       

							</div>
                                                    <?php }
                                                    else {?>
                                                    <?php if (isset($_REQUEST["tarif"])){ ?>
							<div class="col-8 col-12-medium">

								<!-- Box -->
									<section class="box feature">
										<!--<a href="#" class="image featured"><img src="images/pic02.jpg" alt="" /></a>-->
										<div class="inner">
											<header>
                                                                                            <h2>Прикрепите документы</h2>
                                                                                            <p>Расширение: jpg, png, gif<br/> размером не более 2 Мб</p>
											</header>
                                                                                    <p>
                                                                                        <form name="company" method="post" action="user_broker.php" enctype="multipart/form-data">
                                                                                            <input name="uploadfile" type="file"/>
                                    
                                                                                            <input name="broker_user_add"  type="submit" value="Отправить на обработку"/>
                                                                                        </form>
                                                                                    </p>
										</div>
									</section>

							</div>
                                                    <?php }
                                                    else {?>
                                                     <?php if (isset($_REQUEST["broker_user_add"])){ ?>
							<div class="col-8-large">

								<!-- Box -->
									<section class="box feature">
										<!--<a href="#" class="image featured"><img src="images/pic02.jpg" alt="" /></a>-->
										<div class="inner">
											<header>
                                                                                            <h2>Ваша заявка отправлена</h2>												
											</header>
                                                                                    
										</div>
									</section>

							</div>
                                                    <?php }
                                                    else{?>
                                                    <div id="main-wrapper">
                                                       <div class="container">
                                                           <div class="row gtr-200" style='padding-top: 50px;'>

								
									<section class='section'>
<!--										<a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>-->
										<div class="inner">
											<header>
												<h2>Компании</h2>
												
											</header>
											
                                                                                    <form name="company" method="get" action="user_broker.php">
                                                                                                <table class="cir">
                                                                                                    <?php echo $table_company; ?>                            
                                                                                                </table>                
                                                                                                <br/>
                                                                                                <input name="company" type="submit" value="Выбрать"/>
                                                                                        </form>
										</div>
									</section>
                                                                        <section class='section'>
										<!--<a href="#" class="image featured"><img src="images/pic02.jpg" alt="" /></a>-->
										<div class="col-6-large">
											<header>
												<h2>Объяснение:</h2>												
											</header>
                                                                                    <h6>Выберите себе компанию!</h6>
                                                                                    <p>В реальной жизни чтобы получить доступ на биржу, необходимо выбрать компанию-брокер!</p>
                                                                                    
                                                                                    <h4>American project</h4>
                                                                                    <p>Иностранная компания, совсем недавно вошедшая на рынок!<br/>Познакомитесь со спецификой торговли различными биржевыми инструментами, не рискуя собственными средствами </p>
                                                                                    
                                                                                    <h4>Турим -  Пурим</h4>
                                                                                    <p>Российская компания, уже 2 года на российской бирже!<br/>Вы приобретете навыки торговли</p>
                                                                                     
                                                                                    <h4>Ки-кет</h4>
                                                                                    <p>Международная компания, уже 10 лет наши брокеры играют на биржах разных стран!<br/>Вы освоите на практике навыки биржевой торговли и анализа рынка </p>
                                                                                     
                                                                                    </p>
										</div>
									</section>

                                                       </div>
                                                       </div>
                                                </div>
                                                    <?php }}}?>
                                                    
                                                   
                                                    
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

		<!-- Scripts -->

			<script src="../../assets/js/jquery.min.js"></script>
			<script src="../../assets/js/jquery.dropotron.min.js"></script>
			<script src="../../assets/js/browser.min.js"></script>
			<script src="../../assets/js/breakpoints.min.js"></script>
			<script src="../../assets/js/util.js"></script>
			<script src="../../assets/js/main.js"></script>

	</body>
</html>