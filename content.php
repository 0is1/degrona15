<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php degrona15_entry_meta(); ?>
	</header>
	<div class="entry-content">
		<?php the_excerpt(); ?>
		<p class="more button radius"><a href="<?php the_permalink();?>"><?php _e( 'Continue reading', 'DeGrona15' ); ?></a></p>
	</div>
	<footer>
		<?php $tag = get_the_tags(); if (!$tag) { } else { ?><p><?php the_tags(); ?></p><?php } ?>
	</footer>
	<hr />
</article>
