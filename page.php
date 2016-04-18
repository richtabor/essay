<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Essay
 */

get_header(); ?>

	<div id="primary" class="content-area">
		
		<main id="main" class="site-main">

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'template-parts/content', 'page' );

			// End of the loop.
			endwhile;
			?>

		</main><!-- .site-main -->

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>