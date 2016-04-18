<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Essay
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main">

		<?php if ( have_posts() ) :

			$count = 0;
			$i = 1; 

			// Start the loop.
			while ( have_posts() ) : the_post();

				$count++;

				if ($count == 1) :
					
					/*
					 * Display the hero area for the first post.
					 */ 
					?>

					<div id="post-<?php the_ID(); ?>" <?php post_class('site-hero fullscreen'); ?>> 
						<?php get_template_part( 'template-parts/hero' ); ?>
					</div>

				<?php else : ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>

			 		<?php
			 		/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
			 		get_template_part( 'template-parts/content', get_post_format() );
			 		?>

				</article>

				<?php

			// End the loop.
			$i++; endif; endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous page', 'essay' ),
				'next_text'          => esc_html__( 'Next page', 'essay' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'essay' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
		
		</main><!-- .site-main -->
		
	</div><!-- .content-area -->

<?php get_footer();