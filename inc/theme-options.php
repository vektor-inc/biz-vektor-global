<?php
/*-------------------------------------------*/
/*	Set option default
/*-------------------------------------------*/
/*	Print option
/*-------------------------------------------*/
/*	Create title
/*-------------------------------------------*/
/*	layout
/*-------------------------------------------*/
/*	Add layout class to body tag
/*-------------------------------------------*/
/*	Add to the body tag class to turn off the side bar
/*-------------------------------------------*/
/*	Theme option edit
/*-------------------------------------------*/
/*	Theme style
/*-------------------------------------------*/
/*	Menu divide
/*-------------------------------------------*/
/*	Header logo
/*-------------------------------------------*/
/*	Header contact info (TEL & Time)
/*-------------------------------------------*/
/*	Home page _ blogList(RSS)
/*-------------------------------------------*/
/*	Home page _ bottom free area
/*-------------------------------------------*/
/*	mainfoot _ contact
/*-------------------------------------------*/
/*	Create keywords
/*-------------------------------------------*/
/*	footer
/*-------------------------------------------*/
/*	slide show
/*-------------------------------------------*/
/*	Print theme_options js
/*-------------------------------------------*/
/*	Side menu hidden
/*-------------------------------------------*/
/*	Contact Btn
/*-------------------------------------------*/
/*	Contact widget
/*-------------------------------------------*/
/*	Global Version Font size fix
/*-------------------------------------------*/


function biz_vektor_theme_options_init() {
	if ( false === biz_vektor_get_theme_options() )
		add_option( 'biz_vektor_theme_options', biz_vektor_get_default_theme_options() );

	register_setting(
		'biz_vektor_options',
		'biz_vektor_theme_options',
		'biz_vektor_theme_options_validate'
	);
}
add_action( 'admin_init', 'biz_vektor_theme_options_init' );

function biz_vektor_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_biz_vektor_options', 'biz_vektor_option_page_capability' );

function biz_vektor_theme_options_add_page() {
	$theme_page = add_theme_page(
		__('Theme Options', 'bizvektor-global-edition'),   					// Name of page
		__('Theme Options', 'bizvektor-global-edition'),   					// Label in menu
		'edit_theme_options',				// Capability required
		'theme_options',					// Menu slug, used to uniquely identify the page
		'biz_vektor_theme_options_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;
}
add_action( 'admin_menu', 'biz_vektor_theme_options_add_page' );

function biz_vektor_get_theme_options() {
	global $biz_vektor_options;
		$biz_vektor_options = get_option('biz_vektor_theme_options' );
	return $biz_vektor_options;
}

/*-------------------------------------------*/
/*	Print option
/*-------------------------------------------*/
function biz_vektor_Options($optionLabel) {
	$options = biz_vektor_get_theme_options();
	if ( isset( $options[$optionLabel] ) ) { // If !='' that 0 true
		return $options[$optionLabel];
	} else {
		$options_default = biz_vektor_get_default_theme_options();
		if (isset($options_default[$optionLabel]))
		return $options_default[$optionLabel];
	}
}

/*-------------------------------------------*/
/*	Create title
/*-------------------------------------------*/
function biz_vektor_getHeadTitle() {
	$options = biz_vektor_get_theme_options();
	global $wp_query;
	$post = $wp_query->get_queried_object();
	if (is_home() || is_page('home') || is_front_page()) {
	// Author
	} if (is_author()) {
		$userObj = get_queried_object();
		$headTitle = esc_html($userObj->display_name)." | ".get_bloginfo('name');
	// Page
	} else if (is_page()) {
		// Sub Pages
		if ( $post->post_parent ) {
			if($post->ancestors){
				foreach($post->ancestors as $post_anc_id){
					$post_id = $post_anc_id;
				}
			} else {
				$post_id = $post->ID;
			}
			$headTitle = get_the_title()." | ".get_the_title($post_id)." | ".get_bloginfo('name');
		// Not Sub Pages
		} else {
			$headTitle = get_the_title()." | ".get_bloginfo('name');
		}
	// Single
	} else if (is_single()) {
		$category = get_the_category();
		if (!empty($category)) :
			$headTitle = get_the_title()." | ".$category[0]->cat_name." | ".get_bloginfo('name');
		else :
			$headTitle = get_the_title()." | ".get_bloginfo('name');
		endif;
	// Category
	} else if (is_category()) {
		$headTitle = single_cat_title('',false)." | ".get_bloginfo('name');
	// Tag
	} else if (is_tag()) {
		$headTitle = single_tag_title('',false)." | ".get_bloginfo('name');
	// Archive
	} else if (is_archive()) {
		if (is_month()){
			$headTitle = sprintf( __( 'Monthly Archives: %s', 'bizvektor-global-edition' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'bizvektor-global-edition' ) ) );
		} else if (is_year()){
			$headTitle = sprintf( __( 'Yearly Archives: %s', 'bizvektor-global-edition' ), get_the_date( _x( 'Y', 'yearly archives date format', 'bizvektor-global-edition' ) ) );
		} else if (is_tax()){
			$headTitle = single_term_title('',false);
		} else if (!is_day() || !is_tax()){
			global $wp_query;
			$postTypeName = esc_html($wp_query->queried_object->labels->name);
			$headTitle .= $postTypeName;
		}
		$headTitle .= " | ".get_bloginfo('name');
	// Search
	} else if (is_search()) {
		$headTitle = sprintf(__('Search Results for : %s', 'bizvektor-global-edition'),get_search_query())." | ".get_bloginfo('name');
	//Other
	} else {
		$headTitle = get_bloginfo('name');
	}
	global $paged;
	if ( $paged != '0' ){
		$headTitle = '['.sprintf(__('Page of %s', 'bizvektor-global-edition' ),$paged).'] '.$headTitle;
	}
	$headTitle = apply_filters( 'titleCustom', $headTitle );
	return esc_html($headTitle);
}
add_filter( 'wp_title', 'biz_vektor_getHeadTitle', 10, 2 );

/*-------------------------------------------*/
/*	layout
/*-------------------------------------------*/
function biz_vektor_layouts() {
	$layout_options = array(
		'sidebar-content' => array(
			'value' => 'sidebar-content',
			'label' => __('Left sidebar', 'bizvektor-global-edition'),
			'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-content.png',
		),
		'content-sidebar' => array(
			'value' => 'content-sidebar',
			'label' => __('Right sidebar', 'bizvektor-global-edition'),
			'thumbnail' => get_template_directory_uri() . '/inc/images/content-sidebar.png',
		),
	);
	return apply_filters( 'biz_vektor_layouts', $layout_options );
}

/*-------------------------------------------*/
/*	Add layout class to body tag
/*-------------------------------------------*/

function biz_vektor_layout_classes( $existing_classes ) {
	$options = biz_vektor_get_theme_options();
	$current_layout = $options['theme_layout'];

	if ( in_array( $current_layout, array( 'content-sidebar', 'sidebar-content' ) ) )
		$classes = array( 'two-column' );

	if ( 'content-sidebar' == $current_layout )
		$classes[] = 'right-sidebar';
	elseif ( 'sidebar-content' == $current_layout )
		$classes[] = 'left-sidebar';
	else
		$classes[] = $current_layout;

	$classes = apply_filters( 'biz_vektor_layout_classes', $classes, $current_layout );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'biz_vektor_layout_classes' );

/*-------------------------------------------*/
/*	Add to the body tag class to turn off the side bar
/*-------------------------------------------*/
function biz_vektor_topSideBarDisplay( $existing_classes ) {
	if (is_front_page()){
		$options = biz_vektor_get_theme_options();
		if ($options['topSideBarDisplay'] ){
			$classes[] = 'one-column';
			// remove layout class
			$existing_classes = array_diff( $existing_classes , array('right-sidebar','left-sidebar','two-column') );
			// merge 'one-column'
			$existing_classes = array_merge( $existing_classes, $classes );
		}
	}
	return $existing_classes;
}
add_filter( 'biz_vektor_layout_classes', 'biz_vektor_topSideBarDisplay' );

/*-------------------------------------------*/
/*	Theme option edit
/*-------------------------------------------*/

get_template_part('inc/theme-options-edit');

/*-------------------------------------------*/
/*	Theme style
/*-------------------------------------------*/

//	[1] Set theme style array
function biz_vektor_theme_styleSetting() {
	global $biz_vektor_theme_styles;
	$biz_vektor_theme_styles = array(
		'rebuild' => array(
			'label' => 'Rebuild',
			'cssPath' => get_template_directory_uri().'/bizvektor_themes/003/css/003.css',
			'cssPathOldIe' => get_template_directory_uri().'/bizvektor_themes/003/css/003_oldie.css',
			),
		'calmly' => array(
			'label' => 'Calmly',
			'cssPath' => get_template_directory_uri().'/bizvektor_themes/002/002.css',
			'cssPathOldIe' => get_template_directory_uri().'/bizvektor_themes/002/002_oldie.css',
			),
		'plain' => array(
			'label' => __('Plain', 'bizvektor-global-edition'),
			'cssPath' => get_template_directory_uri().'/bizvektor_themes/plain/plain.css',
			'cssPathOldIe' => get_template_directory_uri().'/bizvektor_themes/plain/plain_oldie.css',
			),
		'default' => array(
			'label' => 'Default',
			'cssPath' => get_template_directory_uri().'/bizvektor_themes/001/001.css',
			'cssPathOldIe' => get_template_directory_uri().'/bizvektor_themes/001/001_oldie.css',
			),
	);
	// [2] Receive 'theme style array' from the plug-in
	$biz_vektor_theme_styles = apply_filters( 'biz_vektor_themePlus', $biz_vektor_theme_styles );
}

// [4] Print theme style css
add_action('wp_enqueue_scripts','biz_vektor_theme_style',100 );
function biz_vektor_theme_style() {
	$options = biz_vektor_get_theme_options();
	// Set bbiz_vektor_theme_styles
	global $biz_vektor_theme_styles;
	biz_vektor_theme_styleSetting();

	$themePath = $biz_vektor_theme_styles[$options['theme_style']]['cssPath'];
	wp_enqueue_style('bizvektor_style_theme', $themePath, array(), '1.0.0');

}

/*-------------------------------------------*/
/*	Menu divide
/*-------------------------------------------*/
add_action('wp_head','biz_vektor_gMenuDivide',170 );
function biz_vektor_gMenuDivide() {
	$options = biz_vektor_get_theme_options();
	// No select
	if ($options['gMenuDivide'] == __('[ Select ]', 'bizvektor-global-edition') || ! $options['gMenuDivide'] || ($options['gMenuDivide'] == 'divide_natural' || apply_filters('biz_vektor_gNenuDvide_disable', false)) ) {
	// other
	} else {
		$menuWidth = array(
			'divide_4' => array(238,237),
			'divide_5' => array(193,189),
			'divide_6' => array(159,158),
			'divide_7' => array(139,135),
			);
		$menuWidthActive = $menuWidth[$options['gMenuDivide']][0];
		$menuWidthNonActive = $menuWidth[$options['gMenuDivide']][1];
echo '<style type="text/css">
/*-------------------------------------------*/
/*	menu divide
/*-------------------------------------------*/
@media (min-width: 970px) {
#gMenu .menu li { width:'.$menuWidthNonActive.'px; text-align:center; }
#gMenu .menu li.current_page_item,
#gMenu .menu li.current_page_ancestor { width:'.$menuWidthActive.'px; }
}
</style>'."\n";
echo '<!--[if lte IE 8]>
<style type="text/css">
#gMenu .menu li { width:'.$menuWidthNonActive.'px; text-align:center; }
#gMenu .menu li.current_page_item,
#gMenu .menu li.current_page_ancestor { width:'.$menuWidthActive.'px; }
</style>
<![endif]-->'."\n";
	}
}

/*-------------------------------------------*/
/*	Header logo
/*-------------------------------------------*/
function biz_vektor_print_headLogo() {
	$options = biz_vektor_get_theme_options();
	$head_logo = $options['head_logo'];
	if ($options['head_logo']) {
		print '<img src="'.$options['head_logo'].'" alt="'.get_bloginfo('name').'" />';
	} else {
		echo bloginfo('name');
	}
}
/*-------------------------------------------*/
/*	Header contact info (TEL & Time)
/*-------------------------------------------*/
function biz_vektor_print_headContact() {
	$options = biz_vektor_get_theme_options();
	$contact_txt = $options['contact_txt'];
	$contact_time = nl2br($options['contact_time']);
	$headContact = '';
	if ($options['tel_number']) {
		// tel_number
		$headContact = '<div id="headContact" class="itemClose" onclick="showHide(\'headContact\');"><div id="headContactInner">'."\n";
			if ($contact_txt) {
				// contact_txt
				$headContact .= '<div id="headContactTxt">'.$contact_txt.'</div>'."\n";
			}
			// mobile
			if ( function_exists('wp_is_mobile') && wp_is_mobile() ) {
				$headContact .= '<div id="headContactTel">TEL <a href="tel:'.$options['tel_number'].'">'.$options['tel_number'].'</a></div>'."\n";
			// not mobile
			} else {
				$headContact .= '<div id="headContactTel">TEL '.$options['tel_number'].'</div>'."\n";
			}
			if ($contact_time) {
				// contact_time
				$headContact .= '<div id="headContactTime">'.$contact_time.'</div>'."\n";
			}
		$headContact .=	'</div></div>';
	}
	// set filter to $headContact
	$headContact = apply_filters( 'headContactCustom', $headContact );
	echo $headContact;
}

/*-------------------------------------------*/
/*	Home page _ blogList(RSS)
/*-------------------------------------------*/
function biz_vektor_blogList()	{
	$options = biz_vektor_get_theme_options();
	$blogRss = $options['blogRss'];
	if ($blogRss) {
?>
	<div id="topBlog" class="infoList">
	<h2><?php echo esc_html( biz_vektor_Options('rssLabelName')); ?></h2>
	<div class="rssBtn"><a href="<?php echo $blogRss ?>" id="blogRss" target="_blank">RSS</a></div>
		<?php
		$xml = simplexml_load_file($blogRss);
		$count = 0;
		echo '<ul class="entryList">';
		if ($xml->channel->item){
			// WordPress ameblo
			foreach($xml->channel->item as $entry){
			// fot ameblo PR
			$entryTitJudge = mb_substr( $entry->title, 0, 3 );	// trim 3 charactors
			if (!($entryTitJudge == 'PR:')) { 					// Display to only not 'PR:
				 $entrydate = date ( "Y.m.d",strtotime ( $entry->pubDate ) );
				 echo '<li><span class="infoDate">'.$entrydate.'</span>';
				 echo '<span class="infoTxt"><a href="'.$entry->link.'" target="_blank">'.$entry->title.'</a></span></li>';
				 $count++;
			}
			 if ($count > 4){break;}
			}
		} else if ($xml->item){
			// RSS 1.0 (FC2)
			foreach($xml->item as $entry){
				$dc = $entry->children('http://purl.org/dc/elements/1.1/');
				$entrydate = date('Y.m.d', strtotime($dc->date));
				 echo '<li><span class="infoDate">'.$entrydate.'</span>';
				 echo '<span class="infoTxt"><a href="'.$entry->link.'" target="_blank">'.$entry->title.'</a></span></li>';
				 $count++;
			 if ($count > 4){break;}
			}
		} else {
			// livedoor
			foreach($xml->entry as $entry){
				 $entrydate = substr(( $entry->modified ),0,10);
				 $entrydate = str_replace("-", ".", $entrydate);
				 echo '<li><span class="infoDate">'.$entrydate.'</span>';
				 echo '<span class="infoTxt"><a href="'.$entry->link->attributes()->href.'" target="_blank">'.$entry->title.'</a></span></li>';
				 $count++;
			 if ($count > 4){break;}
			}
		}
		echo "</ul>";
		?>
	</div><!-- [ /#topBlog ] -->
<?php
	}
}
/*-------------------------------------------*/
/*	Home page _ bottom free area
/*-------------------------------------------*/

function biz_vektor_topContentsBottom()	{
	$options = biz_vektor_get_theme_options();
	$topContentsBottom = $options['topContentsBottom'];
	if ($topContentsBottom) {
		echo '<div id="topContentsBottom">'."\n";
		echo $topContentsBottom;
		if ( is_user_logged_in() == TRUE ) {
			echo '<div class="adminEdit edit-item">'."\n";
			echo '<a href="'.get_admin_url().'/themes.php?page=theme_options#topPage" class="btn btnS btnAdmin">';
			echo __('Edit', 'bizvektor-global-edition');
			echo '</a>'."\n";
			echo '</div>'."\n";
		}
		echo '</div>'."\n";
	}
}


/*-------------------------------------------*/
/*	mainfoot _ contact
/*-------------------------------------------*/
function biz_vektor_mainfootContact() {
	$options = biz_vektor_get_theme_options();
	$contact_txt = $options['contact_txt'];
	$contact_time = nl2br($options['contact_time']);
		if ($contact_txt) {
			print '<span class="mainFootCatch">'.$contact_txt.'</span>'."\n";
		}
	if ($options['tel_number']) {
		// mobile
		if ( function_exists('wp_is_mobile') && wp_is_mobile() ) {
			echo '<span class="mainFootTel">TEL <a href="tel:'.$options['tel_number'].'">'.$options['tel_number'].'</a></span>'."\n";
		// not mobile
		} else {
			echo '<span class="mainFootTel">TEL '.$options['tel_number'].'</span>'."\n";
		}
		if ($contact_time) {
			print '<span class="mainFootTime">'.$contact_time.'</span>'."\n";
		}
	}
}

/*-------------------------------------------*/
/*	Create keywords
/*-------------------------------------------*/
function biz_vektor_getHeadKeywords(){
	$options = biz_vektor_get_theme_options();
	if (isset($options['commonKeyWords'])) {
		$commonKeyWords = esc_html($options['commonKeyWords']);
		// display common keywords
		echo $commonKeyWords;
	}
	if ( is_page() || is_single() ) {
		// get custom field
		$entryKeyWords = esc_html(post_custom('metaKeyword'));
	}
	// If common and individual keywords exist, print ','.
	if ( isset($commonKeyWords) && $commonKeyWords && isset($entryKeyWords) && $entryKeyWords) {
		echo ',';
	}
	// print individual keywords
	echo (isset($entryKeyWords)) ? $entryKeyWords : '';
}

/*-------------------------------------------*/
/*	footer
/*-------------------------------------------*/

function biz_vektor_footerSiteName() 		{
	$options = biz_vektor_get_theme_options();
	if ($options['sub_sitename']) {
		$footSiteName = nl2br($options['sub_sitename']);
	} else {
		$footSiteName = get_bloginfo( 'name' );
	}
	if ($options['foot_logo']) {
		print '<img src="'.$options['foot_logo'].'" alt="'.$footSiteName.'" />';
	} else {
		echo $footSiteName;
	}
}
function biz_vektor_print_footContact() {
	$options = biz_vektor_get_theme_options();
	$contact_address = wp_kses_post($options['contact_address']);
	if ($contact_address) {
		print $contact_address;
	}
}

/*-------------------------------------------*/
/*	slide show
/*-------------------------------------------*/
function biz_vektor_slideExist () {
	$options = biz_vektor_get_theme_options();
	if (
		($options['slide1image'] && (!$options['slide1display'])) ||
		($options['slide2image'] && (!$options['slide2display'])) ||
		($options['slide3image'] && (!$options['slide3display'])) ||
		($options['slide4image'] && (!$options['slide4display'])) ||
		($options['slide5image'] && (!$options['slide5display']))
	){
	return true;
	}
}

function biz_vektor_slideBody(){
	$options = biz_vektor_get_theme_options();
	for ( $i = 1; $i <= 5 ; $i++){
		if ($options['slide'.$i.'image']) {
			if (!$options['slide'.$i.'display']) {
				print '<li>';
				if ($options['slide'.$i.'link']) {
					$blank = "";
					if ($options['slide'.$i.'blank']) : $blank = ' target="_blank"'; endif;
					print '<a href="'.$options['slide'.$i.'link'].'" class="slideFrame"'.$blank.'>';
				} else	{
					print '<span class="slideFrame">';
				}
				print '<img src="'.$options['slide'.$i.'image'].'" alt="'.$options['slide'.$i.'alt'].'" />';
				if ($options['slide'.$i.'link']) {
					print '</a>';
				} else {
					print '</span>';
				}
				print '</li>'."\n";
			}
		}
	}
}

/*-------------------------------------------*/
/*	Print theme_options js
/*-------------------------------------------*/
add_action('admin_print_scripts-appearance_page_theme_options', 'biz_vektor_admin_theme_options_plugins');
function biz_vektor_admin_theme_options_plugins( $hook_suffix ) {
	wp_enqueue_media();
	wp_register_script( 'biz_vektor-theme-options', get_template_directory_uri().'/inc/theme-options.js', array('jquery'), '20120902' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'biz_vektor-theme-options' );
}

/*-------------------------------------------*/
/*	Change fonts
/*-------------------------------------------*/
add_action( 'wp_head','biz_vektor_fontStyle',170);
function biz_vektor_fontStyle(){
	$options = biz_vektor_get_theme_options();
	$font_face_serif = _x('serif', 'Font select', 'bizvektor-global-edition');
	$font_face_serif = apply_filters( 'font_face_serif_custom', $font_face_serif );
	$font_face_sans_serif = _x('Meiryo,Osaka,sans-serif', 'Font select', 'bizvektor-global-edition');
	$font_face_sans_serif = apply_filters( 'font_face_sans_serif_custom', $font_face_sans_serif );
	if ( isset($options['font_title']) ) {
		if ( $options['font_title'] == 'serif') {
			$font_title_face = $font_face_serif ;
			$font_title_weight = 'bold';
		} else {
			$font_title_face = $font_face_sans_serif;
			$font_title_weight = 'lighter';
		}
	}
	if ( isset($options['font_menu']) ) {
		if ( $options['font_menu'] == 'serif') {
			$font_menu_face = $font_face_serif ;
		} else {
			$font_menu_face = $font_face_sans_serif;
		}
	}
	if ( ( isset($font_title_face) && $font_title_face ) || ( isset($font_menu_face) && $font_menu_face) ) {
		$font_style_head = '<style type="text/css">
/*-------------------------------------------*/
/*	font
/*-------------------------------------------*/'."\n";
	}
	if ( isset($font_title_face) && $font_title_face ){
		$font_style_head .= 'h1,h2,h3,h4,h4,h5,h6,#header #site-title,#pageTitBnr #pageTitInner #pageTit,#content .leadTxt,#sideTower .localHead {font-family: '.$font_title_face.'; }'."\n";
		$font_style_head .= '#pageTitBnr #pageTitInner #pageTit { font-weight:'.$font_title_weight.'; }'."\n";
	}
	if ( isset($font_menu_face) && $font_menu_face ){
		$font_style_head .= '#gMenu .menu li a strong {font-family: '.$font_menu_face.'; }'."\n";
	}
	if ( ( isset($font_title_face) && $font_title_face ) || ( isset($font_menu_face) && $font_menu_face) ) {
		$font_style_head .= '</style>'."\n";
	}
	// Output font style
	if ( isset($font_style_head) && $font_style_head ) echo $font_style_head;
}

/*-------------------------------------------*/
/*	Side menu hidden
/*-------------------------------------------*/
add_action( 'wp_head','biz_vektor_sideChildDisplay');
function biz_vektor_sideChildDisplay(){
	$options = biz_vektor_get_theme_options();
	if ( isset($options['side_child_display'] ) && $options['side_child_display'] == 'side_child_hidden' ) { ?>
<style type="text/css">
/*-------------------------------------------*/
/*	sidebar child menu display
/*-------------------------------------------*/
#sideTower	ul.localNavi ul.children	{ display:none; }
#sideTower	ul.localNavi li.current_page_ancestor	ul.children,
#sideTower	ul.localNavi li.current_page_item		ul.children,
#sideTower	ul.localNavi li.current-cat				ul.children{ display:block; }
</style>
	<?php
	}
}


/*-------------------------------------------*/
/*	Contact Btn
/*-------------------------------------------*/
function biz_vektor_get_contactBtn(){
	$options = biz_vektor_get_theme_options();
	if ($options['contact_link']) :
	$contactBtn = '<ul>';
	$contactBtn .= '<li class="sideBnr" id="sideContact"><a href="'.$options['contact_link'].'">'."\n";
	$contactBtn .= '<img src="'.get_template_directory_uri().'/images/'.__('bnr_contact.png', 'bizvektor-global-edition').'" alt="'.__('Contact us by e-mail', 'bizvektor-global-edition').'"></a></li>'."\n";
	
	$contactBtn .= '</ul>'."\n";
	return $contactBtn;
	endif;
}

function biz_vektor_get_name() {
	$name = 'BizVektor';
	$name = apply_filters( 'bizvektor_name', $name );
	return $name;
}

function biz_vektor_get_default_theme_options(){
	// default options 
	$default_theme_options = array(
		'font_title'           => 'serif',
		'font_menu'            => 'serif',
		'gMenuDivide'          => 'divide_natural',
		'head_logo'            => '',
		'foot_logo'            => '',
		'contact_txt'          => '',
		'tel_number'           => '',
		'contact_time'         => '',
		'sub_sitename'         => '',
		'contact_address'      => '',
		'contact_link'         => '',
		'topTitle'             => '',
		'commonKeyWords'       => '',
		'header_image_height'  => 250,
		'enableie8Warning'     => true,
		'topEntryTitleDisplay' => '',
		'topSideBarDisplay'    => false,
		'top3PrDisplay'        => '',
		'postTopCount'         => '5',
		'postTopUrl'           => '',
		'listBlogTop'          => 'listType_set',
		'listBlogArchive'      => 'listType_set',
		'blogRss'              => '',
		'side_child_display'   => 'side_child_display',
		'rssLabelName'         => 'Blog entries',
		'favicon'              => '',
		'theme_layout'         => 'content-sidebar',
		'postLabelName'        => 'Blog',
		'theme_style'          => 'default',
		'enable_google_font'   => 'true',
		'pr1_title'            => __('Rich & Powerfull theme options', 'bizvektor-global-edition'),
		'pr1_description'      => __('This area can be changed from the theme customizer as well as from the theme options section.', 'bizvektor-global-edition'),
		'pr1_link'             => '',
		'pr1_image'            => get_template_directory_uri().'/images/samples/pr_image_demo_1.jpg',
		'pr1_image_s'          => get_template_directory_uri().'/images/samples/pr_image_demo_sq_1.jpg',
		'pr2_title'            => __('Various designs available', 'bizvektor-global-edition'),
		'pr2_description'      => __('BizVektor will allow you not only to change the color of the site, but also to switch to a different design.', 'bizvektor-global-edition'),
		'pr2_link'             => '',
		'pr2_image'            => get_template_directory_uri().'/images/samples/pr_image_demo_2.jpg',
		'pr2_image_s'          => get_template_directory_uri().'/images/samples/pr_image_demo_sq_2.jpg',
		'pr3_title'            => __('Optimized for business web sites', 'bizvektor-global-edition'),
		'pr3_description'      => __('Various indispensable business features as child page templates or enquiry capture are included.', 'bizvektor-global-edition'),
		'pr3_link'             => '',
		'pr3_image'            => get_template_directory_uri().'/images/samples/pr_image_demo_3.jpg',
		'pr3_image_s'          => get_template_directory_uri().'/images/samples/pr_image_demo_sq_3.jpg',
		'version'              => "g1.0.8",
		'SNSuse'               => false,

		/// this is option of Standard Edition
		/*
		If these options don't exist that,
		If install "Global Edition" to "Standard Edition" already installed website,
		Disappear many Standard Edition's setting items.
		*/
		'global_font'          => 'Open+Sans',
		'postRelatedCount'     => '6',
		'infoTopCount'         => '5',
		'gaID'                 => '',
		'gaType'               => 'gaType_normal',
		'infoLabelName'        => __('Information', 'bizvektor-global-edition'),
		'infoTopUrl'           => home_url().'/info/',
		'listInfoTop'          => 'listType_set',
		'listInfoArchive'      => 'listType_set',
		'ad_conent_moretag'    => '',
		'ad_conent_after'      => '',
		'ad_related_after'     => '',
		'twitter'              => '',
		'facebook'             => '',
		'fbAppId'              => '',
		'fbAdminId'            => '',
		'ogpImage'             => '',
		'ogpTagDisplay'        => 'ogp_on',
		'snsBtnsFront'         => '',
		'snsBtnsPage'          => '',
		'snsBtnsPost'          => '',
		'snsBtnsInfo'          => '',
		'snsBtnsHidden'        => '',
		'fbCommentsFront'      => '',
		'fbCommentsPage'       => '',
		'fbCommentsPost'       => '',
		'fbCommentsInfo'       => '',
		'fbCommentsHidden'     => '',
		'fbLikeBoxFront'       => '',
		'fbLikeBoxSide'        => '',
		'fbLikeBoxURL'         => '',
		'fbLikeBoxStream'      => '',
		'fbLikeBoxFace'        => '',
		'fbLikeBoxHeight'      => '',
	);
	for ( $i = 1; $i <= 5 ;){
		$default_theme_options['slide'.$i.'link'] = '';
		$default_theme_options['slide'.$i.'image'] = '';
		$default_theme_options['slide'.$i.'alt'] = '';
		$default_theme_options['slide'.$i.'display'] = '';
		$default_theme_options['slide'.$i.'blank'] = '';
	$i++;
	}
	return $default_theme_options;
}


/*-------------------------------------------*/
/*	
/*	@return array(options)
/*-------------------------------------------*/
function biz_vektor_option_validate(){
	$option = get_option('biz_vektor_theme_options');
	$default = biz_vektor_get_default_theme_options();

	if($option && is_array($option)){
		$keys = array_keys($option);
		foreach($keys as $key){
			if( !isset($option[$key]) && $key != 'version'){
				$option[$key] = $default[$key];
			}
		}
	}
	else {
		$option = $default;
	}
	return $option;
}

/*-------------------------------------------*/
/*	Global Version Font size fix
/*-------------------------------------------*/

function displays_global_css() { ?>
		<style type="text/css">
		/*-------------------------------------------*/
		/*	default global version style
		/*-------------------------------------------*/
		body { font-size: 1.05em; }
		.sideTower .localSection li ul li { font-size: 0.9em; }
		</style>
	<?php
}
if ( 'ja' != get_locale() ) {
	add_action( 'wp_head','displays_global_css');
}