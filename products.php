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
 *                MANAGE APP REALTED HERE - START OF PAGE
 * =========================================================================
 */

$products = $shopify->api_call('/admin/api/2021-04/products.json', array('status' => 'active'), 'GET'); 
$response = json_decode($products['body'], true); 
$products = $response;
?>

<?php include_once('header.php') ; ?>

<!-- START PAGE CONTENT -->

<section>
    <table>
          <thead>
            <tr>
              <th></th>
              <th>Product</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($products as $product) : ?>
                <?php foreach($product as $key => $value) : ?>
                    <?php 
                    $image = count($value['images']) > 0 ? $value['images'][0]['src'] : '';
                    ?>
                <tr>
                    <?php if(!empty($image)) : ?>
                    <td><a href="#"><img width="35" height="35" alt="" src="<?= $image ?>" style="width:40px;height:auto;border-radius:5px;border:1px solid #ddd"></a></td>
                    <?php else : ?>
                        <td><i class="icon-image" style="width:40px;height:40px;border:1px solid #ddd;border-radius:5px"></i></td>
                    <?php endif; ?>
                    <td><a href="#"><?= $value['title'] ?></a></td>
                    <td><a href="#"><?= $value['status'] ?></a></td>
                    <td>
                        <button class="secondary icon-addition"></button>
                    </td>
                    
                </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
           
        </tbody>
    </table>
</section>

<!-- END PAGE CONTENT -->


<?php include_once('footer.php') ; ?>