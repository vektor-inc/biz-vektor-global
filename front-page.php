<?php get_header(); ?>
<!-- [ #container ] -->
<div id="container" class="innerBox">
	<!-- [ #content ] -->
	<div id="content">

	<?php get_template_part('module_topPR'); ?>

	<?php if (get_post_type() === 'page') : ?>
	<div id="topFreeArea">
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . 'Pages:', 'after' => '</div>' ) ); ?>
	</div>
	<?php else : ?>

	<?php
	$options = biz_vektor_get_theme_options();
	if(!isset($options['postTopCount'])){$options['postTopCount'] = 0;}
	
	if (have_posts() && $options['postTopCount']): ?>
		<div id="topBlog" class="infoList">
		<h2><?php echo esc_html($biz_vektor_options['postLabelName']); ?></h2>
		<div class="rssBtn"><a href="<?php echo home_url(); ?>/feed/?post_type=post" id="blogRss" target="_blank">RSS</a></div>

		<?php if ( $biz_vektor_options['listBlogTop'] == 'listType_set' ) { ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('module_loop_post2'); ?>
			<?php endwhile ?>
		<?php } else { ?>
			<ul class="entryList">
			<?php while ( have_posts() ) : the_post();?>
				<?php get_template_part('module_loop_post'); ?>
			<?php endwhile; ?>
			</ul>
		<?php } ?>
		<?php biz_vektor_pagination(); ?>
		</div><!-- [ /#topBlog ] -->
	<?php endif; // $post_loop have_posts() ?>

	<?php endif; // get_post_type() === 'page' ?>

	</div>
	<!-- [ /#content ] -->

	<!-- [ #sideTower ] -->
	<div id="sideTower" class="sideTower">
<?php if ( is_active_sidebar( 'common-side-top-widget-area' ) ) dynamic_sidebar( 'common-side-top-widget-area' ); ?>
<?php
if ( is_active_sidebar( 'top-side-widget-area' ) ) :
	dynamic_sidebar( 'top-side-widget-area' );
else :
	// ウィジェットに設定がない場合
	if (function_exists('biz_vektor_get_contactBtn')) biz_vektor_get_contactBtn();
	?>
<?php endif; ?>
<?php if ( is_active_sidebar( 'common-side-bottom-widget-area' ) ) dynamic_sidebar( 'common-side-bottom-widget-area' ); ?>
	</div>
	<!-- [ /#sideTower ] -->
</div>
<!-- [ /#container ] -->

<?php get_footer(); ?>