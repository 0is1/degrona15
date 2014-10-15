<?php

/**
 * Remove parent theme scripts so we can handle all the scripts that are included
 * @see de_grona_15_add_scripts()
 */
remove_action( 'wp_enqueue_scripts', 'FoundationPress_scripts', 1 );

/**
 * Add De Gröna 15 scripts action
 */
add_action( 'wp_enqueue_scripts', 'de_grona_15_add_scripts', 1, 0 );

/**
 * Add De Gröna 15 scripts
 */
function de_grona_15_add_scripts(){

  // deregister the jquery version bundled with wordpress
  wp_deregister_script( 'jquery' );

  // register scripts
  wp_register_script( 'de_grona_15_modernizr', get_stylesheet_directory_uri() . '/js/modernizr/modernizr.min.js', array(), '1.0.0', false );
  wp_register_script( 'de_grona_15_jquery', get_stylesheet_directory_uri() . '/js/jquery/dist/jquery.min.js', array(), '1.0.0', false );
  wp_register_script( 'de_grona_15_foundation', get_stylesheet_directory_uri() . '/js/app.js', array('jquery'), '1.0.0', true );

  // enqueue scripts
  wp_enqueue_script('de_grona_15_modernizr');
  wp_enqueue_script('de_grona_15_jquery');
  wp_enqueue_script('de_grona_15_foundation');

}

/**
 * Include dependencies
 */
require_once( 'library/dependencies.php' );

/**
 * Add custom action: degrona15_before_content
 * This adds De_Grona_Ehdokas-plugin stuff to the front_page
 */
add_action( 'degrona15_before_content', 'degrona15_before_content', 1, 0 );

function degrona15_before_content(){

  if ( is_front_page() ) :
    // If De_Grona_Ehdokas-plugin is installed, retrieve $instance of the plugin
    if ( function_exists( 'De_Grona_Ehdokas' ) ) {
      $instance = De_Grona_Ehdokas::instance();
      if ( $instance->get_candidate_data( 'degrona15_candidate_enable_home_page' ) ) {
        $bg_img_id = $instance->get_candidate_data( 'degrona15_candidate_site_jumbotron' );
        if ( $bg_img_id ) {
          $bg_img = wp_get_attachment_image_src( $bg_img_id, 'full' );
        }

        $data = $instance->get_candidate_home_page_data(); ?>

        <div class='de_grona_candidate_jumbotron' style='background-image: url(<?php echo $bg_img[0];?>);'>
          <div class='row'>
          <?php echo $data; ?>
          </div>
        </div>
      <?php
      }
    }
  endif;
}