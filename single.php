<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package Essay
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main">

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'single' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	// End of the loop.
	endwhile;
	?>

	</main><!-- .site-main -->

</div><!-- .content-area -->
		
<?php get_footer();