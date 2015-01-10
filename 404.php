<?php get_header(); ?>

<div class="row">
<?php do_action( 'degrona15_before_page_content' ); ?>
	<div class="small-12 large-8 columns" role="main">

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php _e('Page Not Found', 'DeGrona15'); ?></h1>
			</header>
			<div class="entry-content">
				<div class="error">
					<p class="bottom"><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'DeGrona15'); ?></p>
				</div>
				<p><?php _e('Please try the following:', 'DeGrona15'); ?></p>
				<ul>
					<li><?php _e( 'Check your spelling', 'DeGrona15' ); ?></li>
					<li><?php printf( __( 'Return to the <a href="%s">home page</a>', 'DeGrona15' ), home_url() ); ?></li>
					<li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'DeGrona15' ); ?></li>
					<li><?php _e( 'Try search &darr;', 'DeGrona15' ); ?></li>
				</ul>
				<?php get_search_form(); ?>
			</div>
		</article>

	</div>
<?php do_action( 'degrona15_after_page_content' ); ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
