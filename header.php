<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="dns-prefetch" href="//cdn.xedgo.com"/>
<link rel="dns-prefetch" href="//lib.baomitu.com"/>
<link rel="dns-prefetch" href="//ww4.sinaimg.cn"/>
<link rel="shortcut icon" href="https://cdn.xedgo.com/images/favicon.ico" />
<link rel='stylesheet' id='materialist-style-css'  href='/css/style.css' type='text/css' media='all' />
<title> 
   <?php 
         if (is_home()||is_search()) { bloginfo('name'); } 
         else{wp_title(''); echo ' - '; bloginfo('name');} 
  ?> 
 </title>
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
 <h1 class="site-title"><a href="/" rel="home">Yuanzi's test Notebook</a></h1>
	<div class="xunbug"><h2 class="site-description">Xunbug equivalent to <span>寻</span><span>B</span><span>U</span><span>G</span>，A very interesting blog</h2></div>
<?php  endif ?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
