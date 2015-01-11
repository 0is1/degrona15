<?php
/*
Template Name: Front Page
*/
get_header(); ?>

<?php do_action( 'degrona15_add_candidate_content' ); ?>
<div class="row">
<?php do_action( 'degrona15_before_page_content' ); ?>
  <?php if ( is_active_sidebar( 'degrona15_frontpage_full' ) ) : ?>
      <div class="front-page-widgets clearfix">
      <?php dynamic_sidebar( 'degrona15_frontpage_full' ); ?>
      </div>
  <?php endif; ?>
  <div class="small-12 large-12 columns" role="main">
  <?php /* Start loop */ ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; // End the loop ?>
  </div>
<?php do_action( 'degrona15_after_page_content' ); ?>
</div>
<?php get_footer(); ?>
