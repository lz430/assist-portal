<?

/** Load up scripts/styles */
function assist_scripts_styles() {
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-responsive', get_template_directory_uri().'/css/bootstrap-responsive.min.css');
    wp_enqueue_style('enrollment-form', get_template_directory_uri().'/css/enrollmentForm.css');

    wp_enqueue_script( 'html5shiv', get_template_directory_uri().'/js/html5shiv.js');
    wp_enqueue_script( 'superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'));
    wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'));
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
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), rand(111,9999));

    wp_enqueue_style('chart-style', get_template_directory_uri().'-child/css/horizBarChart.css', array(), rand(111,9999));
    // wp_enqueue_script('charts-script', get_template_directory_uri().'-child/js/jquery.canvasjs.min.js', array(), rand(111,9999));
    // wp_enqueue_script('portal', get_template_directory_uri().'-child/js/portal.js', array(), rand(111,9999));
}

add_action('wp_enqueue_scripts','assist_portal_scripts_styles');

add_theme_support( 'post-thumbnails' );

/** Sets up the custom menus in the header/footer */
add_action('init', 'register_assist_menus');
function register_assist_menus()
{
    register_nav_menu('header-menu', __('Header Menu'));
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
    #menu-posts-locations:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
        background-position:6px 6px !important;
    }
    #icon-edit.icon32-posts-locations {background: url(<?php bloginfo('template_url') ?>/images/admin-icon-map-large.png) no-repeat;}

    #menu-posts-commercials .wp-menu-image {
        background: url(<?php bloginfo('template_url') ?>/images/admin-icon-tv.png) no-repeat 6px -18px !important;
    }
    #menu-posts-commercials:hover .wp-menu-image, #menu-posts-commercials.wp-has-current-submenu .wp-menu-image {
        background-position:6px 6px !important;
    }
    #icon-edit.icon32-posts-commercials {background: url(<?php bloginfo('template_url') ?>/images/admin-icon-tv-large.png) no-repeat;}

    #menu-posts-cell-phone-plans .wp-menu-image {
        background: url(<?php bloginfo('template_url') ?>/images/admin-icon-phone.png) no-repeat 6px -18px !important;
    }
    #menu-posts-cell-phone-plans:hover .wp-menu-image, #menu-posts-cell-phone-plans.wp-has-current-submenu .wp-menu-image {
        background-position:6px 6px !important;
    }
    #icon-edit.icon32-posts-cell-phone-plans {background: url(<?php bloginfo('template_url') ?>/images/admin-icon-phone-large.png) no-repeat;}
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
        <label for="reg_register_phone"><?php _e( 'Phone', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="input" name="register_phone" id="reg_register_phone" value="<?php if ( ! empty( $_POST['register_phone'] ) ) esc_attr_e( $_POST['register_phone'] ); ?>" />
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
        $validation_errors->add( 'register_phone_error', __( '<strong>Error</strong>: Phone is required!.', 'woocommerce' ) );
    }

    if ( isset( $_POST['register_phone'] ) ) {
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

        if (!$BQ->isValidCustomer()) {
            $validation_errors->add( 'register_phone_error', __( 'Not a valid Assist Wireless phone number.', 'woocommerce' ) );
        } else {
            $_SESSION['customerId'] = $BQ->get_customerId();
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


?>
