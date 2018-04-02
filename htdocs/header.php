<?php
session_start();
echo	'<p>
			<table border="0">
				<tr>
					<td>MENU</td>
					<td><a href="gameindex.php">Home</a></td>';
					if (!$_SESSION["user"]) echo '<td><a href="login.php">Sign In</a></td>
					<td><a href="register.php">Sign Up</a></td>';
					if ($_SESSION["user"]) { 
						$user=$_SESSION["user"];
						echo "<td><a href=\"user.php\">$user</a></td>";
						echo "<td><a href=\"changeav.php\">Change avatar</a></td>";
						echo "<td><a href=\"logout.php\">Logout</a></td>";
					} 
				echo '</tr>
			</table>
	</p>';
