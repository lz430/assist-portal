<?php

class BQ_Base {
    var $requestType;
    var $response;

    function __construct() {
    	$this->set_requestType('');
        $this->set_response('');
    }

    function set_requestType($value) {
    	$this->requestType = $value;
    }

    function get_requestType() {
    	return $this->requestType;
    }

    static function formatRemainingMinutes($minutes) {
    	return number_format($minutes) . ' minute(s)';
    }
    
    static function formatRemainingTextMessages($textMessages) {
    	return number_format($textMessages) . ' text message(s)';
    }

    static function formatRemainingData($mbData) {
    	if ($mbData < 100) {
	    	return number_format(floor($mbData * 100) / 100) . ' MBs';
    	} else {
	    	return number_format((floor($mbData * 100) / 100) / 1000, 1) . ' GBs';
    	}
    }

	function get_response() {
		return $this->response;
	}

	function set_response($value) {
		$this->response = $value;
	}
}

?>