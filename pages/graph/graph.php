<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start();?>
<?php include '../../config.php';?>
<?php include '../../login/code_login.php';?>

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
                                                                            <li><a href="../user/bank.php">Банк</a></li>
                                                                            <li><a href="../user/offer.php">Мои заявки</a></li>
                                                                            <li><a href="../user/archive.php">Мои продукты</a></li>
                                                                        <li>
                                                                            <a href="#">Предложения</a>
									<ul>
                                                                            <li><a href="../user/customer.php">Хочу купить</a></li>
                                                                            <li><a href="../user/seller.php">Хочу продать</a></li>
                                                                            <li class="current"><a href="../user/cup_processing.php">Стакан</a></li>
                                                                        										        
                                                                        </ul>
                                                                        </li>
                                                                        </ul>
                                                                        
								    </li>
                                                                    <li><a href="../user/user_broker.php">Брокеры</a></li>
                                                                    
                                                                    <li><a href="../start.php">Новости</a></li>
                                                                    <li><a href="graph.php">Графики</a></li>
                                                                    <li>
                                                                        <form name="exit" method="get" action="../../index.php">
                                                                        <input id="ex" name="exit" class="btn_exit" type="submit" value="Выход"/>
                                                                        </form>
                                                                    </li>
								</ul>
							</nav>

					</header>
				</div>


			

			<!-- Features -->
				<div id="features-wrapper">
					<div class="container">
						<div class="row">
							<div class="col-10 col-12-medium">

								<!-- Box -->
									<section class="box feature">
                                                                            <div class="inner">
                                                                                <div class="col-4 col-12-medium">
                                                                                    <form name="seller" action="graph.php" method="get">
                                                                                    <table>
                                                                                        <tr>
                                                                                            <td>Продукт</td>
                                                                                            <td>Пользователи</td>
                                                                                            <td>Время</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <p class="col-2"> <select  name="m[1]">
                                                                                                        <option value="11">Яблоки</option>
                                                                                                        <option value="12" >Груша</option>
                                                                                                        <option value="13" >Ананас</option>
                                                                                                        <option value="14" >Морковь</option>
                                                                                                        <option value="15" >Свекла</option>
                                                                                                        <option value="16">Арбуз</option>
                                                                                                        <option value="17"> Черешня</option>
                                                                                                </select></p>
                                                                                            </td>
                                                                                            <td>
                                                                                                <p class="col-2"> <select  name="m[2]">
                                                                                                        <option value="21">Все</option>
                                                                                                        <option value="22" >Я купил</option>
                                                                                                        <option value="23" >Я продал</option>
                                                                                                        
                                                                                                </select></p>
                                                                                            </td>
                                                                                            <td>
                                                                                                <p class="col-2"> <select  name="m[3]">
                                                                                                        <option value="31">Эта неделя</option>
                                                                                                        <option value="32" >2 дня</option>
                                                                                                        <option value="33" >3 дня</option>
                                                                                                        
                                                                                                </select></p>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input name="graph" class="table-input" type="submit" value="Строить"/>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php if (isset($_REQUEST['graph'])){?>
                                                                                        <tr>
                                                                                            <td colspan="4">
                                                                                                <?php
                                                                                                
                                                                                                    require_once './draw.php'; 

                                                                                                ?> 
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php }?>
<!--                                                                                        <tr>
                                                                                            <td colspan="4">
                                                                                                <?php
                                                                                                
                                                                                                    require_once './draw2.php'; 

                                                                                                ?> 
                                                                                            </td>
                                                                                        </tr>-->
                                                                                    </table>
                                                                                </form>
                                                                                
                                                                                </div>
                                                                                <br/>
                                                                                    
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