<?php
/**
 * The file is for creating the page post type meta. 
 * Meta output is output on the page editor.
 *
 * @package Essay
 */ 

function bean_metabox_page() {

	$meta_box = array(
		'id' 		=> 'page-meta',
		'title' 		=>  esc_html__('Page Options', 'essay'),
		'page' 		=> 'page',
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'fields' 		=> array(
			array(	'name'    => esc_html__('Hero Fullscreen Effect:', 'essay'),
					'desc' 	=> esc_html__('Enable the jquery fullscreen hero area on this page. This setting overrides the global option in the Customizerx.', 'essay'),
					'id' 	=> '_bean_hero_override',
					'type' 	=> 'checkbox',
					'std' 	=> false 
				),
		)
	);
	bean_add_meta_box( $meta_box );

} // function bean_metabox_page()

add_action('add_meta_boxes', 'bean_metabox_page');