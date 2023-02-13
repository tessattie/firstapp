<?php 
/**
 * =========================================================================
 *  Check the shopify store
 * =========================================================================
 */

$query = "SELECT * FROM shops WHERE shop_url = '".$data['shop']."' LIMIT 1";
$result = $mysql->query($query);

if($result->num_rows < 1){
	header("Location:install.php?shop=".$_GET['shop']);
	exit();
}

$store_data = $result->fetch_assoc();

$shopify->set_url($data['shop']);
$shopify->set_token($store_data['access_token']);

$shop = $shopify->api_call('/admin/api/2021-04/shop.json', array(), 'GET'); 

$response = json_decode($shop['body'], true); 

if(array_key_exists('errors', $response)){
	header("Location:install.php?shop=".$_GET['shop']);
	exit();
}