
<?php
include('config.php');


if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['username'], $_POST['password'])) {
    $ousername = '';
	
	if(isset($_POST['username'], $_POST['password']))
	{
		
		if(get_magic_quotes_gpc())
		{
			$ousername = stripslashes($_POST['username']);
			
			$username  = mysqli_real_escape_string($link, stripslashes($_POST['username']));
			$password  = stripslashes($_POST['password']);
		}
		else
		{
			$username = mysqli_real_escape_string($link, $_POST['username']);
			$password = $_POST['password'];
		}
		
		$req = mysqli_query($link, 'select password,id,salt from usernames where username="'.$username.'"');
		@$dn  = mysqli_fetch_array($req);
		$password = hash("sha512", $dn['salt'].$password); 
		
		
		if ($dn['password'] == $password and mysqli_num_rows($req)>0) {
			
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['userid'] = $dn['id'];
			
			header("Location: index.php");
		}
		else {
			
			$message = 'Incorrect Parameter!';
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="assets/style.css" rel="stylesheet" title="Style" />
        <title>Logining page</title>
    </head>
    <body>
		<?php if(isset($message)) echo '<div class="message">'.$message.'</div>'; ?>
		<div class="content">
			<form action="login.php" method="post">
				<div class="center">
				<img src="http://localhost/1/assets/images/logo.png" alt="Girl in a jacket" width="" height="">
				<br>
				<br>
					<label for="username">Name : </label>
					<input type="text" name="username" id="username" placeholder="Enter Your username" />
					<br><br>
					<label for="password">Pass : </label><input type="password" name="password" id="password" placeholder="Enter Your Password"  /><br><br>
					<input style="background-color:green;
								color:white;
								font-size:20px;
								width:150px;
								height:50px;
								border:none;
					
					
					" type="submit" value="Log in" />
				</div>
			</form>
		</div>
        <div class="foot"><a href="index.php">Home</a></div>
	</body>
</html>
