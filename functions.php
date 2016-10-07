<?php

$theme_opt = wp_get_theme('bizvektor-global-edition');
define('BizVektor_Theme_Version', preg_replace('/^Version[ :;]*(\d+\.\d+\.\d+.*)$/i', '$1', $theme_opt->Version));

/*-------------------------------------------*/
/*	Set content width
/* 	(Auto set up to media max with.)
/*-------------------------------------------*/
/*	Custom menu
/*-------------------------------------------*/
/*	Widget
/*-------------------------------------------*/
/*	Custom header
/*-------------------------------------------*/
/*	Custom background
/*-------------------------------------------*/
/*	Load theme options
/*-------------------------------------------*/
/*	Load Setting of Default / Calmly
/*-------------------------------------------*/
/*	Load Theme customizer
/*-------------------------------------------*/
/*	Admin page _ Add style
/*-------------------------------------------*/
/*	Admin page _ Add post status to body class
/*-------------------------------------------*/
/*	Admin page _ Add editor css
/*-------------------------------------------*/
/*	Admin page _ Eye catch
/*-------------------------------------------*/
/*	Admin page _ Add custom field of keywords
/*-------------------------------------------*/
/*	Admin page _ page _ customize
/*-------------------------------------------*/
/*	Admin page _ post _ customize
/*-------------------------------------------*/
/*	Custom post type _ add info
/*-------------------------------------------*/
/*	head_description
/*-------------------------------------------*/
/*	head_wp_head clean and add items
/*-------------------------------------------*/
/*	footer_wp_footer clean and add items
/*-------------------------------------------*/
/*	Term list no link
/*-------------------------------------------*/
/*	Global navigation add cptions
/*-------------------------------------------*/
/*	Excerpt _ change ...
/*-------------------------------------------*/
/*	Excerpt _ remove auto mark up to p
/*-------------------------------------------*/
/*	Year Artchive list 'year' insert to inner </a>
/*-------------------------------------------*/
/*	Category list 'count insert to inner </a>
/*-------------------------------------------*/
/*	Block to delete iframe tag from TinyMCE
/*-------------------------------------------*/
/*	Comment
/*-------------------------------------------*/
/*	Archive page link ( don't erase )
/*-------------------------------------------*/
/*	Paging
/*-------------------------------------------*/
/*	Comment out short code
/*-------------------------------------------*/
/*	ChildPageList widget
/*-------------------------------------------*/
/*	posts pagenation setting in front-page
/*-------------------------------------------*/

function biz_vektor_theme_setup(){

	/*-------------------------------------------*/
	/*  Title tag
	/*-------------------------------------------*/
	add_theme_support( 'title-tag' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'custom-header' );

	add_theme_support( 'custom-background', array(
		'default-color' => 'fcfcfc',
	) );

	/*-------------------------------------------*/
	/*	Admin page _ Eye catch
	/*-------------------------------------------*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200, true );


	/*-------------------------------------------*/
	/*	Custom menu
	/*-------------------------------------------*/
	register_nav_menus( array( 'Header' => 'Header Navigation', ) );
	register_nav_menus( array( 'FooterNavi' => 'Footer Navigation', ) );
	register_nav_menus( array( 'FooterSiteMap' => 'Footer SiteMap', ) );

	load_theme_textdomain( 'bizvektor-global-edition' , get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'biz_vektor_theme_setup');

function biz_vektor_body_next(){
	$body_next = '';
	$body_next = apply_filters( 'biz_vektor_body_next', $body_next );
	echo $body_next;
}

/*-------------------------------------------*/
/*	Set content width
/* 	(Auto set up to media max with.)
/*-------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 640;

/*-------------------------------------------*/
/*	Widget
/*-------------------------------------------*/
function biz_vektor_widgetarea_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar(Front page only)', 'bizvektor-global-edition' ),
		'id' => 'top-side-widget-area',
		'description' => __( 'This widget area appears on the front page only.', 'bizvektor-global-edition' ),
		'before_widget' => '<div class="sideWidget" id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="localHead">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar(Post content only)', 'bizvektor-global-edition' ),
		'id' => 'post-widget-area',
		'description' => __( 'This widget area appears only on the post content pages.', 'bizvektor-global-edition' ),
		'before_widget' => '<div class="sideWidget" id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="localHead">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar(Page content only)', 'bizvektor-global-edition' ),
		'id' => 'page-widget-area',
		'description' => __( 'This widget area appears only on the page content pages.', 'bizvektor-global-edition' ),
		'before_widget' => '<div class="sideWidget" id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="localHead">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar(Common top)', 'bizvektor-global-edition' ),
		'id' => 'common-side-top-widget-area',
		'description' => __( 'This widget area appears at top of sidebar.', 'bizvektor-global-edition' ),
		'before_widget' => '<div class="sideWidget" id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="localHead">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar(Common bottom)', 'bizvektor-global-edition' ),
		'id' => 'common-side-bottom-widget-area',
		'description' => __( 'This widget area appears at bottom of sidebar.', 'bizvektor-global-edition' ),
		'before_widget' => '<div class="sideWidget" id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="localHead">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'biz_vektor_widgetarea_init' );


/*-------------------------------------------*/
/*	Custom header
/*-------------------------------------------*/

// Use custom header text
define( 'HEADER_TEXTCOLOR', '' );
// Kill custom header test
define( 'NO_HEADER_TEXT', true );

define('HEADER_IMAGE', '%s/images/headers/features.jpg');
define('HEADER_IMAGE_WIDTH', 950);
define('HEADER_IMAGE_HEIGHT', 250);
register_default_headers( array(
	'features' => array(
		'url' => '%s/images/headers/features.jpg',
		'thumbnail_url' => '%s/images/headers/features-thumbnail.jpg',
		'description' => 'Features'
	),
	'accelerate' => array(
		'url' => '%s/images/headers/accelerate.jpg',
		'thumbnail_url' => '%s/images/headers/accelerate-thumbnail.jpg',
		'description' => 'accelerate'
	),
	'bussines_desk_01' => array(
		'url' => '%s/images/headers/bussines_desk_01.jpg',
		'thumbnail_url' => '%s/images/headers/bussines_desk_01-thumbnail.jpg',
		'description' => 'Bussines desk01'
	),
	'autumn-leaves' => array(
		'url' => '%s/images/headers/autumn-leaves.jpg',
		'thumbnail_url' => '%s/images/headers/autumn-leaves-thumbnail.jpg',
		'description' => 'autumn-leaves'
	),
	'johnny_01' => array(
		'url' => '%s/images/headers/johnny_01.jpg',
		'thumbnail_url' => '%s/images/headers/johnny_01-thumbnail.jpg',
		'description' => 'Johnny'
	),
) );

/*-------------------------------------------*/
/*	Load theme options
/*-------------------------------------------*/
	require( get_template_directory() . '/inc/theme-options.php' );

/*-------------------------------------------*/
/*	Load Setting of Default / Calmly / rebuild
/*-------------------------------------------*/
	require( get_template_directory() . '/bizvektor_themes/001/001_custom.php' );
	require( get_template_directory() . '/bizvektor_themes/002/002_custom.php' );
	require( get_template_directory() . '/bizvektor_themes/003/003_custom.php' );

/*-------------------------------------------*/
/*	Load Theme customizer
/*-------------------------------------------*/
	require( get_template_directory() . '/inc/theme-customizer.php' );

/*-------------------------------------------*/
/*	Admin page _ Add style
/*-------------------------------------------*/
function biz_vektor_admin_css(){
	$adminCssPath = get_template_directory_uri().'/css/style_bizvektor_admin.css';
	wp_enqueue_style( 'theme', $adminCssPath , false, '2014-04-29');
}
add_action('admin_enqueue_scripts', 'biz_vektor_admin_css', 1);

function biz_vektor_wp_css(){
	wp_enqueue_style('bizvektor_style', get_stylesheet_uri(), array(), '1.0.4');
}
add_action('wp_enqueue_scripts', 'biz_vektor_wp_css', 1);

/*-------------------------------------------*/
/*	Admin page _ Add post status to body class
/*-------------------------------------------*/
function biz_vektor_postStatus(){
		$classes = get_post_status(); ?>
		<script type="text/javascript" charset="utf-8">
		function postStatusColor(){
			// Get class and add post status.
			var newClass = document.getElementsByTagName("body")[0].className + " <?php echo $classes ?>";
			// Replace the class name of the current situation
			document.getElementsByTagName("body")[0].setAttribute("class",newClass);
		}
		window.onload = postStatusColor;
		</script>
<?php
}
add_action('admin_head-post.php', 'biz_vektor_postStatus', 12);
add_action('admin_head-post-new.php', 'biz_vektor_postStatus', 12);

/*-------------------------------------------*/
/*	Admin page _ Add editor css
/*-------------------------------------------*/
add_editor_style('css/editor-style.css');


/*-------------------------------------------*/
/*	Admin page _ Add custom field of keywords
/*-------------------------------------------*/
add_action('admin_menu', 'biz_vektor_add_custom_field_metaKeyword');
add_action('save_post', 'biz_vektor_save_custom_field_metaKeyword');

function biz_vektor_add_custom_field_metaKeyword(){
  if(function_exists('biz_vektor_add_custom_field_metaKeyword')){
	add_meta_box('div1', __('Meta Keywords', 'bizvektor-global-edition'), 'biz_vektor_insert_custom_field_metaKeyword', 'page', 'normal', 'high');
	add_meta_box('div1', __('Meta Keywords', 'bizvektor-global-edition'), 'biz_vektor_insert_custom_field_metaKeyword', 'post', 'normal', 'high');
  }
}

function biz_vektor_insert_custom_field_metaKeyword(){
  global $post;
  echo '<input type="hidden" name="noncename_custom_field_metaKeyword" id="noncename_custom_field_metaKeyword" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
  echo '<label class="hidden" for="metaKeyword">'.__('Meta Keywords', 'bizvektor-global-edition').'</label><input type="text" name="metaKeyword" size="50" value="'.get_post_meta($post->ID, 'metaKeyword', true).'" />';
  echo '<p>'.__('To distinguish between individual keywords, please enter a , delimiter (optional).', 'bizvektor-global-edition').'<br />';
  $theme_option_seo_link = '<a href="'.get_admin_url().'/themes.php?page=theme_options#seoSetting" target="_blank">'._x('SEO Setting','link to seo setting', 'bizvektor-global-edition').'</a>';
  sprintf(__('* keywords common to the entire site can be set from %s.', 'bizvektor-global-edition'),$theme_option_seo_link);
  echo '</p>';
}

function biz_vektor_save_custom_field_metaKeyword($post_id){
	$metaKeyword = isset($_POST['noncename_custom_field_metaKeyword']) ? htmlspecialchars($_POST['noncename_custom_field_metaKeyword']) : null;
	if(!wp_verify_nonce($metaKeyword, plugin_basename(__FILE__))){
		return $post_id;
	}
	if('page' == $_POST['post_type']){
		if(!current_user_can('edit_page', $post_id)) return $post_id;
	}else{
		if(!current_user_can('edit_post', $post_id)) return $post_id;
	}

  $data = $_POST['metaKeyword'];

  if(get_post_meta($post_id, 'metaKeyword') == ""){
	add_post_meta($post_id, 'metaKeyword', $data, true);
  }elseif($data != get_post_meta($post_id, 'metaKeyword', true)){
	update_post_meta($post_id, 'metaKeyword', $data);
  }elseif($data == ""){
	delete_post_meta($post_id, 'metaKeyword', get_post_meta($post_id, 'metaKeyword', true));
  }
}

/*-------------------------------------------*/
/*	Admin page _ page _ customize
/*-------------------------------------------*/
add_post_type_support( 'page', 'excerpt' ); // add excerpt

/*-------------------------------------------*/
/*	head_description
/*-------------------------------------------*/
function getHeadDescription() {
	global $wp_query;
	$post = $wp_query->get_queried_object();
	if (is_home() || is_front_page() ) {
		if ( isset($post->post_excerpt) && $post->post_excerpt ) {
			$metadescription = get_the_excerpt();
		} else {
			$metadescription = get_bloginfo( 'description' );
		}
	} else if (is_category() || is_tax()) {
		if ( ! $post->description ) {
			$metadescription = sprintf(__('About %s', 'bizvektor-global-edition'),single_cat_title()).get_bloginfo('name').' '.get_bloginfo('description');
		} else {
			$metadescription = esc_html( $post->description );
		}
	} else if (is_tag()) {
		$metadescription = strip_tags(tag_description());
		$metadescription = str_replace(array("\r\n","\r","\n"), '', $metadescription);  // delete br
		if ( ! $metadescription ) {
			$metadescription = sprintf(__('About %s', 'bizvektor-global-edition'),single_tag_title()).get_bloginfo('name').' '.get_bloginfo('description');
		}
	} else if (is_archive()) {
		if (is_year()){
			$description_date = get_the_date( _x( 'Y', 'yearly archives date format', 'bizvektor-global-edition' ) );
			$metadescription = sprintf(_x('Article of %s.','Yearly archive description', 'bizvektor-global-edition'), $description_date );
			$metadescription .= ' '.get_bloginfo('name').' '.get_bloginfo('description');
		} else if (is_month()){
			$description_date = get_the_date( _x( 'F Y', 'monthly archives date format', 'bizvektor-global-edition' ) );
			$metadescription = sprintf(_x('Article of %s.','Archive description', 'bizvektor-global-edition'),$description_date );
			$metadescription .= ' '.get_bloginfo('name').' '.get_bloginfo('description');
		} else if (is_author()) {
			$userObj = get_queried_object();
			$metadescription = sprintf(_x('Article of %s.','Archive description', 'bizvektor-global-edition'),esc_html($userObj->display_name) );
			$metadescription .= ' '.get_bloginfo('name').' '.get_bloginfo('description');
		} else {
			$postType = get_post_type();
			$metadescription = sprintf(_x('Article of %s.','Archive description', 'bizvektor-global-edition'),esc_html(get_post_type_object($postType)->labels->name) );
			$metadescription .= ' '.get_bloginfo('name').' '.get_bloginfo('description');
		}
	} else if (is_page() || is_single()) {
		$metaExcerpt = $post->post_excerpt;
		if ($metaExcerpt) {
			// $metadescription = strip_tags($post->post_excerpt);
			$metadescription = strip_tags($post->post_excerpt);
		} else {
			$metadescription = mb_substr( strip_tags($post->post_content), 0, 240 ); // kill tags and trim 240 chara
			$metadescription = str_replace(array("\r\n","\r","\n"), ' ', $metadescription);  // delete br
		}
	} else {
		$metadescription = get_bloginfo('description');
	}
	global $paged;
	if ( $paged != '0'){
		$metadescription = '['.sprintf(__('Page of %s', 'bizvektor-global-edition' ),$paged).'] '.$metadescription;
	}
	$metadescription = apply_filters( 'metadescriptionCustom', $metadescription );
	echo $metadescription;
}

/*-------------------------------------------*/
/*	head_wp_head clean and add items
/*-------------------------------------------*/
function biz_vektor_slug_fonts_url(){
	$font_families = array();
	$options = biz_vektor_get_theme_options();
	if(isset($options['enable_google_font']) && $options['enable_google_font'] == 'true'){
		$font_families[] = 'Droid Sans:700';
		$font_families[] = 'Lato:900';
		$font_families[] = 'Anton';
	}
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
	);

	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	return $fonts_url;
}

add_action('wp_enqueue_scripts','biz_vektor_comment_reply');
function biz_vektor_comment_reply(){
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}

// Add Google Web Fonts
add_action('wp_enqueue_scripts','biz_vektor_addWebFonts');
function biz_vektor_addWebFonts(){
	wp_enqueue_style( 'bizvektoraddwebfonts', biz_vektor_slug_fonts_url(), array(), null);
}

// Add BizVektor option css
add_action('wp_enqueue_scripts','biz_vektor_addCommonStyle');
function biz_vektor_addCommonStyle(){
	wp_enqueue_style( 'biz_vektorAddCommonStyle', get_template_directory_uri()."/css/bizvektor_common_min.css", array(), '1.0.0');
}

// add pingback
add_action('wp_enqueue_scripts','biz_vektor_addPingback');
function biz_vektor_addPingback(){
	wp_enqueue_style( 'biz_vektorAddPingback', get_bloginfo( 'pingback_url' ), array(), '1.0.0');
}

/*-------------------------------------------*/
/*	footer_wp_footer clean and add items
/*-------------------------------------------*/
add_action('wp_head','biz_vektor_addJScripts');
function biz_vektor_addJScripts(){
	wp_register_script( 'biz-vektor-min-js' , get_template_directory_uri().'/js/biz-vektor-min.js', array('jquery'), '20140519' );
	wp_enqueue_script( 'biz-vektor-min-js' );
}
function add_defer_to_biz_vektor_js( $url )
{
	if ( FALSE === strpos( $url, 'biz-vektor/js' ) or FALSE === strpos( $url, '.js' ) )
	{ // not our file
		return $url;
	}
	// Must be a ', not "!
	return "$url' defer='defer";
}
add_filter( 'clean_url', 'add_defer_to_biz_vektor_js', 11, 1 );

/*-------------------------------------------*/
/*	Term list no link
/*-------------------------------------------*/
function biz_vektor_get_the_term_list_nolink( $id = 0, $taxonomy, $before = '', $sep = '', $after = '' ) {
	$terms = get_the_terms( $id, $taxonomy );
	if ( is_wp_error( $terms ) )
		return $terms;
	if ( empty( $terms ) )
		return false;
	foreach ( $terms as $term ) {
		$term_names[] =  $term->name ;
	}
	return $before . join( $sep, $term_names ) . $after;
}

/*-------------------------------------------*/
/*	Global navigation add cptions
/*-------------------------------------------*/
class description_walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=array(),$id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$prepend = '<strong>';
		$append = '</strong>';
		$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

		if($depth != 0) {
			$description = $append = $prepend = "";
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
/*-------------------------------------------*/
/*	Excerpt _ change ... 
/*-------------------------------------------*/
function biz_vektor_change_excerpt_more($post) {
	return ' ...';
}
add_filter('excerpt_more', 'biz_vektor_change_excerpt_more');

/*-------------------------------------------*/
/*	Year Artchive list 'year' insert to inner </a>
/*-------------------------------------------*/
function biz_vektor_my_archives_link($html){
  return preg_replace('@</a>(.+?)</li>@', '\1</a></li>', $html);
}
add_filter('get_archives_link', 'biz_vektor_my_archives_link');

/*-------------------------------------------*/
/*	Category list 'count insert to inner </a>
/*-------------------------------------------*/
function biz_vektor_add_my_list_categories( $output, $args ) {
	$output = preg_replace('/<\/a>\s*\((\d+)\)/',' ($1)</a>',$output);
	return $output;
}
add_filter( 'wp_list_categories', 'biz_vektor_add_my_list_categories', 10, 2 );


/*-------------------------------------------*/
/*	Block to delete iframe tag from TinyMCE
/*-------------------------------------------*/
function biz_vektor_add_iframe($initArray) {
$initArray['extended_valid_elements'] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]";
return $initArray;
}
add_filter('tiny_mce_before_init', 'biz_vektor_add_iframe');

/*-------------------------------------------*/
/*	Comment
/*-------------------------------------------*/
if ( ! function_exists( 'biz_vektor_comment' ) ) :
function biz_vektor_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="commentBox">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf(sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e('Your comment is awaiting approval.', 'bizvektor-global-edition'); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata">
		<?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?> <?php edit_comment_link( 'Edit', '<span class="edit-link">(', ')</span>' ); ?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>
		<div class="linkBtn linkBtnS">
		<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply', 'bizvektor-global-edition'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
		break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( __('Edit', 'bizvektor-global-edition'), '<span class="edit-link">(', ')</span>' ); ?>
	<?php
			break;
	endswitch;
}
endif;

/*-------------------------------------------*/
/*	Archive page link ( don't erase )
/*-------------------------------------------*/
function biz_vektor_content_nav( $nav_id ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div id="<?php echo $nav_id; ?>">
			<h4 class="assistive-text"><?php _e('Navigation', 'bizvektor-global-edition'); ?></h4>
			<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older post', 'bizvektor-global-edition')); ?></div>
			<div class="nav-next"><?php previous_posts_link(__('New post <span class="meta-nav">&rarr;</span>', 'bizvektor-global-edition')); ?></div>
		</div><!-- #nav -->
	<?php endif;
	wp_reset_query();
}

/*-------------------------------------------*/
/*	Paging
/*-------------------------------------------*/
function biz_vektor_pagination($max_num_pages = '', $range = 1) {
	$showitems = ($range * 2)+1;

	global $paged;
	if(empty($paged)) $paged = 1;

	if($max_num_pages == '') {
		global $wp_query;
		// the last page
		$max_num_pages = $wp_query->max_num_pages;
		if(!$max_num_pages) {
			 $max_num_pages = 1;
		}
	}

	if(1 != $max_num_pages) {
		echo '<div class="paging">'."\n";

		if ($paged > 1) echo '<a class="prev_link" href="'.get_pagenum_link($paged - 1).'">&laquo;</a>'."\n";

		if ( $paged-$range >= 2 && $max_num_pages > $showitems ) echo '<a href="'.get_pagenum_link(1).'">1</a>'."\n";
		if ( $paged-$range >= 3 && $max_num_pages > $showitems ) echo '<span class="txt_hellip">&hellip;</span>'."\n";

		$addPrevCount = $paged+$range-$max_num_pages;
		$addNextCount = -($paged-1-$range);
		for ($i=1; $i <= $max_num_pages; $i++) {
			if ($paged == $i) {
				$pageItem = '<span class="current">'.$i.'</span>'."\n";
			} else {
				$pageItem = '<a href="'.get_pagenum_link($i).'" class="inactive">'.$i.'</a>'."\n";
			}

			if ( ( $paged-$range <= $i && $i<= $paged+$range ) || $max_num_pages <= $showitems ) {
				echo $pageItem;
			} else if ( $paged-1-$range < 0 && $paged+$range+$addNextCount >= $i ) {
				echo $pageItem;
			} else if ( $paged+$range > $max_num_pages && $paged-$range-$addPrevCount <= $i ) {
				echo $pageItem;
			}
		}

		if ( $paged+$range <= $max_num_pages-2 && $max_num_pages > $showitems ) echo '<span class="txt_hellip">&hellip;</span>'."\n";
		if ( $paged+$range <= $max_num_pages-1 && $max_num_pages > $showitems ) echo '<a href="'.get_pagenum_link($max_num_pages).'">'.$max_num_pages.'</a>'."\n";
		if ($paged < $max_num_pages) echo '<a class="next_link" href="'.get_pagenum_link($paged + 1).'">&raquo;</a>'."\n";
		echo "</div>\n";
	 }
}


/*-------------------------------------------*/
/*	ChildPageList widget
/*-------------------------------------------*/
function biz_vektor_childPageList(){
	global $post;
	if (is_page()) {
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
				<div class="localSection sideWidget pageListSection">
				<h3 class="localHead"><a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h3>
				<ul class="localNavi">
				<?php echo $children; ?>
				</ul>
				</div>

		<?php }
		}
	} // is_page
}

/*-------------------------------------------*/
/*	posts pagenation setting in front-page
/*-------------------------------------------*/
add_action('pre_get_posts','biz_vektor_pre_get_posts_front_page');
function biz_vektor_pre_get_posts_front_page($query){
	$options = biz_vektor_get_theme_options();
	if(!isset($options['postTopCount'])){ $options['postTopCount'] = 0; }

		if ( is_admin() || ! $query->is_main_query() ){
		return;
	}
	if ( !is_page() && is_front_page()) {
		$query->set( 'posts_per_page', $options['postTopCount'] );
		return;
	}
}

/*-------------------------------------------*/
/*	HomePage _ add action filters
/*-------------------------------------------*/
function biz_vektor_contentMain_before(){
	do_action('biz_vektor_contentMain_before');
}
function biz_vektor_contentMain_after(){
	do_action('biz_vektor_contentMain_after');
}
function biz_vektor_sideTower_after(){
	do_action('biz_vektor_sideTower_after');
}
/*-------------------------------------------*/
/*	Archive _ loop custom filters
/*-------------------------------------------*/
function biz_vektor_archive_loop(){
	do_action('biz_vektor_archive_loop');
}
function is_biz_vektor_archive_loop(){
	return apply_filters('is_biz_vektor_archive_loop', false);
}
function is_biz_vektor_extra_single(){
	return apply_filters('is_biz_vektor_single_loop', false);
}
function biz_vektor_extra_single(){
	do_action('biz_vektor_extra_single');
}

/*-------------------------------------------*/
/*	Aceept favicon upload
/*-------------------------------------------*/
function biz_vektor_mine_types($a) {
    $a['ico'] = 'image/x-icon';
    return $a;
}
add_filter('upload_mimes', 'biz_vektor_mine_types');