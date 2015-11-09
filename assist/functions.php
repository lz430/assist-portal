<?

add_action( 'wpmem_post_register_data', 'my_auto_login', 1 );
function my_auto_login( $fields )
{
	/** if you want to send confirmation email the user */
	require_once( WPMEM_PATH . '/wp-members-email.php' );
	wpmem_inc_regemail($fields['ID'],$fields['password'],WPMEM_MOD_REG);
	
	/** notify admin of new reg, remove if not notifying admin */
	$wpmem_fields = get_option( 'wpmembers_fields' );
	//wpmem_notify_admin( $fields['ID'], $wpmem_fields );
	
	/** assemble login credentials */
	$creds = array();
	$creds['user_login']    = $fields['username'];
	$creds['user_password'] = $fields['password'];
	$creds['remember']      = true;

	/** wp_signon the user and get the $user object */
	$user = wp_signon( $creds, false );

	/** if no error, user is a valid signon. continue */
	if( ! is_wp_error( $user ) ) {

		/** set the auth cookie */
		wp_set_auth_cookie( $fields['ID'], true );

		/** and do the redirect */
		wp_redirect( $fields['wpmem_reg_url'] );

		/** wp_redirect requires us to exit() */
		exit();
	}
}


include_once (TEMPLATEPATH . '/functions-woocommerce-custom.php');

/** Load up scripts/styles */
function assist_scripts_styles() {
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-responsive', get_template_directory_uri().'/css/bootstrap-responsive.min.css');

    wp_enqueue_script( 'html5shiv', get_template_directory_uri().'/js/html5shiv.js');
    wp_enqueue_script( 'superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'));
    wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script( 'jquery-masked-input', get_template_directory_uri().'/js/jquery.masked.input.js', array('jquery'));
    wp_enqueue_script( 'jquery-validate', get_template_directory_uri().'/js/jquery.validate.js', array('jquery'));
    wp_enqueue_script( 'assist',    get_template_directory_uri().'/js/assist.js', array('jquery','bootstrap','superfish'));
}
add_action('wp_enqueue_scripts', 'assist_scripts_styles');


// Portal Styles
function assist_portal_scripts_styles() {
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/portal/css/portal.css');
}
if(is_page( array('login' ) )){
    add_action('wp_enqueue_scripts', 'assist_portal_scripts_styles');
}



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

/** Google static map images */
function assist_static_map($address, $width=200, $height=150) {
    $url = "https://maps.googleapis.com/maps/api/staticmap?center=".urlencode($address)."&zoom=14&size=".$width."x".$height."&maptype=roadmap&sensor=false&visual_refresh=false";
    $url.= "&markers=color:red%7c".urlencode($address);
    echo "<img class='map' src='".$url."' width='".$width."' height='".$height."' alt='".$address."'/>";
}

function assist_static_map_large($address) {
    assist_static_map($address, 500, 400);
}

function assist_static_map_link($address) {
    $url = "http://maps.google.com/?q=".urlencode($address);
    echo "<a target='_blank' href='".$url."'>View Larger Map</a>";
}

function assist_static_gplus_link($address) {
    echo $address;
}

function approve_affiliate( $atts ){

    $lead_id = $_REQUEST["entry"];
    $lead = RGFormsModel::get_lead( $lead_id );
    $form = GFFormsModel::get_form_meta( $lead['form_id'] );

    $values= array();
    foreach( $form['fields'] as $field ) {
        $values[$field['label']] =  $lead[$field['id']];
    }

    $name = $values["Affiliate Name"];
    $desc = $values["Affiliate Description"];
    $contact = $values["Affiliate Contact Information"];
    $email = $values["Email"];


    $post = array(
        'post_content'   => $desc,
        'post_name'      => $name,
        'post_status'    => 'publish',
        'post_title'     => $name,
        'post_type'      => 'affiliate'
    );

    $postId = wp_insert_post( $post );

    add_post_meta($postId, "wpcf-contact-information", $contact);

    $permalink = get_permalink( $postId );

    $confirmation = "Congratulations, your Assist Wireless affiliate page has been approved! Your affiliate page can be viewed here: <a href='".$permalink."'></a>";
    $confirmation .= "nnThank you,";
    $confirmation .= "nAssist Wireless,";

    wp_mail( $email, "Assist Wireless Affiliate Confirmation", $confirmation );

    $out = "Affiliate request approved. A message has been sent to the affiliate confirming their request. Their affiliate page can be viewed here: <a href='".$permalink ."'>".$permalink . "</a>";

   return $out;
}
add_shortcode( 'approveAffiliate', 'approve_affiliate' );



function db_decrypt($field) {
    return "AES_DECRYPT(`".$field."`, '".AES_ENCRYPTION_KEY."') as ".$field;
}

function db_encrypt($value) {
    if($value) {
        return "AES_ENCRYPT('".mysql_real_escape_string($value)."', '".AES_ENCRYPTION_KEY."')";
    }
    return $value;
}

function db_field($value) {
    if($value) {
        return "'".mysql_real_escape_string($value)."'";
    }
    return $value;
}

?>