<?php
require 'c_user.php';
include 'header.php';
$player=new User('', '', '', $_GET["pname"],'', '');
$plprop=$player->getprop();
if ($plprop["Gender"] == 0) {
	$gender = 'Male';
}
else {
	$gender = 'Female';
}
echo '<html>
	<head>
		<title>',
			$_GET["pname"],
'		</title>
	</head>
	<body>
		<h2>', $_GET["pname"], '</h><br>
		<img src="',$plprop["AvatarLoc"] , '">
		<p>
			Email: ', $plprop["Email"], '<br>
			Gender: ', $gender, '<br>
		</p>
	</body>
</html>';

?>
