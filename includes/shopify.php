<?php 
class Shopify{

	public $shop_url;
	
	public $access_token;

	public function set_url($url){
		$this->shop_url = $url; 
	}

	public function set_token($token){
		$this->access_token = $token; 
	}

	public function get_url(){
		return $this->shop_url;
	}

	public function get_token(){
		return $this->access_token;
	}

	// /admin/api/2021-04/products.json
	public function api_call($endpoint, $query = array(), $method = 'GET'){
		$url = 'https://'.$this->shop_url . $endpoint;

		// if its a get or delete, we will concat the value of query to URL
		if(in_array($method, array("GET", 'DELETE')) && !is_null($query)){
			$url .= '?'.http_build_query($query);
		}

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);


		$headers[] = ''; 
		if(!is_null($this->access_token)){
			$headers[] = 'X-Shopify-Access-Token:'.$this->access_token;
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		}

		if($method != 'GET' && in_array($method, array("PUT", 'POST'))){
			if(is_array($query)) $query = http_build_query($query);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		}

		

		$response = curl_exec($ch);

		$error = curl_errno($ch);

		$error_message = curl_error($ch); 

		curl_close($ch);

		if($error){
			return $error_message;
		}else{
			$response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2); 
			$headers = array();

			$headers_content = explode("\n", $response[0]);

			$headers['status'] = $headers_content[0];

			array_shift($headers_content);

			foreach($headers_content as $content){
				$data = explode(":", $content);
				$headers[ trim($data[0]) ] = trim($data[1]);
			}

			return array('headers' => $headers, 'body' => $response[1]);
		}
	}

	public function graphql($query = array()){
		$url = 'https://'.$this->shop_url."/admin/api/2021-04/graphql.json"; 

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		$headers[] = ''; 
		$headers[] = 'Content-Type: application/json';
		if(!is_null($this->access_token)){
			$headers[] = 'X-Shopify-Access-Token:' . $this->access_token;
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
		curl_setopt($ch, CURLOPT_POST, true);

		$response = curl_exec($ch);

		$error = curl_errno($ch);

		$error_message = curl_error($ch); 

		curl_close($ch);

		if($error){
			return $error_message;
		}else{
			$response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2); 
			$headers = array();

			$headers_content = explode("\n", $response[0]);

			$headers['status'] = $headers_content[0];

			array_shift($headers_content);

			foreach($headers_content as $content){
				$data = explode(":", $content);
				$headers[ trim($data[0]) ] = trim($data[1]);
			}

			return array('headers' => $headers, 'body' => $response[1]);
		}

	}
}