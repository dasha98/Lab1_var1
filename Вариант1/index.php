<?php include "bd.php";?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type"  charset="utf-8" />
	<title>Лагеря и заезды</title>
	<link href="css.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id='body'>
		<header>
			  <ul>
				<li id='menu'><a href="#">  Главная</a></li>
				<li id='menu'><a href="form.php">  Добавление информации</a></li>
				<li id='menu'><a href="calk.php">  Калькулятор</a></li>
			  </ul>
			<img src='heder.jpg' class='heder'>
			<h1>Лагеря и заезды</h1>
		</header>
        <div class='cont'>
		  <?php $camp = mysqli_query($link, 'SELECT * FROM `lager`');  
		  while ($lager = mysqli_fetch_array($camp)) {
				   $id = $lager['id_lager'];
                   echo "<div style=' width:100%; display: inline-flex; margin-top:10px; border:#FFFFFF solid 2px;'>
				           <img src='{$lager['url']}' width='30%' ;> 
						   <p style='margin: 8px;'> Название лагеря: {$lager['name_lager']}<br>
						   Адрес: {$lager['adres']} </p>";
				   $query = mysqli_query($link, "SELECT * FROM `period` WHERE period.id_lager='$id'");
				   	    echo "<table border=1>
							<tr>
							   <td> Название заезда</td>
							   <td> Дата начала заезда</td>
							   <td> Дата окончания заезда</td>
							   <td> Цена путевки</td>
							</tr>";
				    while ($period = mysqli_fetch_array($query)) {
						echo "<tr>
							   <td> {$period['name_period']}</td>
							   <td> {$period['date_start']}</td>
							   <td> {$period['date_stop']}</td>
							   <td> {$period['price']}</td>	
							</tr>";
					}
					echo "</table></div><br>";
				}
				mysqli_close($link);
		   ?>
		</div>
		<br>
	<footer class='footer'>
		<div align="center" valign="bottom" style="padding-top:6px;" class="copyright">МГТУ им Г.И.Носова &copy; 2019 Марина Барынина</div>
	</footer>
	</div>
</body>
</html>