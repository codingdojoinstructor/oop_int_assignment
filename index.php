<?php
	session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>OOP Intermediate Assignment</title>
</head>
<body>
	<h1>Welcome!</h1>
	<h3>Please enter your email address and password (minimum of 6 characters):</h3>
	
<?php
	if(isset($_SESSION["error_messages"]))
	{
		foreach($_SESSION["error_messages"] as $error_message)
		{
			echo $error_message;
		}
		unset($_SESSION["error_messages"]);
	}
?>
	<form action="process.php" method="post">
		<label for="email">Email: </label>
		<input type="text" name="email" id="email" />
		<br />
		<label for="password">Password:</label>
		<input type="password" name="password" id="password" />
		<br />
		<input type="hidden" name="action" value="login" />
		<input type="submit" value="Submit" />	
	</form>
</body>
</html>