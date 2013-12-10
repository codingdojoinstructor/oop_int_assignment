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
	<title>Welcome | Survey Page</title>
</head>
<body>
	<h1>Hi <?php echo $_SESSION['user_email']; ?>!</h1>
	<p>Your password is <?php echo $_SESSION['user_pw']; ?></p>
	<p>Click here to <a href="change_pw.php">change your password</a></p>
	<p>Or here to <a href="index.php?action=logout">Logout</a></p>
	
	<h2>Simple Personality Test:</h2>
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
	<form action="process.php" method="post" >
		<h3>Enter your personal information:</h3>
		
		<label for="birthdate">Birth Date:</label>
		<input type="date" name="birthdate" id="birthdate" />
		<br />
		<label>Gender:</label>
		<label><input type="radio" name="gender" value="Male" />Male </label>
		<label><input type="radio" name="gender" value="Female" />Female </label>
		
		<h3>Please choose a color:</h3>
		<select name="color">
			<option value="none">Choose Color</option>
			<option value="Orange">Orange</option>
			<option value="Green">Green</option>
			<option value="Blue">Blue</option>
			<option value="Purple">Purple</option>
		</select>

		<br />
		<input type="hidden" name="action" value="process_survey" />
		<input type="submit" value="Submit Survey" />
	</form>
	
	<hr />
	<div id="survey_result">
<?php
		if(isset($_SESSION["result"]))
		{
			echo 	"<h3>Result:</h3>
					You are ". $_SESSION['result']['user_age'] ." days old!<br/>
					The color you choose is ". $_SESSION['result']['user_color'].
					$_SESSION['result']['personality'];
			
			unset($_SESSION['result']);
		}
?>
	</div>
</body>
</html>