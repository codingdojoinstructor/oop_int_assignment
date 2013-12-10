<?php
	session_start();
	
	if(empty($_SESSION))
	{
		header("Location: index.php");
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Change PW</title>
</head>
<body>
	<form action="process.php" method="post">
		<label for="password">New Password:</label>
		<input type="password" name="password" id="password" />
		<br />
		<input type="hidden" name="action" value="change_pw" />
		<input type="submit" value="Submit" />
	</form>
</body>
</html>