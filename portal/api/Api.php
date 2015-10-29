<?php

class Api
{
    var $response;

    // http://stackoverflow.com/a/4778964/24482
    function sxml_append(SimpleXMLElement $to, SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }

    function buildRequestHeader($requestParams) {
        $session = new SimpleXMLElement('<session></session>');
        $sessionId = $session->addchild('id');
        $clec = $session->addchild('clec');
        
        $clec->addchild('overrides');

        $id = $clec->addchild('id');
        $id[0] = $requestParams->id;

        $user = $clec->addchild('user');

        $firstName = $user->addChild('firstName');
        $firstName[0] = $requestParams->firstName;

        $lastName = $user->addChild('lastName');
        $lastName[0] = $requestParams->lastName;
        return $session;
    }

    public function buildRequest($requestParams) {
        $request = new SimpleXMLElement('<BeQuick product="OSS"></BeQuick>');

        // A BeQuick request consists of a header and detail.
        // The header is common across all API calls. The detail changes depending on the API method called.

        // Request header
        $this->sxml_append($request, $this->buildRequestHeader($requestParams));

        // Request details
        $this->sxml_append($request, $requestParams->details->get_XML());

        return $request;
    }

    // TODO: Make stateless by pulling out any parameters that must be passed in via caller
    public function callAPI($url, $request) {
		$data = array('request' => $request->asXML());

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

        if (false) {
            echo "<pre>";
            echo var_export($request, true);
            echo "<br/>";
            echo var_export($this->response->response[0]->invoice->taxTotal, true);
            echo "</pre>";
        }

        return;
    }
}
?>