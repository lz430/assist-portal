<?php
class Customer
{
    var $response;

    public function getFullname() {
    	$fullName = $this->response->response[0]->customer[0]->firstName . ' ' . $this->response->response[0]->customer[0]->lastName;
        return $fullName;
    }

    public function getCustomerId() {
    	$customerId = $this->response->response[0]->customer[0]->customerId;
        return $customerId;
    }

	// TODO: Add formatting of currency
    public function getBalance() {
    	$balance = $this->response->response[0]->customer[0]->balance;
        return $balance;
    }

    // TODO: Make stateless by pulling out any parameters that must be passed in via caller
    public function callAPI($url) {
		$xml = <<<XML
    	<BeQuick product="OSS">
    	  <session>
    	  <id />
    	    <clec>
    	      <overrides />
    	      <id>208</id>
    	      <user>
    	        <firstName>customer</firstName>
    	        <lastName>portal_api</lastName>
    	      </user>
    	    </clec>
    	  </session>
    	  <request type="CustomerProfile">
    	    <customerEsn>270113180106810249</customerEsn>
    	    <includeTelephones>Y</includeTelephones>
    	  </request>
    	</BeQuick>
XML;
    		$data = array('request' => $xml);

    		// use key 'http' even if you send the request to https://...
    		$options = array(
    		    'http' => array(
    		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
    		        'method'  => 'POST',
    		        'content' => http_build_query($data),
    		    ),
    		);
    		$context = stream_context_create($options);
    		$result = file_get_contents($url, false, $context);

    		$this->response = new SimpleXMLElement($result);
    		// echo var_export($this->response, true);
    }
}
?>