add_error( __( 'Please Enter Your First Name.', 'woocommerce' ) );
    $flag = false;
  }
  if($lastname == '')
  {
    $woocommerce->add_error( __( 'Please Enter Your Last Name.', 'woocommerce' ) );
    $flag = false;
  }
  if ( empty( $email ) || ! is_email( $email ) ) {
    $woocommerce->add_error( __( 'Please provide a valid email address', 'woocommerce' ) );
    $flag = false;
  }
  if ( email_exists( $email ) ) {
    $woocommerce->add_error( __( 'An account is already registered with your email address. Please login.', 'woocommerce' ) );
    $flag = false;
  }
  if($password == '')
  {
    $woocommerce->add_error( __( 'Please enter an account password.', 'woocommerce' ) );
    $flag = false;
  }
  if($password2 == '')
  {
    $woocommerce->add_error( __( 'Please enter an account confirm password.', 'woocommerce' ) );
    $flag = false;
  }else if($password2 != $password)
  {
    $woocommerce->add_error( __( 'Account Password Does Not Match.', 'woocommerce' ) ); 
    $flag = false;
  }
  if($reg_captcha == '')
  {
    $woocommerce->add_error( __( 'Please Enter Security Code.', 'woocommerce' ) );
    $flag = false;
  }
  if($flag == true)
  {
    $new_customer = wc_create_new_customer( $email, $username, $password );
    if ( is_wp_error( $new_customer ) ) {
      wc_add_notice( $new_customer->get_error_message(), 'error' );
      return;
    }else 
    {
      wc_set_customer_auth_cookie( $new_customer );
      // Redirect
      if ( wp_get_referer() ) {
          $redirect = esc_url( wp_get_referer() );
      } else {
          $redirect = esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) );

      }
  
      wp_redirect( apply_filters( 'woocommerce_registration_redirect', $redirect ) ); 
    }
  }     

}
$md5_hash_reg = md5(rand(0,999)); 

//We don't need a 32 character long string so we trim it down to 5 
$security_code_reg = substr($md5_hash_reg, 15, 5); 
//Set the session to store the security code
$_SESSION["security_code_reg"] = $security_code_reg;

?>















      

      

             *

      <input type="text" class="checkout-input mg-right input-text" name="firstname" id="reg_firstname"  value=""  />

            *

      <input type="text" class="checkout-input mg-right input-text" name="lastname" id="reg_lastname"  value="" />

      

           *

          <input type="text" class="checkout-input input-text" name="username" id="reg_username" value="" />

      

     *

    <input type="email" class="checkout-input input-text" name="email" id="reg_email" value="" />

      


            


           

   *

  <input type="password" class="checkout-input input-text" name="password" id="reg_password" value="" />

         *

                <input type="password" class="checkout-input" name="password2" id="reg_password2" value="" />

                        
      


      

      

               *

              

              

        

                

                          

              Captha is not match with captha code

                

           

            


            


        

        <input type="submit" class="button" name="register_custom" id="submit" value="" />

      



      

    

        




        

<script>

jQuery( "#reg_captcha" ).keyup(function() {

  var ucaptha = jQuery('#reg_captcha').val();

  var captcha='';

  if(ucaptha != captcha){

    jQuery('#captcha-error').css('display', '');

    jQuery('#submit').attr('disabled', 'disabled');

  }

  else {

    jQuery('#captcha-error').css('display', 'none');

    jQuery('#submit').removeAttr('disabled');

  }

});

</script>