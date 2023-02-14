<?php 
include_once('includes/mysql_connect.php');
$token = $_POST['token']; 

$token_array = explode(".", $token); 
$assoc_token = array_combine(array("header", 'payload', 'signature'), $token_array);
$payload = json_decode(base64_decode($assoc_token['payload']), true); 

$shop = parse_url($payload['dest']);

$now = time() + 10;
$is_future = $payload['exp'] > $now ? true : false;
$is_past = $payload['nbf'] < $now ? true : false;

$secret_key = '1e55e6cabb77dddd8cb48333dbcbe0ef';
$hash_token = hash_hmac('sha256', $assoc_token['header'].'.'.$assoc_token['payload'], $secret_key, true);
$hash_token = rtrim(strtr(base64_encode($hash_token), '+/', '-_'), '=');


if(!$is_future || !$is_past){
	$response = array("error" => "The token is expired", 'success' => false);
	echo json_encode($response);
	return;
}

if($hash_token != $assoc_token['signature']){
	$response = array("error" => "The token is invalid", "success" => false);
	echo json_encode($response);
	return;
}

$response = array(
	"shop" => $shop,
	"success" => true
);

$query = "INSERT INTO session_tokens (shop_url, session_token) VALUES ('".$shop['host']."', '".$token."') ON DUPLICATE KEY UPDATE session_token = '".$token."'";

$mysql->query($query);

echo json_encode($response);