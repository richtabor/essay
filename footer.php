<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #page div and all content after
 *
 * @package Essay
 */
?>

</div><!-- #page.site -->

<footer id="footer" class="site-footer">

	<div class="site-wrapper">

		<p class="site-info">

			<?php
			$visibility = ( false == get_theme_mod( 'powered_by_wordpress' ) ) ? 'hidden' : '' ;
			if ( get_theme_mod( 'powered_by_wordpress' ) || is_customize_preview() ) : ?>
				<a href="http://wordpress.org/" class="powered-by-wordpress <?php echo esc_html($visibility); ?>"><?php printf( __( 'A %s Run Website', 'essay' ), 'WordPress' ); ?></a>
			<?php endif; 

			if ( get_theme_mod( 'powered_by_essay' ) AND get_theme_mod( 'powered_by_wordpress' ) ) {
				echo '<span class="sep"> | </span>';
			}

			$visibility = ( false == get_theme_mod( 'powered_by_essay' ) ) ? 'hidden' : '' ;
			if ( get_theme_mod( 'powered_by_essay' ) || is_customize_preview() ) : ?>
				<a href="https://themebeans.com/themes/essay" class="powered-by-essay" class="powered-by-essay <?php echo esc_html($visibility); ?>"><?php printf( __( 'Powered by %s', 'essay' ), 'Essay' ); ?>
			<?php endif; ?>

		</p><!-- .site-info -->
		
		<a href="#page" class="back-to-top"><?php esc_html_e('To Top', 'essay'); ?></a>
		
	</div><!-- .site-wrapper -->

</footer><!-- .footer -->

<?php wp_footer(); ?>

</body>
</html>