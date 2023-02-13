<?php 

// page to have access to the app 
// We have to check if the value of hmac is correct

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

	if(curl_error($ch)) {
    	echo print_r(curl_error($ch));
	}

	echo print_r($response);

	curl_close($ch);
}else{
	echo 'not legit';
}


