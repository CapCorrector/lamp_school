<html>
        <head>
                <title>
                      Army control 
                </title>
        </head>
        <body>
	<?php
	include 'header.php';
	require_once 'classes.php';
	if (isset($_POST['army'])) {
		$armyid=$_POST['army'];
	}
	else {
		$armyid=$_SESSION['army'];
		unset($_SESSION['army']);
	}
// Create new army
	if (isset($_POST['new'])) {
		$army=new Army('',$_SESSION["uid"]);
		if ($army->create() !== 'toomany') {
			echo 'Army was successfuly created.';
		}
		else {
			echo 'Army limit reached';
		}
		header( "Refresh: 5; url=gameindex.php" );
	}
//Edit, send or delete army
	if (isset($_POST['edit']) or isset($_SESSION['edit'])) {
		unset($_SESSION['edit']);
		switch ($_GET['error']) {
		case "ne":
			echo "You don't have enough troops.<br>";
			break;
		case "wrin":
			echo "You've entered a wrong value.<br>";
			break;
		}
		echo 'Troops list: <br>
		<table border="1">';
		$user=new User($_SESSION["uid"], '', '', '', '', '');
		$base=$user->getbase()[0];
		echo "<tr><td>Type1</td><td>Type2</td><td>Type3</td></tr>
		<tr><td>",$base["BaseUnit1qty"],"</td><td>",$base["BaseUnit2qty"],"</td><td>",$base["BaseUnit3qty"],"</td></tr>",
		"</table><br>";
		$army=new Army($armyid,$_SESSION['uid']);
		$armyprop=$army->getprop();
		$planet=new Planet('','');
		$planets=$planet->getlist();
		echo '<table border="0">
		<form name="army" action="armysubmit.php" method="post">
		<input type="hidden" name="army" value="',$armyid ,'" />
		<tr>
			<td>Type1: </td><td><input type="text" name="u1q" required="required" value="',$armyprop["Unit1qty"],'"></td>
		</tr>
		<tr>
			<td>Type2: </td><td><input type="text" name="u2q" required="required" value="',$armyprop["Unit2qty"],'"></td>
		</tr>
		<tr>
			<td>Type3: </td><td><input type="text" name="u3q" required="required" value="',$armyprop["Unit3qty"],'"></td>
		</tr>
		<tr>
			<td>Destination Planet: </td><td><select name="planet">
			<option value="none">None</option>';
			foreach ($planets as $plan) {
				echo '<option value="', $plan["PlanetID"], '" '; if ($plan["PlanetID"] === $armyprop["DestID"]) {echo 'selected';} echo '>', $plan["PlanetID"], '</option>';
			}
		echo '</select></td>
		</tr>
		<tr>
			<td><input type="Submit" value="Submit" name="submit"></td><td><input type="Submit" value="Delete" name="delete"></td>
		</tr>
		</form>
		</table>
		';
	}
	?>
	</body>
</html>
