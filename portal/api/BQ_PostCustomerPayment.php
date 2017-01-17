<?php

class BQ_PostCustomerPayment extends BQ_Base {
    var $customerId;

    function __construct() {
    	// Set default values
    	$this->set_requestType('PostCustomerPayment');
        $this->set_customerId('');
    }

    function set_customerId($value) {
        $this->customerId = $value;
    }
    
    function get_customerId() {
        return $this->customerId;
    }
    
    function set_paymentTotal($value) {
        $this->paymentTotal = $value;
    }
    
    function get_paymentTotal() {
        return $this->paymentTotal;
    }
    
    function set_paymentType($value) {
        $this->paymentType = $value;
    }
    
    function get_paymentType() {
        return $this->paymentType;
    }
    
    function set_paymentSource($value) {
        $this->paymentSource = $value;
    }
    
    function get_paymentSource() {
        return $this->paymentSource;
    }
    
    function set_ccType($value) {
        $this->ccType = $value;
    }
    
    function get_ccType() {
        return $this->ccType;
    }
    
    function set_ccTypeCode($value) {
        $this->ccTypeCode = $value;
    }
    
    function get_ccTypeCode() {
        return $this->ccTypeCode;
    }
    
    function set_ccNumber($value) {
        $this->ccNumber = $value;
    }
    
    function get_ccNumber() {
        return $this->ccNumber;
    }
    
    function set_ccHolderName($value) {
        $this->ccHolderName = $value;
    }
    
    function get_ccHolderName() {
        return $this->ccHolderName;
    }
    
    function set_ccExp($value) {
        $this->ccExp = $value;
    }
    
    function get_ccExp() {
        return $this->ccExp;
    }
    
    function set_ccCV($value) {
        $this->ccCV = $value;
    }
    
    function get_ccCV() {
        return $this->ccCV;
    }
    
    function set_buyAirTimeSkuID($value) {
        $this->buyAirTimeSkuID = $value;
    }
    
    function get_buyAirTimeSkuID() {
        return $this->buyAirTimeSkuID;
    }
    
    function set_billingZip($value) {
        $this->billingZip = $value;
    }
    
    function get_billingZip() {
        return $this->billingZip;
    }
    
    function set_processElectronicPayment($value) {
        $this->processElectronicPayment = $value;
    }
    
    function get_processElectronicPayment() {
        return $this->processElectronicPayment;
    }
    
    function get_errorMessage() {
        $errorMessage = "";
        if ($this->response->response[0]->attributes()->status == 'failure') {
            foreach ( $this->response->response[0]->errors->error as $error ) {
                $errorMessage = $errorMessage . (string)$error->message . " ";
            }
        }

        return $errorMessage;
    }
    
	function get_XML() {
        $request = new SimpleXMLElement('<request></request>');
        $request[0]['type'] = $this->get_requestType();

        $customerId = $request->addChild('customerId');
        $customerId[0] = $this->get_customerId();

        $paymentTotal = $request->addChild('paymentTotal');
        $paymentTotal[0] = $this->get_paymentTotal();

        $paymentType = $request->addChild('paymentType');
        $paymentType[0] = $this->get_paymentType();

        $paymentSource = $request->addChild('paymentSource');
        $paymentSource[0] = $this->get_paymentSource();

        $ccType = $request->addChild('ccType');
        $ccType[0] = $this->get_ccType();

        $ccTypeCode = $request->addChild('ccTypeCode');
        $ccTypeCode[0] = $this->get_ccTypeCode();

        $ccNumber = $request->addChild('ccNumber');
        $ccNumber[0] = $this->get_ccNumber();

        $ccHolderName = $request->addChild('ccHolderName');
        $ccHolderName[0] = $this->get_ccHolderName();

        $ccExp = $request->addChild('ccExp');
        $ccExp[0] = $this->get_ccExp();

        $ccCV = $request->addChild('ccCV');
        $ccCV[0] = $this->get_ccCV();

        $buyAirTimeSkuID = $request->addChild('buyAirTimeSkuID');
        $buyAirTimeSkuID[0] = $this->get_buyAirTimeSkuID();

        // $billingZip = $request->addChild('billingZip');
        // $billingZip[0] = $this->get_billingZip();

        $processElectronicPayment = $request->addChild('processElectronicPayment');
        $processElectronicPayment[0] = $this->get_processElectronicPayment();

        return $request;
	}

    public function isValidRequest() {
        if ($this->response->response[0]->attributes()->status == 'success') {
            return true;
        } elseif ($this->response->response[0]->attributes()->status == 'success' and $this->response->response[0]->errors[0]->error[0]->message[0] == 'No matching customers found.' ) {
            return false;
        } else {
            // TODO: How to handle other errors?
            return false;
        }
    }
}
?>