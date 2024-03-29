<?php

/**
* Load theme textdomain
*/

add_action( 'after_setup_theme', 'degrona15_theme_setup' );

function degrona15_theme_setup() {
  load_child_theme_textdomain( 'DeGrona15', get_stylesheet_directory() . '/languages' );
}

/**
 * Include foundationpress overrides
 */
require_once( 'library/foundationpress-overrides.php' );

/**
 * Include theme default options
 */
require_once( 'library/theme-default-options.php' );

/**
 * Include theme scripts
 */
require_once( 'library/scripts.php' );

/**
 * Include theme help page
 */
require_once( 'library/theme-help-and-settings-page.php' );

/**
 * Include dependencies
 */
require_once( 'library/dependencies.php' );

/**
 * Include theme default widgets
 */
require_once( 'library/theme-default-widgets.php' );

/**
 * Include theme widget areas
 */
require_once( 'library/widgets.php' );

/**
 * Include entry-meta
 */
require_once( 'library/entry-meta.php' );

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
          $bg_img[0] = $instance->get_jumbtoron_default_bg();
        }

        $data = $instance->get_candidate_home_page_data(); ?>

        <div class='de_grona_candidate_jumbotron' style='background-image: url(<?php echo $bg_img[0];?>);'>
          <!-- <div class='row'> -->
          <?php echo $data; ?>
          <!-- </div> -->
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
      <div class="de_grona_candidate_info large-6 medium-6 small-12 columns">
        <h3><?php bloginfo( 'name' ); ?></h3>
        <?php echo $data; ?>
        <div class="logo">
          <a href="<?php _e( 'http://vihreat.fi', 'DeGrona15' ); ?>" title="<?php _e( 'Vihreät De Gröna', 'DeGrona15' ); ?>">
            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/images/vihreat-logo.png" alt="<?php _e( 'Vihreät De Gröna', 'DeGrona15' ); ?>" width="200">
          </a>
        </div>
      </div>
    <?php
    }
  }
 }

/**
 * Add custom action: degrona15_add_call_to_action_buttons
 * This adds De_Grona_Ehdokas-plugin "call to action" -buttons
 */
add_action( 'degrona15_add_call_to_action_buttons', 'degrona15_add_call_to_action_buttons', 1, 0 );
function degrona15_add_call_to_action_buttons(){
  if ( function_exists( 'De_Grona_Ehdokas' ) ) {
    $instance = De_Grona_Ehdokas::instance();
    $data = $instance->get_call_to_action_buttons();
    if ( !empty( $data ) ) : ?>
      <div class="call-to-action-buttons large-4 medium-6 small-12 columns">
        <?php echo $data; ?>
      </div>
  <?php
    endif;
  }
}

add_action( 'degrona15_before_page_content', 'degrona15_before_page_content', 1, 0 );
function degrona15_before_page_content(){ ?>
  <div class="content-wrap clearfix">
<?php
}

add_action( 'degrona15_after_page_content', 'degrona15_after_page_content', 1, 0 );
function degrona15_after_page_content(){ ?>
  </div>
<?php
}