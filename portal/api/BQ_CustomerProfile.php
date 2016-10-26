<?php

class BQ_CustomerProfile extends BQ_Base {

    const RECERTDAYS = '+75 days';

    var $customerId;
    var $customerEsn;
	var $customerMdn;
    var $includeCustomerAutomatedPayment;
    var $includeDiscounts;
    var $includeInvoices;
    var $includePayments;
    var $includeNotes;
    var $includeTelephones;
    var $includeOrders;
    var $includeRepairs;
    var $includePendingCharges;
    var $includePlanFeatures;
    var $includeTelephoneFeatures;
    var $includePlanAdditionalFeatures;
    var $includeAddressLocation;
    var $includeLdPlanServiceRates;

    function __construct() {
    	// Set default values
    	$this->set_requestType('CustomerProfile');
        $this->set_customerId('');
        $this->set_customerEsn('');
    	$this->set_customerMdn('');

        $this->set_includeTelephones('Y');
    	$this->set_includePlanFeatures('Y');

        $this->includeCustomerAutomatedPayment = 'Y';
        $this->includeDiscounts = 'Y';
        $this->includeInvoices = 'Y';
        $this->includePayments = 'Y';
        $this->includeNotes = 'Y';
        $this->includeOrders = 'Y';
        $this->includeRepairs = 'Y';
        $this->includePendingCharges = 'Y';
        $this->includePlanFeatures = 'Y';
        $this->includeTelephoneFeatures = 'Y';
        $this->includePlanAdditionalFeatures = 'Y';
        $this->includeAddressLocation = 'Y';
        $this->includeLdPlanServiceRates = 'Y';
    }

    function set_customerId($value) {
        $this->customerId = $value;
    }
    
    function update_customerId() {
        $this->customerId = $this->get_customerId();
    }
    
    function get_customerId() {
        if ($this->response) {
            return $this->response->response[0]->customer[0]->customerId;
        } else {
            return $this->customerId;
        }
    }
    
    function set_customerEsn($value) {
        $this->customerEsn = $value;
    }
    
    function get_customerEsn() {
        return $this->customerEsn;
    }
    
	function set_customerMdn($value) {
		$this->customerMdn = $value;
	}
	
	function get_customerMdn() {
		return $this->customerMdn;
	}
	
    function set_includeTelephones($value) {
        $this->includeTelephones = $value;
    }

    function get_includeTelephones() {
        return $this->includeTelephones;
    }

	function set_includePlanFeatures($value) {
		$this->includePlanFeatures = $value;
	}

    function get_includePlanFeatures() {
        return $this->includePlanFeatures;
    }

    function get_includeCustomerAutomatedPayment() {
        return $this->includeCustomerAutomatedPayment;
    }

    function get_includeDiscounts() {
        return $this->includeDiscounts;
    }

    function get_includeInvoices() {
        return $this->includeInvoices;
    }

    function get_includePayments() {
        return $this->includePayments;
    }

    function get_includeNotes() {
        return $this->includeNotes;
    }

    function get_includeRepairs() {
        return $this->includeRepairs;
    }

    function get_includePendingCharges() {
        return $this->includePendingCharges;
    }

    function get_includeTelephoneFeatures() {
        return $this->includeTelephoneFeatures;
    }

    function get_includePlanAdditionalFeatures() {
        return $this->includePlanAdditionalFeatures;
    }

    function get_includeAddressLocation() {
        return $this->includeAddressLocation;
    }

    function get_includeLdPlanServiceRates() {
        return $this->includeLdPlanServiceRates;
    }

    function get_includeOrders() {
        return $this->includeOrders;
    }

	function get_XML() {
        $request = new SimpleXMLElement('<request></request>');
        $request[0]['type'] = $this->get_requestType();

        // NOTE: Either customerId or customerEsn
        if (!($this->get_customerId() === '')) {
            $customerId = $request->addChild('customerId');
            $customerId[0] = $this->get_customerId();
        } elseif (!($this->get_customerEsn() === '')) {
            $customerEsn = $request->addChild('customerEsn');
            $customerEsn[0] = $this->get_customerEsn();
        } elseif (!($this->get_customerMdn() === '')) {
            $customerMdn = $request->addChild('telephoneNumber');
            $customerMdn[0] = $this->get_customerMdn();
        }

        $includeCustomerAutomatedPayment = $request->addChild('includeCustomerAutomatedPayment');
        $includeCustomerAutomatedPayment[0] = $this->get_includeCustomerAutomatedPayment();

        $includeDiscounts = $request->addChild('includeDiscounts');
        $includeDiscounts[0] = $this->get_includeDiscounts();

        $includeInvoices = $request->addChild('includeInvoices');
        $includeInvoices[0] = $this->get_includeInvoices();

        $includePayments = $request->addChild('includePayments');
        $includePayments[0] = $this->get_includePayments();

        $includeNotes = $request->addChild('includeNotes');
        $includeNotes[0] = $this->get_includeNotes();

        $includeTelephones = $request->addChild('includeTelephones');
        $includeTelephones[0] = $this->get_includeTelephones();

        $includeOrders = $request->addChild('includeOrders');
        $includeOrders[0] = $this->get_includeOrders();

        $includeRepairs = $request->addChild('includeRepairs');
        $includeRepairs[0] = $this->get_includeRepairs();

        $includePendingCharges = $request->addChild('includePendingCharges');
        $includePendingCharges[0] = $this->get_includePendingCharges();

        $includePlanFeatures = $request->addChild('includePlanFeatures');
        $includePlanFeatures[0] = $this->get_includePlanFeatures();

        $includeTelephoneFeatures = $request->addChild('includeTelephoneFeatures');
        $includeTelephoneFeatures[0] = $this->get_includeTelephoneFeatures();

        $includePlanAdditionalFeatures = $request->addChild('includePlanAdditionalFeatures');
        $includePlanAdditionalFeatures[0] = $this->get_includePlanAdditionalFeatures();

        $includeAddressLocation = $request->addChild('includeAddressLocation');
        $includeAddressLocation[0] = $this->get_includeAddressLocation();

        $includeLdPlanServiceRates = $request->addChild('includeLdPlanServiceRates');
        $includeLdPlanServiceRates[0] = $this->get_includeLdPlanServiceRates();

        return $request;
	}

    public function isValidCustomer() {
        if ($this->response->response[0]->attributes()->status == 'success') {
            return true;
        } elseif ($this->response->response[0]->attributes()->status == 'success' and $this->response->response[0]->errors[0]->error[0]->message[0] == 'No matching customers found.' ) {
            return false;
        } else {
            // TODO: How to handle other errors?
            return false;
        }
    }

    public function get_fullname() {
    	return $this->response->response[0]->customer[0]->firstName . ' ' . $this->response->response[0]->customer[0]->lastName;
    }

    // public function get_customerId() {
    // 	return $this->response->response[0]->customer[0]->customerId;
    // }

    public function get_balance() {
        $balance = $this->response->response[0]->customer[0]->balance;

        // NOTE: Assumption is that all balances are in US Dollars
        setlocale(LC_MONETARY, 'en_US');

        // NOTE: money_format function is not supported in PHP on Windows
        // if (function_exists('money_format')) {
        //     return money_format('%(#10n', floatval($balance) * -1.0);
        // } else {
            return self::money_format_custom('%#1n', floatval($balance) * 1.0);
        // }
    }

    public function get_balanceFloat() {
        $balance = $this->response->response[0]->customer[0]->balance;

        return floatval($balance);
    }

    public function get_balancePastDue() {
        $balance = $this->response->response[0]->customer[0]->balancePastDue;

        // NOTE: Assumption is that all balances are in US Dollars
        setlocale(LC_MONETARY, 'en_US');

        // NOTE: money_format function is not supported in PHP on Windows
        // if (function_exists('money_format')) {
        //     return money_format('%(#10n', floatval($balance) * -1.0);
        // } else {
            return self::money_format_custom('%#1n', floatval($balance) * 1.0);
        // }
    }

    public function get_carrier() {
        return (string)$this->response->response[0]->customer[0]->telephones[0]->telephone[0]->carrier;
    }

    public function get_planId() {
        return (string)$this->response->response[0]->customer[0]->telephones[0]->telephone[0]->planId;
    }

    public function get_planName() {
        return $this->response->response[0]->customer[0]->telephones[0]->telephone[0]->planName;
    }

    public function get_planPrice() {
        return $this->response->response[0]->customer[0]->telephones[0]->telephone[0]->planPrice;
    }

    public function get_DOB() {
        return (string)$this->response->response[0]->customer[0]->dateOfBirth;
    }

    public function get_email() {
        return $this->response->response[0]->customer[0]->contactInformation->email;
    }

    public function get_telephoneNumber1() {
        return preg_replace("/[^0-9,.]/", "", $this->response->response[0]->customer[0]->telephones[0]->telephone[0]->telephoneNumber1);
    }

    public function get_daysLeft() {
        // http://stackoverflow.com/a/11667920

        date_default_timezone_set('America/New_York');
        $dateStart = new DateTime(date('Y-m-d'));
        $dateEnd = new DateTime($this->response->response[0]->customer[0]->telephones[0]->telephone[0]->nextBillDate);

        $dateDiff = $dateStart->diff($dateEnd);

    	return strval($dateDiff->days) . " day(s) left in period";
    }

    public function get_lifelineCertificationType() {
        return (string)$this->response->response[0]->customer[0]->lifelineCertificationType;
    }

    public function get_lifelineCertificationEtc() {
        return (string)$this->response->response[0]->customer[0]->lifelineCertificationEtc;
    }

    public function get_lifelineCertificationRenewalDate() {
        return (string)$this->response->response[0]->customer[0]->renewalDate;
    }

    public function get_lifelineCertificationReceived() {
        return (string)$this->response->response[0]->customer[0]->lifelineCertificationReceived;
    }

    public function isUpForRecertification() {
        $renewalDate = strtotime($this->get_lifelineCertificationRenewalDate());

        if (strtotime(self::RECERTDAYS, $renewalDate) > time()) {
            return true;
        } else {
            return false;
        }
    }

    // https://www.modxsimplecart.com/about/blog/windows-development?tag=PHP
    function money_format_custom($format, $number) 
    { 
        $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'. 
                  '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/'; 
        if (setlocale(LC_MONETARY, 0) == 'C') { 
            setlocale(LC_MONETARY, ''); 
        } 
        $locale = localeconv(); 
        preg_match_all($regex, $format, $matches, PREG_SET_ORDER); 
        foreach ($matches as $fmatch) { 
            $value = floatval($number); 
            $flags = array( 
                'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ? 
                               $match[1] : ' ', 
                'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0, 
                'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ? 
                               $match[0] : '+', 
                'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0, 
                'isleft'    => preg_match('/\-/', $fmatch[1]) > 0 
            ); 
            $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0; 
            $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0; 
            $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits']; 
            $conversion = $fmatch[5]; 

            $positive = true; 
            if ($value < 0) { 
                $positive = false; 
                $value  *= -1; 
            } 
            $letter = $positive ? 'p' : 'n'; 

            $prefix = $suffix = $cprefix = $csuffix = $signal = ''; 

            $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign']; 
            switch (true) { 
                case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+': 
                    $prefix = $signal; 
                    break; 
                case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+': 
                    $suffix = $signal; 
                    break; 
                case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+': 
                    $cprefix = $signal; 
                    break; 
                case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+': 
                    $csuffix = $signal; 
                    break; 
                case $flags['usesignal'] == '(': 
                case $locale["{$letter}_sign_posn"] == 0: 
                    $prefix = '('; 
                    $suffix = ')'; 
                    break; 
            } 
            if (!$flags['nosimbol']) { 
                $currency = $cprefix . 
                            ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) . 
                            $csuffix; 
            } else { 
                $currency = ''; 
            } 
            $space  = $locale["{$letter}_sep_by_space"] ? ' ' : ''; 
            // HACK!
            $space = ' ';
            if ($prefix == '(') {
                $prefix = '-';
                $suffix = '';
            }

            $value = number_format($value, $right, $locale['mon_decimal_point'], 
                     $flags['nogroup'] ? '' : $locale['mon_thousands_sep']); 
            $value = @explode($locale['mon_decimal_point'], $value); 

            $n = strlen($prefix) + strlen($currency) + strlen($value[0]); 
            if ($left > 0 && $left > $n) { 
                $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0]; 
            } 
            $value = implode($locale['mon_decimal_point'], $value); 
            if ($locale["{$letter}_cs_precedes"]) { 
                $value = $prefix . $currency . $space . $value . $suffix; 
            } else { 
                $value = $prefix . $value . $space . $currency . $suffix; 
            } 
            if ($width > 0) { 
                $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ? 
                         STR_PAD_RIGHT : STR_PAD_LEFT); 
            } 

            $format = str_replace($fmatch[0], $value, $format); 
        } 
        return $format; 
    } 
}

?>