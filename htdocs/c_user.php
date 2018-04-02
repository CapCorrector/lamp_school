<?php
require_once 'classes.php';
class User {
	private $uid;
	private $uhsh;
	private $umail;
	public $uname;
	public $ugender;
	public $avurl;
	public function __construct($uid, $uhsh, $umail, $uname, $ugender, $avurl) {
		$this->uid=$uid;
		$this->uhsh=$uhsh;
		$this->umail=$umail;
		$this->uname=$uname;
		$this->ugender=$ugender;
		$this->avurl=$avurl;
	}
// Create a new user in db
	function create() {
		$conn = new Gamedb();
	 	if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$this->uname=$conn->quote($this->uname);
		$sql="SELECT * FROM users WHERE Username = $this->uname";
		if ($conn->query($sql)->num_rows >= 1) {
			return 'exist';
		}
		else {
		$this->umail=$conn->quote($this->umail);
		$sql="INSERT INTO users (UserID, Username, Password, Email, Gender, AvatarLoc) VALUES (NULL, $this->uname, '$this->uhsh', $this->umail, '$this->ugender', '$this->avurl')";
		$conn->query($sql); 
// Creating a base for the user
		$sql="SELECT UserID FROM users WHERE Username = $this->uname";
		$this->uid=$conn->select($sql)[0]['UserID'];
		$sql="INSERT INTO bases (UserID, Level, BaseUnit1qty, BaseUnit2qty, BaseUnit3qty) VALUES ('$this->uid', '0', '100', '100', '100')";
		$conn->query($sql);
		}
		$conn->close();
	}
// Change user fields (avatar etc)
	function change() {
		$conn = new Gamedb();
		if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$sql="SELECT * FROM users WHERE Username = '$this->uname'";
		$uqry=$conn->query($sql);
		if ($uqry->num_rows < 1) {
			return 'nouser';
		}
		else {
			$this->umail=$conn->quote($this->umail);
			$sql="UPDATE users SET Password='$this->uhsh', Email=$this->umail, Gender='$this->ugender' WHERE Username = '$this->uname'";
			$conn->query($sql);
		}
		$conn->close();
	}		
// Change avatar
	function avchange() {
		$conn = new Gamedb();
		if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$sql="SELECT AvatarLoc FROM users WHERE Username = '$this->uname'";
		$oldav=$conn->select($sql)[0]['AvatarLoc'];
		unlink($oldav);
		$sql="UPDATE users SET AvatarLoc='$this->avurl' WHERE Username = '$this->uname'";
		$conn->query($sql);
		$conn->close();
	}

// Get curent user properties
	function getprop() {
		$conn = new Gamedb();
		if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		if (!empty($this->uname)) {
			$sql="SELECT * FROM users WHERE Username = '$this->uname'";
		}		
		else {
			$sql="SELECT * FROM users WHERE UserID = '$this->uid'";
		}
		return $conn->query($sql)->fetch_assoc();
		$conn->close();
	}
// Get curent user base units
	function getbase() {
		$conn = new Gamedb();
		if (!$conn->connect()) {
			die('Error: ' . mysqli_error($conn));
		}
		$sql="SELECT * FROM bases WHERE UserID = '$this->uid'";
		return $conn->select($sql);
		$conn->close();
	}
}
?>

