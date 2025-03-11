<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator</title>
</head>
<body>

<form action="<?php print(_APP_URL);?>/app/calc.php" method="get">
	<label for="id_x">Liczba 1: </label>
	<input id="id_x" type="text" name="x" /><br />
	<label for="id_op">Operacja: </label>
	<select name="op">
		<option value="plus">+</option>
		<option value="minus">-</option>
		<option value="times">*</option>
		<option value="div">/</option>
	</select><br />
	
	
	<label for="id_y">Liczba 2: </label>
	<input id="id_y" type="text" name="y" /><br />
	<label for="id_kwota">Kwota kredytu: </label>
	<input id="id_kwota" type="text" name="kwota" /><br />

	<label for="id_lata">Ilość lat: </label>
	<input id="id_lata" type="text" name="lata" /><br />

	<label for="id_procent">Oprocentowanie (% roczne): </label>
	<input id="id_procent" type="text" name="procent" /><br />

	
	
	
	
	<input type="submit" value="Oblicz" />
</form>	

<?php
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Wynik: '.$result; ?>
</div>
<?php } ?>

<?php if (isset($rata)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #0f0; width:300px;">
<?php echo 'Miesięczna rata kredytu: '.round($rata, 2).' zł'; ?>
</div>
<?php } ?>

</body>
</html>