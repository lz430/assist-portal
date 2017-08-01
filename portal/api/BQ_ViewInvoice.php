<?php

class BQ_ViewInvoice extends BQ_Base {
	var $customerId;
	var $invoiceId;

    function __construct() {
    	// Set default values
    	$this->set_requestType('ViewInvoice');
    	$this->set_customerId('');
    	$this->set_invoiceId('');
    }

	function set_customerId($value) {
		$this->customerId = $value;
	}
	
	function get_customerId() {
		return $this->customerId;
	}
	
	function set_invoiceId($value) {
		$this->invoiceId = $value;
	}
	
	function get_invoiceId() {
		return $this->invoiceId;
	}
	
	function get_pdflink() {
		if (!empty($this->response)) {
			return (string)$this->response->response[0]->pdfLink;
		} else {
			return '';
		};
	}
	
	function get_XML() {
        $request = new SimpleXMLElement('<request></request>');
        $request[0]['type'] = $this->get_requestType();

        $customerId = $request->addChild('customerId');
        $customerId[0] = $this->get_customerId();

        $invoiceId = $request->addChild('invoiceId');
        $invoiceId[0] = $this->get_invoiceId();

        return $request;
	}

}

?>