<?php
session_start();
require 'c_user.php';
$uname=$_SESSION["user"];
$avfname=(hash('sha256', "$uname"));
$target_dir = "img/avatars/";
$mask=$target_dir . $avfname . "_tmp*";
$file = glob($mask)[0];
$nfile = preg_replace('/_tmp/', '', $file);
rename("$file", "$nfile");
$user=new User('', '', '', $uname,'', $nfile);
$user->avchange();
header("Location: gameindex.php");
?>
