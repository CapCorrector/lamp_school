<?php
require_once 'c_db.php';
class Army {
	private $aid;
	private $oid;
	private $u1q;
	private $u2q;
	private $u3q;
	private $dst;
	public function __construct($aid, $oid) {
		$this->aid=$aid;
		$this->oid=$oid;
	}
// Create a new army in db
	function create() {
		$conn = new Gamedb();
	 	if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$sql="SELECT * FROM armies WHERE OwnerID = '$this->oid'";
		if ($conn->query($sql)->num_rows >= 10) {
			return 'toomany';
		}
		else {
		$sql="INSERT INTO armies (ArmyID, OwnerID, Unit1qty, Unit2qty, Unit3qty) VALUES (NULL, '$this->oid', '0', '0', '0')";
		$qry = $conn->query($sql);
		}
		$conn->close();
	}
// Get user armies
	function get() {
		$conn = new Gamedb();
		if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$sql="SELECT * FROM armies WHERE OwnerID = '$this->oid'";
		return $conn->select($sql);
		$conn->close();
	}		
// Get curent army properties
	function getprop() {
		$conn = new Gamedb();
		if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$sql="SELECT * FROM armies WHERE ArmyID = '$this->aid'";
		return $conn->select($sql)["0"];
		$conn->close();
	}
// Edit curent army
	function changearm($u1q, $u2q, $u3q, $dst) {
		$this->u1q = $u1q;
		$this->u2q = $u2q;
		$this->u3q = $u3q;
		$this->dst = $dst;
		$conn = new Gamedb();
		if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$sql="UPDATE bases SET BaseUnit1qty = BaseUnit1qty - '$this->u1q', BaseUnit2qty = BaseUnit2qty - '$this->u2q', BaseUnit3qty = BaseUnit3qty - '$this->u3q' WHERE UserID = '$this->oid'";
		$conn->query($sql);
		if ($this->dst !== 'none') {
			$sqldst="UPDATE armies SET DestID = '$this->dst', ETA = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE ArmyID = '$this->aid'";
			$conn->query($sqldst);
		}
		else {
			$sqldst="UPDATE armies SET DestID = NULL, ETA = NULL WHERE ArmyID = '$this->aid'";	
			$conn->query($sqldst);
		}
		$sql="UPDATE armies SET Unit1qty = Unit1qty + '$this->u1q', Unit2qty = Unit2qty + '$this->u2q', Unit3qty = Unit3qty + '$this->u3q' WHERE ArmyID = '$this->aid'";
		$conn->query($sql);
		$conn->close();
	}
// Delete curent army
	function delete() {
		$conn = new Gamedb();
		if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$sql="DELETE FROM armies WHERE ArmyID = '$this->aid'";
		$conn->query($sql);
		$conn->close();
	}
}
?>
