<?php

/**
* Single.php template
*/

?>

<?php get_header(); ?>
<div class="row">
<?php do_action( 'degrona15_before_page_content' ); ?>
	<div class="columns small-12 large-6" role="main">

	<?php do_action('foundationPress_before_content'); ?>
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class( ); ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php degrona15_entry_meta(); ?>
			</header>
			<?php do_action('foundationPress_post_before_entry_content'); ?>
			<div class="entry-content">

			<?php if ( has_post_thumbnail() ): ?>
				<div class="row">
					<div class="column">
						<?php the_post_thumbnail('', array('class' => 'th')); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php the_content(); ?>
			</div>
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'DeGrona15'), 'after' => '</p></nav>' )); ?>
				<p><?php the_tags(); ?></p>
			</footer>
			<?php do_action('foundationPress_post_before_comments'); ?>
			<?php comments_template(); ?>
			<?php do_action('foundationPress_post_after_comments'); ?>
		</article>
	<?php endwhile;?>

<?php do_action('foundationPress_after_content'); ?>
</div>
<?php get_sidebar(); ?>
<?php do_action( 'degrona15_after_page_content' ); ?>
</div>
<?php get_footer(); ?>
