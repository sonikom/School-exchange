<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php session_start();?>
<?php include '../../config.php';?>
<?php include '../../login/code_login.php';?>
<?php include './code_customer_product.php';?>
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
<!--                                                                    <li>
									<a href="#">Предложения</a>
									<ul>
                                                                            <li class="current"><a href="user/customer.php">Хочу купить</a></li>
                                                                            <li><a href="seller.php">Хочу продать</a></li>
									</ul>
								    </li>-->
                                                                    <li>
                                                                        <a href="#">Личный кабинет</a>
									<ul>
                                                                            <li><a href="bank.php">Банк</a></li>
                                                                            <li><a href="offer.php">Мои заявки</a></li>
                                                                            <li><a href="archive.php">Мои продукты</a></li>
									

									
                                                                        <li>
                                                                            <a href="#">Предложения</a>
									<ul>
                                                                            <li class="current"><a href="customer.php">Хочу купить</a></li>
                                                                            <li><a href="seller.php">Хочу продать</a></li>
                                                                            <li><a href="cup_processing.php">Стакан</a></li>
                                                                            <li><a href="my_cup.php">Мои стаканы</a></li>
                                                                        </ul>
                                                                        </li>
                                                                            <li><a href="questions.php">Помощь</a></li> 
                                                                        </ul>
                                                                     
								    </li>
                                                                    <!--<li><a href="user_broker.php">Брокеры</a></li>-->
                                                                    <li><a href="../start.php">Новости</a></li>
								  <?php if (isset($_SESSION['email_logout_user'])){?>
								    <li><a href="../graph/graph.php">Графики</a></li>
                                                                    
								    <li>
                                                                        <form name="exit" method="get" action="../../index.php">
                                                                        <input name="exit" id = "ex" class="btn_exit" type="submit" value="Выход"/>
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
						
                                                    
                                                <?php if (isset($_REQUEST["customer_product"]) || (isset($_REQUEST["add_cup"]))){?>
                                                        
                                                          <?php  if (isset($_SESSION['$bad_int'])){ 
                                                                     if ($_SESSION['$bad_int'] == 1){?>
                                                                        <p><h3>Вы выбрали категорию <?php echo $_SESSION['name_product']; ?></h3></p>
                                                                        <form name="order" method="get" action="customer.php">
                                                                          <div class="row">  
                                                                            <div class="col-4">
                                                                            <h4>Выберите количество лотов (любое натуральное число)</h4>
                                                                            <input name="quantity" type="text" value=""/>
                                                                            <font color="red"><h4 class ="txt_red_error">Вы ввели не натуральное число!</h4></font>
                                                                            <h4>Введите цену за один лот</h4>
                                                                            <input name="price" type="text" value=""/>
                                                                            <input name="add_cup" type="submit" value="Готово"/>
                                                                            </div>
                                                                           </div>
                                                                        </form>
                                                                     <?php }
                                                                     else if ($_SESSION['$bad_int'] == 2){?>
                                                                        <p><h3>Вы выбрали категорию <?php echo $_SESSION['name_product']; ?></h3></p>
                                                                        <form name="order" method="get" action="customer.php">
                                                                          <div class="row">  
                                                                            <div class="col-4">
                                                                            <h4>Выберите количество лотов (любое натуральное число)</h4>
                                                                            <input name="quantity" type="text" value=""/><br/>                                                                            
                                                                            <h4>Введите цену за один лот</h4>
                                                                            <input name="price" type="text" value=""/>
                                                                            <font color="red"><h4 class ="txt_red_error">У вас недостаточно средств!</h4></font><br/><br/>
                                                                            <input name="add_cup" type="submit" value="Готово"/>
                                                                            </div>
                                                                           </div>
                                                                        </form>
                                                                     <?php }
                                                                     else if ($_SESSION['$bad_int'] == 3){?>
                                                                        <p><h3>Вы выбрали категорию <?php echo $_SESSION['name_product']; ?></h3></p>
                                                                        <form name="order" method="get" action="customer.php">
                                                                          <div class="row">  
                                                                            <div class="col-4">
                                                                            <h4>Выберите количество лотов (любое натуральное число)</h4>
                                                                            <input name="quantity" type="text" value=""/><br/>                                                                            
                                                                            <h4>Введите цену за один лот</h4>
                                                                            <input name="price" type="text" value=""/>
                                                                            <input name="add_cup" type="submit" value="Готово"/>
                                                                            </div>
                                                                           </div>
                                                                        </form>
                                                                     <?php }
                                                                     else {?> 
                                                                          <div class="row">
                                                                            <div class="col-6">     
                                                                                <form name="customer" action="customer.php" method="get">
                                                                                             <article>

                                                                                                     <h3>Выберите категорию:</h3>

                                                                                                     <?php
                                                                                                     $a[11] = '';
                                                                                                     $a[12] = '';
                                                                                                     $a[13] = '';
                                                                                                     if (isset($_SESSION['food']))
                                                                                                         $a[$_SESSION['food']] = 'selected';
                                                                                                     else
                                                                                                         $a[11] = 'selected';
                                                                                                     ?> 

                                                                                                     <p class="col-6"> <select  name="m[1]">
                                                                                                             <option value="11" <?= $a[11] ?> /> Овощи
                                                                                                             <option value="12" <?= $a[12] ?>/> Фрукты
                                                                                                             <option value="13" <?= $a[13] ?>/> Ягоды
                                                                                                         </select></p>
                                                                                                     <input name="product_category" type="submit" value="Выбрать"/>
                                                                                             </article>
                                                                                     </form>
                                                                                 </div>
                                                                             </div>
                                                                     <?php }?>
                                                            <?php } 
                                                                  else{?>
                                                                       <p><h3>Вы выбрали категорию <?php echo $_SESSION['name_product']; ?></h3></p>
                                                                        <form name="order" method="get" action="customer.php">
                                                                          <div class="row">  
                                                                            <div class="col-4">
                                                                            <h4>Выберите количество лотов (любое натуральное число)</h4>
                                                                            <input name="quantity" type="text" value=""/>                                                                           
                                                                            <h4>Введите цену за один лот</h4>
                                                                            <input name="price" type="text" value=""/>
                                                                            <input name="add_cup" type="submit" value="Готово"/>
                                                                            </div>
                                                                           </div>
                                                                        </form>
                                                <?php }
                                                }
                                                else {?>
                                            <div class="col-8">
                                                    <?php if (isset($_REQUEST["product_category"])){ ?> 
                                                <form name="customer_product" method="get" action="customer.php">
                                                      <?php  if ($_SESSION['category'] == 1): ?>
                                                        
                                                        
                                                            <h3>Овощи</h3>
                                                            <p> <?php echo $_SESSION['category_content']; ?></p>
                                                            <p><table> <?php echo $table_product; ?></table></p>
							<?php endif; 
                                                              if ($_SESSION['category'] == 2): ?>
                                                                <h3>Фрукты</h3>
                                                                <p> <?php echo $_SESSION['category_content']; ?></p>
                                                                <p><table> <?php echo $table_product; ?></table></p>
                                                              <?php endif;
                                                                    if ($_SESSION['category'] == 3): ?>
                                                                        <h3>Ягоды</h3>
                                                                        <p> <?php echo $_SESSION['category_content']; ?></p>
                                                                        <p><table><?php echo $table_product; ?></table></p>
                                                              <?php endif;?>
                                                                        <input name="customer_product" type="submit" value="Выбрать" />
                                                        </form>
                                                        
                                                    <?php }  
                                                                       
                                                    else{?>
                                               </div> 
                                            <div class="row">
                                               <div class="col-6">     
                                                   <form name="customer" action="customer.php" method="get">
								<article>

									<h3>Выберите категорию:</h3>
                                                                        
                                                                        <?php
                                                                        $a[11] = '';
                                                                        $a[12] = '';
                                                                        $a[13] = '';
                                                                        if (isset($_SESSION['food']))
                                                                            $a[$_SESSION['food']] = 'selected';
                                                                        else
                                                                            $a[11] = 'selected';
                                                                        ?> 
                                                                        
									<p class="col-6"> <select  name="m[1]">
                                                                                <option value="11" <?= $a[11] ?> /> Овощи
                                                                                <option value="12" <?= $a[12] ?>/> Фрукты
                                                                                <option value="13" <?= $a[13] ?>/> Ягоды
                                                                            </select></p>
                                                                        <input name="product_category" type="submit" value="Выбрать"/>
								</article>
                                                        </form>
                                                          <?php }
                                                }?>    
                                                    </div>
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