<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Essay
 */
?>

<section class="no-results not-found">

	<header class="page-header">
		<h6 class="page-title"><?php esc_html_e( 'Nothing Found', 'essay' ); ?></h6>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php get_search_form(); ?>
	</div><!-- .page-content -->
	
</section><!-- .no-results -->
