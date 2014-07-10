<!-- [ #sitemapOuter ] -->
<div id="sitemapOuter">
<div id="sitemapPageList">
<ul class="linkList">
<?php wp_list_pages('title_li='); ?>
</ul>
</div>

<!-- [ #sitemapPostList ] -->
<div id="sitemapPostList">

	<!-- [ post ] -->
	<?php query_posts("showposts=-0"); ?>
	<?php if(have_posts()): ?>
	<h5><?php echo esc_html(bizVektorOptions('postLabelName')); ?></h5>
	<ul class="linkList">
	<?php wp_list_categories('title_li='); ?> 
	</ul>
	<?php endif;?>
	<?php wp_reset_query(); ?>
	<!-- [ /post ] -->

</div>
<!-- [ #sitemapPostList ] -->
</div>
<!-- [ /#sitemapOuter ] -->