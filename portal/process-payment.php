<?php
	// BAD
	// http://ap.430designs.com/wp-content/themes/assistv2/portal/process-order.php?sku=325&customerId=11132419&totalDue=7.8&ccNum=4111111111119999&ccName=James&ccExpDate=05/2015&ccCV=250
	// http://ap.430designs.com/wp-content/themes/assistv2/portal/process-order.php?sku=325&customerId=11132419&totalDue=7.8&ccNum=4111111111119999&ccName=James&ccExpDate=05/2016&ccCV=250

	// GOOD
	// http://ap.430designs.com/wp-content/themes/assistv2/portal/process-order.php?sku=325&customerId=11132419&totalDue=7.80&ccNum=5262930430734244&ccName=Jordan Majkszak&ccExpDate=05/2024&ccCV=250
	// http://ap.430designs.com/wp-content/themes/assistv2/portal/process-order.php?sku=321&customerId=11132419&totalDue=4.46&ccNum=5262930430734244&ccName=Jordan Majkszak&ccExpDate=05/2024&ccCV=250

 	header('Content-type: application/json');

	// TODO: Discover?
	function check_cc($cc, $extra_check = false){
	    $cards = array(
	        "visa" => "(4\d{12}(?:\d{3})?)",
	        "amex" => "(3[47]\d{13})",
	        "jcb" => "(35[2-8][89]\d\d\d{10})",
	        "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
	        "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
	        "mastercard" => "(5[1-5]\d{14})",
	        "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
	    );
	    $names = array("VI", "AX", "JCB", "Maestro", "Solo", "MC", "Switch");
	    $matches = array();
	    $pattern = "#^(?:".implode("|", $cards).")$#";
	    $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
	    if($extra_check && $result > 0){
	        $result = (validatecard($cc))?1:0;
	    }
	    return ($result>0)?$names[sizeof($matches)-2]:false;
	}

	// $buyAirTimeSkuID = $_GET['sku'];
	$customerId = $_GET['customerId'];
	$paymentTotal = $_GET['totalDue'];
	$paymentType = 'Credit Card';
	$paymentSource = 'Assist Wireless Portal';
	$ccNumber = $_GET['ccNum'];
	$ccHolderName = $_GET['ccName'];
	$ccExp = $_GET['ccExpDate'];
	$ccCV = $_GET['ccCV'];

	$ccTypeCode = check_cc($ccNumber);
	switch ($ccTypeCode) {
		case "MC":
			$ccType = 'Mastercard';
			break;
		case "VI":
			$ccType = 'Visa';
			break;
		case "AX":
			$ccType = 'American Express';
			break;
		case "DI":
			$ccType = 'Discover';
			break;
		default:
			$ccType = '';
	}

	if ( isset( $customerId ) 
		&& isset( $paymentTotal ) 
		&& isset( $ccNumber )
		&& isset( $ccHolderName )
		&& isset( $ccExp )
		&& isset( $ccCV )
		) {

	  include_once("api/Api.php");
	  include_once("api/Setting.php");
	  include_once("api/RequestParams.php");
	  include_once("api/BQ_Base.php");
	  include_once("api/BQ_PostCustomerPayment.php");
	  $Api = new Api();
	  $requestParams = new requestParams();
	  
	  $BQ = new BQ_PostCustomerPayment();

	  $BQ->set_customerId($customerId);
	  $BQ->set_paymentTotal($paymentTotal);
	  $BQ->set_paymentType($paymentType);
	  $BQ->set_paymentSource($paymentSource);
	  $BQ->set_ccType($ccType);
	  $BQ->set_ccTypeCode($ccTypeCode);
	  $BQ->set_ccNumber($ccNumber);
	  $BQ->set_ccHolderName($ccHolderName);
	  $BQ->set_ccExp($ccExp);
	  $BQ->set_ccCV($ccCV);
	  $BQ->set_billingZip($billingZip);
	  $BQ->set_processElectronicPayment("Y");

	  $requestParams->id = Setting::CLEC_ID;
	  $requestParams->firstName = Setting::CLEC_FIRSTNAME;
	  $requestParams->lastName = Setting::CLEC_LASTNAME;
	  $requestParams->details = $BQ;

	  $request = $Api->buildRequest($requestParams);

	  if (false) {
	  	echo json_encode($request);
	  }

  	$Api->callAPI(Setting::URL, $request);
  	$BQ->set_response($Api->response);

  	if ($BQ->isValidRequest()) {
		$response_array['status'] = 'success';
  	} else {
		$response_array['status'] = 'error';
		$response_array['message'] = $BQ->get_errorMessage();
  	}
  } else {
		$response_array['status'] = 'error';
		$response_array['message'] = 'Missing parameters.';
  }

echo json_encode($response_array);