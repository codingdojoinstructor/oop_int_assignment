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
		$age_in_days = round(abs(strtotime($_POST['birth_date'])-strtotime(date("Y-m-d")))/86400);
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
		
		if(!isset($error))
		{
			set_user_info();
			header("Location: survey_page.php");
			exit();
		}
		else
		{
			$_SESSION['error_messages'] = $error;
			//var_dump($_SESSION);
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
		if($_POST['birth_date'] == NULL)
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
	
		if(!isset($error))
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

    function html5()
    {
        return '<!DOCTYPE HTML><html lang="en-US">';    
    }

    function head($title = '', $javascripts = array(), $stylesheets = array())
    {
        $head = '<head>';
        $head .= '<meta charset="UTF-8">';
        $head .= '<title>'.$title.'</title>';
        if(!empty($javascripts)) 
        {
            foreach($javascripts as $script) 
            {
                $head .= '<script type="text/javascript" src="js/'.$script.'.js"></script>';
            }
        }
        if(!empty($stylesheets)) 
        {
            foreach($stylesheets as $css) 
            {
                $head .= '<link rel="stylesheet" type="text/css" src="css/'.$css.'.css"></script>';
            }
        }
        $head .= '</head><body>';
        
        return $head;
    }
    
    function form_open($action, $inputs = array())
    {
        $form = '<form action="'.$action.'" method="post">';
        if(!empty($inputs))
        {
            foreach($inputs as $name)
            {
                $form .= form_label($name);              
                $form .= '<input type="'.($name == 'password' ? 'password' : 'text').'" name="'.$name.'" id="'.$name.'">';    
            }
        }
        return $form;    
    }

    function form_label($name, $value = '')
    {
        $label = str_replace('_', ' ', $name);
        $label = ucwords($label);
        
        $form_label = '<label for="'.$name.'">'.($value ? $value : $label).': </label>';

        return $form_label;
    }

    function form_input($content, $value = '')
    {
        if(is_array($content)) {
            if($content['type'] != 'hidden')
            {
                $input = form_label($content['name']);
                $input .= '<input ';
            } else {
                $input = '<input ';
            }    
            foreach($content as $attr => $val)
            {
                $input .= $attr.'="'.$val.'"'.(end($content) == $val ? '' : ' ');
            } 
        } else {
            $input = ($content ? form_label($content) : '');
            $input .= '<input type="text" name="';
            if($content)
            {
                $input .= $content.'"'.($value ? ' value="'.$value.'"' : '' ); 
            } else {
                $input .= $value.'"';
            }    
        }

        $input .= '>';

        return $input;
    }

   function form_close($submit = false) 
   {
       $form = '';
       if($submit)
       {
           $form .= '<input type="submit" value="'.$submit.'">';
       }
       $form .= '</form>';

       return $form;
   }

   function close_doc()
   {
       return '</body></html>';
   }
?>
