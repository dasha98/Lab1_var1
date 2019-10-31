<?php
include "bd.php";

    $id_lader = $_POST['id_lager'];
	$name_lager = $_POST['name_lager'];
	$adres = $_POST['adres'];
	$url = $_POST['url'];
	$date_start = $_POST['date_start'];
	$date_stop = $_POST['date_stop'];
	$name_period = $_POST['name_period'];
	$price = $_POST['price'];	
	
if( isset( $_POST['plusLager'] ) ) {
	$id = 1;
	$camp = mysqli_query($link, 'SELECT * FROM `lager`');
	while ($lager = mysqli_fetch_array($camp)) {
			if($lager['name_lager']==$name_lager){	//Проверка наличия лагеря		 
				$id = 0;
			}
	}	
	if($id == 1){
		//занесение данных в таблицу
					$result = mysqli_query($link, "INSERT INTO `lager` (`name_lager`, `adres`, `url`) VALUES ('$name_lager','$adres','$url')");
					$vivod1 = "Данные успешно добавлены ✔";
	}
	else{
		$vivod1 = 'Такой лагерь уже есть в базе';
	}
}

if( isset( $_POST['plusPeriod'] ) ) {
	$id = $id_lader;
	if ($id==0){
		$date = 3;
	}
	else{
		$query = mysqli_query($link, "SELECT * FROM `period` WHERE period.id_lager='$id'");
		$date = 1;
		while ($period = mysqli_fetch_array($query)) {	//Проверка даты начала заезда
			if($period['date_start']==$date_start && $period['date_stop']==$date_stop){			
				$date = 0;
			}
			elseif($period['date_start'] < $date_start && $date_start < $period['date_stop'] OR $period['date_start'] < $date_stop && $date_stop < $period['date_stop']){
				$date = 2;
			}
		}
	}
	if($date == 1){
		//занесение данных в таблицу
					$res = mysqli_query($link, "INSERT INTO `period` (`id_lager`,`date_start`, `date_stop`, `name_period`, `price`) VALUES ('$id_lader','$date_start','$date_stop','$name_period','$price')");
					$vivod2 = "Данные успешно добавлены ✔";
	}
	elseif ($date == 2){
		$vivod2 = 'Введенный заезд пересекается с существующим';
	}
    elseif ($date == 3){
		$vivod2 = 'Вы не выблали лагерь';
	} 	
	else{
		$vivod2 = 'Такой заезд в данном лагере уже есть в базе';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type"  charset="utf-8" />
	<title>Добавление информации</title>
	<link href="css.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id='body'>
		<header>
			  <ul>
				<li id='menu'><a href="index.php">  Главная</a></li>
				<li id='menu'><a href="#">  Добавление информации</a></li>
				<li id='menu'><a href="calk.php">  Калькулятор</a></li>
			  </ul>
			<img src='heder.jpg' class='heder'>
			<h1>Добавить инфоррмацию о лагере или заезде</h1>
		</header>
        <div class="container">
			<form method="POST" action="">
				<div class="form-row">
					 <label for="name_lager"><b>Название лагеря:</b></label> <input type="text" name="name_lager" style="font-size: 12pt;" id="name_lager" required >
				  </div>
				  <br>
				  <div class="form-row">
					 <label for="adres"><b>Адрес:</b></label> <input type="text" name="adres"  style="font-size: 12pt;" id="adres" required >
				  </div>
				  <br>
				  <div class="form-row">
					 <label for="url"><b>Ссылка на картинку:</b></label> <input type="text" name="url"  style="font-size: 12pt;" id="url" required >
				  </div>
				  <p class='form-row'><input class='button' type="submit" name="plusLager" style="font-size: 12pt;" value="Добавить данные о лагере"></p>
				  <p class='vivod'><?php echo $vivod1; ?></p>
				  <br>
			</form>
			<form method="POST" action="">
					<div class="form-row">
					 <label for="name_lager"><b>Название лагеря:</b></label>
					
					<?php echo "<select name='id_lager' size='1' style='font-size: 12pt;'>";     //список существующих лагерей
					 echo "<option selected='selected'style='font-size: 12pt; value='0''>Выберете лагерь</option>";
					 $camp = mysqli_query($link, 'SELECT * FROM `lager`');           
					 while ($lager = mysqli_fetch_array($camp)) {
							echo "<option value='{$lager['id_lager']}'style='font-size: 12pt;'>{$lager['name_lager']}</option>"; 
					 }
					 echo "</select>";
					 ?>
					 
				  </div>
				  <br>
				  <div class="form-row">
					 <label for="date_start"><b>Начало заезда:</b></label> <input type="date" name="date_start"  style="font-size: 12pt;" id="date_start" required >
				  </div>
				  <br>
				  <div class="form-row">
					 <label for="date_stop"><b>Окончание заезда:</b></label> <input type="date" name="date_stop"  style="font-size: 12pt;" id="date_stop" required >
				  </div>
				  <br>
				  <div class="form-row">
					 <label for="name_period"><b>Название заезда:</b></label> <input type="text" name="name_period"  style="font-size: 12pt;" id="name_period" required >
				  </div>
				  <br>
				  <div class="form-row">
					 <label for="price"><b>Стоимость:</b></label> <input type="number" name="price" min="1" style="font-size: 12pt;" id="price" required >
				  </div>
				  <p class='form-row'><input class='button' type="submit" name="plusPeriod" style="font-size: 12pt;" value="Добавить данные о заезде"></p>
				  <p class='vivod'><?php echo $vivod2; 
				  mysqli_close($link);?></p>
			</form>
			
		</div>
	<footer class='footer'>
		<div align="center" valign="bottom" style="padding-top:6px;" class="copyright">МГТУ им Г.И.Носова &copy; 2019 Марина Барынина</div>
	</footer>
	</div>
</body>
</html>