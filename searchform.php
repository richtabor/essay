<?php
/**
 * The template for displaying the theme searchform.
 *
 * @package Essay
 */
 ?>

<form role="search" method="get" id="search-form" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html__( 'Search for:', 'essay' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_html__('Click to search...', 'essay') ?>" name="s" title="Search for:" onfocus="if(this.value=='<?php esc_html__('Click to search...', 'essay') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php esc_html__('Click to search...', 'essay') ?>';" />
	</label>
</form>