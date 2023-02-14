<?php 

include_once('includes/mysql_connect.php') ;
include_once('includes/shopify.php') ;

/**
 * =========================================================================
 *        CREATE VARIABLES FOR SHOPIFY API CLASS AND SET VARIABLES 
 * =========================================================================
 */

$page_title = "Installation Instructions";

$shopify = new Shopify();

$data = $_GET;

include_once('includes/check_token.php') ;

/**
 * =========================================================================
 *                MANAGE APP SETTINGS HERE - START OF PAGE
 * =========================================================================
 */

?>

<?php include_once('header.php') ; ?>

<!-- START PAGE CONTENT -->


<!-- END PAGE CONTENT -->


<?php include_once('footer.php') ; ?>