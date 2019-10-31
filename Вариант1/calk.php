<?php
include "bd.php";

	$name_lager = $_POST['name_lager'];
	$id_lager = $_POST['id_lager'];
	$date_start = $_POST['date_start'];
	$kol = $_POST['kol'];	
	if( isset( $_POST['chet'] ) ) { // Если нажато расчитать	
		$id = $id_lager;
		if ($id==0){
		$date = 3;
		}
	    else{
			$query = mysqli_query($link, "SELECT * FROM `period` WHERE period.id_lager='$id'");
			$date = '0';
			while ($period = mysqli_fetch_array($query)) {	//Проверка наличия заезда
				if($period['date_start']==$date_start){			
					$date = $period['date_start'];	
					$chet = mysqli_query($link, "SELECT price FROM `period` WHERE period.id_lager='$id' AND period.date_start='$date'");
					$s = mysqli_fetch_array($chet); 
					$sum = $s['price']*$kol; //Расчет стоимости
				}
			}
		}
		if($date == '0'){
			$vivod = 'Такого заезда нет в этом лагере ✘';
		}
		elseif ($date == 3){
		$vivod = 'Вы не выблали лагерь';
		} 
		else{
			$vivod = $sum;
			$per0 = 'Общаяя стоимость составит: ';
			$per1 = ' руб.';
		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type"  charset="utf-8" />
	<title>Калькулятор</title>
	<link href="css.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id='body'>
		<header>
			  <ul>
				<li id='menu'><a href="index.php">  Главная</a></li>
				<li id='menu'><a href="form.php">  Добавление информации</a></li>
				<li id='menu'><a href="#">  Калькулятор</a></li>
			  </ul>
			<img src='heder.jpg' class='heder'>
			<h1>Расчитать стоимость</h1>
		</header>
        <div class="container">
			<form  action="" method="POST">
				<div class="form-row">
					 <label for="name_lager"><b>Название лагеря:</b></label>
					
					<?php echo "<select name='id_lager' size='1' style='font-size: 12pt;'>";     //список существующих лагерей
					 echo "<option selected='selected' value='0' style='font-size: 12pt;'>Выберете лагерь</option>";
					 $camp = mysqli_query($link, 'SELECT * FROM `lager`');           
					 while ($lager = mysqli_fetch_array($camp)) {
							echo "<option value='{$lager['id_lager']}'style='font-size: 12pt;'>{$lager['name_lager']}</option>"; 
					 }
					 echo "</select>";?>
				  </div>
				  <br>
				  <div class="form-row">
					 <label for="date_start"><b>Начало заезда:</b></label> 
					 <input type="date" name="date_start"  style="font-size: 12pt;" id="date_start" required >
				  </div>
				  <br>
				  <div class="form-row">
					 <label for="kol"><b>Кол-во детей:</b></label> <input type="number" name="kol" min="1" style="font-size: 12pt;" id="kol" required >
				  </div>
				  <p class='form-row'><input class='button' type="submit" name="chet" style="font-size: 12pt;" value="Расчитать"></p>
				  <p class='vivod'><?php echo $per0, $vivod, $per1;  
				  mysqli_close($link);?></p>
			</form>
			
		</div>
	<footer class='footer'>
		<div align="center" valign="bottom" style="padding-top:6px;" class="copyright">МГТУ им Г.И.Носова &copy; 2019 Марина Барынина</div>
	</footer>
	</div>
</body>
</html>