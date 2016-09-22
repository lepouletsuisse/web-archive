<?php
	header('Content-Type: text/plain; charset=utf-8');
	$text=$_POST['text'];
	$user_key=$_POST['user_key'];
	$title=$_POST['title'];
	$type=$_POST['type'];
	$expire=$_POST['expire'];
	$priv=$_POST['priv'];
	$api_dev_key 			= 'd1f6a41944cdd340da114e34c5110f34'; // your api_developer_key
	$api_paste_code 		= $text; // your paste text
	$api_paste_private 		= $priv; // 0=public 1=unlisted 2=private
	$api_paste_name			= $title; // name or title of your paste
	$api_paste_expire_date 	= $expire;
	$api_paste_format 		= $type;
	$api_user_key 			= $user_key; // if an invalid api_user_key or no key is used, the paste will be create as a guest
	$api_paste_name			= urlencode($api_paste_name);
	$api_paste_code			= urlencode($api_paste_code);

	$url 					= 'http://pastebin.com/api/api_post.php';
	$ch 					= curl_init($url);

	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'api_option=paste&api_user_key='.$api_user_key.'&api_paste_private='.$api_paste_private.'&api_paste_name='.$api_paste_name.'&api_paste_expire_date='.$api_paste_expire_date.'&api_paste_format='.$api_paste_format.'&api_dev_key='.$api_dev_key.'&api_paste_code='.$api_paste_code.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_NOBODY, 0);

	$response  			= curl_exec($ch);
	echo $response;
?>