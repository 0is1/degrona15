<?php do_action('FoundationPress_before_searchform'); ?>
<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div class="row collapse">
		<?php do_action('FoundationPress_searchform_top'); ?>
		<div class="small-8 column">
			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'DeGrona15' ); ?>">
		</div>
		<?php do_action('FoundationPress_searchform_before_search_button'); ?>
		<div class="small-4 column">
			<input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'DeGrona15' ); ?>" class="prefix button success">
		</div>
		<?php do_action('FoundationPress_searchform_after_search_button'); ?>
	</div>
</form>
<?php do_action('FoundationPress_after_searchform'); ?>
