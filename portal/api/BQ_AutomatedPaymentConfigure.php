<?php

class BQ_AutomatedPaymentConfigure extends BQ_Base {
    var $customerId;

    function __construct() {
        // Set default values
        $this->set_requestType('AutomatedPaymentConfigure');
        $this->set_customerId('');
    }

    function set_accountType($value) {
        $this->accountType = $value;
    }
    
    function get_accountType() {
        return $this->accountType;
    }
    
    function set_verifySetup($value) {
        $this->verifySetup = $value;
    }
    
    function get_verifySetup() {
        return $this->verifySetup;
    }
    
    function set_commitChanges($value) {
        $this->commitChanges = $value;
    }
    
    function get_commitChanges() {
        return $this->commitChanges;
    }
    
    function set_enabled($value) {
        $this->enabled = $value;
    }
    
    function get_enabled() {
        return $this->enabled;
    }
    
    function set_chargeLimit($value) {
        $this->chargeLimit = $value;
    }
    
    function get_chargeLimit() {
        return $this->chargeLimit;
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
    
    function get_ccExpYY() {
        return $this->ccExpYY;
    }
    
    function set_ccExpYY($value) {
        $this->ccExpYY = $value;
    }
    
    function get_ccExpMM() {
        return $this->ccExpMM;
    }
    
    function set_ccExpMM($value) {
        $this->ccExpMM = $value;
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
    
    function set_bankAccount($value) {
        $this->bankAccount = $value;
    }
    
    function get_bankAccount() {
        return $this->bankAccount;
    }
    
    function set_bankRouting($value) {
        $this->bankRouting = $value;
    }
    
    function get_bankRouting() {
        return $this->bankRouting;
    }
    
    function set_bankName($value) {
        $this->bankName = $value;
    }
    
    function get_bankName() {
        return $this->bankName;
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

        $accountType = $request->addChild('accountType');
        $accountType[0] = $this->get_accountType();

        $customerId = $request->addChild('account');
        $customerId[0] = $this->get_customerId();

        $verifySetup = $request->addChild('verifySetup');
        $verifySetup[0] = $this->get_verifySetup();

        $commitChanges = $request->addChild('commitChanges');
        $commitChanges[0] = $this->get_commitChanges();

        $paymentType = $request->addChild('paymentType');
        $paymentType[0] = $this->get_paymentType();

        $enabled = $request->addChild('enabled');
        $enabled[0] = $this->get_enabled();

        $chargeLimit = $request->addChild('chargeLimit');
        $chargeLimit[0] = $this->get_chargeLimit();

        // TODO: Remove check for 'Credit Card' once front-end if changed
        if (strcasecmp($paymentType, 'CREDITCARD') == 0 || strcasecmp($paymentType, 'Credit Card') == 0) {
            $ccHolderName = $request->addChild('ccName');
            $ccHolderName[0] = $this->get_ccHolderName();

            $ccNumber = $request->addChild('ccNumber');
            $ccNumber[0] = $this->get_ccNumber();

            $ccExpYY = $request->addChild('ccExpYY');
            $ccExpYY[0] = $this->get_ccExpYY();

            $ccExpMM = $request->addChild('ccExpMM');
            $ccExpMM[0] = $this->get_ccExpMM();

            $ccTypeCode = $request->addChild('ccTypeCode');
            $ccTypeCode[0] = $this->get_ccTypeCode();

            $billingZip = $request->addChild('ccBillingZip');
            $billingZip[0] = $this->get_billingZip();
        } elseif (strcasecmp($paymentType, 'ACH') == 0) {
            $bankAccount = $request->addChild('bankAccount');
            $bankAccount[0] = $this->get_bankAccount();

            $bankRouting = $request->addChild('bankRouting');
            $bankRouting[0] = $this->get_bankRouting();

            // $bankName = $request->addChild('bankName');
            // $bankName[0] = $this->get_bankName();
        }

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