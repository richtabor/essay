<?php
/**
 * The header for our theme.
 *
 * @package Essay
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class('js--preload'); ?> data-layout="<?php echo esc_html( get_theme_mod('blog_layout', 'blog-4') );?>">

<div id="page" class="hfeed site">

<header id="masthead" class="site-header">
	
	<div class="site-wrapper">

		<?php essay_site_logo(); ?>
		
		<?php if ( has_nav_menu( 'primary' ) ) : ?>

			<a id="nav-btn" class="nav-btn" href="javascript:void(0);"><span><?php _e( 'Navigation', 'essay' ); ?></span></a>
			
			<div id="fullscreen-nav" class="fullscreen-nav">
				
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'primary-menu',
						'depth'		  => '2',
					 ) );
					?>

					<?php if ( has_nav_menu( 'social' ) ) : ?>
						<nav id="social-navigation" class="social-navigation" role="navigation">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'		  => '1',
									'link_before'    => '<i class="icon fa"></i><span class="screen-reader-text">',
									'link_after'     => '</span>'
								) );
							?>
						</nav><!-- .social-navigation -->
					<?php endif; ?>

				</nav><!-- .main-navigation -->

			</div><!--  .fullscreen-menu -->

		<?php endif; ?>

	</div><!--  .site-wrapper -->

</header><!-- .site-header -->