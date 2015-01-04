<aside id="sidebar" class="small-12 large-4 columns">
	<?php do_action( 'foundationPress_before_sidebar' ); ?>
	<?php
    if ( is_active_sidebar( 'degrona15_sidebar' ) ) :
      dynamic_sidebar( 'degrona15_sidebar' );
    endif;
  ?>
	<?php do_action( 'foundationPress_after_sidebar' ); ?>
</aside>
