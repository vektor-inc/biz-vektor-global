<?php 
 // https://gist.github.com/2968549
 // http://ottopress.com/tag/customizer/
 
/*	To use text area at customizer
/*-------------------------------------------*/
if(class_exists('WP_Customize_Control')):
	class customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="3" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
endif;

add_action( 'customize_register', 'bizvektor_customize_register' );
function bizvektor_customize_register($wp_customize) {

	/*	Design setting
	/*-------------------------------------------*/
    $wp_customize->add_section( 'biz_vektor_design', array(
        'title'          => _x('Design settings', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
        'priority'       => 100,
    ) );

    $wp_customize->add_setting( 'biz_vektor_theme_options[head_logo]', array(
        'default'        	=> '',
        'type'           	=> 'option',
        'capability'     	=> 'edit_theme_options',
        'sanitize_callback' => 'biz_vektor_customize_sanitize_head_logo',
    ) );

    $wp_customize->add_setting( 'biz_vektor_theme_options[foot_logo]', array(
        'default'        	=> '',
        'type'          	=> 'option',
        'capability'     	=> 'edit_theme_options',
        'sanitize_callback' => 'biz_vektor_customize_sanitize_foot_logo',
    ) );

    $wp_customize->add_setting( 'biz_vektor_theme_options[gMenuDivide]', array(
        'default'       	=> '',
        'type'           	=> 'option',
        'capability'     	=> 'edit_theme_options',
        'sanitize_callback' => 'biz_vektor_customize_sanitize_gMenuDivide',
    ) );

    $wp_customize->add_setting( 'biz_vektor_theme_options[theme_layout]', array(
        'default'        	=> '',
        'type'           	=> 'option',
        'capability'     	=> 'edit_theme_options',
        'sanitize_callback' => 'biz_vektor_customize_sanitize_theme_layout',
    ) );

    $wp_customize->add_setting( 'biz_vektor_theme_options[font_title]', array(
        'default'        	=> '',
        'type'           	=> 'option',
        'capability'     	=> 'edit_theme_options',
        'sanitize_callback' => 'biz_vektor_customize_sanitize_font_title',
    ) );

    $wp_customize->add_setting( 'biz_vektor_theme_options[font_menu]', array(
        'default'        	=> '',
        'type'           	=> 'option',
        'capability'     	=> 'edit_theme_options',
        'sanitize_callback' => 'biz_vektor_customize_sanitize_font_menu',
    ) );

		// Create section UI
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'head_logo',
			array(
				'label'     => _x('Header logo image', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_design',
				'settings'  => 'biz_vektor_theme_options[head_logo]',
				'priority'  => 101,
			)
		) );
		$wp_customize->add_control( 'head_logo_url_txt',
			array(
				'label'     => _x('Header logo image URL', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_design',
				'settings'  => 'biz_vektor_theme_options[head_logo]',
				'type' => 'text',
				'priority' => 102,
			));

		// Create section UI
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'foot_logo',
			array(
				'label'     => _x('Footer logo image', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_design',
				'settings'  => 'biz_vektor_theme_options[foot_logo]',
				'priority' => 111,
			)
		) );
		$wp_customize->add_control( 'foot_logo_url_txt',
			array(
				'label'     => _x('Footer logo image URL', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_design',
				'settings'  => 'biz_vektor_theme_options[foot_logo]',
				'type' => 'text',
				'priority' => 112,
			));

		$biz_vektor_gMenuDivides = array(
			'divide_natural' => _x('Not specified (left-justified)', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
			'divide_4' => _x('4', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
			'divide_5' => _x('5', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
			'divide_6' => _x('6', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
			'divide_7' => _x('7', 'biz-vektor theme-customizer', 'bizvektor-global-edition'));
		$wp_customize->add_control( 'gMenuDivide',array(
			'label'     => _x('Number of header menus', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
			'section'   => 'biz_vektor_design',
			'settings'  => 'biz_vektor_theme_options[gMenuDivide]',
			'type' => 'select',
			'choices' => $biz_vektor_gMenuDivides,
			'priority' => 200,
		));

		foreach ( biz_vektor_layouts() as $layout ) {
			$biz_vektor_layout_array[$layout['value']] = $layout['label'];
		}
		$wp_customize->add_control( 'biz_vektor_layout',array(
			'label'     => _x('Layout', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
			'section'   => 'biz_vektor_design',
			'settings'  => 'biz_vektor_theme_options[theme_layout]',
			'type' => 'radio',
			'choices' => $biz_vektor_layout_array,
			'priority' => 301,
		));
		$wp_customize->add_control( 'font',array(
			'label'     => _x('Heading font', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
			'section'   => 'biz_vektor_design',
			'settings'  => 'biz_vektor_theme_options[font_title]',
			'type' => 'radio',
			'choices' => array(
				'serif' => _x('Serif', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'sanserif' => _x('Sanserif', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				),
			'priority' => 501,
		));
		$wp_customize->add_control( 'font_menu',array(
			'label'     => _x('Global Menu font', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
			'section'   => 'biz_vektor_design',
			'settings'  => 'biz_vektor_theme_options[font_menu]',
			'type' => 'radio',
			'choices' => array(
				'serif' => _x('Serif', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'sanserif' => _x('Sanserif', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				),
			'priority' => 502,
		));


	/*	Contact information
	/*-------------------------------------------*/
	// Create section
	$wp_customize->add_section( 'biz_vektor_contact', array(
	    'title'          => _x('Contact settings', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
	    'priority'       => 101,
	));

		$add_setting_array = array(
		    'default'        => '',
		    'type'           => 'option',
		    'capability'     => 'edit_theme_options',
		);
		$wp_customize->add_setting( 'biz_vektor_theme_options[contact_txt]', array(
		    'default'        => '',
		    'type'           => 'option',
		    'capability'     => 'edit_theme_options',
		    'sanitize_callback' => 'biz_vektor_customize_sanitize_contact_txt',
		) );

		$wp_customize->add_setting( 'biz_vektor_theme_options[tel_number]', array(
		    'default'        => '',
		    'type'           => 'option',
		    'capability'     => 'edit_theme_options',
		    'sanitize_callback' => 'biz_vektor_customize_sanitize_tel_number',
		) );

		$wp_customize->add_setting( 'biz_vektor_theme_options[contact_time]', array(
		    'default'        => '',
		    'type'           => 'option',
		    'capability'     => 'edit_theme_options',
		    'sanitize_callback' => 'biz_vektor_customize_sanitize_contact_time',
		) );

		$wp_customize->add_setting( 'biz_vektor_theme_options[sub_sitename]', array(
		    'default'        => '',
		    'type'           => 'option',
		    'capability'     => 'edit_theme_options',
		    'sanitize_callback' => 'biz_vektor_customize_sanitize_sub_sitename',
		) );

		$wp_customize->add_setting( 'biz_vektor_theme_options[contact_address]', array(
		    'default'        => '',
		    'type'           => 'option',
		    'capability'     => 'edit_theme_options',
		    'sanitize_callback' => 'biz_vektor_customize_sanitize_contact_address',
		) );

		$wp_customize->add_setting( 'biz_vektor_theme_options[contact_link]', array(
		    'default'        => '',
		    'type'           => 'option',
		    'capability'     => 'edit_theme_options',
		    'sanitize_callback' => 'biz_vektor_customize_sanitize_contact_link',
		) );

		$wp_customize->add_control( 'contact_txt',
			array(
				'label'     => _x('Message', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_contact',
				'settings'  => 'biz_vektor_theme_options[contact_txt]',
				'type' 		=> 'text',
				'priority' 	=> 1,
			));
		$wp_customize->add_control( 'tel_number',
			array(
				'label'     => _x('Phone number', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_contact',
				'settings'  => 'biz_vektor_theme_options[tel_number]',
				'type' 		=> 'text',
				'priority' 	=> 2,
			));
		$wp_customize->add_control( 'contact_time',
			array(
				'label'     => _x('Office hours', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_contact',
				'settings'  => 'biz_vektor_theme_options[contact_time]',
				'type' 		=> 'text',
				'priority' 	=> 3,
			));
		$wp_customize->add_control( 'sub_sitename',
			array(
				'label'     => _x('Site / Company / Store / Service name. This is displayed in the left bottom part of the footer.', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_contact',
				'settings'  => 'biz_vektor_theme_options[sub_sitename]',
				'type' 		=> 'text',
				'priority' 	=> 4,
			));
		$wp_customize->add_control( new customize_Textarea_Control( $wp_customize,'contact_address',
			array(
				'label'     => _x('Company address', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_contact',
				'settings'  => 'biz_vektor_theme_options[contact_address]',
				//'type' => 'textfield',
				'priority' 	=> 5,
			)));
		$wp_customize->add_control( 'contact_link',
			array(
				'label'     => _x('The contact page URL', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_contact',
				'settings'  => 'biz_vektor_theme_options[contact_link]',
				'type'		=> 'text',
				'priority' 	=> 6,
			));

	/*	TOP 3PR
	/*-------------------------------------------*/
	// Create section UI
    $wp_customize->add_section( 'biz_vektor_top3pr', array(
        'title'          => __('3PR area settings', 'bizvektor-global-edition'),
        'priority'       => 102,
    ) );

	for ( $i = 1; $i <= 3 ;){
		$wp_customize->add_setting( 'biz_vektor_theme_options[pr'.$i.'_title]',       array('default' => '','type'=> 'option','capability' => 'edit_theme_options','sanitize_callback' => 'biz_vektor_customize_sanitize_3pr_title' ) );
		$wp_customize->add_setting( 'biz_vektor_theme_options[pr'.$i.'_description]', array('default' => '','type'=> 'option','capability' => 'edit_theme_options','sanitize_callback' => 'biz_vektor_customize_sanitize_3pr_description' ) );
		$wp_customize->add_setting( 'biz_vektor_theme_options[pr'.$i.'_link]',        array('default' => '','type'=> 'option','capability' => 'edit_theme_options','sanitize_callback' => 'biz_vektor_customize_sanitize_3pr_link' ) );
		$wp_customize->add_setting( 'biz_vektor_theme_options[pr'.$i.'_image]',       array('default' => '','type'=> 'option','capability' => 'edit_theme_options','sanitize_callback' => 'biz_vektor_customize_sanitize_3pr_image' ) );
		$wp_customize->add_setting( 'biz_vektor_theme_options[pr'.$i.'_image_s]',     array('default' => '','type'=> 'option','capability' => 'edit_theme_options','sanitize_callback' => 'biz_vektor_customize_sanitize_3pr_image_s' ) );
		// Create section UI
		$wp_customize->add_control( 'pr'.$i.'_title',
			array(
				'label'     => '['.$i.']'.__('Title', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_top3pr', 
				'settings'  => 'biz_vektor_theme_options[pr'.$i.'_title]',
				'type' => 'text',
				'priority' => ($i*10)+1,
			)
		);
		$wp_customize->add_control( new customize_Textarea_Control( $wp_customize, 'pr'.$i.'_description',
			array(
				'label'     => '['.$i.']'.__('Description', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_top3pr', 
				'settings'  => 'biz_vektor_theme_options[pr'.$i.'_description]',
				'priority' => ($i*10)+2,
			)));
		$wp_customize->add_control( 'pr'.$i.'_link',
			array(
				'label'     => '['.$i.']'.__('URL', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_top3pr', 
				'settings'  => 'biz_vektor_theme_options[pr'.$i.'_link]',
				'type' => 'text',
				'priority' => ($i*10)+3,
			)
		);
		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'pr'.$i.'_image',
			array(
				'label'     => '['.$i.']'._x('Image (Desktop version) : 310px width is recommended.', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_top3pr', 
				'settings'  => 'biz_vektor_theme_options[pr'.$i.'_image]',
				'priority' => ($i*10)+4,
			))
		);
		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'pr'.$i.'_image_s',
			array(
				'label'     => '['.$i.']'._x('Image (Smartphone version) : 120px by 120px is recommended.', 'biz-vektor theme-customizer', 'bizvektor-global-edition'),
				'section'   => 'biz_vektor_top3pr', 
				'settings'  => 'biz_vektor_theme_options[pr'.$i.'_image_s]',
				'priority' => ($i*10)+5,
			))
		);

	$i++;
	}
}


function biz_vektor_customize_sanitize_head_logo( $input ){
	if(preg_match('/^http.+\.(jpg|jpeg|bmp|png|gif)$/i', $input)){
		return $input;
	}
	else {
		return '';
	}
}

function biz_vektor_customize_sanitize_foot_logo( $input ){
	if(preg_match('/^http.+\.(jpg|jpeg|bmp|png|gif)$/i', $input)){
		return $input;
	}
	else {
		return '';
	}
}

function biz_vektor_customize_sanitize_gMenuDivide( $input ){
	$biz_vektor_gMenuDivides = array(
		'divide_natural',
		'divide_4',
		'divide_5',
		'divide_6',
		'divide_7'
	);
	if(in_array($input, $biz_vektor_gMenuDivides)){
		return $input;
	}
	else{
		return 'divide_natural';
	}
}

function biz_vektor_customize_sanitize_theme_layout( $input ){
	$biz_vektor_layout_array = array(
		'content-sidebar',
		'sidebar-content'
		);

	if(in_array($input, $biz_vektor_layout_array)){
		return $input;
	}
	else{ return 'content-sidebar'; }
}

function biz_vektor_customize_sanitize_font_title( $input ){
	if($input == 'serif' || $input == 'sanserif'){ return $input; }
	else{ return 'sanserif'; }
}

function biz_vektor_customize_sanitize_font_menu( $input ){
	if($input == 'serif' || $input == 'sanserif'){ return $input; }
	else{ return 'sanserif'; }
}

function biz_vektor_customize_sanitize_contact_txt( $input ){
	return esc_html( $input );
}

function biz_vektor_customize_sanitize_tel_number( $input ){
	return esc_html( $input );
}

function biz_vektor_customize_sanitize_contact_time( $input ){
	return esc_html( $input );
}

function biz_vektor_customize_sanitize_sub_sitename( $input ){
	return esc_html( $input );
}

function biz_vektor_customize_sanitize_contact_address( $input ){
	return esc_html( $input );
}

function biz_vektor_customize_sanitize_contact_link( $input ){
	return esc_html( $input );
}

function biz_vektor_customize_sanitize_3pr_title( $input ){
	return esc_html( $input );
}

function biz_vektor_customize_sanitize_3pr_description( $input ){
	return esc_html( $input );
}

function biz_vektor_customize_sanitize_3pr_link( $input ){
	return esc_html( $input );
}

function biz_vektor_customize_sanitize_3pr_image( $input ){
	if(preg_match('/^http.+\.(jpg|jpeg|bmp|png|gif)$/i', $input)){
		return $input;
	}
	else {
		return '';
	}
}

function biz_vektor_customize_sanitize_3pr_image_s( $input ){
	if(preg_match('/^http.+\.(jpg|jpeg|bmp|png|gif)$/i', $input)){
		return $input;
	}
	else {
		return '';
	}
}

function bizvektor_customize_sanitize_color( $input ){
	if(preg_match('/^#([0-9a-f]{6}?|[0-9a-f]{3}?)$/i',$input)){return $input;}
	else { return false; }
}
