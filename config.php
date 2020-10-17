<?php

session_start();


$amcyper_svr = 'localhost';	
$amcyper_usr = 'root';						
$amcyper_pwd = '';							
$amcyper_sch = 'capstone';				
$link	    = new mysqli($amcyper_svr, $amcyper_usr, $amcyper_pwd, $amcyper_sch);

if (!$link) {
	die('Could not connect: ' . mysqli_error());
}


function passwordverify($pwd, &$errors) {
	$errors_init = $errors;

	if (strlen($pwd) < 10) $errors[] = "Enter 9 character pwdword at least";
	if (!preg_match("#[0-9]+#", $pwd)) $errors[] = "pwdword should have number";
	if (!preg_match("#[a-zA-Z]+#", $pwd)) $errors[] = "pwdword should have letter";
	if (!preg_match("#[a-z]+#", $pwd)) $errors[] .= "pwdword should have lowercase letter";
	if (!preg_match("#[A-Z]+#", $pwd)) $errors[] .= "pwdword should have uppercase letter";
	if (!preg_match("#\W+#", $pwd)) $errors[] .= "pwdword should have symbol";

	return ($errors == $errors_init);
}


function thekey($user1, $user2) {
	global $link;

	
	$cipher = "aes-256-cbc";
	$ivlen  = openssl_cipher_iv_length($cipher);
	$iv		= base64_decode("5AIQwo8fWMKaUxDI9R9YwppTwqPCmlPCo5emwo8fWOg"); 
	$dbkey  = base64_decode("zT/PiCvCiUYtd96Pwogrwp1Br0lGLd7PiCvCicKdbUs"); 

	if ($user1 > $user2) {	
		$tmp = $user1;
		$user1 = $user2;
		$user2 = $tmp;
	};

	$method = openssl_get_cipher_methods();
	if (in_array($cipher, $method)) {
		$key = base64_encode(openssl_random_pseudo_bytes(24));
	@	$encrypted_key = openssl_encrypt($key, $cipher, $dbkey, 0, $iv);

		$req = mysqli_query($link, 'select * from mkey where user1="'.$user1.'" and user2="'.$user2.'"');
		$dn  = mysqli_num_rows($req);
		$dat = mysqli_fetch_array($req);

		
		if ($dn == 0) mysqli_query($link, 'insert into mkey(user1, user2, mskey) values ('.$user1.', "'.$user2.'", "'.$encrypted_key.'")');
		else {
			$cryp_key = $dat['mskey'];
			@$key = openssl_decrypt($cryp_key, $cipher, $dbkey, 0, $iv);
		}
		return $key;
	}
	else return false;
}
?>
