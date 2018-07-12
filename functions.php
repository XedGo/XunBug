<?php
/**
 * Materialist functions and definitions
 *
 * @package Materialist
 */

/**
	评论邮件回复
**/
function comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'postmaster@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回应';
    $message = '<div style="border-right:#666666 1px solid;border-radius:8px;color:#111;font-size:12px;width:95%;border-bottom:#666666 1px solid;font-family:微软雅黑,arial;margin:10px auto 0px;border-top:#666666 1px solid;border-left:#666666 1px solid"><div class="adM">
    </div><div style="width:100%;background:#666666;min-height:60px;color:white;border-radius:6px 6px 0 0"><span style="line-height:60px;min-height:60px;margin-left:30px;font-size:12px">您在<a style="color:#00bbff;font-weight:600;text-decoration:none" href="' . get_option('home') . '" target="_blank">' . get_option('blogname') . '</a> 上的留言有回复啦！</span> </div>
    <div style="margin:0px auto;width:90%">
    <p><span style="font-weight:bold;">' . trim(get_comment($parent_id)->comment_author) . '</span>, 您好!</p>
    <p>您于' . trim(get_comment($parent_id)->comment_date) . ' 在文章《' . get_the_title($comment->comment_post_ID) . '》上发表评论: </p>
    <p style="border-bottom:#ddd 1px solid;border-left:#ddd 1px solid;padding-bottom:20px;background-color:#eee;margin:15px 0px;padding-left:20px;padding-right:20px;border-top:#ddd 1px solid;border-right:#ddd 1px solid;padding-top:20px">' . nl2br(get_comment($parent_id)->comment_content) . '</p>
    <p><span style="font-weight:bold;">' . trim($comment->comment_author) . '</span> 于' . trim($comment->comment_date) . ' 给您的回复如下: </p>
    <p style="border-bottom:#ddd 1px solid;border-left:#ddd 1px solid;padding-bottom:20px;background-color:#eee;margin:15px 0px;padding-left:20px;padding-right:20px;border-top:#ddd 1px solid;border-right:#ddd 1px solid;padding-top:20px">' . nl2br($comment->comment_content) . '</p>
    <p>您可以点击 <a style="color:#00bbff;text-decoration:none" href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank">查看回复的完整内容</a></p>
    <p>感谢你对 <a style="color:#00bbff;text-decoration:none" href="' . get_option('home') . '" target="_blank">' . get_option('blogname') . '</a> 的关注，如您有任何疑问，欢迎在博客留言，我会一一解答</p><p style="color:#A8979A;">(此邮件由系统自动发出，请勿回复。)</p></div></div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
    }
}
add_action('comment_post', 'comment_mail_notify');



add_filter('pre_site_transient_update_themes', create_function('$a', "return null;"));
remove_action('admin_init', '_maybe_update_themes');
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 725; /* pixels */
}

if ( ! function_exists( 'materialist_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function materialist_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Materialist, use a find and replace
	 * to change 'materialist' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'materialist', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'materialist' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside'
	) );

	// Adding editor style
	add_editor_style( array(
		'https://fonts.loli.net/css?family=Roboto:400,700,300',
		'editor.css'
	) );	
}
endif; // materialist_setup
add_action( 'after_setup_theme', 'materialist_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function materialist_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'materialist' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'materialist_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function materialist_scripts() {

	wp_enqueue_style( 'materialist-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'materialist-script', get_template_directory_uri() . '/js/materialist.js', array( 'jquery' ), '20150121' );

	wp_enqueue_script( 'materialist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'materialist_scripts' );

/**
 * Display color scheme based on one accent color choosen by user
 */
if( ! function_exists( 'materialist_color_scheme' ) ) :
function materialist_color_scheme(){
	$color_scheme = get_theme_mod( 'color_scheme', false );

	if( $color_scheme ){
		wp_add_inline_style( 'materialist-style', $color_scheme );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'materialist_color_scheme' );

if( ! function_exists( 'materialist_excerpt_length') ) :
/**
 * Modifying excerpt's length
 * 
 * @return int
 */
function materialist_excerpt_length(){
	return 20;
}
endif;
add_filter( 'excerpt_length', 'materialist_excerpt_length' );

if( ! function_exists( 'materialist_excerpt_more' ) ) :
/**
 * Replacing excerpt's annoying [&hellip;]
 * 
 * @return string
 */
function materialist_excerpt_more(){
	return ' &hellip;';
}
endif;
add_filter( 'excerpt_more', 'materialist_excerpt_more' );


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Load simple color adjuster library
 */
if( ! class_exists( 'Materialist_Simple_Color_Adjuster' ) ){
	require get_template_directory() . '/inc/simple-color-adjuster.php';
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
