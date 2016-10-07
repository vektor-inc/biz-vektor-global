<?php
$panListHtml = '<!-- [ #panList ] -->
<div id="panList">
<div id="panListInner" class="innerBox">
';

global $wp_query;
global $biz_vektor_options;

// get post type
$postType = get_post_type();
// get post type label
$post_type_object = get_post_type_object($postType);
if($post_type_object){
	$postTypeName = esc_html($post_type_object->labels->name);
}

// post label
$postLabelName = $biz_vektor_options['postLabelName'];
// post top URL
$postTopUrl = (isset($biz_vektor_options['postTopUrl']))? $biz_vektor_options['postTopUrl'] : '';

$panListHtml .= '<ul>';
$panListHtml .= '<li id="panHome"><a href="'. home_url() .'">HOME</a> &raquo; </li>';

// 404
if ( is_404() ){
	$panListHtml .= "<li>".__('Not found', 'bizvektor-global-edition')."</li>";
} else if ( is_search() ) {
	$panListHtml .= "<li>".sprintf(__('Search Results for : %s', 'bizvektor-global-edition'),get_search_query())."</li>";

// post home
} else if ( is_home() ){
	$panListHtml .= '<li>'.$postLabelName.'</li>';

// page
} elseif ( is_page() ) {
	$post = $wp_query->get_queried_object();
	if ( $post->post_parent == 0 ){
		$panListHtml .= "<li>".the_title('','', FALSE)."</li>";
	} else {
		$title = the_title('','', FALSE);
		$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
		array_push($ancestors, $post->ID);
		foreach ( $ancestors as $ancestor ){
			if( $ancestor != end($ancestors) ){
				$panListHtml .= '<li><a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a> &raquo; </li>';
			} else {
				$panListHtml .= '<li>'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</li>';
			}
		}
	}

// author
} else if (is_author()) {
	$userObj = get_queried_object();
	$panListHtml .= '<li>'.esc_html($userObj->display_name).'</li>';

// single
} elseif ( is_single() ) {

	if ($postType == 'post') {
		if ($postTopUrl) {
			$panListHtml .= '<li><a href="'.esc_url($postTopUrl).'">'.$postLabelName.'</a> &raquo; </li>';
		} else {
			$panListHtml .= '<li>'.$postLabelName.' &raquo; </li>';
		}
		$category = get_the_category();
		$category_id = get_cat_ID( $category[0]->cat_name );
		if ($category_id) :  // memo : case by no tax custom post type
			$panListHtml .= '<li>'. get_category_parents( $category_id, TRUE, ' &raquo; ' ).'</li>';
		endif;
	// custom post type
	} else {
		$panListHtml .= '<li><a href="'.home_url().'/'.$postType.'">'.$postTypeName.'</a> &raquo; </li>';
		$taxonomies = get_the_taxonomies();
		foreach ( $taxonomies as $taxonomySlug => $taxonomy ) {}
		if ($taxonomies):
			$taxo_catelist = get_the_term_list( $post->ID, $taxonomySlug, '', ' , ', '' );
			$panListHtml .= '<li>'.$taxo_catelist.' &raquo; </li>';
		endif;
	}
	$panListHtml .= '<li>'.get_the_title()."</li>";

// taxonomy
} else if (is_tax()) {
	if ( $postType == 'post') {
		$postTopUrl = (isset($biz_vektor_options['postTopUrl']))? esc_html($biz_vektor_options['postTopUrl']) : '';
		if ($postTopUrl) {
			$panListHtml .= '<li><a href="'.$postTopUrl.'">'.$postLabelName.'</a> &raquo; </li>';
		} else {
			$panListHtml .= '<li>'.$postLabelName.' &raquo; </li>';
		}
	// custom post type
	} else {
		if (get_post_type()) {
			$postTypeSlug = get_post_type();
		} else {
			$taxonomy = get_queried_object()->taxonomy;
			$postTypeSlug = get_taxonomy( $taxonomy )->object_type[0];
		}
		$postTypeName = get_post_type_object($postTypeSlug)->labels->name;
		$panListHtml .= '<li><a href="'.home_url().'/'.$postType.'">'.$postTypeName.'</a> &raquo; </li>';
	}
	$panListHtml .= '<li>'.single_cat_title('','', FALSE).'</li>';

// category
} else if ( is_category() ) {
	$postTopUrl = (isset($biz_vektor_options['postTopUrl']))? esc_html($biz_vektor_options['postTopUrl']) : '';
	if ($postTopUrl) {
		$panListHtml .= '<li><a href="'.$postTopUrl.'">'.$postLabelName.'</a> &raquo; </li>';
	} else {
		$panListHtml .= '<li>'.$postLabelName.' &raquo; </li>';
	}
	$cat = get_queried_object();
	// parent = 0 means has parent
	if($cat -> parent != 0):
		$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
		foreach($ancestors as $ancestor):
			$panListHtml .= '<li><a href="'.get_category_link($ancestor).'">'.get_cat_name($ancestor).'</a> &raquo; </li>';
		endforeach;
	endif;
	$panListHtml .= '<li>'. $cat -> cat_name. '</li>';

// tag
} elseif ( is_tag() ) {
	if ($postType == 'post') {
		if ($postTopUrl) {
			$panListHtml .= '<li><a href="'.esc_url($postTopUrl).'">'.$postLabelName.'</a> &raquo; </li>';
		} else {
			$panListHtml .= '<li>'.$postLabelName.' &raquo; </li>';
		}
	// custom post type
	} else {
		$panListHtml .= '<li>'.$postTypeName.' &raquo; </li>';
	}
	$tagTitle = single_tag_title( "", false );
	$panListHtml .= "<li>". $tagTitle ."</li>";

// archive
} elseif ( is_archive() && (!is_category() || !is_tax()) ) {

	if (is_year() || is_month()){
		if ($postType == 'post') {
			if ($postTopUrl) {
				$panListHtml .= '<li><a href="'.esc_url($postTopUrl).'">'.$postLabelName.'</a> &raquo; </li>';
			} else {
				$panListHtml .= '<li>'.$postLabelName.' &raquo; </li>';
			}
		// custom post type
		} else {
			$panListHtml .= '<li><a href="'.home_url().'/'.$postType.'">'.$postTypeName.'</a> &raquo; </li>';
		}
		if (is_year()){
			$panListHtml .= "<li>".sprintf( __( 'Yearly Archives: %s', 'bizvektor-global-edition' ), get_the_date( _x( 'Y', 'yearly archives date format', 'bizvektor-global-edition' ) ) )."</li>";
		} else if (is_month()){
			$panListHtml .= "<li>".sprintf( __( 'Monthly Archives: %s', 'bizvektor-global-edition' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'bizvektor-global-edition' ) ) )."</li>";
		}
	} else {
		if(!isset($postTyeName)){
			global $wp_query;
			$postTypeName = $wp_query->queried_object->labels->name;
		}
		$panListHtml .= '<li>'.$postTypeName.'</li>';
	}

} elseif ( is_attachment() ) {
	$panListHtml .= '<li>'.the_title('','', FALSE).'</li>';
}
$panListHtml .= '</ul>';
$panListHtml .= '</div>
</div>
<!-- [ /#panList ] -->
';
$panListHtml = apply_filters( 'bizvektor_panListHtml', $panListHtml );
echo $panListHtml;