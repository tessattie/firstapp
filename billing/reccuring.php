<?php 

$query = "SELECT * FROM recurring_billings WHERE shop_url = '". $shopify->get_url()."' LIMIT 1"; 

$result = $mysql->query($query);

$billing_data = $result->fetch_assoc();


if(isset($_GET['charge_id']) || $result->num_rows > 0){
$cid  = isset($_GET['charge_id']) ? $_GET['charge_id'] : $billing_data['charge_id'];
$query = array("query" => '{
		node(id: "gid://shopify/AppSubscription/'.$cid.'") {
			... on AppSubscription {
				status
				id 
			}
		}
	}');

	$check_charge = $shopify->graphql($query);
	$check_charge = json_decode($check_charge['body'], true);

	if(!empty($check_charge['data']['node'])){
		if($check_charge['data']['node']['status'] != 'ACTIVE'){
			echo "Merchant hasnt paid yet"; 
			die;
		}
	}else{
		echo "wow, looks like you're trying to create your own charge ID. You cannot do that";
		die;
	}

	$shop = $shopify->get_url();
	$charge_id = $check_charge['data']['node']['id'];
	$charge_id = explode("/", $charge_id);
	$charge_id = $charge_id[array_key_last($charge_id)];
	$gid = $check_charge['data']['node']['id'];
	$status = $check_charge['data']['node']['status'];

	$query = "INSERT INTO recurring_billings (shop_url, charge_id, gid, status) VALUES('".$shop."', '".$charge_id."', '".$gid."', '".$status."') ON DUPLICATE KEY UPDATE status='".$status."'";

	$mysql->query($query);

}else{
	$query = array("query" => 'mutation {
		appSubscriptionCreate (
			name: "Firstapp Application RC"
			lineItems: {
				plan: {
					appRecurringPricingDetails : {
						price: {
							amount: 4.99
							currencyCode: USD
						}
					}
				}
			}
			test: true
			returnUrl: "https://'.$shopify->get_url().'/admin/apps/firstapp-12"
		) {
			appSubscription {
				id
			}
			confirmationUrl 
			userErrors{
				field 
				message
			}
		}
	}');

	$charge = $shopify->graphql($query);
	$charge = json_decode($charge['body'], true);

	echo "<script>top.window.location = '".$charge['data']['appSubscriptionCreate']['confirmationUrl']."'</script>";
	die();
}
