<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Essay
 */



if ( ! function_exists( 'essay_hero_background' ) ) :
/**
 * Return the hero background image.
 * 
 * Checks if a featured image is uploaded and creates a background image CSS rule
 * Create your own essay_hero_background() to override in a child theme.
 *
 * @see https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
 * @see https://codex.wordpress.org/Function_Reference/get_post_thumbnail_id
 * @see https://codex.wordpress.org/Function_Reference/has_post_thumbnail 
 */
function essay_hero_background( $next_post ) {
	global $post;

	$prev_post = get_previous_post();

	if ( in_array( get_post_type(), array( 'post', 'page' ) ) ) {	
		if ( has_post_thumbnail() ) {

			if ($next_post == 'prev_post' ) {
				$featured_image = esc_url( wp_get_attachment_url( get_post_thumbnail_id( $prev_post->ID) ) );
			} else {
				$featured_image =  esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID) ) );
			}
			
			$hero_bg_img = 'background-image: url(' . $featured_image . ');'; 
			return $hero_bg_img;
		}
	}
}
endif;



if ( ! function_exists( 'essay_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the author and comments.
 * Create your own essay_entry_meta() to override in a child theme.
 */

function essay_entry_meta() {
	if ( is_singular() && 'post' == get_post_type() ) {
		printf( '<span class="byline">%1$s<span class="author vcard"><span class="screen-reader-text">%2$s</span> <a class="url fn n" href="%3$s">%4$s </a></span></span>',
			esc_html( 'By', 'essay' ),
			esc_html_x( 'Author', 'Used before post author name.', 'essay' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		essay_entry_date();
	}

	if ( is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
			comments_popup_link( sprintf( __( ' Leave a comment<span class="screen-reader-text"> on %s</span>', 'essay' ), get_the_title() ) );
		echo '</span>';
	}
}
endif;



if ( ! function_exists( 'essay_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 * Create your own essay_entry_date() to override in a child theme.
 */
function essay_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( '<span class="posted-on"><span class="screen-reader-text">%1$s</span>%2$s&nbsp;<a href="%3$s" rel="bookmark">%4$s</a></span>',
		esc_html_x( 'Posted', 'Used before publish date.', 'essay' ),
		esc_html( 'on', 'essay' ),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;



if ( ! function_exists( 'essay_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 * Create your own essay_entry_date() to override in a child theme.
 */
function essay_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'essay' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'essay' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'essay' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;



if ( ! function_exists( 'essay_comments_placeholders' ) ) :
/**
 * Adds placehoder in the post comment fields.
 * Create your own essay_comments_placeholders() to override in a child theme.
 */
function  essay_comments_placeholders( $fields ) {
    $fields['author'] = str_replace(
        '<input',
        '<input placeholder="'.esc_html__( 'Name *', 'essay' ).'"',
        $fields['author']
    );
    $fields['email'] = str_replace(
        '<input','<input placeholder="'.esc_html__( 'Email *', 'essay' ).'"',
        $fields['email']
    );
    $fields['url'] = str_replace(
        '<input',
        '<input placeholder="'.esc_html__( 'Website', 'essay' ).'"',
        $fields['url']
    );
    return $fields;
}
add_filter( 'comment_form_default_fields', 'essay_comments_placeholders' );
endif;



if ( ! function_exists( 'essay_entry_taxonomies' ) ) :
/**
 * Print HTML with category and tags for current post.
 * Create your own essay_entry_taxonomies() to override in a child theme.
 */
function essay_entry_taxonomies() {
	
	if ( get_theme_mod( 'show_category' ) == true ) :
		$categories_list = get_the_category_list( esc_html_x( ' ', 'Used between list items, there is a space after the comma.', 'essay' ) );
		if ( $categories_list && essay_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Categories', 'Used before category names.', 'essay' ),
				$categories_list
			);
		}
	endif;

	if ( get_theme_mod( 'show_tags' ) == true ) :
		$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'Used between list items, there is a space after the comma.', 'essay' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Tags', 'Used before tag names.', 'essay' ),
				$tags_list
			);
		}
	endif;
}
endif;



/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function essay_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'essay_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'essay_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so essay_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so essay_categorized_blog should return false.
		return false;
	}
}



/**
 * Flush out the transients used in {@see essay_categorized_blog()}.
 */
function essay_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'essay_categories' );
}
add_action( 'edit_category', 'essay_category_transient_flusher' );
add_action( 'save_post',     'essay_category_transient_flusher' );



/*
 * Adds a custom class to submenu list items. 
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
function essay_add_menu_parent_class( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item'; 
		}
	}
	
	return $items;    
}
add_filter( 'wp_nav_menu_objects', 'essay_add_menu_parent_class' );