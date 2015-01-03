<?php

/**
* Load theme textdomain
*/

add_action( 'after_setup_theme', 'degrona15_theme_setup' );

function degrona15_theme_setup() {
  load_child_theme_textdomain( 'DeGrona15', get_stylesheet_directory() . '/languages' );
}

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
  wp_register_script( 'web-font-loader','//ajax.googleapis.com/ajax/libs/webfont/1.5.6/webfont.js', array(), '1.0.0', false );
  wp_register_script( 'de_grona_15_foundation', get_stylesheet_directory_uri() . '/js/app.js', array('jquery'), '1.0.0', true );

  wp_register_style( 'de_grona_styles', get_stylesheet_directory_uri() . '/css/app.css', array(), '1.0.0', 'screen' );
  wp_enqueue_style( 'de_grona_styles' );

  // enqueue scripts
  wp_enqueue_script( 'de_grona_15_modernizr' );
  wp_enqueue_script( 'de_grona_15_jquery' );
  wp_enqueue_script( 'web-font-loader' );
  wp_enqueue_script( 'de_grona_15_foundation' );

}

/**
 * Include theme default options
 */
require_once( 'library/theme-default-options.php' );

/**
 * Include theme help page
 */
require_once( 'library/theme-help-page.php' );

/**
 * Include dependencies
 */
require_once( 'library/dependencies.php' );


/**
 * Add custom action: degrona15_add_candidate_content
 * This adds De_Grona_Ehdokas-plugin stuff to the front_page
 */
add_action( 'degrona15_add_candidate_content', 'degrona15_add_candidate_content', 1, 0 );

function degrona15_add_candidate_content(){

  if ( is_front_page() ) :
    // If De_Grona_Ehdokas-plugin is installed, retrieve $instance of the plugin
    if ( function_exists( 'De_Grona_Ehdokas' ) ) {
      $instance = De_Grona_Ehdokas::instance();
      if ( $instance->get_candidate_data( 'degrona15_candidate_enable_home_page' ) ) {
        $bg_img_id = $instance->get_candidate_data( 'degrona15_candidate_site_jumbotron' );
        if ( $bg_img_id ) {
          $bg_img = wp_get_attachment_image_src( $bg_img_id, 'full' );
        } else {
          $bg_img[0] = get_stylesheet_directory_uri() . '/assets/img/images/default-3.jpg';
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

/**
 * Add custom action: degrona15_add_candidate_contact_info
 * This adds De_Grona_Ehdokas-plugin contact information that is used in footer.php
 */
add_action( 'degrona15_add_candidate_contact_info', 'degrona15_add_candidate_contact_info', 1, 0 );
function degrona15_add_candidate_contact_info(){
  // If De_Grona_Ehdokas-plugin is installed, retrieve $instance of the plugin
    if ( function_exists( 'De_Grona_Ehdokas' ) ) {
      $instance = De_Grona_Ehdokas::instance();
      if ( $instance->get_candidate_data( 'degrona15_candidate_enable_home_page' ) ) {
        $data = $instance->get_candidate_contact_information_data(); ?>
        <div class="de_grona_candidate_info large-6 small-12 columns">
          <h3><?php bloginfo( 'name' ); ?></h3>
          <?php echo $data; ?>
        </div>
      <?php
      }
    }
 }