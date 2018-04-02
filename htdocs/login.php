<?php
require 'c_db.php';
include 'header.php';
if (!$_POST["user"]) {
echo '<html>
	<head>
		<title>
			Login
		</title>
	</head>
	<body>
		<h2>Please log in.</h2>
		<form name="input" action="login.php" method="post" enctype="multipart/form-data">
			User:<br>
			<input type="text" name="user" required="required"><br>
			Password:<br>
			<input type="password" name="password" required="required"><br>';
			if ($_GET["wrus"] == 1) { echo 'Wrong username or password.<br>'; }
echo '			<input type="Submit" value="Submit">
		</form>
	</body>
</html>';
}
else {
	$uname=preg_replace("/[\W]/", '', $_POST["user"]);
	$conn = new Gamedb();
	if (!$conn->connect()) {
		die('Error: ' . mysqli_error($conn));
	}
	$sql="SELECT * FROM users WHERE Username = '$uname'";
	$qry=$conn->query($sql);
	if ($qry->num_rows >= 1) {
		$uprehash=$uname.$upass=$_POST["password"];
		$uhash=(hash('sha512', "$uname.$upass"));
		if ($uhash === $qry->fetch_assoc()["Password"]) {
			$_SESSION["user"]=$uname;
			$_SESSION["uid"]=$conn->query($sql)->fetch_assoc()["UserID"];
			header("Location: gameindex.php");
		}
		else {
			header("Location: login.php?wrus=1");
		}
	}
	else {
	header("Location: login.php?wrus=1");
	}
	$conn->close();
}
?>
