<?php
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="assets/style.css" rel="stylesheet" title="Style" />
        <title>Inbox</title>
    </head>
    <body>
        <div class="content">
<?php

if(isset($_SESSION['username']))
{

$rcvdMsg = mysqli_query($link, 'select private.id, private.message, private.title, private.timestamp, private.tag, usernames.id userid, usernames.username from private, usernames where private.recipient="'.$_SESSION['userid'].'" and usernames.id=private.sender order by private.timestamp desc');
$sentMsg = mysqli_query($link, 'select private.id, private.message, private.title, private.timestamp, private.tag, usernames.id userid, usernames.username from private, usernames where private.sender="'.$_SESSION['userid'].'" and usernames.id=private.recipient order by private.timestamp desc');
?>
<a href="new_private.php" class="link_new_pm">Send New Message</a><br />
<h3>Received messages (<?php echo intval(mysqli_num_rows($rcvdMsg)); ?>):</h3>
<table>
	<tr>
    	<th class="title_cell">Title</th>
        <th>Sender</th>
        <th>Time</th>
        <th>Message</th>
    </tr>
<?php

while($dn1 = mysqli_fetch_array($rcvdMsg))
{
?>
	<tr>
    	<td class="left"><b><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></b></td>
    	<td><?php echo htmlentities($dn1['username'], ENT_QUOTES, 'UTF-8'); ?></td>
    	<td><?php echo date('Y/m/d H:i:s' ,$dn1['timestamp']); ?></td>
        <td>
		<?php
	$cipher = "aes-256-cbc";
			$ivlen  = openssl_cipher_iv_length($cipher);
			$key    = thekey($_SESSION['userid'], $dn1['userid']);
			$method = openssl_get_cipher_methods();
			if (in_array($cipher, $method)) {
				$c    = base64_decode($dn1['message']);
				$iv   = substr($c, 0, $ivlen);
				$hmac = substr($c, $ivlen, $sha2len=32);
				$ciphertext_raw = substr($c, $ivlen+$sha2len);
				
				$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
				if (!hash_equals($hmac, $calcmac)) {	
					$decrypted = "Message decryption integrity failed.";
				}
				else {
					$decrypted = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv, $dn1['tag']);
				}
			}
			else $decrypted = "Decryption algorithm unsupported.";
			
			echo $decrypted;
		?>
		</td>
    </tr>
<?php
}

if(intval(mysqli_num_rows($rcvdMsg))==0)
{
?>
	<tr>
    	<td colspan="4" class="center">You have no received messages.</td>
    </tr>
<?php
}
?>
</table>
<br />
<h3>Sent messages (<?php echo intval(mysqli_num_rows($sentMsg)); ?>):</h3>
<table>
	<tr>
    	<th class="title_cell">Title</th>
        <th>Receiver</th>
        <th>Time</th>
        <th>Message</th>
    </tr>
<?php

while($dn2 = mysqli_fetch_array($sentMsg))
{
?>
	<tr>
    	<td class="left"><b><?php echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); ?></b></td>
    	<td><?php echo htmlentities($dn2['username'], ENT_QUOTES, 'UTF-8'); ?></td>
    	<td><?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></td>
		<td>
		<?php
	$cipher = "aes-256-cbc";
			$ivlen  = openssl_cipher_iv_length($cipher);
			$key    = thekey($_SESSION['userid'], $dn2['userid']);
			$method = openssl_get_cipher_methods();
			if (in_array($cipher, $method)) {
				$c    = base64_decode($dn2['message']);
				$iv   = substr($c, 0, $ivlen);
				$hmac = substr($c, $ivlen, $sha2len=32);
				$ciphertext_raw = substr($c, $ivlen+$sha2len);
				
				$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
				if (!hash_equals($hmac, $calcmac)) {	
					$decrypted = "Message decryption integrity failed.";
				}
				else {
					$decrypted = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv, $dn2['tag']);
				}
			}
			else $decrypted = "Decryption algorithm unsupported.";
			
			echo $decrypted;
		?>
		</td>
    </tr>
<?php
}

if(intval(mysqli_num_rows($sentMsg))==0)
{
?>
	<tr>
    	<td colspan="4" class="center">You have no sent messages.</td>
    </tr>
<?php
}
?>
</table>
<?php
}
else
{
	echo 'You must be logged in to access this page.';
}
?>
		</div>
		<div class="foot"><a href="index.php">Home</a></div>
	</body>
</html>
