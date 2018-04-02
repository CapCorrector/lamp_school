<html>
	<head>
		<title>
			Avatar change	
		</title>
	</head>
	<body>
		<?php include 'header.php'; ?>
		<h2>Please select a new avatar.</h2>
		<form name="input" action="avpreview.php" method="post" enctype="multipart/form-data">
			<table border="0">
			<tr>
			<td>Please upload your new avatar: </td><td><input type="file" name="avatar" id="avatar"</td>
			</tr>
			</table>
			<input type="Submit" value="Preview">
		</form>
	</body>
</html>
