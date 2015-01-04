<aside id="sidebar" class="small-12 large-4 columns">
	<?php do_action( 'foundationPress_before_sidebar' ); ?>
	<?php
    if ( is_active_sidebar( 'sidebar-widgets' ) ) :
      dynamic_sidebar( 'sidebar-widgets' );
    endif;
  ?>
	<?php do_action( 'foundationPress_after_sidebar' ); ?>
</aside>
