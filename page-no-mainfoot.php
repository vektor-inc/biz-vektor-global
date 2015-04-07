<?php
/*
 * Template Name: Don't show contact at the bottom of the page
 */
get_header(); ?>

<!-- [ #container ] -->
<div id="container" class="innerBox">
	<!-- [ #content ] -->
	<div id="content" class="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" class="entry-content">
	<?php the_content(); ?>
	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . 'Pages:', 'after' => '</div>' ) ); ?>
</div><!-- .entry-content -->

<?php endwhile; ?>

<?php // Child page list ?>
<?php
	if($post->ancestors){
		foreach($post->ancestors as $post_anc_id){
			$post_id = $post_anc_id;
		}
	} else {
		$post_id = $post->ID;
	}
	if ($post_id) {
		$children = wp_list_pages("title_li=&child_of=".$post_id."&echo=0");
		if ($children) { ?>
		<div class="childPageBox">
		<h4><a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h4>
		<ul>
		<?php echo $children; ?>
		</ul>
		</div>
		<?php } ?>
<?php } ?>
<?php // /Child page list ?>

</div>
<!-- [ /#content ] -->

<!-- [ #sideTower ] -->
<div id="sideTower" class="sideTower">
	<?php get_sidebar('page'); ?>
</div>
<!-- [ /#sideTower ] -->
</div>
<!-- [ /#container ] -->

<?php get_footer(); ?>