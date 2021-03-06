<?
include 'wp_bootstrap_navwalker.php';
/** Load up scripts/styles */
function assist_scripts_styles() {
    wp_enqueue_style('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
    wp_enqueue_script( 'html5shiv', get_template_directory_uri().'/js/html5shiv.js');
    wp_enqueue_script( 'superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'));
    wp_enqueue_script( 'bootstrap','//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script( 'jquery-masked-input', get_template_directory_uri().'/js/jquery.masked.input.js', array('jquery'));
    wp_enqueue_script( 'jquery-validate', get_template_directory_uri().'/js/jquery.validate.js', array('jquery'));
    wp_enqueue_script( 'enrollment-form', get_template_directory_uri().'/js/enrollmentForm.js');
    wp_enqueue_script( 'assist',    get_template_directory_uri().'/js/assist.js', array('jquery','bootstrap','superfish'));
}
add_action('wp_enqueue_scripts', 'assist_scripts_styles');
/* -------------------------------------- *\
    Assist Portal 
\* -------------------------------------- */
// include get_template_directory() . '/portal/portal-dashboard.php';
function assist_portal_scripts_styles() {
    wp_enqueue_style('portal-style', get_template_directory_uri().'/css/portal.css', array(), rand(111,9999));
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), rand(111,9999));
    wp_enqueue_style('gauge-style', get_template_directory_uri().'/css/jquery.dynameter.css', array(), rand(111,9999));
    wp_enqueue_script('gauge-script', '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js', array(), rand(111,9999));
    wp_enqueue_script('gauges', get_template_directory_uri().'/js/justgage-1.1.0.min.js', array(), rand(111,9999));
    wp_enqueue_script( 'jquery_payment', get_template_directory_uri() . '/js/jquery.payment/jquery.payment.min.js', array('jquery') );
    wp_enqueue_script( 'jquery-input-mask', get_template_directory_uri() . '/js/jquery.masked.input.js', array('jquery') );
    wp_enqueue_script('portal-scripts', get_template_directory_uri().'/js/portal.js', array(), rand(111,9999));
}
add_action('wp_enqueue_scripts','assist_portal_scripts_styles');
add_theme_support( 'post-thumbnails' );
/** Sets up the custom menus in the header/footer */
add_action('init', 'register_assist_menus');
function register_assist_menus()
{
    register_nav_menu('header-menu', __('Header Menu'));
    register_nav_menu('upper-menu', __('Top Right Nav'));
    register_nav_menu('page-footer-menu', __('Page Footer Menu'));
    register_nav_menu('mobile-menu', __('Mobile Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
}
/** Styling for the custom post type icons */
add_action( 'admin_head', 'register_assist_admin_icons' );
function register_assist_admin_icons() {
    ?>
    <style type="text/css" media="screen">
    #menu-posts-locations .wp-menu-image {
        background: url(<?php bloginfo('template_url') ?>/images/admin-icon-map.png) no-repeat 6px -18px !important;
    }
    
    #menu-posts-locations:hover .wp-menu-image,
    #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
        background-position: 6px 6px !important;
    }
    
    #icon-edit.icon32-posts-locations {
        background: url(<?php bloginfo('template_url') ?>/images/admin-icon-map-large.png) no-repeat;
    }
    
    #menu-posts-commercials .wp-menu-image {
        background: url(<?php bloginfo('template_url') ?>/images/admin-icon-tv.png) no-repeat 6px -18px !important;
    }
    
    #menu-posts-commercials:hover .wp-menu-image,
    #menu-posts-commercials.wp-has-current-submenu .wp-menu-image {
        background-position: 6px 6px !important;
    }
    
    #icon-edit.icon32-posts-commercials {
        background: url(<?php bloginfo('template_url') ?>/images/admin-icon-tv-large.png) no-repeat;
    }
    
    #menu-posts-cell-phone-plans .wp-menu-image {
        background: url(<?php bloginfo('template_url') ?>/images/admin-icon-phone.png) no-repeat 6px -18px !important;
    }
    
    #menu-posts-cell-phone-plans:hover .wp-menu-image,
    #menu-posts-cell-phone-plans.wp-has-current-submenu .wp-menu-image {
        background-position: 6px 6px !important;
    }
    
    #icon-edit.icon32-posts-cell-phone-plans {
        background: url(<?php bloginfo('template_url') ?>/images/admin-icon-phone-large.png) no-repeat;
    }
    </style>
    <?php }
    /* -------------------------------------- *\
        Adding custom fields for registration
    \* -------------------------------------- */
    /**
     * Add new register fields for WooCommerce registration.
     *
     * @return string Register fields HTML.
     */
    function wooc_extra_register_fields() {
?>
        <div class="clear"></div>
        <p class="form-row form-row-wide">
            <label for="reg_register_phone">
                <?php _e( 'Assist Wireless Phone Number', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="tel" class="input" name="register_phone" id="reg_register_phone" required value="<?php if ( ! empty( $_POST['register_phone'] ) ) esc_attr_e( $_POST['register_phone'] ); ?>" />
        </p>
        <p class="form-row form-row-wide">
            <label for="reg_register_dob">
                <?php _e( 'Date of Birth (mm-dd-yyyy)', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="text" class="input" name="register_dob" id="reg_register_dob" required value="<?php if ( ! empty( $_POST['register_dob'] ) ) esc_attr_e( $_POST['register_dob'] ); ?>" />
        </p>
        <?php
}
add_action( 'woocommerce_register_form', 'wooc_extra_register_fields' );
/**
 * Validate the extra register fields.
 *
 * @param  string $username          Current username.
 * @param  string $email             Current email.
 * @param  object $validation_errors WP_Error object.
 *
 * @return void
 */
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
    if ( isset( $_POST['register_phone'] ) && empty( $_POST['register_phone'] ) ) {
        $validation_errors->add( 'register_phone_error', __( 'Phone is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['register_dob'] ) && empty( $_POST['register_dob'] ) ) {
        $validation_errors->add( 'register_dob_error', __( 'Date of Birth is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['register_phone'] ) && isset( $_POST['register_dob'] ) ) {
        include_once(TEMPLATEPATH . "/portal/api/Api.php");
        include_once(TEMPLATEPATH . "/portal/api/Setting.php");
        include_once(TEMPLATEPATH . "/portal/api/RequestParams.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_Base.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_CustomerProfile.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_GetAirtimeBalance.php");
        $Api = new Api();
        $requestParams = new requestParams();
        $BQ = new BQ_CustomerProfile();
        $BQ->set_CustomerMdn($_POST['register_phone']);
        $requestParams->id = Setting::CLEC_ID;
        $requestParams->firstName = Setting::CLEC_FIRSTNAME;
        $requestParams->lastName = Setting::CLEC_LASTNAME;
        $requestParams->details = $BQ;
        $request = $Api->buildRequest($requestParams);
        $Api->callAPI(Setting::URL, $request);
        $BQ->set_response($Api->response);
        // Must wrap certain properties/methods with print_r in order to "see" them
        // echo print_r($BQ->get_DOB());
        // echo print_r($_POST['register_dob']);
        // die();
        if ( ! $BQ->isValidCustomer( ) ) {
            $validation_errors->add( 'register_phone_error', __( 'Not a valid Assist Wireless phone number.', 'woocommerce' ) );
        } elseif ( DateTime::createFromFormat( 'Y-m-d', $BQ->get_DOB( ) )->format('m-d-Y') <> $_POST['register_dob'] ) {
            $validation_errors->add( 'register_dob_error', __( "Date of birth does not match what's in our records." , 'woocommerce' ) );
            // For Debugging
            // $validation_errors->add( 'register_dob_error', __( "Date of birth does not match what's in our records." . DateTime::createFromFormat( 'Y-m-d', $BQ->get_DOB( ) )->format('m-d-Y') . ' - ' . $_POST['register_dob'], 'woocommerce' ) );
        } else {
            // HACK
            $BQ->update_customerId();
            // Not sure you can use these variables yet... since WC session hasn't started?
            // WC()->session->set('customerId', (string)$BQ->get_customerId());
            // WC()->session->set('carrier', (string)$BQ->get_carrier());
            $_SESSION['customerId'] = (string)$BQ->get_customerId();
            $_SESSION['carrier'] = (string)$BQ->get_planId();
        }
    }
}
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );
/**
 * Save the extra register fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */
function wooc_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['register_phone'] ) ) {
        // WooCommerce billing phone
        update_user_meta( $customer_id, 'register_phone', sanitize_text_field( $_POST['register_phone'] ) );
    }
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
// Hook into user data immediately after successful registration
function post_registration_update_acf( $user_id ) {
    if ( isset( $_SESSION['customerId'] ) ) {
    //     // Update Customer ID ACF field (field key = field_561b01c3cecfb)
        update_field('customer_id', $_SESSION['customerId'], 'user_'.$user_id);
    //     // Update Carrier ACF field (field key = field_5628d86e7d32a)
        update_field('carrier', $_SESSION['carrier'], 'user_'.$user_id);
    //     // TODO: Why does using the field key not work?
    //     // update_field('field_561b01c3cecfb', 'ABC-field-key', 'user_29');
    }
}
add_action( 'user_register', 'post_registration_update_acf', 10, 1 );
// Hook after user successfully logs in
function post_login_get_acf($user_login, $user) {
    if ( false ) {
        // TODO: Why do I need to use the field key, and not the field name, in this instance?
        // Get value in Customer ID ACF field (field key = field_561b01c3cecfb)
        $customerId = get_field('field_561b01c3cecfb', 'user_' . $user->ID);
        include_once(TEMPLATEPATH . "/portal/api/Api.php");
        include_once(TEMPLATEPATH . "/portal/api/Setting.php");
        include_once(TEMPLATEPATH . "/portal/api/RequestParams.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_Base.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_CustomerProfile.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_GetAirtimeBalance.php");
        $Api = new Api();
        $requestParams = new requestParams();
        $BQ = new BQ_CustomerProfile();
        $BQ->set_CustomerId($customerId);
        $requestParams->id = Setting::CLEC_ID;
        $requestParams->firstName = Setting::CLEC_FIRSTNAME;
        $requestParams->lastName = Setting::CLEC_LASTNAME;
        $requestParams->details = $BQ;
        $request = $Api->buildRequest($requestParams);
        $Api->callAPI(Setting::URL, $request);
        $BQ->set_response($Api->response);
        WC()->session->set('fullname', $BQ->get_fullName());
        WC()->session->set('customerId', $customerId); // NOTE: Not $BQ->get_customerId()
        WC()->session->set('balance', $BQ->get_balance());
        WC()->session->set('balancePastDue', $BQ->get_balancePastDue());
        WC()->session->set('planName', $BQ->get_planName());
        WC()->session->set('planPrice', $BQ->get_planPrice());
        // WC()->session->set('mdn', $BQ->get_telephoneNumber1());
        // WC()->session->set('daysLeft', $BQ->get_daysLeft());
    }
}
add_action( 'wp_login', 'post_login_get_acf', 10, 2 );
function mysite_woocommerce_payment_complete( $order_id ) {
    error_log( "Payment has been received for order $order_id", 1, "james@agilemediaventures.com" );
}
add_action( 'woocommerce_payment_complete', 'mysite_woocommerce_payment_complete' );
function mysite_hold( $order_id ) {
    error_log( "Order $order_id is on hold", 1, "james@agilemediaventures.com" );
}
add_action( 'woocommerce_order_status_on-hold', 'mysite_hold');
// TODO: Call BeQuick API to calculate sales tax
function custom_add_tax( $instance ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;
    global $woocommerce;
    $fee = 0;
    foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
        $product = new WC_Product( $values['product_id'] );
        $sku = $product->get_sku();
        $qty = $values['quantity'];
        include_once(TEMPLATEPATH . "/portal/api/Api.php");
        include_once(TEMPLATEPATH . "/portal/api/Setting.php");
        include_once(TEMPLATEPATH . "/portal/api/RequestParams.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_Base.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_CustomerManualInvoiceQuoteRequest.php");
        $Api = new Api();
        $requestParams = new requestParams();
        $BQ = new BQ_CustomerManualInvoiceQuoteRequest();
        // $BQ->set_billingProfileId('3');
        $BQ->set_customerId(WC()->session->get('customerId'));
        $skus = array($sku);
        $BQ->set_Skus($skus);
        $requestParams->id = Setting::CLEC_ID;
        $requestParams->firstName = Setting::CLEC_FIRSTNAME;
        $requestParams->lastName = Setting::CLEC_LASTNAME;
        $requestParams->details = $BQ;
        $request = $Api->buildRequest($requestParams);
        $Api->callAPI(Setting::URL, $request);
        $BQ->set_response($Api->response);
        // echo '<pre>' . var_export( $BQ->get_response(), true ) . '</pre>';
        // echo '<pre>' . var_export( $BQ->get_tax_total(), true ) . '</pre>';
        $fee += $BQ->get_tax_total();
    }
    // echo '<pre>' . var_export( $woocommerce->cart->get_cart(), true ) . '</pre>';
    // echo '<pre>' . var_export( $instance, true ) . '</pre>';
    $woocommerce->cart->add_fee( 'Sales Tax', $fee, true, 'standard' );
    return $instance;
}
add_action( 'woocommerce_cart_calculate_fees', 'custom_add_tax' );
function add_your_gateway_class( $methods ) {
    $methods[] = 'WC_Gateway_BeQuick'; 
    // echo var_dump($methods);
    return $methods;
}
add_filter( 'woocommerce_payment_gateways', 'add_your_gateway_class', 10, 1 );
/**
 * Set a custom add to cart URL to redirect to
 * @return string
 */
function custom_add_to_cart_redirect() { 
    // TODO
    return '/portal-checkout?sku=444'; 
}
add_filter( 'woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect' );
// Custom payment gateway
// function init_your_gateway_class() {
//     class WC_Gateway_Your_Gateway extends WC_Payment_Gateway {}
// }
// add_action( 'plugins_loaded', 'init_your_gateway_class' );
// function add_your_gateway_class( $methods ) {
//     $methods[] = 'WC_Gateway_Your_Gateway'; 
//     return $methods;
// }
// add_filter( 'woocommerce_payment_gateways', 'add_your_gateway_class' );
// Redirect customer after login
add_filter('woocommerce_login_redirect', 'wcs_login_redirect');
function wcs_login_redirect( $redirect ) {
 $redirect = '/';
 return $redirect;
}
// Removing Reviews
add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {
 unset($tabs['reviews']);
 return $tabs;
}
add_action('woocommerce_payment_complete', 'custom_process_order', 10, 1);
function custom_process_order($order_id) {
    $order = new WC_Order( $order_id );
    $myuser_id = (int)$order->user_id;
    $user_info = get_userdata($myuser_id);
    $items = $order->get_items();
    foreach ($items as $item) {
        if ($item['product_id']==24) {
          // Do something clever
        }
    }
    return $order_id;
}
add_filter( 'auth_cookie_expiration', 'login_expire' );
function login_expire( $expirein ) {
    return 3600; // 1 hour in seconds
}