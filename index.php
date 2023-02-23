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
 *                    DISPLAY ANYTHING ABOUT THE STORE
 * =========================================================================
 */

 include_once('billing/reccuring.php') ;

/**
 * =========================================================================
 *                    DISPLAY ANYTHING ABOUT THE STORE
 * =========================================================================
 */


// $access_scopes = $shopify->api_call('/admin/oauth/access_scopes.json', array(), 'GET'); 
// $response = json_decode($access_scopes['body'], true); 
// echo print_r($response);

?>


<?php include_once('header.php') ; ?>

<?php  
$query = array('query' => "{
    shop{
      id 
      name 
      email 
    }
  }");


  $page_title = "Help";

?>

<!-- START PAGE CONTENT -->

  <section>
    <div class="alert">
      <dl>
          <dt>
              <p>Welcome to shopify app</p>
          </dt>
      </dl>
  </div>
  </section>




<!-- END PAGE CONTENT -->


<?php include_once('footer.php') ; ?>