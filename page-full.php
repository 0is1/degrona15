<?php
/*
Template Name: Full Width
*/
get_header(); ?>
<div class="row">
<?php do_action( 'degrona15_before_page_content' ); ?>
	<div class="small-12 large-12 columns" role="main">
	<?php /* Start loop */ ?>
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'DeGrona15'), 'after' => '</p></nav>' )); ?>
				<p><?php the_tags(); ?></p>
			</footer>
			<?php comments_template(); ?>
		</article>
	<?php endwhile; // End the loop ?>

	</div>
<?php do_action( 'degrona15_after_page_content' ); ?>
</div>
<?php get_footer(); ?>
