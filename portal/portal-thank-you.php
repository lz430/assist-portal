<?php
  /*
  * * Template Name: Portal Thank You Page
  * * @package assist-portal 
  */
  get_header();

  $url  = $_SERVER['HTTP_REFERER'];
  $keys = parse_url($url); // parse the url
  $path = explode("/", $keys['path']); // splitting the path
  
?>
<?php 
  switch ($path[1]){
    case "auto-payment": 
      $thankyou = "Thank you for enrolling!";
      $mainline = "Please note, it may take up to 1 hour for changes to post to your account.";
      break;

    case "make-payment":
      $thankyou = "Thank you for your payment!";
      $mainline = "Please note, it may take up to 1 hour for your payment and top-up to post to your account. ";
      break;

    default:
      $thankyou = "Thank you!";
      $mainline = "Please note, it may take up to 1 hour for changes to post to your account. ";
  }
?>
  <h1 align="center">SUCCESS!</h1>
  <h1 align="center"><?php echo $thankyou ?></h1>
  <p style="text-align:center;"><img src="http://portal.assistwireless.com/wp-content/uploads/2015/12/ThumbsUp.png" alt="Thumbs Up" align="middle" width="250" height="250" ></p>
  <h3 align="center">Please note, it may take up to 1 hour for your payment and top-up to post to your account. </h3>
  <p align="center">You'll be redirected to your account dashboard in a moment - or click <a href="http://portal.assistwireless.com/">HERE</a> to go back to your account dashboard  now.</p>
  <?php 
    // WP_Query arguments
    $args = array (
    );
    // The Query
    $query = new WP_Query( $args );
    // The Loop
    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
        $query->the_post();
        the_content();
      }
    } else {
      // no posts found
    }
    // Restore original Post Data
    wp_reset_postdata();
   ?>
  <?php get_footer(); ?>