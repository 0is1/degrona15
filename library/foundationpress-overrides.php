<?php

/**
 * Remove parent theme scripts so we can handle all the scripts that are included
 * @see de_grona_15_add_scripts()
 */
remove_action( 'wp_enqueue_scripts', 'FoundationPress_scripts', 1 );

/**
* Remove parent theme widgets (because it's easier to handle all the sidebars in this theme)
*/
function remove_parent_theme_widgets(){

  unregister_sidebar( 'sidebar-widgets' );
  unregister_sidebar( 'footer-widgets' );

}

add_action( 'widgets_init', 'remove_parent_theme_widgets', 11 );

/**
* Unset parent theme page templates that we don't want to show
*/
function remove_parent_theme_page_templates( $templates ) {
    unset( $templates['kitchen-sink.php'] );
    unset( $templates['hero.php'] );
    return $templates;
}

add_filter( 'theme_page_templates', 'remove_parent_theme_page_templates' );