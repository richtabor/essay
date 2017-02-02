<?php
/**
 * Essay Customizer functionality
 *
 * @package Essay
 */


/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function bean_customize_register( $wp_customize ) {



	/**
	 * Remove unnecessary controls.
	 */
	$wp_customize->remove_section( 'colors');
	$wp_customize->remove_control('blogdescription');
	$wp_customize->remove_control('site_logo_header_text');



	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path() . '/inc/customizer/custom-controls/slider.php';
	require get_parent_theme_file_path() . '/inc/customizer/custom-controls/content.php';
	require get_parent_theme_file_path() . '/inc/customizer/custom-controls/range.php';
	require get_parent_theme_file_path() . '/inc/customizer/custom-controls/image-radio/image-radio.php';
	


	/**
	 * Top-Level Customizer sections and panels.
	 */
	
	// Add the Theme Options top-level panel.
	$wp_customize->add_panel( 'essay_theme_options', array(
		'title' 				=> esc_html__( 'Settings', 'essay' ),
		'description' 			=> esc_html__( 'Customize various options throughout the theme with the settings within this panel.', 'essay' ),
		'priority' 			=> 90,
	) );



	/**
	 * Theme Customizer Sections.
	 * For more information on Theme Customizer settings and default sections:
	 *
 	 * @see https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */



	/**
	 * Add the layout section.
	 */
	$wp_customize->add_section( 'pro_layout_content', array(
		'title' 						=> esc_html__( 'Layout', 'essay' ),
		'panel'       					=> 'essay_theme_options',
	) );

			// Upsell content.
			$wp_customize->add_setting( 'layout_content', array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'bean_sanitize_nohtml',
			) );

			$wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'layout_content', array(
				'type' 				=> 'content',
				'label' 				=> esc_html__( 'Layout Settings', 'essay' ),
			     'description' 			=> sprintf( __( '<a target="_blank" href="%1$s" class="button button-secondary">Get Access to Layout Settings</a>', 'essay' ), esc_url( PRO_UPGRADE_URL ) ),
				'section'				=> 'pro_layout_content',
				'input_attrs' 			=> array( 'content' => __( '<p>Select one of six grid layouts for the blogroll and index pages, and set a footer layout - with either one column or two.</p><ul><li>6 Grid Layout Options</li><li>Footer Widget Area</li><li>One or Two Column Footer</li></ul>', 'essay' ) 
				),
			) ) );



	/**
	 * Add the hero area section.
	 */
	$wp_customize->add_section( 'pro_heroarea_content', array(
		'title' 						=> esc_html__( 'Hero', 'essay' ),
		'panel'       					=> 'essay_theme_options',
	) );

			// Upsell content.
			$wp_customize->add_setting( 'heroarea_content', array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'bean_sanitize_nohtml',
			) );

			$wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'heroarea_content', array(
				'type' 				=> 'content',
				'label' 				=> esc_html__( 'Hero Area Settings', 'essay' ),
			     'description' 			=> sprintf( __( '<a target="_blank" href="%1$s" class="button button-secondary">Get Access to Hero Area Settings</a>', 'essay' ), esc_url( PRO_UPGRADE_URL ) ),
				'section'				=> 'pro_heroarea_content',
				'input_attrs' 			=> array( 'content' => __( '<p>Customize your posts by enabling the fullscreen effect seen on the Essay demo, blurring filter, parallax effect and hero title emphasis.</p><ul><li>Hero Fullscreen Effect</li><li>Hero Blur Effect</li><li>Hero Parallax Effect</li><li>Hero Title Emphasis</li></ul>', 'essay' ) 
				),
			) ) );



	/**
	 * Add the blog section.
	 */
	$wp_customize->add_section( 'essay_theme_options_blog', array(
		'title' 				=> esc_html__( 'Blog', 'essay' ),
		'panel'       			=> 'essay_theme_options',
	) );	

			// Add the dropcap setting and control.
			$wp_customize->add_setting( 'use_dropcap', array(
				'default'           	=> FALSE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'use_dropcap', array(
				'type' 				=> 'checkbox',
				'label'       			=> esc_html__( 'Use drop caps', 'essay' ),
				'description' 			=> esc_html__( 'Enable drop caps on single post pages. A drop cap is a large capital letter at the beginning of the post content. ', 'essay' ),
				'section' 			=> 'essay_theme_options_blog',
			) );

			// Add the dropcap setting and control.
			$wp_customize->add_setting( 'show_next', array(
				'default'           	=> FALSE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'show_next', array(
				'type' 				=> 'checkbox',
				'label'       			=> esc_html__( 'Show next post feature', 'essay' ),
				'description' 			=> esc_html__( 'Enable the next post pagination on the footer of the single post view.', 'essay' ),
				'section' 			=> 'essay_theme_options_blog',
			) );

			// Add the categories setting and control.
			$wp_customize->add_setting( 'show_category', array(
				'default'           	=> FALSE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'show_category', array(
				'type' 				=> 'checkbox',
				'label'       			=> esc_html__( 'Show post categories', 'essay' ),
				'description' 			=> esc_html__( 'Show the post categories under author biography on single post pages.', 'essay' ),
				'section' 			=> 'essay_theme_options_blog',
			) );

			// Add the tags setting and control.
			$wp_customize->add_setting( 'show_tags', array(
				'default'           	=> FALSE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'show_tags', array(
				'type' 				=> 'checkbox',
				'label'       			=> esc_html__( 'Show post tags', 'essay' ),
				'description' 			=> esc_html__( 'Show the post tags under author biography on single post pages.', 'essay' ),
				'section' 			=> 'essay_theme_options_blog',
			) );



	/**
	 * Add the footer section.
	 */
	$wp_customize->add_section( 'pro_footer', array(
		'title' 						=> esc_html__( 'Footer', 'essay' ),
		'panel'       					=> 'essay_theme_options',
	) );

			// Add the powered by Charmed setting and control.
			$wp_customize->add_setting( 'powered_by_essay', array(
				'default'           	=> TRUE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'powered_by_essay', array(
				'type' 				=> 'checkbox',
				'label'       			=> esc_html__( 'Powered by Essay', 'essay' ),
				'section' 			=> 'pro_footer',
			) );

			// Add the powered by WordPress setting and control.
			$wp_customize->add_setting( 'powered_by_wordpress', array(
				'default'           	=> FALSE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'powered_by_wordpress', array(
				'type' 				=> 'checkbox',
				'label'       			=> esc_html__( 'A WordPress run site. Nice.', 'essay' ),
				'section' 			=> 'pro_footer',
			) );



	/**
	 * Add the colors section.
	 */
	$wp_customize->add_section( 'essay_pro_colors', array(
		'title' 				=> esc_html__( 'Colors', 'essay' ),
		'panel'       			=> 'essay_theme_options',
	) );	

			$wp_customize->add_setting( 'theme_accent_color', array(
				'default'           	=> '#007AFF',
				'sanitize_callback' 	=> 'sanitize_hex_color',
				'transport'         	=> 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_accent_color', array(
				'label'        		=> esc_html__( 'Accent Color', 'essay' ),
				'section'     			=> 'essay_pro_colors',
			) ) );

			//Upsell content.
			$wp_customize->add_setting( 'pro_colors_content', array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'bean_sanitize_nohtml',
			) );

			$wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'pro_colors_content', array(
				'type' 				=> 'content',
				'label' 				=> esc_html__( 'Advanced Color Settings', 'charmed' ),
			     'description' 			=> sprintf( __( '<a target="_blank" href="%1$s" class="button button-secondary">Get Access to More Color Settings</a>', 'charmed' ), esc_url( PRO_UPGRADE_URL ) ),
				'section'				=> 'essay_pro_colors',
				'input_attrs' 			=> array( 'content' => __( '<p>Fine tune your site design with a number of color customization options for each section of the theme:</p><ul><li>Accent Colors</li><li>Hero Header Color</li><li>Body Text</li><li>Headings</li><li>Blockquotes</li><li>Footer Text</li><li>CSS3 Black/White Post Filter</li></ul>', 'charmed' ) 
				),
			) ) );



	/**
	 * Add the typography section.
	 */
	$wp_customize->add_section( 'essay_pro_typography', array(
		'priority'    					=> 91,
		'title'       					=> esc_html__( 'Typography', 'essay' ),
		
	) );

		// Upsell content.
		$wp_customize->add_setting( 'pro_typography_content', array(
			'default'           	=> '',
			'sanitize_callback' 	=> 'bean_sanitize_nohtml',
		) );

		$wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'pro_typography_content', array(
			'type' 				=> 'content',
			'label' 				=> esc_html__( 'Typography Settings', 'charmed' ),
		     'description' 			=> sprintf( __( '<a target="_blank" href="%1$s" class="button button-secondary">Get Access to Typography Settings</a>', 'essay' ), esc_url( PRO_UPGRADE_URL ) ),
			'section'				=> 'essay_pro_typography',
			'input_attrs' 			=> array( 'content' => __( '<p>You\'ll have access to 500+ Google Fonts along with font size, line height, letter spacing, and word spacing settings for each section:</p><ul><li>Body</li><li>Page Titles</li><li>Page Content</li></ul>', 'essay' ) 
			),
		) ) );



	/**
	 * JetPack Site Logo feaure support
	 * Check to see if JetPack Site Logo module is added. 
	 * For more information on the JetPack site logo:
	 *
 	 * @see http://jetpack.me/support/site-logo/
	 */
	if ( !function_exists( 'jetpack_the_site_logo' ) ) { 
		// Add logo uploader setting and control to the standard WP title_tagline section.
		$wp_customize->add_setting( 'site_logo', array(
			'sanitize_callback'	=> 'bean_sanitize_image',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo', array(
	          'label'       		=> esc_html__( 'Site logo', 'essay' ),
	          'description' 		=> esc_html__( 'Upload a logo to replace the default site name.', 'essay' ),
	          'section'     		=> 'title_tagline',
	          'settings'    		=> 'site_logo', 
	          
	     ) ) );
	}

	
	/**
	 * Set transports for the Customizer.
	 */
	
	$wp_customize->get_setting( 'blogname' )->transport            		= 'postMessage';
	$wp_customize->get_setting( 'site_logo' )->transport 		   		= 'refresh';
	$wp_customize->get_setting( 'powered_by_essay' )->transport  	   = 'postMessage';
	$wp_customize->get_setting( 'powered_by_wordpress' )->transport     = 'postMessage';


	
	
}

add_action( 'customize_register', 'bean_customize_register', 11 );



/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function essay_customize_preview_js() {
	wp_enqueue_script( 'essay-customize-preview', get_theme_file_uri() . '/inc/customizer/js/customize-preview.js', array( 'customize-preview' ), ESSAY_VERSION, true );
}
add_action( 'customize_preview_init', 'essay_customize_preview_js' );