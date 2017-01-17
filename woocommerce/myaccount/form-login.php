<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php wc_print_notices(); ?>

<!-- Banner -->
<img src="<?php echo get_template_directory_uri(); ?>/images/banner-promo-login.png" alt="Login Promotion">

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
	<div class="row" id="customer_login">
		<div class="col-lg-2 col-md-2 col-sm-hidden col-xs-hidden"></div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
<?php endif; ?>
		<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>
		<form method="post" class="login">
			<?php do_action( 'woocommerce_login_form_start' ); ?>
			<p class="form-row form-row-wide">
				<label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="input" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			</p>
			<p class="form-row form-row-wide">
				<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input class="input" type="password" name="password" id="password" />
			</p>
			<?php do_action( 'woocommerce_login_form' ); ?>
			<p class="form-row login-button">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
				<label for="rememberme" class="inline">
					<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
				</label>
			</p>
			<p class="lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>
			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</form>
<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>
		<form method="post" class="register">
			<img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" alt="Loading..." class="loading">
			<div class="hide-me">
				<?php do_action( 'woocommerce_register_form_start' ); ?>
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
					<p class="form-row form-row-wide">
						<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="text" class="input" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</p>
				<?php endif; ?>
				<p class="form-row form-row-wide">
					<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="email" class="input" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
				</p>
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
					<p class="form-row form-row-wide">
						<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="password" class="input" name="password" id="reg_password" />
					</p>
				<?php endif; ?>
				<!-- Spam Trap -->
				<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php //do_action( 'register_form' ); ?>
				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-register' ); ?>
					<input type="submit" class="button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
				</p>
				<?php do_action( 'woocommerce_register_form_end' ); ?>
			</div> <!-- end hidden-->
		</form>
	</div><!-- end register columns-->
	<div class="col-lg-2 col-md-2 col-sm-hidden col-xs-hidden"></div>	
</div>
<?php endif; ?>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
	<div class="container">
		<div class="col-lg-2 col-md-2 col-sm-hidden col-xs-hidden"></div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<p><strong>Welcome to the Assist Wireless Customer Portal!</strong> Login or create an account to check your voice, text, and data balance, purchase a top-up, and pay your bill.
			</br></br>To register for the portal, you will need to:<ul>
  <li>Provide your <strong>email address</strong>.</li>
  <li>Create a new <strong>password</strong>.</li>
  <li>Provide your <strong>Assist Wireless phone number</strong>.</li>
  <li>Provide your <strong>date of birth</strong> in this format: YYYY-MM-DD</li>
</ul>
			If you have any questions or if you need help, call us at <strong>(855) 392-7747</strong>.</p>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-hidden col-xs-hidden"></div>
	</div>