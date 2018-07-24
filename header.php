<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="dns-prefetch" href="//cdn.xunbug.com"/>
<link rel="dns-prefetch" href="//lib.baomitu.com"/>
<link rel="shortcut icon" href="https://cdn.xunbug.com/images/favicon.ico" />
<link rel='stylesheet' id='materialist-style-css'  href='//cdn.xunbug.com/css/v5_style.css' type='text/css' media='all' />
<script src="https://lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<?php
if ( is_home () || is_search()) : 
//如果是文章单页
?>
<title>园子的测试笔记</title>
<meta name="description" content="园子的测试笔记，探索一个测试工程师的无限可能，这里散落着各种创意与想法，你是否愿意同我一起拾取？" />   
<meta name="keywords" content="测试,寻bug,园子的笔记本,xunbug.com,园子,测试工程师" /> 
<?php elseif (is_single()) :?>
<!-- og -->
<title><?php wp_title(''); echo ' - '; bloginfo('name'); ?></title>
<meta name="description" content="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120	,"......"); ?>" />
<meta property="og:type" content="blog"/>
<meta property="og:title" content="<?php wp_title(''); ?>"/>
<meta property="og:url" content="<?php the_permalink();?>"/>
<meta property="og:description" content="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120	,"......"); ?>"/>
<meta property="og:image" content="<?php the_post_thumbnail_url(); ?>" />  
<meta property="article:published_time" content="<?php date_default_timezone_set('PRC'); echo get_the_date('c'); ?>" />
<meta property="article:author" content="园子" /> 
<meta property="article:published_first" content="园子的测试笔记,<?php the_permalink();?>" /> 
<?php  endif ?>
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
<h2 class="site-description">为此间江湖年少偏爱纵横天下，恩仇趁年华轻剑快马。</h2>
<?php  endif ?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
