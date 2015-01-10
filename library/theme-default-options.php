<?php

/*
* Check if title-tag theme_support is available (WP 4.1+)
* If not, use fallback filter: degrona15_title
*/
if ( ! function_exists( '_wp_render_title_tag' ) ) :

  add_filter( 'wp_title', 'degrona15_custom_title', 10, 2 );

  function degrona15_title() { ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
  <?php
  }
  add_action( 'wp_head', 'degrona15_title' );

else :
  /*
  * Let WordPress manage the document title.
  * By adding theme support, we declare that this theme does not use a
  * hard-coded <title> tag in the document head, and expect WordPress to
  * provide it for us.
  */
  add_theme_support( 'title-tag' );

endif;

function degrona15_custom_title( $title, $sep ){
  if ( is_feed() ) {
    return $title;
  }

  global $page, $paged;

  // Add the blog name
  $title .= get_bloginfo( 'name', 'display' );

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " $sep $site_description";
  }

  // Add a page number if necessary:
  if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
    $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
  }

  return $title;
}

// Add default post / page and navigation in after_switch_theme hook
add_action( 'after_switch_theme', 'degrona15_setup_options', 100 );

function degrona15_setup_options() {

  // update_option( 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/' );

  $hello_world = get_post( 1, 'ARRAY_A' );
  // By default we check only english and finnish versions of default post/page
  if( $hello_world && $hello_world['post_title'] == 'Hello world!' || $hello_world['post_title'] == 'Moikka maailma!') :
    // TODO: translations!
    wp_update_post(
      array (
            'ID'            => 1,
            'post_title'    => 'Tiedote: Tervetuloa käyttämään WordPressiä!',
            'post_name'     => 'tiedote-tervetuloa-kayttamaan-wordpressia',
            'post_content'  => 'Tämä on sivuston esimerkkiartikkeli. Artikkeleita on hyvä käyttää mm. blogitekstien julkaisemiseen. Poista tämä teksti hallintapaneelista -> Artikkelit -> Kaikki artikkelit -> valitse "Tiedote: Tervetuloa käyttämään WordPressiä!"-artikkeli ja siirrä se roskakoriin. Voit kirjoittaa uusia artikkeleita valitsemalla "Lisää uusi" Artikkelit-sivulla.'
      ) );
  endif;

  $sample_page = get_post( 2, 'ARRAY_A' );
  // By default we check only english and finnish versions of default post/page
  if( $sample_page && $sample_page['post_title'] == 'Sample Page' || $sample_page['post_title'] == 'Esimerkkisivu') :
    wp_update_post(
      array (
            'ID'            => 2,
            'post_title'    => __('Home', 'DeGrona15'),
            'post_name'     => __('home', 'DeGrona15'),
            'post_content'  => ''
      ) );
    update_option( 'page_on_front', 2 );
    update_option( 'show_on_front', 'page' );

  endif;


  $posts_page_id = get_option( 'page_for_posts' );
  $blog_page_already_exists = false;

  if( ! $posts_page_id && ! get_page_by_path( 'blogi' )) :

    $posts_page_id = wp_insert_post( array('post_title' => __('Blog', 'DeGrona15'), 'post_name' => __('blog', 'DeGrona15'), 'post_status' => 'publish', 'post_type' => 'page' ) );

    if( $posts_page_id ) :

      update_option( 'page_for_posts', $posts_page_id );

    endif;

  else :

    $blog_page_already_exists = true;

  endif;

  if ( ! has_nav_menu( 'top-bar-l' ) ) :

    $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

    if( ! $menus ){

      $menu_id = wp_create_nav_menu( __( 'The Main Menu', 'DeGrona15' ) );

      /**
      * Set up default menu items
      * If posts page is set above: add blog-page to menu as well
      */

        wp_update_nav_menu_item( $menu_id, 0,
          array(
            'menu-item-title' =>  __('Home', 'DeGrona15'),
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'
          )
        );

        if( $posts_page_id && ! $blog_page_already_exists ){

          wp_update_nav_menu_item( $menu_id, 0,
            array(
              'menu-item-title' =>  __('Blog', 'DeGrona15'),
              'menu-item-object-id' => $posts_page_id,
              'menu-item-object' => 'page',
              'menu-item-type'      => 'post_type',
              'menu-item-status' => 'publish'
            )
          );
      }

      // Add menu to mobile and top-bar-l
      $menu_defaults = array(
        'mobile-off-canvas' => $menu_id,
        'top-bar-l' => $menu_id
      );

      set_theme_mod('nav_menu_locations', $menu_defaults);

    } else {
      // Add menu to mobile and top-bar-l
      $menu_defaults = array(
        'mobile-off-canvas' => $menus[0]->term_id,
        'top-bar-l' => $menus[0]->term_id
      );

      set_theme_mod('nav_menu_locations', $menu_defaults);
    }

  endif;

}

// Add default widget image in after_switch_theme hook
add_action( 'after_switch_theme', 'degrona15_fire_set_default_widget_image', 10 );
add_filter( 'degrona15_set_default_widget_image', 'degrona15_set_default_widget_image', 1, 0 );

// Call degrona15_set_default_widget_image filter
function degrona15_fire_set_default_widget_image(){
  apply_filters( 'degrona15_set_default_widget_image', '' );
}

// Set default image
function degrona15_set_default_widget_image(){

  // Check if default image is set
  $default_image = get_option( 'degrona15_default_image_id' );

  // If default image is not set, let's create it
  if ( ! $default_image ) :
    // We need these to use download_url() and media_handle_sideload()
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    // Default image URI
    // $url = 'https://dl.dropboxusercontent.com/u/11862254/vihreat/default-degrona-image-widget.jpg';
    $url = get_stylesheet_directory_uri() .'/assets/img/images/default-degrona-image-widget.jpg';
    $tmp = download_url( $url );
    $file_array = array(
      'name' => basename( $url ),
      'tmp_name' => $tmp
    );

    // Check for download errors
    if ( is_wp_error( $tmp ) ) {
      @unlink( $file_array[ 'tmp_name' ] );
      return $tmp;
    }

    $id = media_handle_sideload( $file_array, 0 );
    // Check for handle sideload errors.
    if ( is_wp_error( $id ) ) {
      @unlink( $file_array['tmp_name'] );
      return $id;
    }

    update_option( 'degrona15_default_image_id', $id );

    return $id;

  else :

    return $default_image;

  endif;
}

// Add default widgets in after_switch_theme hook
add_action( 'after_switch_theme', 'degrona15_call_setup_widgets', 9999 );

function degrona15_call_setup_widgets(){
  add_action( 'wp_loaded', 'degrona15_setup_widgets' );
}

function degrona15_setup_widgets(){

  if( ! is_active_sidebar( 'degrona15_frontpage_full' ) ) :

    $default_image_id = get_option( 'degrona15_default_image_id' );

    if( ! $default_image_id ) :

      $default_image_id = apply_filters( 'degrona15_set_default_widget_image', '' );

    endif;

    if ( ! is_wp_error( $default_image_id ) ) :

      $default_widgets = array (
        'degrona15_frontpage_full' => array (
          0 => 'simpleimage-1',
          1 => 'simpleimage-2'
        )
      );

      update_option( 'widget_simpleimage',
        array (
          1 => array (
            'title' => __( 'Vaaliteema 1', 'DeGrona15' ),
            'text' => __( 'Tässä esittelen vaaliteemaa numero yksi. Kylläpä se onkin hieno teema! Lisää vaaliteemasta voi lukea painamalla Read more -painiketta.', 'DeGrona15' ),
            'link' => __( 'vihreat.fi', 'DeGrona15' ),
            'link_text' => __( 'Read more', 'DeGrona15' ),
            'image_size' => 'full',
            'image_id' => $default_image_id
            ),
          2 => array (
            'title' => __( 'Vaaliteema 2', 'DeGrona15' ),
            'text' => __( 'Tässä on toinen vaaliteema! Se on vähintään yhtä mainio, kuin ensimmäinenkin.

Tekstiä voi kirjoittaa myös toiselle riville! Pääset muokkaamaan kuvia ja tekstiä hallintapaneelissa: Ulkoasu &rarr; Vimpaimet ', 'DeGrona15' ),
            'link' => __( 'vihreat.fi', 'DeGrona15' ),
            'link_text' => __( 'Read more', 'DeGrona15' ),
            'image_size' => 'full',
            'image_id' => $default_image_id
            )
          )
      );

      update_option( 'sidebars_widgets',  $default_widgets );

    endif;

  endif;

  // if( ! is_active_sidebar( 'degrona15_frontpage_socialmedia' ) ) :

  //   $default_widgets = array (
  //     'degrona15_frontpage_socialmedia' => array (
  //       0 => 'TODO'
  //     )
  //   );

  //   update_option( 'TODO',
  //     array (
  //       1 => array (
  //         'title' => 'TODO'
  //         )
  //       )
  //   );

  //   $defaults_now = get_option( 'sidebars_widgets' );
  //   $merged_defaults_widgets = array_merge( $defaults_now, $default_widgets );

  //   update_option( 'sidebars_widgets',  $merged_defaults_widgets );

  // endif;

}