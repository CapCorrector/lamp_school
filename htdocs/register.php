<html>
	<head>
		<title>
			New User
		</title>
	</head>
	<body>
		<?php include 'header.php'; ?>
		<h2>Registration Form.</h2>
		<form name="input" action="registersubmit.php" method="post" enctype="multipart/form-data">
			<table border="0">
			<tr>
			<td>Username: </td><td><input type="text" name="user" required="required"></td><?php if ($_GET["wrun"] == "1") { echo '<td><font color="red">Wrong or existing username</font></td>'; } ?>
			</tr>
			<tr>
			<td>Password: </td><td><input type="password" name="password" required="required"></td><?php if ($_GET["wrps"] == "1") { echo '<td><font color="red">Wrong password</font></td>'; } ?>
			</tr>
			<tr>
			<td>Confirm Password: </td><td><input type="password" name="password2" required="required"></td><?php if ($_GET["erpm"] == "1") { echo '<td><font color="red">Password missmatch</font></td>'; } ?>
                        </tr>
			<tr>
                        <td>Email: </td><td><input type="email" name="email" required="required"></td><?php if ($_GET["wrem"] == "1") { echo '<td><font color="red">Wrong e-mail</font></td>'; } ?>
                        </tr>
			<td>Gender: </td><td><select name="gender">
 				<option value="0">Male</option>
 				<option value="1">Female</option>
			</select></td>
			<tr>
			<td>Please upload your avatar: </td><td><input type="file" name="avatar" id="avatar"</td>
			</tr>
			<tr>
			<td>Please accept our <a href="terms.html">terms and conditions</a></td><td><input type="checkbox" name="termsaccept" value="tacc"></td><?php if ($_GET["ertc"] == "1") { echo '<td><font color="red">Please accept our terms and conditions</font></td>'; } ?>
			</tr>
			</table>
			<input type="Submit" value="Submit">
			<input type="Reset" value="Reset">
		</form>
	</body>
</html>
