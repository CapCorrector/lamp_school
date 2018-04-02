<?php
require 'c_db.php';
include 'header.php';
$conn=new Gamedb();
$pname=$_GET["pname"];
$sql="SELECT * FROM users WHERE Username like '%$pname%'";
$res=$conn->select($sql);
foreach ($res as $result) {
	echo '<a href="player.php?pname=',$result["Username"],'">',$result["Username"],'</a><br>';
}
?>
