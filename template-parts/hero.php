<?php
/**
 *  The template for displaying the hero area.
 * 
 *  @package Essay
 */

//  Video meta.
$video_url = get_post_meta($post->ID, '_bean_video_url', true);
$video_embed = get_post_meta($post->ID, '_bean_video_embed', true);


//  Stylistic options for the hero area.
$blur_option = ( get_theme_mod( 'use_blur' ) == true ? 'blur' : false ); 
$parallax_option = ( get_theme_mod( 'use_parallax' ) == true ? 'parallax' : false ); 
$style_options = $blur_option .' '. $parallax_option;
?>

<div class="inner">

	<?php echo sprintf( '<a href="%s" rel="bookmark" class="entry-link"></a>', esc_url( get_permalink() )); ?>
	
	<header class="entry-header">
		<div class="inner">
			<?php

			if ( is_sticky() && is_home() && ! is_paged() ) {
				printf( '<h5 class="sticky-post">%s</h5>', esc_html__( 'Featured', 'essay' ) );
			} else {
				if ( !is_singular('page') ) {
					printf( _x( '<h5 class="days-ago">%s ago</h5>', '%s = human-readable time difference', 'essay' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
				}
			}
			
			if ( is_singular() ) :
	               the_title( '<h1 class="entry-title"><span>', '</span></h1>');
	          else : 
	               the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark"><span>', esc_url( get_permalink() ) ), '</span></a></h2>' );
	          endif; 
	        
			if ( !is_singular('page') ) { ?>
			 	<aside class="entry-aside">
		        		<h5><cite></cite><?php essay_entry_meta(); ?><cite></cite></h5>
		          </aside>
			<?php } 

	         if ( has_excerpt() ) { 
				echo '<h4 class="entry-intro">'. get_the_excerpt() .'</h4>';
	          } ?>

	          <?php 
			// Post ID + Permalink.
	          printf( '<div class="postcount"><a href="%1$s" rel="bookmark">#%2$s</a></div>', esc_url( get_permalink() ), esc_html( get_the_ID() ) ); ?>

			
			<a href="#post-<?php the_ID(); ?>" class="scroll-more"></a>
			
		</div>

	</header>

	<?php if ( get_post_format() === 'video' ) : ?>

		<?php if( $video_url ) { ?>
	          <video class="video-background <?php echo esc_html($style_options);?>" autoplay="" loop="" muted="" controls>
	          	<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
	          </video>
	     <?php } elseif ( $video_embed ) { ?>
	          <div class="video-background embedded <?php echo esc_html($style_options);?> ">
	               <?php echo stripslashes(htmlspecialchars_decode($video_embed)); ?>
	          </div>
	     <?php } else { } 

     endif; ?>
	
     <div class="image-background <?php echo esc_html($style_options);?>" style="<?php echo esc_html( essay_hero_background('') ); ?>"></div>

</div><!-- .inner -->