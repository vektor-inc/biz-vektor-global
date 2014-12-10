<?php
/*-------------------------------------------*/
/*	Design setting
/*-------------------------------------------*/
/*	Contact information
/*-------------------------------------------*/
/*	3PR area
/*-------------------------------------------*/
/*	Blog
/*-------------------------------------------*/
/*	SEO and Google Analytics Setting
/*-------------------------------------------*/
/*	Toppage setting
/*-------------------------------------------*/
/*	Slide Setting
/*-------------------------------------------*/

function biz_vektor_theme_options_render_page() { ?>
	<div class="wrap" id="biz_vektor_options">
		<h2><?php printf( __( '%s Theme Options', 'biz-vektor' ), wp_get_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<?php if ( function_exists( 'biz_vektor_activation' ) ) {
		biz_vektor_activation_information();
		} else { ?>
		<div id="sub-content" style="background-color: #f5f5f5;">
			<a style="display:block;border-bottom:1px solid #ccc;" href="http://bizvektor.com/en/" target="_blank" title="BizVektor Standard Edition Official Website">
				<img style="width:100%;height:auto;display:block;" src="<?php echo get_template_directory_uri() ?>/inc/images/global-banner-bizvekto-standard-ad.jpg" height="805" width="561" alt="BizVektor Standard Edition Official Website" />
			</a>
			<p style="padding: 20px 20px 0px 20px;font-size: 14px;line-height: 1.5em;margin: 0;">Thank you for using BizVektor Global Edition!<br />
			For a more powerful and <strong>business ready</strong> theme you can download for FREE BizVektor Standard Edition.
			</p>
			<p style="padding: 10px 20px 20px 20px;font-size: 14px;line-height: 1.5em;margin: 0;">
				With <a href="http://bizvektor.com/en/" target="_blank" title="BizVektor Standard Edition FREE download">BizVektor Standard Edition</a> you get a <strong>complete solution</strong> for your company website!
			</p>
		</div>
		<?php } ?>

		<?php global $biz_vektor_options;
		biz_vektor_get_theme_options(); ?>
		<div id="main-content">
		<p class="message_intro">
	<?php $customizer_link = '<a href="'.get_admin_url().'customize.php">'.__('Theme customizer','biz-vektor').'</a>'; ?>
	<?php _e('Thank you for using BizVektor.', 'biz-vektor');?> 
	<?php printf(__('You can change basic design settings from %s', 'biz-vektor'),$customizer_link); ?> <br />
	<?php _e('Here you can change social media settings.','biz-vektor'); ?>

		</p>
		<form method="post" action="options.php">
			<?php
				settings_fields( 'biz_vektor_options' );
				$options = biz_vektor_get_theme_options();
				$default_options = biz_vektor_get_default_theme_options();
			?>
<?php
/*-------------------------------------------*/
/*	Design setting
/*-------------------------------------------*/
?>
<div id="design" class="sectionBox">
<?php get_template_part('inc/theme-options-nav'); ?>
<h3><?php _ex('Design settings', 'biz-vektor theme-options-edit', 'biz-vektor'); ?>
	<span class="message_box">
		<?php printf(__('You can change settings for this section also from %s', 'biz-vektor'), $customizer_link ); ?>
	</span>
</h3>
	<table class="form-table">
	<tr>
	<th><?php _e('Design skin', 'biz-vektor') ?></th>
	<td>
	<select name="biz_vektor_theme_options[theme_style]" id="<?php echo esc_attr( $options['theme_style'] ); ?>">
	<option value="">[ <?php _e('Select', 'biz-vektor') ?> ]</option>
	<?php
	// Read biz_vektor_theme_styles
	global $biz_vektor_theme_styles;
	biz_vektor_theme_styleSetting();
	// Create pulldown item
	foreach( $biz_vektor_theme_styles as $biz_vektor_theme_styleKey => $biz_vektor_theme_styleValues) {
			if ( $biz_vektor_theme_styleKey == $options['theme_style'] ) {
				print ('<option value="'.$biz_vektor_theme_styleKey.'" selected>'.$biz_vektor_theme_styleValues['label'].'</option>');
			} else {
				print ('<option value="'.$biz_vektor_theme_styleKey.'">'.$biz_vektor_theme_styleValues['label'].'</option>');
			}
	}
	?>
	</select>
	<?php
	global $themePlusSettingNavi;
	$themePlusSettingNavi = '<p>'.__('* If there are settings for the particular design skin, after you save your changes, you can update them from theme customizer.', 'biz-vektor').'</p>';
	$themePlusSettingNavi = apply_filters( 'themePlusSettingNavi', $themePlusSettingNavi );
	echo $themePlusSettingNavi;
	?>
	</td>
	</tr>
	<!-- Menu divide -->
	<tr>
	<th><?php _ex('Number of header menus', 'biz-vektor theme-customizer', 'biz-vektor') ;?></th>
	<td>
	<select name="biz_vektor_theme_options[gMenuDivide]" id="<?php echo esc_attr( $options['gMenuDivide'] ); ?>">
	<option value="">[ <?php _e('Select', 'biz-vektor') ?> ]</option>
	<?php
	$biz_vektor_gMenuDivides = array(
		'divide_natural' => _x('Not specified (left-justified)','biz-vektor theme-customizer', 'biz-vektor'),
		'divide_4' => _x('4', 'biz-vektor theme-customizer', 'biz-vektor'),
		'divide_5' => _x('5', 'biz-vektor theme-customizer', 'biz-vektor'),
		'divide_6' => _x('6', 'biz-vektor theme-customizer', 'biz-vektor'),
		'divide_7' => _x('7', 'biz-vektor theme-customizer', 'biz-vektor')
	);
	if( $options['gMenuDivide'] == ''){
		$options['gMenuDivide'] = 'divide_natural';
	}
	foreach( $biz_vektor_gMenuDivides as $biz_vektor_gMenuDivideKey => $biz_vektor_gMenuDivideValue) {
		if ( $biz_vektor_gMenuDivideKey == $options['gMenuDivide'] ) {
			print ('<option value="'.$biz_vektor_gMenuDivideKey.'" selected>'.$biz_vektor_gMenuDivideValue.'</option>');
		} else {
			print ('<option value="'.$biz_vektor_gMenuDivideKey.'">'.$biz_vektor_gMenuDivideValue.'</option>');
		}
	}
	?>
	</select>
	</td>
	</tr>
	<!-- Head logo -->
	<tr>
	<th scope="row"><?php _ex('Header logo image', 'biz-vektor theme-customizer', 'biz-vektor') ;?></th>
	<td><input type="text" name="biz_vektor_theme_options[head_logo]" id="head_logo" value="<?php echo esc_attr( $options['head_logo'] ); ?>" style="width:60%;" /> 
	<button id="media_head_logo" class="media_btn"><?php _e('Select image', 'biz-vektor') ;?></button><br />
	<?php _e('Recommended : less than 60px height', 'biz-vektor') ;?><br />
	</td>
	</tr>
	<!-- Footer logo -->
	<tr>
	<th scope="row"><?php _ex('Footer logo image', 'biz-vektor theme-customizer', 'biz-vektor') ;?></th>
	<td><input type="text" name="biz_vektor_theme_options[foot_logo]" id="foot_logo" value="<?php echo esc_attr( $options['foot_logo'] ); ?>" style="width:60%;" /> 
	<button id="media_foot_logo" class="media_btn"><?php _e('Select image', 'biz-vektor') ;?></button><br />
	<?php _e('Recommended : 180-250px width', 'biz-vektor') ;?><br />
	</td>
	</tr>
	<!-- theme-layout -->
	<tr class="image-radio-option theme-layout">
	<th scope="row"><?php _ex('Layout', 'biz-vektor theme-customizer', 'biz-vektor') ;?></th>
	<td>
	<?php
		foreach ( biz_vektor_layouts() as $layout ) { ?>
			<div class="layout">
			<label class="description">
				<input type="radio" name="biz_vektor_theme_options[theme_layout]" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $options['theme_layout'], $layout['value'] ); ?> />
				<span>
					<img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="100" alt="" />
				</span>
				<div><?php echo $layout['label']; ?></div>
			</label>
			</div>
			<?php
		}
	?>
	<br clear="all" />
	<?php _e('You can select 1-column from below: ', 'biz-vektor');?>
	<ul>
		<li>
			<?php
			$toppage_setting_link = '<a href="#topPage">'.__('Home page settings', 'biz-vektor').'</a>';
			printf( __('[Top page] %s', 'biz-vektor'), $toppage_setting_link );?>
		</li>
		<li><?php _e('[page] Edit Page > Page Attributes > Template', 'biz-vektor') ;?></li>
	</ul>
	</td>
	</tr>
	<!-- Heading font -->
	<tr>
	<th><?php _ex('Heading font', 'biz-vektor theme-customizer', 'biz-vektor') ;?></th>
	<td>
	<?php
	$biz_vektor_font_titles = array('serif' => _x('Serif', 'biz-vektor theme-customizer', 'biz-vektor'),'sanserif' => _x('Sanserif', 'biz-vektor theme-customizer', 'biz-vektor'),);
	foreach( $biz_vektor_font_titles as $biz_vektor_font_titleValue => $biz_vektor_font_titleLavel) {
		if ( $biz_vektor_font_titleValue == $options['font_title'] ) { ?>
		<label><input type="radio" name="biz_vektor_theme_options[font_title]" value="<?php echo $biz_vektor_font_titleValue ?>" checked> <?php echo $biz_vektor_font_titleLavel ?></label>
		<?php } else { ?>
		<label><input type="radio" name="biz_vektor_theme_options[font_title]" value="<?php echo $biz_vektor_font_titleValue ?>"> <?php echo $biz_vektor_font_titleLavel ?></label>
		<?php }
	}
	?>
	<td>
	</tr>
	<!-- Global Menu font -->
	<tr>
	<th><?php _ex('Global Menu font', 'biz-vektor theme-customizer', 'biz-vektor') ;?></th>
	<td>
	<?php
	$biz_vektor_font_menus = array('serif' => _x('Serif', 'biz-vektor theme-customizer', 'biz-vektor'),'sanserif' => _x('Sanserif', 'biz-vektor theme-customizer', 'biz-vektor'),);
	foreach( $biz_vektor_font_menus as $biz_vektor_font_menuValue => $biz_vektor_font_menuLavel) {
		if ($biz_vektor_font_menuValue == $options['font_menu'] ) { ?>
		<label><input type="radio" name="biz_vektor_theme_options[font_menu]" value="<?php echo $biz_vektor_font_menuValue ?>" checked> <?php echo $biz_vektor_font_menuLavel ?></label>
		<?php } else { ?>
		<label><input type="radio" name="biz_vektor_theme_options[font_menu]" value="<?php echo $biz_vektor_font_menuValue ?>"> <?php echo $biz_vektor_font_menuLavel ?></label>
		<?php }
	}
	?>
	<td>
	</tr>
	<!-- Sidebar Child page menu display -->
	<tr>
	<th><?php _e('Deployment of the sidebar menu', 'biz-vektor') ;?></th>
	<td>
		<p><?php _e('If the site hierarchy is deep, you can choose to hide this menu hierarchy other than the Page you are currently viewing.', 'biz-vektor');?></p>
	<?php
	$biz_vektor_side_childs = array('side_child_display' => __('Display', 'biz-vektor'),'side_child_hidden' => __('Hide', 'biz-vektor'),);
	foreach( $biz_vektor_side_childs as $biz_vektor_side_childValue => $biz_vektor_side_childLavel) {
		if ( $biz_vektor_side_childValue == $options['side_child_display'] ) { ?>
		<label><input type="radio" name="biz_vektor_theme_options[side_child_display]" value="<?php echo $biz_vektor_side_childValue ?>" checked> <?php echo $biz_vektor_side_childLavel ?></label>
		<?php } else { ?>
		<label><input type="radio" name="biz_vektor_theme_options[side_child_display]" value="<?php echo $biz_vektor_side_childValue ?>"> <?php echo $biz_vektor_side_childLavel ?></label>
		<?php }
	}
	?>
	<p>* <?php _e('This setting can not be changed from the theme customizer.', 'biz-vektor') ;?></p> 
	</td></tr>
	<tr>
	<th><?php _e('google fonts', 'biz-vektor'); ?></th>
	<td>
		<label><input type="checkbox" name="biz_vektor_theme_options[enable_google_font]" value="true" <?php echo (isset($options['enable_google_font']) && $options['enable_google_font'])? 'checked': ''; ?> />
		<?php _e('enable google font', 'biz-vektor'); ?></label>
	</td>
	</tr>
	</table>
	<?php submit_button(); ?>
</div>
<!-- [ /#design ] -->

<?php
/*-------------------------------------------*/
/*	Contact information
/*-------------------------------------------*/
?>
<div id="contactInfo" class="sectionBox">
	<?php get_template_part('inc/theme-options-nav'); ?>
	<h3><?php _ex('Contact settings', 'biz-vektor theme-customizer', 'biz-vektor') ;?>
		<span class="message_box">
			<?php printf(__('You can change settings for this section also from %s', 'biz-vektor'), $customizer_link ); ?>
		</span>
	</h3>
	<table class="form-table">
	<tr>
	<th scope="row"><?php _ex('Message', 'biz-vektor theme-customizer', 'biz-vektor') ;?></th>
	<td>
	<input type="text" name="biz_vektor_theme_options[contact_txt]" id="contact_txt" value="<?php echo esc_attr( $options['contact_txt'] ); ?>" style="width:50%;" /><br />
	<span><?php _e('ex) ', 'biz-vektor') ;?><?php _e('Please feel free to inquire.', 'biz-vektor') ;?></span>
	</td>
	</tr>
	<tr>
	<th scope="row"><?php _ex('Phone number', 'biz-vektor theme-customizer', 'biz-vektor') ;?></th>
	<td>
	<input type="text" name="biz_vektor_theme_options[tel_number]" id="tel_number" value="<?php echo esc_attr( $options['tel_number'] ); ?>" style="width:50%;" /><br />
	<span><?php _e('ex) ', 'biz-vektor') ;?>000-000-0000</span>
	</td>
	</tr>
	<tr>
	<th scope="row"><?php _ex('Office hours', 'biz-vektor theme-customizer', 'biz-vektor') ;?></th>
	<td>
	<textarea cols="20" rows="2" name="biz_vektor_theme_options[contact_time]" id="contact_time" value="" style="width:50%;" /><?php echo esc_attr( $options['contact_time'] ); ?></textarea><br />
	<span><?php _e('ex) ', 'biz-vektor') ;?><?php _ex('Office hours', 'biz-vektor theme-customizer', 'biz-vektor') ;?> 9:00 - 18:00 (<?php _e('Weekdays except holidays', 'biz-vektor') ;?>)</span>
	</td>
	</tr>
	<tr>
	<th scope="row"><?php _ex('Site / Company / Store / Service name. This is displayed in the left part of the footer bottom and footer copyright section.', 'biz-vektor theme-customizer', 'biz-vektor') ;?><br />
	</th>
	<td>
	<textarea cols="20" rows="2" name="biz_vektor_theme_options[sub_sitename]" id="sub_sitename" value="" style="width:50%;" /><?php echo esc_attr( $options['sub_sitename'] ); ?></textarea><br />
	<span><?php _e('ex) ', 'biz-vektor') ;?><?php _e('BizVektor, Inc.', 'biz-vektor') ;?></span><br />
	<?php _e('* Use this feature when the site name has become too long for SEO purposes.', 'biz-vektor') ;?>
	</td>
	</tr>
	<!-- Company address -->
	<tr>
	<th scope="row"><?php _ex('Company address', 'biz-vektor theme-customizer', 'biz-vektor') ;?><br /><?php _e('This is displayed in the left bottom part of the footer.', 'biz-vektor') ;?></th>
	<td>
	<textarea cols="20" rows="5" name="biz_vektor_theme_options[contact_address]" id="contact_address" value="" style="width:50%;" /><?php echo $options['contact_address'] ?></textarea><br />
		<span><?php _e('ex) ', 'biz-vektor') ;?>
		<?php _e('316, Minami Sakae Building,<br />1-22-16, Sakae, Naka-ku, Nagoya-shi,<br />Aichi 460-0008 JAPAN<br />TEL / FAX +81-52-228-9176', 'biz-vektor') ;?>
		</span>
	</td>
	</tr>
	<!-- he URL of contact page -->
	<tr>
	<th scope="row"><?php _ex('The contact page URL', 'biz-vektor theme-customizer', 'biz-vektor') ;?></th>
	<td>
	<input type="text" name="biz_vektor_theme_options[contact_link]" id="contact_link" value="<?php echo esc_attr( $options['contact_link'] ); ?>" /><br />
	<span><?php _e('ex) ', 'biz-vektor') ;?>http://www.********.co.jp/contact/ <?php _e('or', 'biz-vektor') ;?> /******/</span><br />
	<?php _e('* If you fill in the blank, contact banner will be displayed in the sidebar.', 'biz-vektor') ;?><br />
	<span class="alert"><?php _e('If not, it does not appear.', 'biz-vektor') ;?></span>
	</td>
	</tr>
	</table>
	<?php submit_button(); ?>
</div>
<!-- [ /#contactInfo ] -->

<?php
/*-------------------------------------------*/
/*	3PR area
/*-------------------------------------------*/
?>
<div id="prBox" class="sectionBox">
	<?php get_template_part('inc/theme-options-nav'); ?>
	<h3><?php _e('3PR area settings', 'biz-vektor') ;?>
		<span class="message_box">
			<?php printf(__('You can change settings for this section also from %s', 'biz-vektor'), $customizer_link ); ?>
		</span>
	</h3>

<table class="form-table">
<!-- Home 3PR Area hidden -->
<tr>
<th><?php _e('The display of the home page 3PR area.', 'biz-vektor'); ?></th>
<td><p>
	<?php _e('Check this box if you do not want to see the 3PR area on the home page.', 'biz-vektor'); ?></p>
<p><input type="checkbox" name="biz_vektor_theme_options[top3PrDisplay]" id="top3PrDisplay" value="true" <?php if ($options['top3PrDisplay']) {?> checked<?php } ?>> <?php _e('Do not show the top 3PR area', 'biz-vektor'); ?></p></td>
</tr>
</table>

<div class="sectionbox">
<?php for ( $i = 1; $i <= 3 ;){ ?>

<div class="prItem">
<h5><?php _e('PR area', 'biz-vektor') ?><?php echo $i; ?></h5>
<dl>
<dt><?php _e('Title', 'biz-vektor') ;?></dt>
<dd><input type="text" name="biz_vektor_theme_options[pr<?php echo $i; ?>_title]" id="pr<?php echo $i; ?>_title" value="<?php echo esc_attr( $options['pr'.$i.'_title'] ); ?>" /></dd>
<dt><?php _e('Description', 'biz-vektor') ;?></dt>
<dd><textarea cols="15" rows="3" name="biz_vektor_theme_options[pr<?php echo $i; ?>_description]" id="pr<?php echo $i; ?>_description" value=""><?php echo esc_attr( $options['pr'.$i.'_description'] ); ?></textarea></dd>
<dt><?php _e('URL', 'biz-vektor') ;?></dt>
<dd><input type="text" name="biz_vektor_theme_options[pr<?php echo $i; ?>_link]" id="pr<?php echo $i; ?>_link" value="<?php echo esc_attr( $options['pr'.$i.'_link'] ); ?>" /></dd>
<dt><?php _e('Image (Desktop version)', 'biz-vektor') ;?></dt>
<dd>
<span class="mediaSet">
<input type="text" name="biz_vektor_theme_options[pr<?php echo $i; ?>_image]" class="media_text" id="pr<?php echo $i; ?>_image" value="<?php echo esc_attr( $options['pr'.$i.'_image'] ); ?>" /> 
<button id="media_pr<?php echo $i; ?>_image" class="media_btn"><?php _e('Select image', 'biz-vektor') ;?></button></span>
<?php _e('310px width is recommended.', 'biz-vektor') ;?></dd>
<dt><?php _e('Image (Smartphone version)', 'biz-vektor') ;?></dt>
<dd>
<span class="mediaSet">
<input type="text" name="biz_vektor_theme_options[pr<?php echo $i; ?>_image_s]" class="media_text" id="pr<?php echo $i; ?>_image_s" value="<?php echo esc_attr( $options['pr'.$i.'_image_s'] ); ?>" /> 
<button id="media_pr<?php echo $i; ?>_image_s" class="media_btn"><?php _e('Select image', 'biz-vektor') ;?></button></span>
<?php _e('120px by 120px is recommended.', 'biz-vektor') ;?></dd>
</dl>
</div>
<?php
$i++;
} ?>
</div>
<br clear="all" /><!-- [rolling when none] -->
	<?php _e('* If you are unsure about the image, you can leave this field blank.', 'biz-vektor') ;?><br />
	<span class="alert">
	<?php _e('* You can set different image for desktop and smartphone versions of the site.', 'biz-vektor') ;?>
	</span>
<?php submit_button(); ?>
</div>

<?php
/*-------------------------------------------*/
/*	Blog
/*-------------------------------------------*/
?>
<div id="postSetting" class="sectionBox">
<?php get_template_part('inc/theme-options-nav'); ?>
<h3><?php printf( __('Settings for [ %s ].', 'biz-vektor'),esc_html( $biz_vektor_options['postLabelName']));?></h3>
<?php _e('* Does not appear if there are no posts.', 'biz-vektor') ;?><br />
<?php _e('* If the excerpt field is not empty, the content will appear in the &quot;excerpt&quot;. Otherwise, the text will be displayed in a certain number of', 'biz-vektor') ;?><br />
* <?php _e('<span class="alert">Featured image of the article</span> is displayed.', 'biz-vektor') ;?><br />
	<?php _e('You can set the &quot;featured image&quot;, from the bottom right widget area of particular article edit screen.', 'biz-vektor') ;?><br />
	<?php _e('If there is no widget, please check &quot;Featured image&quot; at the top right of the screen from the &quot;Screen options&quot; tab.', 'biz-vektor') ;?>

<table class="form-table">
<!-- Post -->
<tr>
	<th><?php echo esc_html( $biz_vektor_options['postLabelName']); ?></th>
	<td>
		&raquo; <?php _e('Change the title', 'biz-vektor') ;?> <input type="text" name="biz_vektor_theme_options[postLabelName]" id="postLabelName" value="<?php echo esc_attr( $options['postLabelName'] ); ?>" style="width:200px;" />
	<dl>
	<dt><?php printf(__('Display layout of &quot; %s &quot on the top page.', 'biz-vektor'), esc_html( $biz_vektor_options['postLabelName']) ); ?></dt>
	<dd>
	<?php
	$biz_vektor_listTypes = array(
		'listType_title' => __('Title only', 'biz-vektor'),
		'listType_set' => __('With excerpt and thumbnail', 'biz-vektor')
	);
	foreach( $biz_vektor_listTypes as $biz_vektor_listTypeValue => $biz_vektor_listTypeLavel) {
		if ( $biz_vektor_listTypeValue == $options['listBlogTop'] ) { ?>
		<label><input type="radio" name="biz_vektor_theme_options[listBlogTop]" value="<?php echo $biz_vektor_listTypeValue ?>" checked> <?php echo $biz_vektor_listTypeLavel ?></label>
		<?php } else { ?>
		<label><input type="radio" name="biz_vektor_theme_options[listBlogTop]" value="<?php echo $biz_vektor_listTypeValue ?>"> <?php echo $biz_vektor_listTypeLavel ?></label>
		<?php }
	}
	?>
	</dd>
	<dt><?php printf(__('Display layout of &quot; %s &quot on the archive page.', 'biz-vektor'), esc_html( $biz_vektor_options['postLabelName']) ); ?></dt>
	<dd>
	<?php
	$biz_vektor_listTypes = array(
		'listType_title' => __('Title only', 'biz-vektor'),
		'listType_set' => __('With excerpt and thumbnail', 'biz-vektor')
	);
	foreach( $biz_vektor_listTypes as $biz_vektor_listTypeValue => $biz_vektor_listTypeLavel) {
		if ( $biz_vektor_listTypeValue == $options['listBlogArchive'] ) { ?>
		<label><input type="radio" name="biz_vektor_theme_options[listBlogArchive]" value="<?php echo $biz_vektor_listTypeValue ?>" checked> <?php echo $biz_vektor_listTypeLavel ?></label>
		<?php } else { ?>
		<label><input type="radio" name="biz_vektor_theme_options[listBlogArchive]" value="<?php echo $biz_vektor_listTypeValue ?>"> <?php echo $biz_vektor_listTypeLavel ?></label>
		<?php }
	}
	?>
	</dd>
	</dl>
	<!-- Post display count -->
	<dl>
		<dt><?php printf(__('Number of %s posts to be displayed on the home page.', 'biz-vektor'),esc_html( $biz_vektor_options['postLabelName']));?></dt>
		<dd><input type="text" name="biz_vektor_theme_options[postTopCount]" id="postTopCount" value="<?php echo esc_attr( $options['postTopCount'] ); ?>" style="width:50px;" /> <?php _ex('posts', 'top page post count', 'biz-vektor') ;?></dd>
	</dl>
	<!-- /Post display count -->
	<dl>
		<dt>Top URL of <?php echo esc_html( $biz_vektor_options['postLabelName']);?></dt>
		<dd><?php $postTopUrl = esc_html(home_url().'/post/'); ?>
			<input type="text" name="biz_vektor_theme_options[postTopUrl]" id="postTopUrl" value="<?php echo esc_attr( $options['postTopUrl'] ); ?>" style="width:80%" /></dd>
	</dl>
</td>
</tr>

</table>
<?php submit_button(); ?>

</div>
<!-- [ /#postSetting ] -->

<?php
/*-------------------------------------------*/
/*	Toppage setting
/*-------------------------------------------*/
?>
<div id="topPage" class="sectionBox">
<?php get_template_part('inc/theme-options-nav'); ?>
<h3><?php _e('Home page settings', 'biz-vektor') ;?></h3>
<table class="form-table">
<tr>
<th><?php _e('Main visual', 'biz-vektor') ;?></th>
<td><?php _e('You can use a slide show or a still image.', 'biz-vektor') ;?>
<ul>
<li>[ <a href="<?php echo get_admin_url(); ?>themes.php?page=custom-header" target="_blank">
	&raquo; <?php _e('Still image settings', 'biz-vektor') ;?></a> ]</li>
<li>[ <a href="#slideSetting">
	&raquo; <?php _e('Slide show settings', 'biz-vektor') ;?></a> ]</li>
</ul></td>
</tr>
<!-- Home 3PR area -->
<tr>
<th><?php _e('Home 3PR area', 'biz-vektor'); ?></th>
<td>
<ul>
<li>[ <a href="#prBox">&raquo; <?php _e('Settings for the Home page 3PR area are here', 'biz-vektor'); ?></a> ]</li>
</ul></td>
</tr>
<!-- Home page side bar hidden -->
<tr>
<th><?php _e('The display of the home page side bar.', 'biz-vektor'); ?></th>
<td><p>
	<?php _e('Check this box if you do not want to display the side bar on the home page.', 'biz-vektor'); ?></p>
<p><input type="checkbox" name="biz_vektor_theme_options[topSideBarDisplay]" id="topSideBarDisplay" value="true" <?php if ($options['topSideBarDisplay']) {?> checked<?php } ?>> <?php _e('I want to hide the sidebar', 'biz-vektor'); ?></p></td>
</tr>
<!-- Display number of Blog -->
<tr>
	<th><?php printf( __('Display a number of %s posts.', 'biz-vektor'),esc_html( $biz_vektor_options['postLabelName'])); ?>
	<td><a href="#postSetting">
	<?php printf( __('Please set from the [ Setting the %s ] section.', 'biz-vektor'),esc_html( $biz_vektor_options['postLabelName'] ) ); ?></a>
	</td>
</tr>
</table>

<?php submit_button(); ?>
</div>

<?php
/*-------------------------------------------*/
/*	Slideshow Settings
/*-------------------------------------------*/
?>
<div id="slideSetting" class="sectionBox">
<?php get_template_part('inc/theme-options-nav'); ?>
<h3><?php _e('Slideshow Settings', 'biz-vektor'); ?></h3>
<p><?php _e('Please enter the URL of the image to be used in the slideshow.', 'biz-vektor'); ?><br />
<?php _e('The recommended size of the image is 950 x 250px.', 'biz-vektor'); ?><br />
<?php
$topVisualLink = '<a href="'.get_admin_url().'themes.php?page=custom-header" target="_blank">'.__('Home page Main visual', 'biz-vektor').'</a>';
printf(__('%s will be displayed if the slideshow is not set.', 'biz-vektor'),$topVisualLink); ?><br />
<?php _e('It can be only the URL of an image. However, the link is set for the image if you enter a link URL.', 'biz-vektor'); ?><br />
<?php _e('Please type in the alternate text for the image.', 'biz-vektor'); ?>
<?php _e('When filled in, will be more likely to match the search.', 'biz-vektor'); ?>
<?php _e('Moreover, for visually impaired visitors using a text-to-speech device, it reads out the text.', 'biz-vektor'); ?>
</p>
<table class="form-table">
<?php
for ( $i = 1; $i <= 5 ;){
$slideLink = 'slide'.$i.'link';
$slideImage = 'slide'.$i.'image';
$slideAlt = 'slide'.$i.'alt';
$slideDisplay = 'slide'.$i.'display';
$slideBlank = 'slide'.$i.'blank'; ?>
<tr>
<td><?php _e('Link URL', 'biz-vektor'); ?> [<?php echo $i ?>]<br />
	<input type="text" name="biz_vektor_theme_options[<?php echo $slideLink ?>]" id="<?php echo $slideLink ?>" value="<?php echo esc_attr( $options[$slideLink] ) ?>" /></td>
<td><?php _e('Image URL', 'biz-vektor'); ?> [<?php echo $i ?>]<br />
	<input type="text" name="biz_vektor_theme_options[<?php echo $slideImage ?>]" id="<?php echo $slideImage ?>" value="<?php echo esc_attr( $options[$slideImage] ) ?>" /> <button id="media_<?php echo $slideImage ?>" class="media_btn"><?php _e('Select an image', 'biz-vektor'); ?></button>
</td>
<td><?php _e('Alternate text', 'biz-vektor'); ?> (alt) [<?php echo $i ?>]<br />
	<input type="text" name="biz_vektor_theme_options[<?php echo $slideAlt ?>]" id="<?php echo $slideAlt ?>" value="<?php echo esc_attr( $options[$slideAlt] ) ?>" /></td>
<td>
<label><input type="checkbox" name="biz_vektor_theme_options[<?php echo $slideDisplay ?>]" id="<?php echo $slideDisplay ?>" value="true" <?php if ($options[$slideDisplay]) :echo ' checked';endif; ?>> <?php _ex('Do not display', 'Slide not displayed', 'biz-vektor'); ?></label><br />
<label><input type="checkbox" name="biz_vektor_theme_options[<?php echo $slideBlank ?>]" id="<?php echo $slideBlank ?>" value="true" <?php if ($options[$slideBlank]) :echo ' checked';endif; ?>> <?php _e('Open in a blank window', 'biz-vektor'); ?></label>
</td>
</tr>
<?php
	$i++;
} ?>

</table>
<p><?php _e('* The slideshow can be set to up to 5 images, but when accessing the site using a slow internet connection, because of the time it takes to display all images, the visitor might leave the page early onwhich might have a negative effect. Therefore using three or less images is recommended.', 'biz-vektor'); ?>
	</p>
<?php submit_button(); ?>
</div>

</form>
</div><!-- [ /#main-content ] -->
</div><!-- [ /#biz_vektor_options ] -->
<?php
}

/*-------------------------------------------*/
/* function of input value
/*-------------------------------------------*/
function biz_vektor_theme_options_validate( $input ) {
	$defaults = biz_vektor_get_theme_options();
	$output = biz_bektor_option_validate();
	
	if(isset($_POST['bizvektor_action_mode']) && $_POST['bizvektor_action_mode'] == 'reset'){ 
		if(isset($_POST['bizvektor_reset_check']) && isset($_POST['bizvektor_reset_key_port']) && $_POST['bizvektor_reset_key_port'] == $_POST['bizvektor_reset_key']){
			echo "reseted";
			return $defaults;
		}else{
			echo "faild";
			return $output;
		}
	}

	// Design
	$output['gMenuDivide']            = ($input['gMenuDivide'])? $input['gMenuDivide']: $defaults['gMenuDivide'];
	$output['head_logo']              = $input['head_logo'];
	$output['foot_logo']              = $input['foot_logo'];
	$output['font_title']             = $input['font_title'];
	$output['font_menu']              = $input['font_menu'];
	$output['side_child_display']     = $input['side_child_display'];
	$output['enable_google_font']     = $input['enable_google_font'];

	// Contact info
	$output['contact_txt']            = $input['contact_txt'];
	$output['tel_number']             = $input['tel_number'];
	$output['contact_time']           = $input['contact_time'];
	$output['sub_sitename']           = $input['sub_sitename'];
	$output['contact_address']        = $input['contact_address'];
	$output['contact_link']           = $input['contact_link'];

	// 3PR
	$output['top3PrDisplay']          = (isset($input['top3PrDisplay']) && $input['top3PrDisplay'] == 'true')?	 true : false;
	$output['pr1_title']              = ($input['pr1_title'] == '')?			 $defaults['pr1_title'] : $input['pr1_title'] ;
	$output['pr1_description']        = ($input['pr1_description'] == '')?	 $defaults['pr1_description'] : $input['pr1_description'] ;
	$output['pr1_link']               = $input['pr1_link'];
	$output['pr1_image']              = $input['pr1_image'];
	$output['pr1_image_s']            = $input['pr1_image_s'];
	$output['pr2_title']              = ($input['pr2_title'] == '')?			 $defaults['pr2_title'] : $input['pr2_title'] ;
	$output['pr2_description']        = ($input['pr2_description'] == '')?	 $defaults['pr2_description'] : $input['pr2_description'] ;
	$output['pr2_link']               = $input['pr2_link'];
	$output['pr2_image']              = $input['pr2_image'];
	$output['pr2_image_s']            = $input['pr2_image_s'];
	$output['pr3_title']              = ($input['pr3_title'] == '')?			 $defaults['pr3_title'] : $input['pr3_title'] ;
	$output['pr3_description']        = ($input['pr3_description'] == '')?	 $defaults['pr3_description'] : $input['pr3_description'] ;
	$output['pr3_link']               = $input['pr3_link'];
	$output['pr3_image']              = $input['pr3_image'];
	$output['pr3_image_s']            = $input['pr3_image_s'];

	// Infomation & Blog	
	$output['postLabelName']          = (!$input['postLabelName'])?	 $defaults['postLabelName'] : $input['postLabelName'] ;
	$output['listBlogTop']            = $input['listBlogTop'];
	$output['listBlogArchive']        = $input['listBlogArchive'];
	$output['postTopUrl']             = $input['postTopUrl'];
	$output['postTopCount']           = (!$input['postTopCount'])? 0 : $input['postTopCount'];

	// TopPage
	$output['topSideBarDisplay']      = (isset($input['topSideBarDisplay']) && $input['topSideBarDisplay'] == 'true')? true : false;

	// SlideShow
	for ( $i = 1; $i <= 5 ;){
		$output['slide'.$i.'link']     = $input['slide'.$i.'link'];
		$output['slide'.$i.'image']    = $input['slide'.$i.'image'];
		$output['slide'.$i.'alt']      = $input['slide'.$i.'alt'];
		$output['slide'.$i.'display']  = (isset($input['slide'.$i.'display']) && $input['slide'.$i.'display'])? "true" : '';
		$output['slide'.$i.'blank']    = (isset($input['slide'.$i.'blank']) && $input['slide'.$i.'blank'])? "true" : '';
	$i++;
	}

	if($input['theme_layout'] == ''){ $output['theme_layout'] = "content-sidebar"; }

	$output['theme_style'] = ($input['theme_style'] == '') ? "rebuild" : $input['theme_style'] ;

	// Theme layout must be in our array of theme layout options
	if ( isset( $input['theme_layout'] ) && array_key_exists( $input['theme_layout'], biz_vektor_layouts() ) )
		$output['theme_layout'] = $input['theme_layout'];

	// sidebar child menu display
	if( isset($input['side_child_display']) && $input['side_child_display'] ){ $output['side_child_display'] = $input['side_child_display']; }

	return apply_filters( 'biz_vektor_theme_options_validate', $output, $input, $defaults );
}

?>