<?php
  /*
  * * Template Name: Portal Thank You Page
  * * @package assist-portal 
  */
  get_header();
  ?>
  <h1 align="center">SUCCESS!</h1>
  <h1 align="center">Thank you for your payment!</h1>
  <p style="text-align:center;"><img src="http://ap.430designs.com/wp-content/uploads/2015/11/ThumbsUp.png" alt="Thumbs Up" align="middle" width="250" height="250" ></p>
  <h3 align="center">Please note, it may take up to 1 hour for your payment and top-up to post to your account. </h3>
  <p align="center">You'll be redirected to your account dashboard in a moment - or click <a href="http://ap.430designs.com/">HERE</a> to go back to your account dashboard  now.</p>
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