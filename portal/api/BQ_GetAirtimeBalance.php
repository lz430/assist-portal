<?php

class BQ_GetAirtimeBalance extends BQ_Base {
	var $esn;
	var $mdn;
	var $includePurchaseDetails;

    function __construct() {
    	// Set default values
    	$this->set_requestType('GetAirtimeBalance');
    	$this->set_esn('');
    	$this->set_mdn('');
    	$this->set_includePurchaseDetails('Y');
    }

	function set_esn($value) {
		$this->esn = $value;
	}
	
	function get_esn() {
		return $this->esn;
	}
	
	function set_mdn($value) {
		$this->mdn = $value;
	}
	
	function get_mdn() {
		return $this->mdn;
	}
	
	function set_includePurchaseDetails($value) {
		$this->includePurchaseDetails = $value;
	}

	function get_includePurchaseDetails() {
		return $this->includePurchaseDetails;
	}

	function get_XML() {
        $request = new SimpleXMLElement('<request></request>');
        $request[0]['type'] = $this->get_requestType();

        // $esn = $request->addChild('esn');
        // $esn[0] = $this->get_esn();

        $mdn = $request->addChild('mdn');
        $mdn[0] = $this->get_mdn();

        $includePurchaseDetails = $request->addChild('includePurchaseDetails');
        $includePurchaseDetails[0] = $this->get_includePurchaseDetails();

        return $request;
	}

	// TODO: What should happen if the value is 0?
	// TODO: What should happen if there's an error?
	function get_remainingData() {
		if (!empty($this->response)) {
			return self::formatRemainingData(floatval($this->response->response[0]->remaining_data[0]));
		} else {
			return '';
		};
	}

	function get_remainingMinutes() {
		if (!empty($this->response)) {
			return self::formatRemainingMinutes(floatval($this->response->response[0]->remaining_minutes[0]));
		} else {
			return '';
		};
	}

	function get_remainingText() {
		if (!empty($this->response)) {
			return self::formatRemainingTextMessages(floatval($this->response->response[0]->remaining_text[0]));
		} else {
			return '';
		};
	}
}

?>