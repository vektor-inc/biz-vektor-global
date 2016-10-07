<?php

/*-------------------------------------------*/
/*  Print header menu to head contact area
/*-------------------------------------------*/
add_filter('headContactCustom','rebuild_head_contact_custom');
function rebuild_head_contact_custom($headContact){
	$gMenuHtml = '';

	// ////////////// SubMenu
	// $sub_menu_args = array(
	//  'theme_location' => 'headerSubMenu',
	//  'fallback_cb' => '',
	//  'echo' => false,
	//  // 'walker' => new description_walker()
	// );
	// $headSubMenu = wp_nav_menu( $sub_menu_args ) ;

	////////////// Global menu
	$args = array(
	 'theme_location' => 'Header',
	 'fallback_cb' => '',
	 'echo' => false,
	 'walker' => new description_walker()
	);
	$gMenu = wp_nav_menu( $args ) ;

	if ($gMenu || $gMenuHtml) {
	$gMenuHtml .= '
	<!-- [ #gMenu ] -->
	<div id="gMenu">
	<div id="gMenuInner" class="innerBox">
	<h3 class="assistive-text" onclick="showHide(\'header\');"><span>MENU</span></h3>
	<div class="skip-link screen-reader-text">
		<a href="#content" title="'.__('Skip menu', 'bizvektor-global-edition').'">'.__('Skip menu', 'bizvektor-global-edition').'</a>
	</div>'."\n";

	// if ($headSubMenu) {
	// 	$gMenuHtml .= '<div class="headSubMenu">'."\n";
	// 	$gMenuHtml .= $headSubMenu;
	// 	$gMenuHtml .= '</div>'."\n";
	// }
	$gMenuHtml .= '<div class="headMainMenu">'."\n";
	$gMenuHtml .= $gMenu."\n";
	$gMenuHtml .= '</div>'."\n";
	$gMenuHtml .= '</div><!-- [ /#gMenuInner ] -->
	</div>
	<!-- [ /#gMenu ] -->'."\n";
	} // if ($gMenu) 
	$headContact = $gMenuHtml;
	return $headContact;
}

/*-------------------------------------------*/
/*  make empty the original globalmenu
/*-------------------------------------------*/
add_filter('bizvektor_gMenuHtml','rebuild_gMenu_custom');
function rebuild_gMenu_custom(){
	$gMenuHtml = '';
	return $gMenuHtml;
}

/*-------------------------------------------*/
/*  disable width of globalmenu
/*-------------------------------------------*/
add_filter('biz_vektor_gNenuDvide_disable', 'reguild_disable_gMenu');
function reguild_disable_gMenu(){
	return true;
}