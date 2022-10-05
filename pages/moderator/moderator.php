<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start();?>
<?php include '../../config.php';?>
<?php include '../../login/code_login.php';?>
<?php include './code_moderator_procesing.php';?>
<?php include './code_moderator_mail_no.php';?>
<?php include './code_moderator_mail_yes.php';?>
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
                                                                    <li><a href="moderator_archive.php">Клиенты</a></li>
                                                                    <li class="current"><a href="moderator.php">Работа</a></li>
                                                                    <li><a href="../start.php">Новости</a></li>
								    <li>
                                                                        <form name="exit" method="get" action="../../index.php">
                                                                        <input name="exit" id = "ex" type="submit" value="Выход"/><br/><?php// echo $email; ?>
                                                                        </form>
                                                                    </li>
								</ul>
							</nav>

					</header>
				</div>		

			
				<div id="features-wrapper">
					<div class="container">
						<div class="row">                                
                                                    	<div class="col-8 col-12-medium">
									<section class="box feature">
										<!--<a href="#" class="image featured"><img src="images/pic02.jpg" alt="" /></a>-->
										<div class="inner">
											<header>
                                                                                            <table>
												<tr>
                                                                                                    <th>№</th>
                                                                                                    <th>Фамилия Имя Отчество</th>
                                                                                                    <th>Паспорт</th>
                                                                                                    <th>Ответственный</th>                                                                                                    
                                                                                                </tr>	
                                                                                            </table>
											</header>
                                                                                    <p>
                                                                                        <form name="procesing" method="get" action="moderator.php">
                                                                                            <table>
                                                                                                <?php echo $table_provesing; ?>                            
                                                                                            </table> 
                                                                                             
                                                                                            <input name="status"  type="submit" value="Выбрать"/>
                                                                                        </form>
                                                                                    </p>
										</div>
									</section>
							</div>
                                                    	
                                                    <div class="col-4 col-12-medium">

								
									<section class="box feature">
<!--										<a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>-->
										<div class="inner">
                                                                                    <form name="procesing" method="get" action="moderator.php">
                                                                                        <?php if(isset($_SESSION['first'])){?>
                                                                                        <table class="table table-hover table-striped mt-3">
                                                                                            <tr>
                                                                                                <td>Фамилия:</td>
                                                                                                <td><?php echo $_SESSION['last']; ?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Имя:</td>
                                                                                                <td><?php echo $_SESSION['first']; ?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Отчество:</td>
                                                                                                <td><?php echo $_SESSION['middle']; ?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Паспорт:</td>
                                                                                                <td><?php echo $_SESSION['pasport_procesing']; ?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Email:</td>
                                                                                                <td><?php echo $_SESSION['email_procesing']; ?></td>
                                                                                            </tr>
                                                                                        </table>

                                                                                        <input name="add" class="btn btn-primary tm-table-mt" type="submit" value="Добавить"/>
                                                                                        <br/>
                                                                                        <br/>
                                                                                        <input name="refusal" class="btn btn-primary tm-table-mt" type="submit" value="Отказ"/>
                                                                                        <?php } ?>
                                                                                    </form>
										</div>
									</section>

							</div>
                                                    
						</div>
					</div>
				</div>

			
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