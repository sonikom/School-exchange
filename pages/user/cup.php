<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start();?>
<?php include '../../config.php';?>
<?php include '../../login/code_login.php';?>
<?php include './code_cup.php';?>
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
                                                                    <!--<li><a href="user_broker.php">Брокеры</a></li>-->
                                                                    <li><a href="../start.php">Новости</a></li>
								    <li><a href="../graph/graph.php">Графики</a></li>
                                                                    <li>
                                                                        <form name="exit" method="get" action="../../index.php">
                                                                        <input name="exit" id = "ex"  class="btn_exit" type="submit" value="Выход"/>
                                                                        </form>
                                                                    </li>
								</ul>
							</nav>

					</header>
				</div>

			<!-- Main -->
				<div id="main-wrapper">
					<div class="container">
                                            
                                            
						<div class="row gtr-200" style='padding-top: 50px;'>
						
                                                    
                                        <section class='section_left'>
                                               <table id="zagolovok">
                                                   <thead>
                                                       <tr>                                                           
                                                           <td>Цена за лот</td>
                                                           <td>Количество лотов</td>
                                                           <td>Моё количество</td>
                                                       </tr>
                                                   </thead>
                                                   <?php echo $table_seller_cup; ?>
                                                   <tr HEIGHT="1px"  bgcolor="#32CD32"  ><td></td><td></td><td></td></tr>
                                                   <?php echo $table_customer_cup; ?>
                                               </table>
                                                <br/>
                                                
                                            </section>
                                            <section class='section_right'>
                                                <h4>Что такое "Биржевой стакан" ?</h4>
                                                <p>Биржевой стакан или лента сделок – это список лимитных заявок на рынке в текущий момент. Как правило, заявки на продажу расположены сверху – еще их называют «аски»(от англ. ask – спрос). Заявки на покупку, расположены снизу и называются «биды» (от англ. bid – предложение). И те, и другие еще называют «офферами» (offers)</p>
                                                <img src="../visor/cup.PNG"></img>
                                            </section>
                                       <?php if (isset($_SESSION['check_my_cup'])){
                                                if ($_SESSION['check_my_cup'] == 0){ ?>
                                                <form name="my_cup" method="get" action="cup.php">
                                                    <h4>Хотите добавить данный стакан в "Мои Стаканы" ?</h4><br/>
                                                    <input name="my_cup" type="submit" value="Да!" />
                                                </form>
                                       <?php }
                                       }
                                       else {?>
                                        <form name="my_cup" method="get" action="cup.php">
                                                    <h4>Хотите добавить данный стакан в "Мои Стаканы" ?</h4><br/>
                                                    <input name="my_cup" type="submit" value="Да!" /><br/>
                                        </form><br/><br/>
                                       <?php } ?>
                                        <form name="my_cup" method="get" action="cup.php">
                                                    <h4>Хотите сгенерировать стакан?</h4><br/>
                                                    <input name="f_processing_cup" type="submit" value="Да!" />
                                        </form>
                                                    
                                        </div>
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