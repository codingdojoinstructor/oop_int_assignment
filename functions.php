<?php
	session_start();
	
	function change_password()
	{
		$_SESSION['user_pw'] = $_POST['password'];
		header("Location: survey_page.php");
	}
	
	function logout_user()
	{
		session_destroy();	
	}
	
	function calculate_age()
	{
		$age_in_days = round(abs(strtotime($_POST['birthdate'])-strtotime(date("Y-m-d")))/86400);
		return $age_in_days;
	}

	function validate_login()
	{
		if(empty($_POST['email']) || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == FALSE)
		{
			$error[] = "Wrong email format! <br />";
		}
		
		if(empty($_POST['password']) || strlen($_POST['password']) < 6)
		{
			$error[] = "Wrong password format! <br />";
		}
		
		if($error == NULL)
		{
			set_user_info();
			header("Location: survey_page.php");
			exit();
		}
		else
		{
			$_SESSION['error_messages'] = $error;
			var_dump($_SESSION);
			header("Location: index.php");
			exit();
		}
	}
	
	function process_personality()
	{
		switch($_POST['color']) 
		{
			case "Orange":
				$personality = "<p>Orange is the color of social communication and optimism. From a negative color meaning it is also a sign of pessimism and superficiality.</p>";
				break;
				
			case "Green":
				$personality = "<p>Green is the color of balance and growth. It can mean both self-reliance as a positive and possessiveness as a negative, among many other meanings..</p>";
				break;
			
			case "Blue":
				$personality = "<p>Blue is the color of trust and peace. It can suggest loyalty and integrity as well as conservatism and frigidity.</p>";
				break;
				
			case "Purple":
				$personality = "<p>Purple is the color of the imagination. It can be creative and individual or immature and impractical.</p>";
				break;
		}
		
		return $personality;
	}
	
	function display_result()
	{
		$_SESSION['result']['user_age'] = calculate_age();
		$_SESSION['result']['user_color'] = $_POST['color'];
		$_SESSION['result']['personality'] = process_personality();
	}
	
	function validate_survey_answer()
	{
		if($_POST['birthdate'] == NULL)
		{
			$error[] = "Please enter correct date<br/>";
		}
		
		if(!isset($_POST['gender']) || $_POST['gender'] == NULL)
		{
			$error[] = "I am sure you are a human being and you have a gender. <br/>";
		}
		
		if(isset($_POST['color']) && $_POST['color'] == "none")
		{
			$error[] = "Choose a color, please. <br/>";
		}
	
		if($error == NULL)
		{
			display_result();		
		}
		else
		{
			$_SESSION['error_messages'] = $error;
		}
		
		header("Location: survey_page.php");
		exit();
	}
	
	function set_user_info()
	{
		$_SESSION['user_email'] = $_POST['email'];
		$_SESSION['user_pw'] = $_POST['password'];
	}
?>