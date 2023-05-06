<?php
/*
Plugin Name: My Recent Posts Carousel
Description: A WordPress plugin that displays recent posts as a background image carousel.
Version: 1.0
Author: Your Name
Author URI: Your website
License: GPL2
*/

function my_recent_posts_carousel() {
  // query pentru a obține ultimele 5 postări
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 5
  );
  $query = new WP_Query( $args );
  
  // începutul caruselului
  $output = '<div class="owl-carousel owl-theme">';
  
  // iterează prin fiecare postare și adaugă o casetă în carusel
  while ( $query->have_posts() ) {
    $query->the_post();
    $output .= '<div class="item" data-bg="' . get_the_post_thumbnail_url() . '">';
    $output .= '<h3>' . get_the_title() . '</h3>';
    $output .= '</div>';
  }
  
  // încheierea caruselului
  $output .= '</div>';
  
  // restabilirea query-ului WordPress
  wp_reset_postdata();
  
  // returnează caruselul
  return $output;
}

// adaugă un shortcode pentru a afișa caruselul în pagini și postări
function my_recent_posts_carousel_shortcode() {
  return my_recent_posts_carousel();
}
add_shortcode( 'my_recent_posts_carousel', 'my_recent_posts_carousel_shortcode' );

// adaugă stilurile CSS și scripturile JavaScript necesare
function my_recent_posts_carousel_scripts() {
  wp_enqueue_style( 'owl-carousel', plugins_url( 'owl.carousel.min.css', __FILE__ ) );
  wp_enqueue_style( 'owl-theme', plugins_url( 'owl.theme.default.min.css', __FILE__ ) );
  wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'owl-carousel', plugins_url( 'owl.carousel.min.js', __FILE__ ), array( 'jquery' ), '2.3.4', true );
  wp_enqueue_script( 'my-recent-posts-carousel', plugins_url( 'my-recent-posts-carousel.js', __FILE__ ), array( 'owl-carousel' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_recent_posts_carousel_scripts' );
