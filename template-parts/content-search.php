<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Essay
 */
?>

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