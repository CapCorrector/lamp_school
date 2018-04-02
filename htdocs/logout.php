<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["uid"]);
session_destroy();
header("Location: gameindex.php");
?>
