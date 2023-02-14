<?php 
// Installer file
// Tunnel to connect to app, update when you reconnect to the app
$_NGROK = 'https://750e-190-115-138-228.eu.ngrok.io';
// Shopify API KEY
$_API_KEY = '69c8c0bda75fb65d3c9cab2b04e886b2';
//shopify store name
$shop = $_GET['shop'];
// access we need from shopify to make our app work with the store
$scope = 'read_products,write_products,read_orders,write_orders,read_script_tags,write_script_tags';
//where to redirect the client once installed
$redirect_uri = $_NGROK . '/firstapp/token.php';

$nonce = bin2hex( random_bytes(12) );
$access_mode = "per-user"; 

$oauth_url = 'https://' . $shop . "/admin/oauth/authorize?client_id=" . $_API_KEY . '&scope=' . $scope . '&state='.$nonce.'&grant_options[]=' . $access_mode . '&redirect_uri=' . urlencode($redirect_uri);

header("Location:" . $oauth_url);
exit();

