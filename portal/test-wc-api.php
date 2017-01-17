<?php
  /*
  * * Template Name: James Test
  * * @package assist-portal 
  */
  get_header();
  // TODO: Why doesn't this work?
  // Check in various folders if autoload doesn't work
  function __autoload($class_name) {
    
  }

  $consumer_key = "ck_44963f7bcdd06c3336558491243aeff1e190f014";
  $consumer_secret = "cs_ff4c2a087839b0dc820229077fd0732ae608e802";

  require_once( 'api/Setting.php' );
  require_once( 'wc-api/woocommerce-api.php' );

  $options = array(
      'ssl_verify'      => false,
  );

  try {

      $client = new WC_API_Client( Setting::WC_BASE_URL, Setting::WC_CONSUMER_KEY, Setting::WC_CONSUMER_SECRET, $options );

  } catch ( WC_API_Client_Exception $e ) {

      echo $e->getMessage() . PHP_EOL;
      echo $e->getCode() . PHP_EOL;

      if ( $e instanceof WC_API_Client_HTTP_Exception ) {

          print_r( $e->get_request() );
          print_r( $e->get_response() );
      }
  }
  
  echo print_r($client->orders->get( "34" ));

	get_footer(); 
