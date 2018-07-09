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
		<div class="share">分享到： <a href="#" onclick="shareTo('qq')">QQ</a> &nbsp; <a href="#" onclick="shareTo('sina')">Weibo</a></div>
		<?php materialist_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->

<script>
	function shareTo(stype){
    var ftit = '';
    var flink = '';
    ftit = $('.site-title').text();
    flink = $('.content-area img').eq(0).attr('src');
    if(typeof flink == 'undefined'){
        flink='';
    }
    if(stype=='sina'){
    	window.open('http://service.weibo.com/share/share.php?appkey=&title='+ftit+'&url='+document.location.href+'&pic='+flink+'&searchPic=false&style=simple');
    }
    if(stype == 'qq'){
        window.open('http://connect.qq.com/widget/shareqq/index.html?url='+document.location.href+'?sharesource=qzone&title='+ftit+'&pics='+flink+'&summary='+document.querySelector('meta[name="description"]').getAttribute('content')+'&desc=园子的测试小课堂，快来给我一起发现有趣的东西吧！');
    }
}
</script>