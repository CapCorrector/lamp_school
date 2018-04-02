<?php
include 'header.php';
require 'c_user.php';
$user=new User('', '', '', $_SESSION["user"],'', '');
$prop=$user->getprop();
?>
<html>
	<head>
		<title>
			Edit User
		</title>
	</head>
	<body>
		<h2>Edit User</h2>
		<form name="input" action="userupdate.php" method="post" enctype="multipart/form-data">
			<table border="0">
			<tr>
			<td>Password: </td><td><input type="password" name="password" required="required"></td><?php if ($_GET["wrps"] == "1") { echo '<td><font color="red">Wrong password</font></td>'; } ?>
			</tr>
			<tr>
			<td>Confirm Password: </td><td><input type="password" name="password2" required="required"></td><?php if ($_GET["erpm"] == "1") { echo '<td><font color="red">Password missmatch</font></td>'; } ?>
                        </tr>
			<tr>
                        <td>Email: </td><td><input type="email" name="email" required="required" <?php echo "value=\"", $prop["Email"], "\""?>></td><?php if ($_GET["wrem"] == "1") { echo '<td><font color="red">Wrong e-mail</font></td>'; } ?>
                        </tr>
			<td>Gender: </td><td><select name="gender">
 				<option value="0">Male</option>
 				<option value="1" <?php if ($prop["Gender"]=="1") { echo 'selected';} ?>>Female</option>
			</select></td>
			</table>
			<input type="Submit" value="Submit">
		</form>
	</body>
</html>
