<?php
/**
 * Fonts functionality
 *
 * @package Essay Pro
 */


 
function bean_font_family($font) {
	$family = str_replace(" ", "+", $font);
	return $family;
}



function bean_enqueue_fonts() {
	$default = array(
		'default',
		'Default',
		'arial',
		'Arial',
		'courier',
		'Courier',
		'verdana',
		'Verdana',
		'trebuchet',
		'Trebuchet',
		'georgia',
		'Georgia',
		'times',
		'Times',
		'tahoma',
		'Tahoma',
		'helvetica',
		'Helvetica'
	);

	$fonts = array();

	//ADD IN MORE FONTS HERE, IF THE FONT FAMILY CHANGES IN THE CUSTOMIZER
	$body_font_family = get_theme_mod('body_font_family');
	$header_font_family = get_theme_mod('header_font_family');
	
	if($body_font_family != '') { $fonts[] = $body_font_family; }	
	if($header_font_family != '') { $fonts[] = $header_font_family; }
	
	//REMOVE DUPLICATES
	$fonts = array_unique($fonts);

	//CHECK GOOGLE FONTS AGAINST SYSTEM, CALL ENQUE
	foreach($fonts as $font) 
	{
		//GOOGLE FONTS CHECK
		if(!in_array($font, $default)) 
		{
			bean_enqueue_google_fonts($font);
		}
		
	}
}
add_action( 'wp_enqueue_scripts', 'bean_enqueue_fonts' );



function bean_enqueue_google_fonts($font) {
	$font = explode(',', $font);
	$font = $font[0];

	//CUSTOM CHECKS FOR CERTAIN FONTS
	if ( $font == 'Open Sans' ){
		$font = 'Open Sans:400,600';
	} else {
		$font = $font . ':400,500,700';
	}

	//FRIENDLY MOD
	$font = str_replace(" ", "+", $font);
	
	//CSS ENQUEUE
	wp_enqueue_style( "bean-google-$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}