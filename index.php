<?php
    include_once('functions.php');
?>
<?=html5() ?>
<?=head('OOP Intermediate Assignment') ?>
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
    
    echo form_open("process.php", array('email', 'password'));
    echo form_input(array('type' => 'hidden', 'name' => 'action', 'value' => 'login'));
    echo form_close("Submit");
    
    echo close_doc();
?>
