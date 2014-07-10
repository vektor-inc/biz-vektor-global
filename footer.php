<?php
/**
 * The template for displaying the footer.
 */
?>
</div><!-- #main -->

<div id="back-top">
<a href="#wrap">
	<img id="pagetop" src="<?php echo get_template_directory_uri(); ?>/js/res-vektor/images/footer_pagetop.png" alt="PAGETOP" />
</a>
</div>

<!-- [ #footerSection ] -->
<div id="footerSection">

	<div id="pagetop">
	<div id="pagetopInner" class="innerBox">
	<a href="#wrap">PAGETOP</a>
	</div>
	</div>

	<div id="footMenu">
	<div id="footMenuInner" class="innerBox">
	<?php wp_nav_menu( array(
		'theme_location' => 'FooterNavi',
		'fallback_cb' => ''
	) ); ?>
	</div>
	</div>

	<!-- [ #footer ] -->
	<div id="footer">
	<!-- [ #footerInner ] -->
	<div id="footerInner" class="innerBox">
		<dl id="footerOutline">
		<dt><?php biz_vektor_footerSiteName(); ?></dt>
		<dd>
		<?php biz_vektor_print_footContact(); ?>
		</dd>
		</dl>
		<!-- [ #footerSiteMap ] -->
		<div id="footerSiteMap">
		<?php wp_nav_menu(
		array(
			'theme_location' => 'FooterSiteMap',
			'fallback_cb' => ''
		) ); ?>
		</div>
		<!-- [ /#footerSiteMap ] -->
	</div>
	<!-- [ /#footerInner ] -->
	</div>
	<!-- [ /#footer ] -->

	<!-- [ #siteBottom ] -->
	<div id="siteBottom">
	<div id="siteBottomInner" class="innerBox">
	<div id="copy">Copyright &copy; <a href="'.home_url( '/' ).'" rel="home"><?php echo bloginfo( 'name' ); ?></a> All Rights Reserved.</div>
	<div id="powerd">Powered by <a href="https://ja.wordpress.org/">WordPress</a> &amp; <a href="http://bizVektor.com" target="_blank" title="'.__('Free WordPress Theme BizVektor for business', 'biz-vektor').'">BizVektor Theme</a> by <a href="http://www.vektor-inc.co.jp" target="_blank" title="'._x('Vektor,Inc.', 'footer', 'biz-vektor').'">Vektor,Inc.</a> technology.</div>
	</div>
	</div>
	<!-- [ /#siteBottom ] -->
</div>
<!-- [ /#footerSection ] -->
</div>
<!-- [ /#wrap ] -->
<?php wp_footer();?>
</body>
</html>