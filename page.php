<?php get_header(); ?>
<div class="row">
<?php do_action( 'degrona15_before_page_content' ); ?>
	<div class="small-12 large-8 columns" role="main">

	<?php do_action('foundationPress_before_content'); ?>

	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<?php do_action('foundationPress_page_before_entry_content'); ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'DeGrona15'), 'after' => '</p></nav>' )); ?>
				<p><?php the_tags(); ?></p>
			</footer>
		</article>
	<?php endwhile;?>

	<?php do_action('foundationPress_after_content'); ?>

	</div>
	<?php get_sidebar(); ?>
	<?php do_action( 'degrona15_after_page_content' ); ?>
</div>
<?php get_footer(); ?>
