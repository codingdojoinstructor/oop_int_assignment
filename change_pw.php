<?php
    include_once('functions.php');	
	
	if(empty($_SESSION))
	{
		header("Location: index.php");
		exit();
	}
?>
<?=html5(); ?>
<?=head('Change PW'); ?>
<?php
    echo form_open("process.php");
    echo form_label("password", "New Password");
    echo form_input(false, "password");
    echo form_input(array('type' => 'hidden', 'name' => 'action', 'value' => 'change_pw'));
    echo form_close("Submit");

    echo close_doc();
?>
