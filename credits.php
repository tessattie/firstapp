<?php 

include_once('includes/mysql_connect.php') ;
include_once('includes/shopify.php') ;
/**
 * =========================================================================
 *        CREATE VARIABLES FOR SHOPIFY API CLASS AND SET VARIABLES 
 * =========================================================================
 */

$shopify = new Shopify();
$data = $_GET;

include_once('includes/check_token.php') ;

$array = json_decode('{
	"application_credit" : {
		"description" : "application credit for refund",
		"amount" : 4.99,
		"test": true
	}
}', true);

$credit = $shopify->api_call('/admin/api/2021-07/application_credits.json', $array, 'POST');
$credit = json_decode($credit['body'], true);

echo print_r($credit);