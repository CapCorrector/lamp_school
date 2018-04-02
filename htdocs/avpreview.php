<html>
 <head>
  <title>Avatar preview.</title>
 </head>
 <body>
<?php
require 'c_user.php';
session_start();
$fielderr="0";
$uname=$_SESSION["user"];
// Hashing
$avfname=(hash('sha256', "$uname"));
// Avatar upload
$target_dir = "img/avatars/";
$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$mask=$target_dir . $avfname . '_tmp*';
array_map('unlink', glob($mask));
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
    $tfile = $target_dir . $avfname . '_tmp.' . $imageFileType;
    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $tfile)) {
    } else {
    }
}

// Upload done


// Providing output

$user=new User('', '', '', $uname,'', '');
$prop=$user->getprop();
if ($prop["Gender"] == 0) {
        $gender = 'Male';
}
else {
        $gender = 'Female';
}
echo '<h2>', $uname, '</h><br>
<img src="',$tfile , '">
<p>
Email: ', $prop["Email"], '<br>
Gender: ', $gender, '<br>
</p>
<form name="input" action="avsubmit.php" method="post" enctype="multipart/form-data">
<input type="Submit" value="Submit">
</form>';

?>
</body>
</html>
