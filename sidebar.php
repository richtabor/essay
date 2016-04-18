<?php
/**
 * The sidebar containing the main widget area for pages.
 * Content bottom widget areas on posts and pages
 *
 * @package Essay
 */

if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) )
	return;
	// If we get this far, we have widgets. Let do this.
	
	// Establish a variable to retrieve the footer layout option from the Customizer.
	$footer_layout = get_theme_mod('footer_layout', 'footer-1');
	?>

<div id="content-bottom-widgets" class="content-bottom-widgets <?php echo esc_html($footer_layout); ?>" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
</div><!-- .content-bottom-widgets -->