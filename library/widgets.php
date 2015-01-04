<?php

function degrona15_register_widgets() {
  register_sidebar(array(
      'id' => 'degrona15_frontpage_full',
      'name' => __('Frontpage widgets', 'DeGrona15'),
      'description' => __('Drag frontpage widgets to this container', 'DeGrona15'),
      'before_widget' => '<section id="%1$s" class="large-12 columns widget %2$s">',
      'after_widget' => '</section>',
      'before_title' => '<h6>',
      'after_title' => '</h6>'
  ));

  register_sidebar(array(
      'id' => 'degrona15_frontpage_socialmedia',
      'name' => __('Frontpage social media widgets', 'DeGrona15'),
      'description' => __('Drag social media widgets to this container', 'DeGrona15'),
      'before_widget' => '<section id="%1$s" class="large-12 columns widget %2$s">',
      'after_widget' => '</section>',
      'before_title' => '<h6>',
      'after_title' => '</h6>'
  ));

  register_sidebar(array(
      'id' => 'degrona15_sidebar',
      'name' => __('Sidebar widgets', 'DeGrona15'),
      'description' => __('Drag widgets to this sidebar container.', 'DeGrona15'),
      'before_widget' => '<section id="%1$s" class="row widget %2$s"><div class="small-12 large-4 columns">',
      'after_widget' => '</div></section>',
      'before_title' => '<h6>',
      'after_title' => '</h6>'
  ));

  register_sidebar(array(
      'id' => 'degrona15_footer',
      'name' => __('Footer widgets', 'DeGrona15'),
      'description' => __('Drag widgets to this footer container', 'DeGrona15'),
      'before_widget' => '<section id="%1$s" class="large-12 columns widget %2$s">',
      'after_widget' => '</section>',
      'before_title' => '<h6>',
      'after_title' => '</h6>'
  ));
}

add_action( 'widgets_init', 'degrona15_register_widgets' );

?>