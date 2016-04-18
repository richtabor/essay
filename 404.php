<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Essay
 */
 
get_header(); ?>
	
	<div id="primary" class="content-area">

		<main id="main" class="site-main">
		
			<section class="error-404 not-found">

				<header class="page-header">
					<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'essay' ); ?></p>
				</header><!-- .page-header -->
				
				<div class="page-content">
					<p><a href="javascript:javascript:history.go(-1)"><?php esc_html_e( 'Go back', 'essay' ); ?></a><?php esc_html_e( ' or ', 'essay' ); ?><a href="<?php echo esc_url( home_url('/') ); ?>"><?php esc_html_e( 'go home', 'essay' ); ?></a> &rarr;</p>
	 			</div><!-- .page-content -->

	 		</section><!-- .error-404 -->

		</main><!-- .site-main -->
	
	</div><!-- .content-area -->
	
<?php get_footer();