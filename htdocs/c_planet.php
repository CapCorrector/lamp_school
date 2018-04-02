<?php
require_once 'classes.php';
class Planet {
	private $plid;
	private $oid;
	private $u1q;
	private $u2q;
	private $u3q;
	public function __construct($plid, $oid) {
		$this->plid=$plid;
		$this->oid=$oid;
	}
// Get users planets
	function get() {
		$conn = new Gamedb();
		if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$sql="SELECT * FROM planets WHERE OwnerID = '$this->oid'";
		return $conn->select($sql);
		$conn->close();
	}		
// Get list of planets
	function getlist() {
		$conn = new Gamedb();
		if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$sql="SELECT * FROM planets";
		return $conn->select($sql);
		$conn->close();
	}
}
?>
