<?php
chdir('/opt/bitnami/apache2/htdocs');
require_once 'classes.php';
$conn = new Gamedb();
if (!$conn->connect()) {
	die('Error: ' . mysqli_error($conn));
}
//Adding units to all users
$sql="UPDATE bases SET BaseUnit1qty = BaseUnit1qty + '1', BaseUnit2qty = BaseUnit2qty + '1', BaseUnit3qty = BaseUnit3qty + '1'";
$conn->query($sql);
$sql="SELECT * FROM armies WHERE ETA != 0 AND ETA < NOW() ORDER BY ETA";
$farmies=$conn->select($sql);
foreach ($farmies as $farmy) {
	$sql="SELECT * FROM planets WHERE PlanetID = '".$farmy["DestID"]."'";
	$planet=$conn->select($sql)[0];
	if ($planet['OwnerID'] === $farmy['OwnerID']) //Adding units if the owner is same
	{
		$pu['1']=$planet['Unit1qty']+$farmy['Unit1qty'];
		$pu['2']=$planet['Unit2qty']+$farmy['Unit2qty'];
		$pu['3']=$planet['Unit3qty']+$farmy['Unit3qty'];
		$sql="UPDATE planets SET Unit1qty = '".$pu['1']."', Unit2qty = '".$pu['2']."', Unit3qty = '".$pu['3']."' WHERE PlanetID = '".$planet['PlanetID']."'";
		$conn->query($sql);
	}
	else {
		//No logic, put all units into a pit and let 'survival of the fittest' happen
		$punits=$planet['Unit1qty']+$planet['Unit2qty']+$planet['Unit3qty'];
		$aunits=$farmy['Unit1qty']+$farmy['Unit2qty']+$farmy['Unit3qty'];
		if ($punits>=$aunits) {
			$pu['1']=floor(($punits-$aunits) / 3);
			$pu['2']=floor(($punits-$aunits) / 3);
			$pu['3']=floor(($punits-$aunits) / 3);
			$sql="UPDATE planets SET Unit1qty = '".$pu['1']."', Unit2qty = '".$pu['2']."', Unit3qty = '".$pu['3']."' WHERE PlanetID = '".$planet['PlanetID']."'";
			$conn->query($sql);
		}
		else {
			$pu['1']=floor(($aunits-$punits) / 3);
			$pu['2']=floor(($aunits-$punits) / 3);
			$pu['3']=floor(($aunits-$punits) / 3);
			$sql="UPDATE planets SET Unit1qty = '".$pu['1']."', Unit2qty = '".$pu['2']."', Unit3qty = '".$pu['3']."', OwnerID = '".$farmy['OwnerID']."' WHERE PlanetID = '".$planet['PlanetID']."'";
			$conn->query($sql);
		}
	}
	$sql="DELETE FROM armies WHERE ArmyID = '".$farmy['ArmyID']."'";
	$conn->query($sql);
}
?>
