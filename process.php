<?php
	include_once("functions.php");
	
	if(isset($_POST['action']) && $_POST['action'] == "login")
    {
		validate_login();
	}
	
	if(isset($_POST['action']) && $_POST['action'] == "change_pw")
	{
		change_password();
	}
	
	if(isset($_POST['action']) && $_POST['action'] == "process_survey")
	{
		validate_survey_answer();
	}
	
	if(isset($_GET['action']) &&  $_GET['action'] == "logout")
	{
		logout_user();	
	}
?>
