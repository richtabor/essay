<?php
/**
 * The file is for creating the post type meta. 
 * Meta output is output on the post editor.
 *
 * @package Essay
 */
 
function bean_metabox_post() {

	$meta_box = array(
		'id' 		=> 'bean-meta-box-video',
		'title' 		=>  esc_html__('Video Post Format', 'essay'),
		'page' 		=> 'post',
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'fields' 		=> array(
			array(    'name' 	=> esc_html__( 'Video URL', 'essay' ),
					'desc' 	=> esc_html__('Upload a video to display in the hero area.'),
					'id' 	=> '_bean_video_url',
					'type' 	=> 'file',
					'std' 	=> ''
			),
			array( 	'name' 	=> esc_html__( 'Embed Code', 'essay' ),
					'desc' 	=> esc_html__('Add a video embed iframe.','essay'),
					'id' 	=> '_bean_video_embed',
					'type' 	=> 'textarea',
					'std' 	=> ''
			),
		)
	);
	bean_add_meta_box( $meta_box );
} // bean_metabox_post()

add_action('add_meta_boxes', 'bean_metabox_post');