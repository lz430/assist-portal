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
            $taxTotal = $this->response->response[0]->invoice->taxTotal;
            if (function_exists('money_format')) {
                return money_format('%#2n', floatval($taxTotal));
            } else {
                return self::money_format_custom('%#2n', floatval($taxTotal));
            }
        } else {
            return '';
        };
    }
    
    function get_sku_description() {
        if (!empty($this->response)) {
            return $this->response->response[0]->invoice->skuDetail[0]->sku[0]->description;
        } else {
            return '';
        };
    }
    
    function get_sku_price() {
        if (!empty($this->response)) {
            $price = $this->response->response[0]->invoice->skuDetail[0]->sku[0]->price;
            if (function_exists('money_format')) {
                return money_format('%#2n', floatval($price));
            } else {
                return self::money_format_custom('%#2n', floatval($price));
            }

        } else {
            return '';
        };
    }

    function get_total_due() {
        if (!empty($this->response)) {
            $totalDue = $this->response->response[0]->invoice->totalDue;
            if (function_exists('money_format')) {
                return money_format('%#2n', floatval($totalDue));
            } else {
                return self::money_format_custom('%#2n', floatval($totalDue));
            }

        } else {
            return '';
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