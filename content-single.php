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