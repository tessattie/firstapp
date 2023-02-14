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

$script_url = 'https://750e-190-115-138-228.eu.ngrok.io/firstapp/scripts/firstapp.js';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if($_POST['action_type'] == 'create_script'){
        $mutation = array("query" => "mutation {
            scriptTagCreate(input:{
                src: '".$script_url."'
                displayScope: ALL
                })
                scriptTag{
                    id
                }
                userErrors{
                    field 
                    message
                }
        }");
        $created_script = $shopify->graphql($mutation);
        // $script_tag_data = array(
        //     "script_tag" => array(
        //         "event" => "onload", 
        //         "src" => $script_url
        //     )
        // );
        // $create_script = $shopify->api_call('/admin/api/2021-04/script_tags.json', $script_tag_data, 'POST');
        // $create_script = json_decode($create_script['body'], true); 

        // echo print_r($create_script);
    }
}

/**
 * =========================================================================
 *                MANAGE APP SETTINGS HERE - START OF PAGE
 * =========================================================================
 */

$script_tags = $shopify->api_call('/admin/api/2021-04/script_tags.json', array(), 'GET'); 
$response = json_decode($script_tags['body'], true); 
$page_title = "Script Tags";
?>

<?php include_once('header.php') ; ?>

<!-- START PAGE CONTENT -->
<section>
    <aside>
  <h2>
    Install Script Tags
  </h2>
  <p>Click the install button to apply our script to your Shopify Store</p>
</aside>
<article>
    <div class="card">
        <form action="" method = "POST">
            <input type="hidden" name="action_type" value="create_script">
            <button type="submit">Create Script Tag</button>
        </form>
    </div>
</article>
</section>


<!-- END PAGE CONTENT -->


<?php include_once('footer.php') ; ?>