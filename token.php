<?php 
include_once('includes/mysql_connect.php') ;

$_API_KEY = '69c8c0bda75fb65d3c9cab2b04e886b2';
$_SECRET_KEY = '1e55e6cabb77dddd8cb48333dbcbe0ef';
$data = $_GET;
$hmac = $data['hmac'];
$shop = $data['shop'];
// unset($data['hmac']);
$data = array_diff_key($data, array('hmac' => ''));
ksort($data);

$new_hmac = hash_hmac('sha256', http_build_query($data), $_SECRET_KEY);

if(hash_equals($hmac, $new_hmac)){
	$access_token_endpoint = 'https://' . $shop . '/admin/oauth/access_token';
	
	$var = array(
		'client_id' => $_API_KEY,
		'client_secret' => $_SECRET_KEY, 
		'code' => $data['code']
	); 

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $access_token_endpoint);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, count($var));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $var);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$response = curl_exec($ch);
	$response = json_decode($response, true); 

	echo print_r($response);


    // TODO : this has to be changed with a prepared statement. 
	$query = "INSERT INTO shops (shop_url, access_token, created) VALUES('".$shop."', '".$response['access_token']."', NOW()) ON DUPLICATE KEY UPDATE access_token='".$response['access_token']."'";

	if($mysql->query($query)){
		echo '<script>top.window.location = "https://'.$shop.'/admin/apps"</script>';
		die();
	}

	curl_close($ch);
}else{
	echo 'not legit';
}


