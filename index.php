
<?php
include('config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="assets/style.css" rel="stylesheet" title="Style" />
        <title>Main</title>
    </head>
    <body>
	<center>
	<img src="http://localhost/1/assets/images/logo.png" alt="" width="" height="">

	</center>
        <div class="content">
<?php
?>

<center> WELCOME TO OUR MESSAGE SYSTEM
<membername>
<?php
if(isset($_SESSION['username'])) {
	echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');}
?>
</membername>

<br />
<br /><br />
<?php

if (isset($_SESSION['username'])) {
	echo 'Please see here for a <a href="users.php">list users</a> you can send a message to.<br /><br />';

    echo '<a href="new_pm.php" class="link_new_pm">Send New Message</a>';
	
?>
</center>

<a href="mailbox.php" class="link_new_pm">Inbox</a>
<br /><br />
<a href="logout.php">Sign out</a>
<?php
}
else {

?>
<b><a href="login.php">Login</a><br /><br /><b>
<b><a href="sign_up.php">Signup</a><b>
<?php
}
?>
		</div>
		</div>
	
		
		



	</body>
</html>
