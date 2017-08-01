<?php
  /*
  * * Template Name: Portal Invoice Page
  * * @package assist-portal 
  */

  function getInvoiceDetails($customerId, $invoiceId) {
    $Api = new Api();
    $requestParams = new requestParams();

    $BQ = new BQ_ViewInvoice();

    $BQ->set_invoiceId($invoiceId);
    $BQ->set_customerId($customerId);

    $requestParams->id = Setting::CLEC_ID;
    $requestParams->firstName = Setting::CLEC_FIRSTNAME;
    $requestParams->lastName = Setting::CLEC_LASTNAME;
    $requestParams->details = $BQ;

    $request = $Api->buildRequest($requestParams);

    $Api->callAPI(Setting::URL, $request);
    $BQ->set_response($Api->response);

    return $BQ->get_pdflink();
  }
  
  get_header();
  
  include_once(TEMPLATEPATH."/portal/api/Api.php");
  include_once(TEMPLATEPATH."/portal/api/Setting.php");
  include_once(TEMPLATEPATH."/portal/api/RequestParams.php");
  include_once(TEMPLATEPATH."/portal/api/BQ_Base.php");
  include_once(TEMPLATEPATH."/portal/api/BQ_CustomerProfile.php");
  include_once(TEMPLATEPATH."/portal/api/BQ_ViewInvoice.php");

  $Api = new Api();
  $requestParams = new RequestParams();

  $BQ = new BQ_CustomerProfile();
  $BQ->set_CustomerMdn(WC()->session->get("mdn"));

  $requestParams->id = Setting::CLEC_ID;
  $requestParams->firstName = Setting::CLEC_FIRSTNAME;
  $requestParams->lastName = Setting::CLEC_LASTNAME;
  $requestParams->details = $BQ;

  $request = $Api->buildRequest($requestParams);
  $Api->callAPI(Setting::URL, $request);
  $BQ->set_response($Api->response);

  // NOTE
  $customerInvoices = json_decode((string)$BQ->get_lastNInvoices(10));

  // echo "<pre>";
  // echo var_dump($customerInvoices);
  // echo "</pre>";
  ?>  

  <div class="container invoice-page">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h2>Invoices</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Invoice #</th>
          <th>Month</th>
          <th>Invoice Amount</th>
        </tr>
      </thead>
      <tbody>
      <?
      foreach ($customerInvoices as $customerInvoice) {
        $pdflink = getInvoiceDetails($id, $customerInvoice->invoiceNumber);
        if ($pdflink) {
          $customerInvoice->invoicePdflink = $pdflink;
        } else {
          $customerInvoice->invoicePdflink = '';
        }

        echo "<tr>";

        // echo "<pre>";
        // echo  print_r($customerInvoice);
        // echo "</pre>";

        // Invoice Number + link to Pdf
        if ($customerInvoice->invoicePdflink) {
          echo '<td><a href="' . $customerInvoice->invoicePdflink . '">' . $customerInvoice->invoiceNumber . '</a></td>';
        } else {
          echo '<td>' . $customerInvoice->invoiceNumber . '</td>';
        }
        // Invoice Date
        echo "<td>" . $customerInvoice->invoiceDate . "</td>";
        // Invoice Amount
        echo "<td>" . $customerInvoice->invoiceAmount . "</td>";

        echo "</tr>";
      };
      ?>
      </tbody>
    </table>
  </div>

  </div>

  <?php get_footer(); ?>