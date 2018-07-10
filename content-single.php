<?php
/**
 * @package Materialist
 */
?>

<div class="hentry-separator">
	<?php materialist_posted_on(); ?>
</div><!-- .entry-meta -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		if( has_post_thumbnail( ) ){
			echo '<div class="entry-featured-image">';
			the_post_thumbnail( 'large' );
			echo '</div>';
		} 
	?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">'. __( 'Pages:', 'materialist' ) .'</span>',
				'after'  => '</div>',
				'pagelink' => '<span class="page-link">%</span>'
			) );
		?>
	</div><!-- .entry-content -->
<br>

<footer class="entry-footer">
	<span class="tags-links about">
		<div class="widget widget_recent_entries">
<h2 class="widgettitle">相关文章</h2>
<ul>
<?php
global $post;
$post_tags = wp_get_post_tags($post->ID);
if ($post_tags) {
  foreach ($post_tags as $tag) {
    // 获取标签列表
    $tag_list[] .= $tag->term_id;
  }
 
  // 随机获取标签列表中的一个标签
  $post_tag = $tag_list[ mt_rand(0, count($tag_list) - 1) ];
 
  // 该方法使用 query_posts() 函数来调用相关文章，以下是参数列表
  $args = array(
        'tag__in' => array($post_tag),
        'category__not_in' => array(NULL),  // 不包括的分类ID
        'post__not_in' => array($post->ID),
        'showposts' => 5,                           // 显示相关文章数量
        'caller_get_posts' => 1
    );
  query_posts($args);
 
  if (have_posts()) {
    while (have_posts()) {
      the_post(); update_post_caches($posts); ?>
    <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php
    }
  }
  else {
    echo '<li>* 暂无相关文章</li>';
  }
  wp_reset_query(); 
}
else {
  echo '<li>* 暂无相关文章</li>';
}
?>
</ul>
</div>
</span>
</footer>
<br>

	<footer class="entry-footer">
		<div class="share">
			<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a></div><br>
		</div>
		<?php materialist_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->


<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='https://cdn.xunbug.com/static/api/js/share.js?v=189860593.js?cdnversion='+~(-new Date()/36e5)];</script>