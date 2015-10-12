<?php
/**
 * Template Name: Portal Login Page
 */
get_header();
?>
<div class="container">
  <div id="login" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>Lifeline Cell Phone Service</h1>
    <p class="message"></p>
  <form name="loginform" id="loginform" action="http://ap.430designs.com/wp-login.php" method="post">
    <p>
      <label for="user_login">Username<br>
      <input type="text" name="log" id="user_login" aria-describedby="login_error" class="input" value="" size="20"></label>
    </p>
    <p>
      <label for="user_pass">Password<br>
      <input type="password" name="pwd" id="user_pass" aria-describedby="login_error" class="input" value="" size="20"></label>
    </p>
    <p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p>
    <p class="submit">
      <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary" value="Log In">
      <input type="hidden" name="redirect_to" value="https://www.assistwireless.com/dev/wp-admin/">
      <input type="hidden" name="testcookie" value="1">
    </p>
  </form>
  <p id="nav">
    <a href="https://www.assistwireless.com/dev/my-account/lost-password/" title="Password Lost and Found">Lost your password?</a>
  </p>
    <p id="backtoblog"><a href="<?php echo get_bloginfo('url'); ?>" title="Are you lost?">← Back to Lifeline Cell Phone Service</a></p>
    
    </div>
  </div>
  <?php get_footer(); ?>