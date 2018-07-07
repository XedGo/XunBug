<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="dns-prefetch" href="//cdn.xunbug.com"/>
<link rel="dns-prefetch" href="//lib.baomitu.com"/>
<link rel="shortcut icon" href="https://cdn.xunbug.com/images/favicon.ico" />
<link rel='stylesheet' id='materialist-style-css'  href='//cdn.xunbug.com/css/v1_style.css' type='text/css' media='all' />
<script src="https://lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<?php
if ( is_home () || is_search()) : 
//如果是文章单页
?>
<title>园子的测试笔记</title>
<meta name="description" content="园子的测试笔记，记录我的生活与工作，或许这里还藏着许多有趣的东西，一起来发现吧。" />   
<meta name="keywords" content="xunbug,寻bug,园子的笔记本,xunbug.com" /> 
<?php else ://其他情况?>
<title><?php wp_title(''); echo ' - '; bloginfo('name'); ?></title>
<meta name="description" content="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120	,"......"); ?>" />
<!-- og -->
<meta property="og:type" content="acticle"/>
<meta property="og:title" content="<?php wp_title(''); ?>"/>
<meta property="og:url" content="<?php the_permalink();?>"/>
<meta property="og:description" content="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120	,"......"); ?>"/>
<meta property="og:image" content="<?php the_post_thumbnail_url(); ?>" />  
<meta property="article:published_time" content="<?php date_default_timezone_set('PRC'); echo get_the_date('c'); ?>" />
<meta property="article:author" content="园子" /> 
<meta property="article:published_first" content="园子的测试笔记,<?php the_permalink();?>" /> 
<?php  endif ?>
<!--og end-->
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<nav id="top-navigation">
		<a href="#drawer" data-target-id="drawer" class="genericon genericon-menu toggle-button"><span class="label"><?php _e( 'Navigation', 'materialist' ); ?></span></a>
				<h3 class="site-title-nav"><a href="/" rel="home">Yuanzi Notebook</a></h3>
	</nav>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
<?php
if ( is_single ()) : 
//如果是文章单页
?>
<h1 class="site-title"><a href="<?php the_permalink(); ?>" rel="home"><?php the_title(); ?></a></h1>
<?php else ://其他情况 ?>
 <h1 class="site-title"><a href="/" rel="home">Yuan Zi's Test Notebook</a></h1>
	<div class="xunbug"><h2 class="site-description">Xunbug equivalent to <span>寻</span><span>B</span><span>U</span><span>G</span>，A very interesting blog</h2></div>
<?php  endif ?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
