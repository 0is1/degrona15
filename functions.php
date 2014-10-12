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