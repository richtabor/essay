<?php
/**
 * The template used for displaying page content
 *
 * @package Essay
 */
 ?>

<div <?php post_class( 'site-hero ' . esc_html('not-fullscreen') . ' ' . esc_html('not-fullscreen')); ?>> 
	<?php get_template_part( 'template-parts/hero' ); ?>
</div>

<div class="hero-bottom">
	<div class="triangle"></div>
	<div class="fill"></div>
</div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content">
		
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'essay' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'essay' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->

	<?php 
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
 	?>

<?php get_sidebar(); ?>