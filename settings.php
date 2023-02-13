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

/**
 * =========================================================================
 *                MANAGE APP SETTINGS HERE - START OF PAGE
 * =========================================================================
 */

$products = $shopify->api_call('/admin/api/2021-04/products.json', array(), 'GET'); 
$response = json_decode($products['body'], true); 

?>

<?php include_once('header.php') ; ?>

<!-- START PAGE CONTENT -->

<h1>SETTINGS</h1>

<!-- END PAGE CONTENT -->


<?php include_once('footer.php') ; ?>