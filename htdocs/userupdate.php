<html>
 <head>
  <title>User registration.</title>
 </head>
 <body>
<?php
include 'header.php';
require 'c_user.php';
$fielderr="0";
// Pass missmatch
if ($_POST["password"] !== $_POST["password2"]) {
	$erpm="1";
	$fielderr="1";
}
$uname=$_SESSION["user"];
// Email input check
$umail=$_POST["email"];
if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
        $wrem="1";
        $fielderr="1";
}
// Hashing
$upass=$_POST["password"];
$uhash=(hash('sha512', "$uname.$upass"));

if ($fielderr != 1) {
	$user=new User('', $uhash, $umail, $uname, $_POST["gender"], '');
	if ($user->change() === 'nouser') {
	unset($_SESSION["user"]);
	session_destroy();
	header( "Refresh: 5; url=login.php" );
	echo "We are terribly sorry but there was a glitch with your username. Please relogin.";
	exit();
	}
}

// Providing output
if ($fielderr == 1) {
	header("Location: user.php?wrun=$wrun&wrps=$wrps&erpm=$erpm&wrem=$wrem&ertc=$ertc");
}
else {
	header( "Refresh: 5; url=gameindex.php" );
	echo "Your user was successfuly updated. You will be redirected to the homepage.";
}
?>
</body>
</html>
