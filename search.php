<?php get_header(); ?>
<div class="row">
<?php do_action( 'degrona15_before_page_content' ); ?>
	<div class="small-12 large-8 columns" role="main">

		<?php do_action('foundationPress_before_content'); ?>

		<h2><?php _e('Search Results for', 'DeGrona15'); ?> "<?php echo get_search_query(); ?>"</h2>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>

	<?php endif;?>

	<?php do_action( 'foundationPress_before_pagination' ); ?>

	<?php if ( function_exists('FoundationPress_pagination') ) { FoundationPress_pagination(); } else if ( is_paged() ) { ?>

		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'DeGrona15' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'DeGrona15' ) ); ?></div>
		</nav>
	<?php } ?>

	<?php do_action( 'foundationPress_after_content'); ?>

	</div>
	<?php get_sidebar(); ?>
	<?php do_action( 'degrona15_after_page_content' ); ?>
</div>

<?php get_footer(); ?>
