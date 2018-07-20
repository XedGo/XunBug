<?php
/**
 * Materialist functions and definitions
 *
 * @package Materialist
 */
function post_thumbnail_src(){
    global $post;
    if( $values = get_post_custom_values("thumb") ) {   //输出自定义域图片地址
        $values = get_post_custom_values("thumb");
        $post_thumbnail_src = $values [0];
    } elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        $post_thumbnail_src = $thumbnail_src [0];
    } else {
        $post_thumbnail_src = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        if(!empty($matches[1][0])){
            $post_thumbnail_src = $matches[1][0];   //获取该图片 src
        }elseif( suxingme('suxingme_post_thumbnail') ){
            $post_thumbnail_src = suxingme('suxingme_post_thumbnail');
        }else{  
            //如果日志中没有图片，则显示默认图片
            $post_thumbnail_src = get_template_directory_uri().'/img/default_thumb.png';
        }
    }
    return $post_thumbnail_src;
}
/**
	评论邮件回复
**/
function comment_mail_notify($comment_id) { 
 $comment = get_comment($comment_id);
 $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
 $spam_confirmed = $comment->comment_approved; 
 if (($parent_id != '') && ($spam_confirmed != 'spam')) { 
 $wp_email = 'xunbug@gmail.com' . preg_replace('#^www.#', '', strtolower($_SERVER['SERVER_NAME']));
 $to = trim(get_comment($parent_id)->comment_author_email); 
 $subject = '[' . get_option("blogname") . '] 您的留言有了新回复'; 
 $message = ' 
 <div style="width: 60%;margin: 0 auto"> 
 <div style="font-size: 28px;line-height: 28px;text-align: center;"><p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p></div> 
 <div style="border-bottom: 1px solid #eee;padding-top: 10px;"> 
 <p style="color: #999;">您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:</p> 
 <p style="font-size: 18px;">' . trim(get_comment($parent_id)->comment_content) . '</p> 
 </div> 
 <div style="border-bottom: 1px solid #eee;padding-top: 10px;"> 
 <p style="color: #999;">' . trim($comment->comment_author) . ' 给您的回复:</p> 
 <p style="font-size: 18px;">' . trim($comment->comment_content) . '</p>
 <p style="text-align: center;font-size: 12px;padding-bottom: 20px;"><a style="border: 1px solid #3297fb;color: #3297fb;padding: 7px 14px;text-decoration: none;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-radius:4px;" href="' . esc_attr(get_comment_link($parent_id, array('type' => 'comment'))) . '">点击查看</a></p> 
 </div> <div style="font-size: 12px;color: #999;text-align: center;"> 
 <p>此邮件由系统自动发送，请勿回复</p> 
 <p>© <a href="https://xunbug.com" style="color: #999;text-decoration: none;">' . get_option('blogname') . '</a></p> 
 </div> 
 </div>'; 
 $from = "From: \"" . get_option('blogname') . "\" <$wp_email>"; 
 $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n"; wp_mail( $to, $subject, $message, $headers ); } } 
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
