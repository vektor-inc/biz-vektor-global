<!DOCTYPE html>
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="edge" />
<![endif]-->
<?php global $biz_vektor_options;
biz_vektor_get_theme_options(); ?>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="start" href="<?php echo site_url(); ?>" title="HOME" />
<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrap">
<!-- [ #headerTop ] -->
<div id="headerTop">
<div class="innerBox">
<div id="site-description"><?php bloginfo( 'description' ); ?></div>
</div>
</div><!-- [ /#headerTop ] -->

<!-- [ #header ] -->
<div id="header">
<div id="headerInner" class="innerBox">
<!-- [ #headLogo ] -->
<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
<<?php echo $heading_tag; ?> id="site-title">
<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>" rel="home">
<?php biz_vektor_print_headLogo(); ?>
</a>
</<?php echo $heading_tag; ?>>
<!-- [ #headLogo ] -->

<!-- [ #headContact ] -->
<?php biz_vektor_print_headContact(); ?>
<!-- [ /#headContact ] -->


</div>
<!-- #headerInner -->
</div>
<!-- [ /#header ] -->

<?php
$args = array(
 'theme_location' => 'Header',
 'fallback_cb' => '',
 'echo' => false,
 'walker' => new description_walker()
);
$gMenu = wp_nav_menu( $args ) ;
// メニューがセットされていたら実行
if ($gMenu) {
// ナビのHTMLを一旦変数に格納
$gMenuHtml = '
<!-- [ #gMenu ] -->
<div id="gMenu" class="itemClose" onclick="showHide(\'gMenu\');">
<div id="gMenuInner" class="innerBox">
<h3 class="assistive-text"><span>MENU</span></h3>
<div class="skip-link screen-reader-text">
	<a href="#content" title="'.__('Skip menu', 'bizvektor-global-edition').'">'.__('Skip menu', 'bizvektor-global-edition').'</a>
</div>'."\n";
$gMenuHtml .= $gMenu."\n";
$gMenuHtml .= '</div><!-- [ /#gMenuInner ] -->
</div>
<!-- [ /#gMenu ] -->'."\n";
// gMenuのHTMLにフックを設定
$gMenuHtml = apply_filters( 'bizvektor_gMenuHtml', $gMenuHtml );
// gMenuのHTMLを出力
echo $gMenuHtml;
} // if ($gMenu) 
?>

<?php wp_reset_query(); ?>
<?php if (!is_front_page()) { ?>
<?php get_template_part('module_pageTit'); ?>
<?php get_template_part('module_panList'); ?>
<?php } ?>

<?php if (is_front_page() && (biz_vektor_slideExist() || get_header_image()) ) { ?>
<div id="topMainBnr">
<div id="topMainBnrFrame"<?php if (biz_vektor_slideExist()) echo ' class="flexslider"';?>>
<?php if(biz_vektor_slideExist()) { ?>
	<ul class="slides">
	<?php biz_vektor_slideBody(); ?>
	</ul>
<?php } else { ?>
	<div class="slideFrame"><img src="<?php header_image(); ?>" alt="" /></div>
<?php } ?>
</div>
</div>
<?php } ?>
<div id="main">