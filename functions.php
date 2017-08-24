<?php
/**
 *
 * Essay functions and definitions
 * 
 * @package Essay
 * @author  Richard Tabor <rich@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * 
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 */



/**
 * Set constant for version.
 */
define( 'ESSAY_VERSION', '1.0.1' );



/**
 * Check to see if development mode is active.
 * If set the 'true', then serve standard theme files,
 * instead of minified .css and .js files.
 */
define( 'ESSAY_DEBUG', true );



/**
 * Essay only works in WordPress 4.2 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.2', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'essay_setup' ) ) :
function essay_setup() {
	


	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Essay, use a find and replace
	 * to change 'essay' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'essay', get_template_directory() . '/languages' );
	


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	


	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );



	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 140, 140, true );



	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'essay' ),
		'social'  => esc_html__( 'Social Menu', 'essay' )
	) );



	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video'
	) );



	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css' ) );
}
endif; // essay_setup
add_action( 'after_setup_theme', 'essay_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function essay_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bean_content_width', 644 );
}
add_action( 'after_setup_theme', 'essay_content_width', 0 );



/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function essay_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Content Bottom 1', 'essay' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears at the bottom of the content on pages.', 'essay' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Content Bottom 2', 'essay' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Appears at the bottom of the content on pages.', 'essay' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'essay_widgets_init' );



/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function essay_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'essay_javascript_detection', 0 );



/**
 * Enqueue scripts and styles.
 */
function essay_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'essay-fonts', essay_fonts_url(), array(), null );

	/**
	 * Check whether WP_DEBUG or SCRIPT_DEBUG or ESSAY_DEBUG is set to true. 
	 * If so, we’ll load the unminified versions of the main theme stylesheet. If not, load the compressed and combined version.
	 * This is also similar to how WordPress core does it. 
	 * 
	 * @link https://codex.wordpress.org/WP_DEBUG
	 */
	if ( WP_DEBUG || SCRIPT_DEBUG || ESSAY_DEBUG || is_child_theme() ) {

		// Add the main stylesheet.
		wp_enqueue_style( 'essay-style', get_stylesheet_uri() );

		if ( !is_child_theme() ) {
			// Add the Font Awesome icon font stylesheet - but not if we're using a child theme.
			wp_enqueue_style('essay-icon-font', get_stylesheet_directory_uri(). '/inc/fonts/font-awesome.css', false, '1.0', 'all');
		}
		
	} else {
		// Add the main minified stylesheet.
		wp_enqueue_style('essay-minified-style', get_template_directory_uri(). '/style-min.css', false, '1.0', 'all');
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load the contact and comment form validation scripts.
	if ( is_page_template('template-contact.php') || is_singular('post') ) {
		wp_enqueue_script( 'validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ), ESSAY_VERSION, true );
	}

	/**
	 * Now let's check the same for the scripts.
	 */

	wp_enqueue_script('jquery');
	
	if ( WP_DEBUG || SCRIPT_DEBUG || ESSAY_DEBUG ) {

		// Load the Vague script, enabling the blur effect.
		wp_enqueue_script( 'vague', get_template_directory_uri() . '/js/src/vague.js', array( 'jquery' ), ESSAY_VERSION, true );

		// Load the NProgress progress bar loader javascript.
		wp_enqueue_script( 'nprogress', get_template_directory_uri() . '/js/src/nprogress.js', array( 'jquery' ), ESSAY_VERSION, true );

		// Load the FitVids responsive video javascript.
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/src/fitvids.js', array( 'jquery' ), ESSAY_VERSION, true );

		// Load the custom theme javascript functions.
		wp_enqueue_script( 'essay-functions', get_template_directory_uri() . '/js/src/functions.js', array( 'jquery' ), ESSAY_VERSION, true );

	} else {
		// Load the combined javascript library.
		wp_enqueue_script( 'essay-combined-scripts', get_template_directory_uri() . '/js/combined-min.js', array(), ESSAY_VERSION, true );
		
		// Load the minified javascript functions.
		wp_enqueue_script( 'essay-minified-functions', get_template_directory_uri() . '/js/functions-min.js', array( 'jquery' ), ESSAY_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'essay_scripts' );



if ( ! function_exists( 'essay_fonts_url' ) ) :
/**
 * Register Google fonts for Essay.
 *
 * @return string Google fonts URL for the theme.
 */
function essay_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = '';

	/* translators: If there are characters in your language that are not supported by Fira Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Fira Sans font: on or off', 'essay' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Lekton, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Lato font: on or off', 'essay' ) ) {
		$fonts[] = 'Lato:400';
	}

	/* translators: If there are characters in your language that are not supported by Lekton, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Carrois Gothic SC font: on or off', 'essay' ) ) {
		$fonts[] = 'Carrois Gothic SC:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif; // essay_fonts_url



if ( ! function_exists( 'essay_site_logo' ) ) :
/**
 * Output an <img> tag of the site logo.
 *
 * Checks if jetpack_the_site_logo is available. If so, use  jetpack_the_site_logo();.
 * If not, there's a fallback of site_logo in the Theme Customizer.
 *
 */
function essay_site_logo() {

	if ( function_exists( 'jetpack_the_site_logo' ) ) : 
		if ( jetpack_has_site_logo() ) { jetpack_the_site_logo(); } 
		else { ?> <h1 class="site-logo-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1><?php }
	else : 
		if( get_theme_mod( 'site_logo' )) { ?> 
		  	<a class="site-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_mod( 'site_logo' ) );?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="site-logo"></a>
		<?php } else { ?>
		  	<h1 class="site-logo-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php }
	endif; 
}
endif; // essay_site_logo



/**
 * Convert HEX to RGB.
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 * HEX code, empty array otherwise.
 */
function essay_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}



if ( ! function_exists( 'essay_protected_title_format' ) ) :
/**
 * Filter the text prepended to the post title for protected posts. 
 * Create your own essay_protected_title_format() to override in a child theme.
 * 
 * @link https://developer.wordpress.org/reference/hooks/protected_title_format/
 */
function essay_protected_title_format($title) { 
	return '%s'; 
}
add_filter('protected_title_format', 'essay_protected_title_format');
endif; // essay_protected_title_format



if ( ! function_exists( 'essay_protected_form' ) ) :
/**
 * Filter the HTML output for the protected post password form.
 * Create your own essay_protected_form() to override in a child theme.
 * 
 * @link https://developer.wordpress.org/reference/hooks/the_password_form/
 * @link https://codex.wordpress.org/Using_Password_Protection 
 */
function essay_protected_form() {
    global $post;
  
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );

    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <label for="' . $label . '">' . __( "Password:", 'essay' ) . ' </label><input name="post_password" placeholder="' . __( "Insert the password to view this post...", 'essay' ) . '" type="password" placeholder=""/><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'essay' ) . '" />
    </form>
    ';
  
    return $o;
}
add_filter( 'the_password_form', 'essay_protected_form' );
endif; // essay_protected_title_format



if ( ! function_exists( 'essay_comments' ) ) :
/**
 * Define custom callback function for comment output.  
 * Based strongly on the output from Twenty Sixteen. 
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
 * @link https://wordpress.org/themes/twentysixteen/
 *
 * Create your own essay_comments() to override in a child theme.
 */
function essay_comments($comment, $args, $depth) {
	
	global $post;

	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>

	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
	<?php if ( 'div' != $args['style'] ) : ?>
		<article id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	
		<footer class="comment-meta">
			
			<div class="comment-author vcard">
				<div class="avatar-wrapper">
					<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>
				<?php printf( __( '<b class="fn">%s</b> <span class="says">says:</span>', 'essay' ), get_comment_author_link() ); ?>

				<?php if( $comment->user_id === $post->post_author ) { ?><span class="author-badge"><?php esc_html_e( 'Author', 'essay' ); ?></span><?php } ?>
			</div>

			<div class="comment-metadata">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php /* translators: 1: date, 2: time */
					printf( __('%1$s at %2$s', 'essay'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link(__('Edit', 'essay'),'','');
				?>
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Awaiting moderation.', 'essay' ); ?></p>
				<?php endif; ?>
			</div>

		</footer>

		<div class="comment-content">
			<?php comment_text(); ?>
		</div>

	<?php if ( 'div' != $args['style'] ) : ?>
		</article>
	<?php endif;
}
endif; // essay_comments



if ( ! function_exists( 'essay_pingback_header' ) ) :
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function essay_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
    }
}
add_action( 'wp_head', 'essay_pingback_header' );
endif;



/**
 * Admin specific functions.
 */
require get_template_directory() . '/inc/admin.php';



/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/customizer-css.php';
require get_template_directory() . '/inc/customizer/sanitization.php';



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Add Widgets.
 */
require get_template_directory() . '/inc/widgets/widget-flickr.php';
