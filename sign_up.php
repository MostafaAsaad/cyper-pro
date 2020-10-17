
<?php
include('config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="assets/style.css" rel="stylesheet" title="Style" />
		<title>Registeration</title>
	</head>
	<body>
<?php

if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email']) and $_POST['username'] != '')
{
	
	if(get_magic_quotes_gpc())
	{
		$_POST['username']  = stripslashes($_POST['username']);
		$_POST['password']  = stripslashes($_POST['password']);
		$_POST['passverif'] = stripslashes($_POST['passverif']);
		$_POST['email']  	= stripslashes($_POST['email']);
	}
	
	$errors = [];
	if($_POST['password'] == $_POST['passverif'])
	{
		
		if(passwordverify($_POST['password'], $errors))
		{
			
			if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i', $_POST['email']))
			{
				
				$username = mysqli_real_escape_string($link, $_POST['username']);
				$password = mysqli_real_escape_string($link, $_POST['password']);
				$email	  = mysqli_real_escape_string($link, $_POST['email']);
				$salt	  = (string)rand(10000, 99999);	     
				$password = hash("sha512", $salt.$password); 
				
				$dn = mysqli_num_rows(mysqli_query($link, 'select id from usernames where username="'.$username.'"'));
				if($dn == 0)
				{
					
					if(mysqli_query($link, 'insert into usernames(username, password, email, salt) values ("'.$username.'", "'.$password.'", "'.$email.'","'.$salt.'")'))
					{
						
						$form = false;
?>
		<div class="message">You have Registred complete.<br />
        <a href="login.php">Log in</a></div>
<?php
					}
					else
					{
						
						$form	= true;
						$message = 'An error occurred while signing up.';
					}
				}
				else
				{
					
					$form	= true;
					$message = 'The username is already in use, please choose another one.';
				}
			}
			else
			{
				
				$form	= true;
				$message = 'The email adress is invalid.';
			}
		}
		else
		{
			
			$form	= true;
			$message = '';
			foreach ($errors as $item)
				$message = $message.$item."<BR>";
		}
	}
	else
	{
		
		$form	 = true;
		$message = 'The passwords are not matching.';
	}
}
else
{
	$form = true;
}
if ($form) {
	
	if(isset($message)) echo '<div class="message">'.$message.'</div>';

	
?>
		<div class="content">
			<form action="sign_up.php" method="post">
				You can fill the following:<br />
				<div class="center">
					<label for="username">Name : </label><input type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
					<label for="password">Pass : <span class="small"> (10 characters min.)</span></label><input type="password" name="password" /><br />
					<label for="passverif">Password<span class="small"> (verification)</span></label><input type="password" name="passverif" /><br />
					<label for="email">Mail : </label><input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
					<input type="submit" value="Sign up" />
				</div>
			</form>
		</div>
<?php
}
?>
		<div class="foot"><a href="index.php">Main</a></div>
	</body>
</html>
