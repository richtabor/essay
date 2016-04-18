<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Essay
 */



if ( ! function_exists( 'essay_jetpack_setup' ) ) :
function essay_jetpack_setup() {



	/*
	 * Let JetPack manage the site logo.
	 * By adding theme support, we declare that this theme does use the default
	 * JetPack Site Logo functionality, if the module is activated. 
	 *
	 * See: http://jetpack.me/support/site-logo/
	 */
	add_theme_support( 'site-logo' );



	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main', // Don't change this
		'render'    => 'essay_scroll_render',
		'footer'    => 'page',
		'wrapper'    => false,
	) );
}
endif;
add_action( 'after_setup_theme', 'essay_jetpack_setup' );



if ( ! function_exists( 'essay_scroll_render' ) ) :
/**
 * Define the code that is used to render the posts added by Infinite Scroll.
 * Create your own essay_scroll_render() to override in a child theme.
 */
function essay_scroll_render() {

	while ( have_posts() ) {
		the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('article fadein'); ?>>

			<?php
			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_format() ); ?>
		
		</article> 
	<?php
	}
}
endif;