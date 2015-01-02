<?php

add_action('after_switch_theme', 'degrona15_setup_options', 100 );

function degrona15_setup_options() {
  if ( ! has_nav_menu( 'top-bar-l' ) ) {

    $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

    if( ! $menus ){

      $menu_id = wp_create_nav_menu( __( 'The Main Menu', 'DeGrona15' ) );

      // Set up default menu items
      wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title' =>  __('Home', 'DeGrona15'),
        'menu-item-url' => home_url( '/' ),
        'menu-item-status' => 'publish')
      );
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

  }

  // update_option('permalink_structure', '/%year%/%monthnum%/%day%/%postname%/' );

  // Check if theme is switched first time or not
  $first_theme_switch = get_option( 'degrona15_theme_switched' );

  if ( ! $first_theme_switch ) :
    // This is first switch to theme: let's edit default post/page

    $hello_world = get_post( 1, 'ARRAY_A' );

    if( $hello_world && $hello_world['post_title'] == 'Hello World!' || $hello_world['post_title'] == 'Moikka maailma!') :
      wp_update_post(
        array (
              'ID'            => 1,
              'post_title'    => 'Tiedote: Tervetuloa käyttämään WordPressiä!',
              'post_content'  => 'Tämä on sivuston esimerkkiartikkeli. Artikkeleita on hyvä käyttää mm. blogitekstien julkaisemiseen. Poista tämä teksti hallintapaneelista -> Artikkelit -> Kaikki artikkelit -> valitse "Tiedote: Tervetuloa käyttämään WordPressiä!"-artikkeli ja siirrä se roskakoriin. Voit kirjoittaa uusia artikkeleita valitsemalla "Lisää uusi" Artikkelit-sivulla.'
        ) );
    endif;

    $sample_page = get_post( 2, 'ARRAY_A' );

    if( $sample_page && $sample_page['post_title'] == 'Sample Page' || $sample_page['post_title'] == 'Esimerkkisivu') :
      wp_update_post(
        array (
              'ID'            => 2,
              'post_title'    => 'Etusivu',
              'post_content'  => ''
        ) );
    endif;

    update_option( 'degrona15_theme_switched', true );

  endif;

}