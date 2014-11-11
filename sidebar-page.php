<?php if ( is_active_sidebar( 'common-side-top-widget-area' ) ) dynamic_sidebar( 'common-side-top-widget-area' ); ?>
<?php
if ( is_active_sidebar( 'page-widget-area' ) ) :
	dynamic_sidebar( 'page-widget-area' );
else :
	// ウィジェットに設定がない場合
	biz_vektor_childPageList();
	if (function_exists('biz_vektor_get_contactBtn')) biz_vektor_get_contactBtn();
endif; ?>
<?php if ( is_active_sidebar( 'common-side-bottom-widget-area' ) ) dynamic_sidebar( 'common-side-bottom-widget-area' ); ?>