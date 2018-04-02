<html>
 <head>
  <title>User registration.</title>
 </head>
 <body>
<?php
require 'c_user.php';
//require 'c_db.php';
$fielderr="0";
// Pass missmatch
if ($_POST["password"] !== $_POST["password2"]) {
	$erpm="1";
	$fielderr="1";
}
// Username input check
$uname=$_POST["user"];
if (preg_match("/[\W]/",$uname)){
	$wrun="1";
	$fielderr="1";
}
// Email input check
$umail=$_POST["email"];
if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
        $wrem="1";
        $fielderr="1";
}
// Hashing
$upass=$_POST["password"];
$uhash=(hash('sha512', "$uname.$upass"));
$avfname=(hash('sha256', "$uname"));
//Terms and conditions check
if ($_POST["termsaccept"] !== 'tacc') {
	$ertc="1";
	$fielderr="1";
}
// Avatar upload
$target_dir = "img/avatars/";
$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
// Check file size
if ($_FILES["avatar"]["size"] > 2500000) {
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
// if everything is ok, try to upload file
} else {
    $tfile = $target_dir . $avfname . '.' . $imageFileType;
    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $tfile)) {
    } else {
    }
}

// Upload done



if ($fielderr != 1) {
	$user=new User('',$uhash, $umail, $uname, $_POST["gender"], $tfile);
	if ($user->create() === 'exist') {
		$wrun="1";
		$fielderr="1";
	}
}

// Providing output
if ($fielderr == 1) {
	header("Location: register.php?wrun=$wrun&wrps=$wrps&erpm=$erpm&wrem=$wrem&ertc=$ertc");
}
else {
	header( "Refresh: 5; url=gameindex.php" );
	echo "Your user was successfuly registered. You will be redirected to the homepage.";
}
?>
</body>
</html>
