</section>
<footer class="row">
	<?php do_action( 'foundationPress_before_footer' ); ?>

  <?php
    if ( is_active_sidebar( 'footer-widgets' ) ) :
      dynamic_sidebar( 'footer-widgets' );
    endif;
  ?>

  <?php do_action( 'foundationPress_after_footer' ); ?>
  <?php do_action( 'degrona15_add_candidate_contact_info' ); ?>
</footer>

	<?php do_action('foundationPress_layout_end'); ?>
	</div>
</div>
<?php wp_footer(); ?>
<?php do_action('foundationPress_before_closing_body'); ?>
</body>
</html>
