</main>

<script src="https://unpkg.com/@shopify/app-bridge@3"></script>
<script src="https://unpkg.com/@shopify/app-bridge-utils"></script>
<script src="https://unpkg.com/axios/dist/axios.js"></script>
<script>
	var AppBridge = window['app-bridge'];
	var AppBridgeUtil = window['app-bridge-utils'];
	var actions = window['app-bridge'].actions;
	var createApp = AppBridge.default;

	var TitleBar = actions.TitleBar;
	var Button = actions.Button

    var app = createApp({
	  	apiKey: '69c8c0bda75fb65d3c9cab2b04e886b2',
	  	shopOrigin: '<?= $shopify->get_url() ?>'
	  })

    var installScriptBtn = Button.create(app, {label : 'Install Script Tags'});

	const titleBarOpt = {
		title: '<?= $page_title ?>',
		buttons: {
			primary : installScriptBtn
		}
	}
    const appTitleBar = TitleBar.create(app, titleBarOpt)

    // ==================================================
    // Getting session token 
    // ==================================================

    const getSessionToken = AppBridgeUtil.getSessionToken;


    getSessionToken(app).then(token => {
    	var formData = new FormData();
    	formData.append('token', token);
    	fetch('verify_session.php', {
    		method: 'POST',
    		header: {
    			'Content-Type' : 'application/json'
    		},
    		body: formData
    	}).then(response => response.json())
    	.then(data => {
    		console.log(data)
    		if(data.success){
    			axios({
    				method: 'POST', 
    				url: 'authenticated_fetch.php',
    				data: {
    					shop: data.shop.host,
    				},
    				headers: {
    					'Content-Type' : 'application/json', 
    					'Authorization' : 'Bearer: ' + token
    				}
    			}).then(response => {
    				console.log(response.data);
    			})
    		}
    	})
    })

</script>
</body>
</html>