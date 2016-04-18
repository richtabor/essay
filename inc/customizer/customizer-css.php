<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package Essay
 */


/*===================================================================*/                						
/*  THEME CUSTOMIZER STYLES	                							
/*===================================================================*/
if ( !function_exists('Bean_Customize_Variables') ) {
	function Bean_Customize_Variables() {
	
	//COLOR VARIABLES
	$theme_accent_color = get_theme_mod('theme_accent_color', '#007AFF');

	//TYPOGRAPHY VARIABLES
	$type_select_headings = get_theme_mod('type_select_headings');
	$type_select_body = get_theme_mod('type_select_body');
?>		
	
	
	
<style><?php


	// Convert main text hex color to rgba.
	$theme_accent_color_rgb = essay_hex2rgb( $theme_accent_color );

	//If the rgba values are empty return early.
	if ( empty ( $theme_accent_color_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$opacity_05  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.05)', $theme_accent_color_rgb );
	$opacity_33  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.33)', $theme_accent_color_rgb );
	$opacity_50  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.5)', $theme_accent_color_rgb );
	$opacity_75  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.75)', $theme_accent_color_rgb );





/*===================================================================*/        	
/*  THEME CUSTOMIZER COLORS/STYLES                							
/*===================================================================*/	
$customizations = 
'
a:hover,
a:focus,
a:active, 
.page-links a span:not(.page-links-title):hover,
.page-links span:not(.page-links-title) { color:'.$theme_accent_color.'; }
 
p a:hover { background-image: linear-gradient(to bottom, rgba(0,0,0,0) 50%, '.$theme_accent_color.' 50%); }
 

.entry-categories a:hover,
.site-hero .entry-header h1 span,
.site-hero .entry-header h2 span { border-color:'.$theme_accent_color.'!important; }


.cats,
p a:hover,
h1 a:hover, 
.author-tag,
.logo a h1:hover,
.tagcloud a:hover,
nav ul li a:hover,
.widget li a:hover,
.entry-meta a:hover,
.header-alt a:hover,
.pagination a:hover,
.post-after a:hover,
.comment-author a:hover,
.bean-tabs > li.active > a,
.bean-panel-title > a:hover,

.archives-list ul li a:hover,

nav ul li.current-menu-item a,
.bean-tabs > li.active > a:hover,
.bean-tabs > li.active > a:focus,
#colophon .inner .subtext a:hover,
.bean-pricing-table .pricing-column li.info:hover,
.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-item-title,
.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-item-title,
.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-caption,
.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-caption { color:'.$theme_accent_color.'!important; }

#nprogress .bar,
.bean-btn,
.tagcloud a,
nav a h1:hover, 
div.jp-play-bar,
.avatar-list li a.active,
div.jp-volume-bar-value,
.bean-direction-nav a:hover,
.bean-pricing-table .table-mast,
.entry-categories a:hover, 
.pagination .prev:hover,
.pagination .prev:focus,
.pagination .next:hover,
.pagination .next:focus,
.post .post-slider.fade .bean-direction-nav a:hover { background-color:'.$theme_accent_color.'; }



button,
.button,
button[disabled]:hover,
button[disabled]:focus,
input[type="button"],
input[type="button"][disabled]:hover,
input[type="button"][disabled]:focus,
input[type="reset"],
input[type="reset"][disabled]:hover,
input[type="reset"][disabled]:focus,
input[type="submit"],
input[type="submit"][disabled]:hover,
input[type="submit"][disabled]:focus { border-color:'.$opacity_50.' !important ; } 



.comment-buttons a, .comment-form .form-submit input { color:'.$opacity_75.' !important; }

.comment-buttons a:hover, 
.comment-buttons a.active,
.comment-form .form-submit input:hover { 
	color:'.$theme_accent_color.' !important; 
	border-color:'.$theme_accent_color.' !important;
	background-color:'.$opacity_05.' !important; 
} 


button:hover,
button:focus,
.button:hover,
.button:focus,
input[type="button"]:hover,
input[type="button"]:focus,
input[type="reset"]:hover,
input[type="reset"]:focus,
input[type="submit"]:hover,
input[type="submit"]:focus { background:'.$theme_accent_color.'; border-color:'.$theme_accent_color.' ; } 

input[type="text"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="password"]:focus,
input[type="search"]:focus,
textarea:focus {	
}

.bean-btn { border: 1px solid '.$theme_accent_color.'!important; }

.bean-quote { background-color:'.$theme_accent_color.'!important; }
';  




//PAGE TEXT ALIGNMENT
$page_text_align = get_post_meta(get_the_ID(), '_bean_page_text_align', true);
if($page_text_align) { 
     echo '.entry-content {text-align:'.$page_text_align.'!important;}';
} 



if( !get_theme_mod( 'use_emphasis' ) ) {
	echo '.site-hero .entry-header h1 span, .site-hero .entry-header h2 span { border: none !important; padding: 0 !important;}';
}


$css_filter_style = get_theme_mod( 'css_filter' );
if( $css_filter_style != '' ) {
    switch ( $css_filter_style ) {
        case 'none':
            // DO NOTHING
            break;
        case 'grayscale':
          echo '.image-background, .video-background { filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); filter:gray; -webkit-filter:grayscale(100%);-moz-filter: grayscale(100%);-o-filter: grayscale(100%);}';
            break;
        case 'sepia':
        	echo '.image-background, .video-background { -webkit-filter: sepia(50%); }';
            break;
         case 'saturation':
         	echo '.image-background, .video-background { -webkit-filter: saturate(150%); }';
            break;      
    }
}



//IF PORTFOLIO CSS FILTERS
$css_filter_style = get_theme_mod( 'css_filter' );
if( $css_filter_style != '' ) {
	switch ( $css_filter_style ) {
		case 'none':
          // DO NOTHING
		break;
		case 'grayscale':
			echo 'article .entry-content-media .post-thumb img, .post-inner { -webkit-filter: grayscale(100%); }';
			echo 'section:hover .entry-content-media .post-thumb img, section:hover .post-inner { -webkit-filter: grayscale(0%); }';
			echo '.widget img { -webkit-filter: grayscale(100%); } .widget:hover img { -webkit-filter: grayscale(0%); }';
		break;
		case 'sepia':
			echo 'section .entry-content-media .post-thumb img, .post-inner  { -webkit-filter: sepia(60%); }';
			echo 'section:hover .entry-content-media .post-thumb img, section:hover .post-inner { -webkit-filter: sepia(0%); }';
			echo '.widget img { -webkit-filter: sepia(100%); } .widget:hover img { -webkit-filter: sepia(0%); }';
		break;    
	}
}


if( get_theme_mod('sliding_panel') ) {  echo '.row {padding: 0 50px 0 70px!important;}'; }




/*===================================================================*/         	
/*  BEAN PRICING TABLE PLUGIN, IF ACTIVATED	                							
/*===================================================================*/	
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); if (is_plugin_active('bean-pricingtables/bean-pricingtables.php')) { 
	echo '.bean-pricing-table .pricing-column li span {color:'.$theme_accent_color.'!important;}#powerTip,.bean-pricing-table .pricing-highlighted{background-color:'.$theme_accent_color.'!important;}#powerTip:after {border-color:'.$theme_accent_color.' transparent!important; }';
}





/*===================================================================*/         	
/*  CUSTOM CSS	                							
/*===================================================================*/	
$customcss = get_theme_mod( 'bean_tools_css' );




/*===================================================================*/         	
/*  FINAL OUTPUT                							
/*===================================================================*/	
//COMBINE THE VARIABLES FROM ABOVE
$customizer_final_output =  $customizations . $customcss;

$final_output = preg_replace('#/\*.*?\*/#s', '', $customizer_final_output);
$final_output = preg_replace('/\s*([{}|:;,])\s+/', '$1', $final_output);
$final_output = preg_replace('/\s\s+(.*)/', '$1', $final_output);
echo $final_output;
?>
</style>
<?php } add_action( 'wp_head', 'Bean_Customize_Variables', 1 );
}