<?php
	header('Content-Type: text/plain; charset=utf-8');
	$username=$_POST['username'];
	$pass=$_POST['pass'];
	$api_dev_key 		= 'd1f6a41944cdd340da114e34c5110f34';
	$api_user_name 		= $username;
	$api_user_password 	= $pass;
	$api_user_name 		= urlencode($api_user_name);
	$api_user_password 	= urlencode($api_user_password);
	$url				= 'http://pastebin.com/api/api_login.php';
	$ch					= curl_init($url);

	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'api_dev_key='.$api_dev_key.'&api_user_name='.$api_user_name.'&api_user_password='.$api_user_password.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_NOBODY, 0);

	$response 		= curl_exec($ch);
	echo $response;
?>