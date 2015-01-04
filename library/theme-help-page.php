<?php

/**
 * Redirect to help page after activating the theme
 */

add_action('after_switch_theme', 'degrona15_after_switch_theme');

function degrona15_after_switch_theme(){
  $redirect_to = admin_url() . 'themes.php?page=degrona15-theme-help-page';
  wp_redirect($redirect_to);
}

/**
 * Create the help page
 */
add_action( 'admin_menu', 'degrona15_add_theme_pages' );

function degrona15_add_theme_pages(){
  add_theme_page( __( 'About theme', 'DeGrona15' ), __( 'About theme', 'DeGrona15' ), 'edit_theme_options', 'degrona15-theme-help-page', 'degrona15_theme_help_page' );
  add_theme_page( __( 'DeGröna 15', 'DeGrona15' ), __( 'DeGröna 15', 'DeGrona15' ), 'edit_theme_options', 'degrona15-theme-settings-page', 'degrona15_theme_settings_page' );

}

/**
 * Redirect user after successful login.
 */
function degrona15_login_redirect( $redirect_to, $request, $user ) {
  //is there a user to check?
  global $user, $blog_id;

  $has_logged_in = get_user_meta( $user->ID, '_degrona15_dismiss_theme_help_page_' . $blog_id, true);

  if ( isset( $user->ID ) && ! $has_logged_in ) {
     $redirect_to = admin_url() . 'themes.php?page=degrona15-theme-help-page';
     update_user_meta( $user->ID, '_degrona15_dismiss_theme_help_page_' . $blog_id, 1 );
     return $redirect_to;
  } else {
    return $redirect_to;
  }
}

add_filter( 'login_redirect', 'degrona15_login_redirect', 10, 3 );

/**
 * Help page content.
 */
function degrona15_theme_help_page(){
  ?>
  <div class="wrap about-wrap">
    <h1><?php _e( 'Information about DeGröna 15-theme ', 'DeGrona15' ); ?></h1>
    <div class="about-text"><?php _e('DeGröna15-theme is designed especially for election candidates. You can easily add your personal information, image, vote number and frontpage background image (and much more) in <a href="admin.php?page=de_grona_ehdokas_settings">Candidate\'15 -page</a>', 'DeGrona15' ); ?>
    </div>
    <div class="about-theme">
      <div class="feature-section col two-col">
        <div>
          <img src="<?php echo get_stylesheet_directory_uri();?>/screenshot.png" alt="<?php _e( 'DeGröna 15 -theme', 'DeGrona15' ); ?>" title="<?php _e( 'DeGröna 15 -theme', 'DeGrona15' ); ?>">
        </div>
        <div>
          <h4><?php _e( 'Focus is in important things', 'DeGrona15' ); ?></h4>
          <p><?php _e( 'Theme is designed for election candidates. It is simple and fits in many needs. Theme design gets readers attention directly to the campaign main points.', 'DeGrona15' ); ?></p>
          <p><?php _e( 'Donate and "Get Involed" -pages encourage visitors to act.', 'DeGrona15' ); ?></p>
          <p><?php _e( 'Edit theme settings <a href="themes.php?page=degrona15-theme-settings-page">here.</a>', 'DeGrona15' ); ?></p>

        </div>
      </div>
    </div>

    <hr>

    <div class="return-to-dashboard">
      <?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
        <a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
          <?php is_multisite() ? _e( 'Return to Updates' ) : _e( 'Return to Dashboard &rarr; Updates' );?></a> |
      <?php endif; ?>
        <a href="<?php echo esc_url( self_admin_url() ); ?>">
          <?php is_blog_admin() ? _e( 'Go to Dashboard &rarr; Home' ) : _e( 'Go to Dashboard' ); ?></a>
    </div>


  </div>
  <?php
}

/**
 * Settings page content.
 */
function degrona15_theme_settings_page(){
  ?>
  <div class="wrap about-wrap">
    <h1><?php _e( 'DeGröna 15-theme settings', 'DeGrona15' ); ?></h1>
  </div>
  <?php
}
