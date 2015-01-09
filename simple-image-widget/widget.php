<?php
/**
 * Default widget template.
 *
 * Copy this template to /simple-image-widget/widget.php in your theme or
 * child theme to make edits.
 *
 * @package   SimpleImageWidget
 * @copyright Copyright (c) 2014, Blazer Six, Inc.
 * @license   GPL-2.0+
 * @since     4.0.0
 */
?>
<?php echo '<div class="row simple-image-content">'; ?>
	<?php echo '<div class="column large-6 small-12 image-wrap">'; ?>
	<?php if ( ! empty( $image_id ) ) : ?>
		<div class="simple-image">
			<figure class="left" title="<?php echo $link_text; ?> – <?php echo $link; ?>">
				<?php
					echo $link_open;
					echo wp_get_attachment_image( $image_id, $image_size );
					echo $link_close;
				?>
			</figure>
		</div>
	<?php endif; ?>
	<?php echo '</div>'; ?>
	<?php echo '<div class="column large-6 small-12">'; ?>
	<?php
	if ( ! empty( $title ) ) :
		echo $before_title . $title . $after_title;
	endif;
	?>

	<?php
	if ( ! empty( $text ) ) :
		echo wpautop( $text );
	endif;
	?>

	<?php if ( ! empty( $link_text ) && ! empty( $text_link_open ) ) : ?>
		<p class="more button radius" title="<?php echo $link_text; ?> – <?php echo $link; ?>">
			<?php
			echo $text_link_open;
			echo $link_text;
			echo $text_link_close;
			?>
		</p>
	<?php endif; ?>
	<?php echo '</div>'; ?>
<?php echo '</div>'; ?>