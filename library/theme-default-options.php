<?php

add_action('after_switch_theme', 'degrona15_setup_options', 100 );

function degrona15_setup_options() {

  update_option('permalink_structure', '/%year%/%monthnum%/%day%/%postname%/' );

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