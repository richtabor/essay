<?php
/**
 * The template for displaying Author biography
 *
 * @package Essay
 */
?>

<div class="author-info">
	<div class="avatar-wrapper">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'essay_author_bio_avatar_size', 180 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .avatar-wrapper -->

	<div class="author-description">
		<h4 class="author-title"><span class="author-heading"><?php esc_html_e( 'Written by', 'essay' ); ?></span> <?php echo esc_html( get_the_author() ); ?></h4>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( esc_html__( 'View all posts by %s', 'essay' ), esc_html( get_the_author() ) ); ?>
			</a>
		</p><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .author-info -->