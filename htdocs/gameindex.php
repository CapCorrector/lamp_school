<html>
	<head>
		<title>
			Game	
		</title>
	</head>
	<body>
		<?php
			include 'header.php' ;
			require_once 'classes.php';
			$army=new Army('',$_SESSION["uid"]);
			$armies=$army->get();
		?>
		<form name="playersearch" action="plsearch.php" method="get">
			Search for a player:
			<br><input type="text" name="pname"><input type="submit" value="Search">
		</form>
		<?php 
		$planet=new Planet('','');
		$planets=$planet->getlist();
		echo 'Planets list: <br>
		<table border="1">
		<tr><td>PlanteID</td><td>Owner</td>';
		foreach ($planets as $plan) {
			$pl=new User($plan['OwnerID'], '', '', '', '', '');
			$plprop=$pl->getprop();
			echo "<tr><td>",$plan['PlanetID'],"</td><td>",$plprop['Username'];
		}
		echo '</table>';
		if ($_SESSION['uid']) {
			echo 'Troops list: <br>
			<table border="1">';
			$user=new User($_SESSION["uid"], '', '', '', '', '');
			$base=$user->getbase()[0];
			echo "<tr><td>Type1</td><td>Type2</td><td>Type3</td></tr>
			<tr><td>",$base["BaseUnit1qty"],"</td><td>",$base["BaseUnit2qty"],"</td><td>",$base["BaseUnit3qty"],"</td></tr>",
			"</table><br>";
			echo '<table border="0">
			<form name="armies" action="army.php" method="post">
				<tr>
				<td>Army: </td><td><select name="army">';
				foreach ($armies as $arm) {
					echo '<option value="', $arm["ArmyID"], '">', $arm["ArmyID"], '</option>';
				}
				echo '</select></td>
				</tr>
				<tr>
				<td><input type="Submit" value="Edit" name="edit"></td><td><input type="Submit" value="New" name="new"></td>
				</tr>
			</form>
			</table>';
		}
		?>
<!--		<table border="1">
			<tr>
                                <td colspan ="2">Top 10 Players</td>
                        </tr>

			<tr>
				<td>Nickname</td>
				<td>Points</td>
			</tr>
			<tr>
				<td>Someplayer link</td>
				<td>Over 9000</td>
			</tr>
		</table> -->
	</body>
</html>
