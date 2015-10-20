<?php

class BQ_CustomerManualInvoiceQuoteRequest extends BQ_Base {
	var $customerId;
	var $billingProfileId;
	var $lineType;
	var $city;
	var $state;
	var $zip;
	var $skus;

    function __construct() {
    	// Set default values
    	$this->set_requestType('CustomerManualInvoiceQuoteRequest');
    	$this->set_customerId('');
    	$this->set_billingProfileId('');
    	$this->set_lineType('Residential');
    	$this->set_city('');
    	$this->set_state('');
    	$this->set_zip('');
    }

	function set_customerId($value) {
		$this->customerId = $value;
	}
	
	function get_customerId() {
		return $this->customerId;
	}
	
	function set_billingProfileId($value) {
		$this->billingProfileId = $value;
	}
	
	function get_billingProfileId() {
		return $this->billingProfileId;
	}
	
	function set_lineType($value) {
		$this->lineType = $value;
	}
	
	function get_lineType() {
		return $this->lineType;
	}
	
	function set_city($value) {
		$this->city = $value;
	}
	
	function get_city() {
		return $this->city;
	}
	
	function set_state($value) {
		$this->state = $value;
	}
	
	function get_state() {
		return $this->state;
	}
	
	function set_zip($value) {
		$this->zip = $value;
	}
	
	function get_zip() {
		return $this->zip;
	}
	
	function set_skus(array $value) {
		$this->skus = $value;
	}
	
	function get_skus() {
		return $this->skus;
	}
	
	function get_tax_total() {
		if (!empty($this->response)) {
			return floatval($this->response->response[0]->invoice->taxTotal);
		} else {
			return 0;
		};
	}
	
	function get_XML() {
        $request = new SimpleXMLElement('<request></request>');
        $request[0]['type'] = $this->get_requestType();

        $customerId = $request->addChild('customerId');
        $customerId[0] = $this->get_customerId();

        $billingProfileId = $request->addChild('billingProfileId');
        $billingProfileId[0] = $this->get_billingProfileId();

        $lineType = $request->addChild('lineType');
        $lineType[0] = $this->get_lineType();

        $city = $request->addChild('city');
        $city[0] = $this->get_city();

        $state = $request->addChild('state');
        $state[0] = $this->get_state();

        $zip = $request->addChild('zip');
        $zip[0] = $this->get_zip();

        $skus = $request->addChild('skus');
        
        if (false) { // Attempt 1
	        $sku = $skus->addChild('sku');
	        // Loop through each item in sku
	        foreach ($this->get_skus() as $value) {
	        	$id = $sku->addChild('id');
	    		$id[0] = $value;
	    	}
        } else { // Attempt 2
	        // Loop through each item in sku
	        foreach ($this->get_skus() as $value) {
		        $sku = $skus->addChild('sku');
	        	$id = $sku->addChild('id');
	    		$id[0] = $value;
	    	}
        }

        return $request;
	}

}

?>