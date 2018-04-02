<?php
include 'header.php';
require_once 'classes.php';
$army=new Army($_POST['army'],$_SESSION['uid']);
// Editing army
if (isset($_POST['submit'])) {
	$user=new User($_SESSION["uid"], '', '', '', '', '');
	$base=$user->getbase()[0];
	if (preg_match("/[\D]/",$_POST['u1q']) or preg_match("/[\D]/",$_POST['u2q']) or preg_match("/[\D]/",$_POST['u3q'])){
		$_SESSION['army']=$_POST['army'];
		$_SESSION['edit']="1";
		header("Location: army.php?error=wrin");
		exit();
	}
	$armyprop=$army->getprop();
//Chnge to $$ when there will be more types
	$armyd = array ("1" => $_POST['u1q'] - $armyprop['Unit1qty'], "2" => $_POST['u2q'] - $armyprop['Unit2qty'], "3" => $_POST['u3q'] - $armyprop['Unit3qty']);
	if ($armyd['1'] < $base['BaseUnit1qty'] and $armyd['2'] < $base['BaseUnit2qty'] and $armyd['3'] < $base['BaseUnit3qty']) {
		$army->changearm($armyd['1'],$armyd['2'],$armyd['3'],$_POST['planet']);	
		$_SESSION['army']=$_POST['army'];
		$_SESSION['edit']="1";
		 header("Location: army.php");
	}
	else {
		$_SESSION['army']=$_POST['army'];
		$_SESSION['edit']="1";
		header("Location: army.php?error=ne");
		exit();
	}
}

// Deleting army
if (isset($_POST['delete'])) {
	$army->delete();
	header("Location: gameindex.php");
}

?>
