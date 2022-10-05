<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start();?>
<?php include '../../config.php';?>
<?php include '../../login/code_login.php';?>
<?php include './code_broker_archive.php';?>
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
								<!--<span>by HTML5 UP</span>-->
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>
                                                                    <li><a href="../../index.php">Главная</a></li>
<!--									<li>
										<a href="#">Информация</a>
										<ul>
											<li><a href="#">О проекте</a></li>
											<li><a href="#">Помощь</a></li>
											<li><a href="#">Есть вопрос?</a></li>
										</ul>
									</li>-->
                                                                    <li  class="current"><a href="moderator_archive.php">Клиенты</a></li>
                                                                    <li><a href="moderator.php">Работа</a></li>
                                                                    <li><a href="../start.php">Новости</a></li>
								    <li>
                                                                        <form name="exit" method="get" action="../../index.php">
                                                                        <input name="exit" type="submit" value="Выход"/><br/><?php// echo $email; ?>
                                                                        </form>
                                                                    </li>
								</ul>
							</nav>

					</header>
				</div>

			<!-- Main -->
				<div id="main-wrapper">
					<div class="container">
						
                                                    
                                                
                                            <div class="col-8">
                                                <h3>Мои клиенты</h3>                                             
                                                
                                                
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <td>Фамилия</td>
                                                            <td>Имя</td>
                                                            <td>Отчество</td>
                                                            <td>Паспорт</td>
                                                            <td>Email</td>
                                                            <td>Контракт</td>
                                                        </tr>
                                                    </thead>
                                                    <?php echo $table_provesing;?>
                                                </table>
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
                                                                            <li>Проект Сони Комаровой</li><li> <a href="../../index.php">Школьная Биржа</a></li>
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