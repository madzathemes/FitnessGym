<?php

/*-----------------------------------------------------------------------------------*/
/* Directory
/*-----------------------------------------------------------------------------------*/

if ( get_stylesheet_directory() == get_template_directory() ) {
	define('OF_FILEPATH', get_template_directory());
	define('OF_DIRECTORY', get_template_directory_uri());
} else {
	define('OF_FILEPATH', get_stylesheet_directory());
	define('OF_DIRECTORY', get_stylesheet_directory_uri());
}
define('MADZA_FILEPATH', get_template_directory());
define('MADZA_DIRECTORY', get_template_directory_uri());





/*-----------------------------------------------------------------------------------*/
/* Function
/*-----------------------------------------------------------------------------------*/

include_once ('functions/class-widget.php');
include_once ('functions/functions-widget.php');
include_once ('functions/functions-footer.php');
include_once ('functions/functions-homepage.php');
include_once ('functions/functions-slider.php');
include_once ('functions/functions-hooks.php');
include_once ('functions/functions-comment.php');
include_once ('functions/functions-shortcodes.php');
include_once ('functions/functions-general.php');
include_once ('functions/plugins/glass-slider/glass-slider.php');
include_once ('functions/plugins/aq_resizer.php');
include_once ('functions/import/madza-import.php');
#include_once ('functions/import/madza-export.php');

/*-----------------------------------------------------------------------------------*/
/* Madza Theme Setup
/*-----------------------------------------------------------------------------------*/
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
function madza_theme_setup() {

	add_editor_style();

	add_theme_support( 'post-formats', array('image', 'video', 'link', 'quote', 'gallery' ) );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );

	load_theme_textdomain( 'madza_translate', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	set_post_thumbnail_size( 999, 999, true );

	register_nav_menus( array(
		'primary' => __( 'Header Navigation', 'madza_translate' ),
	) );

	register_nav_menus( array(
		'select_menu' => __( 'Responsive Header Navigation', 'madza_translate' ),
	) );

	register_nav_menus( array(
		'footer_menu' => __( 'Footer Navigation', 'madza_translate' ),
	) );



}

add_action( 'after_setup_theme', 'madza_theme_setup' );



/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );
include_once( 'option-tree/theme-options.php' );

/*-----------------------------------------------------------------------------------*/
/* Default Options
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) ) $content_width = 610;

function madzathemes_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'madzathemes_page_menu_args' );

function new_excerpt_length( $length ) {

	if(ot_get_option("blog_content_lenght")!="") { $lenghts = ot_get_option("blog_content_lenght"); } else { $lenghts = "100"; }
	return $lenghts;

}
add_filter( 'excerpt_length', 'new_excerpt_length' );

function get_required_page($page = ''){
	global $wpdb;

	$result = wp_cache_get($page . '-guid', __FUNCTION__);

	if($result === false)
	{
		$result = $wpdb->get_var("SELECT p.guid
					FROM $wpdb->posts p
					WHERE p.post_status = 'publish'
					AND p.post_title = '{$page}' ");

		if ($result)
		{
			wp_cache_add($page . '-guid', $result,  __FUNCTION__);
		}
	}
	return $result;
}

if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
}


/*-----------------------------------------------------------------------------------*/
/*	Theme Options
/*-----------------------------------------------------------------------------------*/

function my_custom_login_logo() {
    if(ot_get_option("login_logo")!="") {
	    echo '<style type="text/css">
	        h1 a { '.ot_get_option("login_logo").' !important; }
	    </style>';
    }
}

add_action('login_head', 'my_custom_login_logo');

function madza_sidebar_function() {
	global $post;
    $args = array(
    	'post_type'=> 'mt_sidebar',
        'order' => 'ASC',
        'posts_per_page' => 999,
        'orderby' => 'date',
        'order' => 'DSC',
    );

    query_posts($args); while ( have_posts() ) : the_post();

			register_sidebar(array(
			  'name' => __(get_the_title()),
			  'id' => 'sidebar-id-'.$post->ID.'',
			  'description' => __( 'Widget area created from Sidebar custom post type.' , 'madza_translate'),
			  'before_widget' => '<div class="menu_categories">',
				'after_widget' => '<div class="clear"></div></div>',
				'before_title' => '<h4 class="widget_h"><span>',
				'after_title' => '</span></h4>',
			));

	 endwhile; wp_reset_query();
}
add_action('madza_sidebar_function', 'madza_sidebar_function');

madza_sidebar_function();


add_action('admin_init','optionscheck_change_santiziation', 100);

function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}


function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
          "width" => array()
      );
      $custom_allowedtags["script"] = array();

      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}




/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/all_plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name, slug and required.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name'                  => 'MadzaThemes.com', // The plugin name
            'slug'                  => 'madzathedadfmes', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/all_plugins/madzathemes.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		),
        array(
            'name'			=> 'WPBakery Visual Composer', // The plugin name
            'slug'			=> 'js_composer', // The plugin slug (typically the folder name)
            'source'			=> get_stylesheet_directory() . '/all_plugins/js_composer.zip', // The plugin source
            'required'			=> true, // If false, the plugin is only 'recommended' instead of required
            'version'			=> '4.12', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		=> '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'			=> 'LayerSlider WP', // The plugin name
            'slug'			=> 'layerslidessr', // The plugin slug (typically the folder name)
            'source'			=> get_stylesheet_directory() . '/all_plugins/LayerSlider.zip', // The plugin source
            'required'			=> true, // If false, the plugin is only 'recommended' instead of required
            'version'			=> '5.6.9', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		=> '', // If set, overrides default API URL and points to an external URL
        ),
        array(
			'name'     				=> 'easyReservations', // The plugin name
			'slug'     				=> 'easyreservations', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
        array(
            'name'			=> 'Timetable Responsive Schedule For WordPress', // The plugin name
            'slug'			=> 'timetable', // The plugin slug (typically the folder name)
            'source'			=> get_stylesheet_directory() . '/all_plugins/timetable.zip', // The plugin source
            'required'			=> true, // If false, the plugin is only 'recommended' instead of required
            'version'			=> '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		=> '', // If set, overrides default API URL and points to an external URL
        )

    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'tgmpa';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_slug'  => 'themes.php',         // Default parent menu slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
        )
    );

    tgmpa( $plugins, $config );

}

if(function_exists('vc_set_as_theme')) vc_set_as_theme();



if ( ! function_exists( 'mt_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function mt_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">

		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous pagination-link"><?php next_posts_link( __( '<span class="meta-nav">&larr; Older posts</span> ', 'madza_themes' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next pagination-link"><?php previous_posts_link( __( '<span class="meta-nav">Newer posts  &rarr;</span>', 'madza_themes' ) ); ?></div>
			<?php endif; ?>
			<div class="clear"></div>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;



function themename_customize_register($wp_customize){


	 $wp_customize->add_section('themename_header', array(
        'title'    => 'Header',
        'priority' => 124,
    ));

	class Example_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';

    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}

	//	==================================================
    //  =============================
    //  = ==== General Options
    //  =============================

    $wp_customize->add_section('themename_general_mt', array(
        'title'    => 'General Options',
        'priority' => 121,
    ));


    //  =============================
    //  = Favicon             =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_favicon]', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'mt_favicon', array(
        'label'    => __('Upload Favicon (16px x 16px Png/Gif image)', 'themename'),
        'section'  => 'themename_general_mt',
        'settings' => 'themename_theme_options[mt_favicon]',
    )));

	//  =============================
    //  = Responsive   	    =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[mt_responsive]', array(
        'default'        => 'responsive_yes',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'mt_responsive', array(
        'settings' => 'themename_theme_options[mt_responsive]',
        'label'   => 'Layouts',
        'section' => 'themename_general_mt',
        'type'    => 'select',
        'choices'    => array(
        	'responsive_yes' => 'Responsive',
            'responsive_no' => 'Fixed',
        ),
    ));



	//  =============================
    //  = Breadcrumb
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_breadcrumb]', array(
        'capability' => 'edit_theme_options',
        'default'        => "1",
        'type'       => 'option',
    ));

    $wp_customize->add_control('mt_breadcrumb', array(
        'settings' => 'themename_theme_options[mt_breadcrumb]',
        'label'    => 'Display Breadcrumb',
        'section'  => 'themename_general_mt',
       'type'    => 'select',
        'choices'    => array(
        	'1' => 'On',
            '2' => 'Off',
        ),
    ));


    //  =============================
    //  = Custom Css
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_css]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',


    ));

    $wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'mt_css', array(
        'label'      => 'Custom CSS',
        'section'    => 'themename_general_mt',
        'settings'   => 'themename_theme_options[mt_css]',
    )));





	//	==================================================
    //  =============================
    //  = ==== Logo Options
    //  =============================

    $wp_customize->add_section('themename_logo', array(
        'title'    => 'Logo',
        'priority' => 123,
    ));


    //  =============================
    //  = Logo             =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_logo]', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'default' => get_template_directory_uri().'/images/fitnessgym.png',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'mt_logo', array(
        'label'    => __('Upload Logo', 'themename'),
        'section'  => 'themename_logo',
        'settings' => 'themename_theme_options[mt_logo]',
    )));

    //  =============================
    //  = Logo Responsive            =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_logo_r]', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'default' => get_template_directory_uri().'/images/fitnessgym.png',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'mt_logo_r', array(
        'label'    => __('Upload Responsive Logo', 'themename'),
        'section'  => 'themename_logo',
        'settings' => 'themename_theme_options[mt_logo_r]',
    )));

    //  =============================
    //  = Logo Widht
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_logo_w]', array(
        'default'        => '154',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',


    ));

    $wp_customize->add_control('mt_logo_w', array(
        'label'      => 'Logo Width (px)',
        'section'    => 'themename_logo',
        'settings'   => 'themename_theme_options[mt_logo_w]',
    ));

    //  =============================
    //  = Logo Height
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_logo_h]', array(
        'default'        => '50',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',


    ));

    $wp_customize->add_control('mt_logo_h', array(
        'label'      => 'Logo Height (px)',
        'section'    => 'themename_logo',
        'settings'   => 'themename_theme_options[mt_logo_h]',
    ));

    //  =============================
    //  = Logo margin Top
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_logo_t]', array(
        'default'        => '15',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',


    ));

    $wp_customize->add_control('mt_logo_t', array(
        'label'      => 'Logo Margin Top (px)',
        'section'    => 'themename_logo',
        'settings'   => 'themename_theme_options[mt_logo_t]',
    ));





    //	==================================================
    //  =============================
    //  = ==== Header Options
    //  =============================


    //  =============================
    //  = Menu fixed
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_menu_fix]', array(
    	'default'        => "1",
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));

    $wp_customize->add_control('mt_menu_fix', array(
        'settings' => 'themename_theme_options[mt_menu_fix]',
        'label'    => 'Fixed Menu',
        'section'  => 'themename_header',
        'type'     => 'checkbox',
    ));



    //  =============================
    //  = Header Style  	    =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[mt_header_s]', array(
        'default'        => 'style_3',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'mt_header_s', array(
        'settings' => 'themename_theme_options[mt_header_s]',
        'label'   => 'Header Style',
        'section' => 'themename_header',
        'type'    => 'select',
        'choices'    => array(
        	'style_1' => 'Style 1',
            'style_2' => 'Style 2',
            'style_3' => 'Style 3',
            'style_4' => 'Style 4',
        ),
    ));




    //  =============================
    //  = Header Button name
    //  =============================
   // $wp_customize->add_setting('themename_theme_options[mt_header_bn]', array(
   //     'default'        => 'Make an Appointment',
   //     'capability'     => 'edit_theme_options',
   //     'type'           => 'option',


   // ));

   // $wp_customize->add_control('mt_header_bn', array(
   //     'label'      => 'Button Name',
   //     'section'    => 'themename_header',
   //     'settings'   => 'themename_theme_options[mt_header_bn]',
   // ));


 //  =============================
    //  = Header Button url
    //  =============================
   // $wp_customize->add_setting('themename_theme_options[mt_header_bu]', array(
   //     'default'        => "http://www.themeforest.net",
   //     'capability'     => 'edit_theme_options',
   //     'type'           => 'option',


   // ));

   // $wp_customize->add_control('mt_header_bu', array(
   //     'label'      => 'Button URL',
   //     'section'    => 'themename_header',
   //     'settings'   => 'themename_theme_options[mt_header_bu]',
   // ));



	//  =============================
    //  = Menu right area
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_header_ep]', array(
    	'default'        => "1",
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));

    $wp_customize->add_control('mt_header_ep', array(
        'settings' => 'themename_theme_options[mt_header_ep]',
        'label'    => 'Display Header Right area',
        'section'  => 'themename_header',
        'type'     => 'checkbox',
    ));





    //  =============================
    //  = Phone area
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_header_phone]', array(
        'default'        => '<i class="fa fa-phone"></i>  Call Us: <strong>+371 2 200 055 99</strong>',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',


    ));

    $wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'mt_header_phone', array(
        'label'      => 'Phone area',
        'section'    => 'themename_header',
        'settings'   => 'themename_theme_options[mt_header_phone]',
    )));





        //  =============================
    //  = Header email
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_header_email]', array(
        'default'        => '<i class="fa fa-envelope"></i> your@domain.com',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',


    ));

    $wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'mt_header_email', array(
        'label'      => 'E-mail area',
        'section'    => 'themename_header',
        'settings'   => 'themename_theme_options[mt_header_email]',
    )));


     //  =============================
    //  = Top area seo text
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_header_seo]', array(
        'default'        => 'Great text area for SEO (Google, Yahoo, Bing)',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',


    ));

    $wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'mt_header_seo', array(
        'label'      => 'Header SEO text',
        'section'    => 'themename_header',
        'settings'   => 'themename_theme_options[mt_header_seo]',
    )));





    $wp_customize->add_section('themename_color_scheme', array(
        'title'    => __('Style Options', 'themename'),
        'priority' => 125,
    ));



     //  =============================
    //  = Color Picker              =
    //  =============================
    $wp_customize->add_setting('default_color', array(
        'default'           => '#f44429',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'default_color', array(
        'label'    => __('Default Color', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'default_color',
    )));






    //  =============================
    //  = Radio Input               =
    //  =============================
    $wp_customize->add_setting('layout_style', array(
        'default'        => 'full',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control('themename_layout_style', array(
        'label'      => __('Layout Style', 'themename'),
        'section'    => 'themename_color_scheme',
        'settings'   => 'layout_style',
        'type'       => 'radio',
        'choices'    => array(
            'full' => 'Full Width',
            'box' => 'Boxed',
        ),
    ));






   //  =============================
    //  = Color Picker              =
    //  =============================
    $wp_customize->add_setting('bg_default_color', array(
        'default'           => '#3a3a3a',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'bg_default_color', array(
        'label'    => __('Background Color', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'bg_default_color',
    )));





    //  =============================
    //  = Image Upload              =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[image_upload_test]', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_upload_test', array(
        'label'    => __('Upload Background Image', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'themename_theme_options[image_upload_test]',
    )));


    //  =============================
    //  = Image Upload              =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[image_upload_test2]', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_upload_test2', array(
        'label'    => __('Upload Background Title Image', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'themename_theme_options[image_upload_test2]',
    )));






    //  =============================
    //  = Background Repeat  	    =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[background_repeat]', array(
        'default'        => 'none',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'example_select_box', array(
        'settings' => 'themename_theme_options[background_repeat]',
        'label'   => 'Background Repeat:',
        'section' => 'themename_color_scheme',
        'type'    => 'select',
        'choices'    => array(
        	'none' => 'Select',
            'full' => 'Full',
            'no-repeat' => 'No Repeat',
            'repeat' => 'Repeat',
            'repeat-x' => 'Repeat Horizontally',
            'repeat-y' => 'Repeat Vertically',
            'inherit' => 'Inherit',
        ),
    ));

    //  =============================
    //  = Background Attachment  	    =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[background_attachment]', array(
        'default'        => 'none',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'example_select_box2', array(
        'settings' => 'themename_theme_options[background_attachment]',
        'label'   => 'Background Attachment:',
        'section' => 'themename_color_scheme',
        'type'    => 'select',
        'choices'    => array(
        	'none' => 'Select',
            'fixed' => 'Fixed',
            'scroll' => 'Scroll',
            'inherit' => 'Inherit',
        ),
    ));

    //  =============================
    //  = Background Position  	    =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[background_position]', array(
        'default'        => 'none',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'example_select_box3', array(
        'settings' => 'themename_theme_options[background_position]',
        'label'   => 'Background Position:',
        'section' => 'themename_color_scheme',
        'type'    => 'select',
        'choices'    => array(
        	'none' => 'Select',
            'left top' => 'Left Top',
            'left center' => 'Left Center',
            'left bottom' => 'Left Bottom',
            'center top' => 'Center Top',
            'center center' => 'Center Center',
            'center bottom' => 'Center Bottom',
            'right top' => 'Right Top',
            'right center' => 'Right Center',
            'right bottom' => 'Right Bottom',
        ),
    ));


      //	==================================================
    //  =============================
    //  = ==== Title
    //  =============================

    $wp_customize->add_section('themename_title', array(
        'title'    => __('Title', 'themename'),
        'priority' => 129,
    ));



     //  =============================
    //  = Color Picker              =
    //  =============================
    $wp_customize->add_setting('bg_default_color_title', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'bg_default_color_title', array(
        'label'    => __('Title Background Color', 'themename'),
        'section'  => 'themename_title',
        'settings' => 'bg_default_color_title',
    )));





    //  =============================
    //  = Image Upload              =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[image_upload_test_title]', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_upload_test_title', array(
        'label'    => __('Upload Title Background Image', 'themename'),
        'section'  => 'themename_title',
        'settings' => 'themename_theme_options[image_upload_test_title]',
    )));


    //  =============================
    //  = Background Repeat  	    =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[background_repeat_title]', array(
        'default'        => 'none',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'example_select_box', array(
        'settings' => 'themename_theme_options[background_repeat_title]',
        'label'   => 'Background Repeat:',
        'section' => 'themename_title',
        'type'    => 'select',
        'choices'    => array(
        	'none' => 'Select',
            'no-repeat' => 'No Repeat',
            'repeat' => 'Repeat',
            'repeat-x' => 'Repeat Horizontally',
            'repeat-y' => 'Repeat Vertically',
            'inherit' => 'Inherit',
        ),
    ));

    //  =============================
    //  = Background Attachment  	    =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[background_attachment_title]', array(
        'default'        => 'none',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'example_select_box2', array(
        'settings' => 'themename_theme_options[background_attachment_title]',
        'label'   => 'Background Attachment:',
        'section' => 'themename_title',
        'type'    => 'select',
        'choices'    => array(
        	'none' => 'Select',
            'fixed' => 'Fixed',
            'scroll' => 'Scroll',
            'inherit' => 'Inherit',
        ),
    ));

    //  =============================
    //  = Background Position  	    =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[background_position_title]', array(
        'default'        => 'none',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'example_select_box3', array(
        'settings' => 'themename_theme_options[background_position_title]',
        'label'   => 'Background Position:',
        'section' => 'themename_title',
        'type'    => 'select',
        'choices'    => array(
        	'none' => 'Select',
            'left top' => 'Left Top',
            'left center' => 'Left Center',
            'left bottom' => 'Left Bottom',
            'center top' => 'Center Top',
            'center center' => 'Center Center',
            'center bottom' => 'Center Bottom',
            'right top' => 'Right Top',
            'right center' => 'Right Center',
            'right bottom' => 'Right Bottom',
        ),
    ));







    //	==================================================
    //  =============================
    //  = ==== Fonts
    //  =============================

    $wp_customize->add_section('themename_fonts', array(
        'title'    => __('Fonts', 'themename'),
        'priority' => 130,
    ));


	//  =============================
    //  = Google Font name
    //  =============================
    $wp_customize->add_setting('themename_theme_options[font_name]', array(
        'default'        => 'Open+Sans:300,400,600,700',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',


    ));

    $wp_customize->add_control('mt_google_font_name', array(
        'label'      => 'Google Font Name',
        'section'    => 'themename_fonts',
        'settings'   => 'themename_theme_options[font_name]',
    ));


    //  =============================
    //  = Google Font name
    //  =============================
    $wp_customize->add_setting('themename_theme_options[font_css]', array(
        'default'        => "font-family: 'Open Sans', sans-serif;",
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('mt_google_font_css', array(
        'label'      => 'Google Font CSS',
        'section'    => 'themename_fonts',
        'settings'   => 'themename_theme_options[font_css]',
    ));



    //	==================================================
    //  =============================
    //  = ==== Footer
    //  =============================

    $wp_customize->add_section('themename_footer', array(
        'title'    => 'Footer',
        'priority' => 131,
    ));

	//  =============================
    //  = Footer Top
    //  =============================
    $wp_customize->add_setting('themename_theme_options[footer_top]', array(
    	'default'        => "1",
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));

    $wp_customize->add_control('mt_footer_top', array(
        'settings' => 'themename_theme_options[footer_top]',
        'label'    => 'Display Top Footer',
        'section'  => 'themename_footer',
        'type'     => 'checkbox',
    ));


    //  =============================
    //  = Footer Bottom
    //  =============================
    $wp_customize->add_setting('themename_theme_options[footer_bottom]', array(
        'capability' => 'edit_theme_options',
        'default'        => "1",
        'type'       => 'option',
    ));

    $wp_customize->add_control('mt_footer_bottom', array(
        'settings' => 'themename_theme_options[footer_bottom]',
        'label'    => 'Display Bottom Footer',
        'section'  => 'themename_footer',
        'type'     => 'checkbox',
    ));


    //  =============================
    //  = Footer Top Columns  	    =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[footer_columns]', array(
        'default'        => '2_4',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'mt_footer_columns', array(
        'settings' => 'themename_theme_options[footer_columns]',
        'label'   => 'Footer Columns:',
        'section' => 'themename_footer',
        'type'    => 'select',
        'choices'    => array(
       		'1_1' => '1/1',
        	'1_2' => '1/2',
            '1_3' => '1/3',
            '1_4' => '1/4',
            '2_4' => '2/4',
            '4_2' => '4/2',
        ),
    ));


	//  =============================
    //  = Copyright
    //  =============================
    $wp_customize->add_setting('themename_theme_options[copyright_text]', array(
        'default'        => 'Copyright 2013. Powered by WordPress Theme. By M.Bitenieks',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',


    ));

    $wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'mt_copyright_text', array(
        'label'      => 'Copyright Text',
        'section'    => 'themename_footer',
        'settings'   => 'themename_theme_options[copyright_text]',
    )));



	//	==================================================
    //  =============================
    //  = ==== Social Icons
    //  =============================

    $wp_customize->add_section('themename_icons', array(
        'title'    => __('Social Icons', 'themename'),
        'priority' => 140,
    ));


	//  =============================
    //  = Google Font name
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_icon_facebook]', array(
        'default'        => '#',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_icon_facebook', array(
        'label'      => 'Facebook icon link',
        'section'    => 'themename_icons',
        'settings'   => 'themename_theme_options[mt_icon_facebook]',
    ));

    $wp_customize->add_setting('themename_theme_options[mt_icon_twitter]', array(
        'default'        => '#',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_icon_twitter', array(
        'label'      => 'Twitter icon link',
        'section'    => 'themename_icons',
        'settings'   => 'themename_theme_options[mt_icon_twitter]',
    ));

    $wp_customize->add_setting('themename_theme_options[mt_icon_vimeo]', array(
        'default'        => '#',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_icon_vimeo', array(
        'label'      => 'Vimeo icon link',
        'section'    => 'themename_icons',
        'settings'   => 'themename_theme_options[mt_icon_vimeo]',
    ));

    $wp_customize->add_setting('themename_theme_options[mt_icon_youtube]', array(
        'default'        => '#',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_icon_youtube', array(
        'label'      => 'Youtube icon link',
        'section'    => 'themename_icons',
        'settings'   => 'themename_theme_options[mt_icon_youtube]',
    ));

    $wp_customize->add_setting('themename_theme_options[mt_icon_linkedin]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_icon_linkedin', array(
        'label'      => 'LinkedIn icon link',
        'section'    => 'themename_icons',
        'settings'   => 'themename_theme_options[mt_icon_linkedin]',
    ));

    $wp_customize->add_setting('themename_theme_options[mt_icon_gplus]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_icon_gplus', array(
        'label'      => 'Google Plus icon link',
        'section'    => 'themename_icons',
        'settings'   => 'themename_theme_options[mt_icon_gplus]',
    ));

    $wp_customize->add_setting('themename_theme_options[mt_icon_dribble]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_icon_dribble', array(
        'label'      => 'Dribble icon link',
        'section'    => 'themename_icons',
        'settings'   => 'themename_theme_options[mt_icon_dribble]',
    ));

    $wp_customize->add_setting('themename_theme_options[mt_icon_skype]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_icon_skype', array(
        'label'      => 'Skype icon link',
        'section'    => 'themename_icons',
        'settings'   => 'themename_theme_options[mt_icon_skype]',
    ));



    $wp_customize->add_setting('themename_theme_options[mt_icon_pinterest]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_icon_pinterest', array(
        'label'      => 'Pinterest icon link',
        'section'    => 'themename_icons',
        'settings'   => 'themename_theme_options[mt_icon_pinterest]',
    ));

    $wp_customize->add_setting('themename_theme_options[mt_icon_rss]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_icon_rss', array(
        'label'      => 'Rss icon link',
        'section'    => 'themename_icons',
        'settings'   => 'themename_theme_options[mt_icon_rss]',
    ));



    //	==================================================
    //  =============================
    //  = ==== Rewrite CPT
    //  =============================

    $wp_customize->add_section('themename_rewrite', array(
        'title'    => __('Rewrite CPT Slug', 'themename'),
        'priority' => 141,
    ));


	//  =============================
    //  = CPT doctor
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_rewrite_doctor]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_rewrite_doctor', array(
        'label'      => 'Rewrite Doctor CPT slug',
        'section'    => 'themename_rewrite',
        'settings'   => 'themename_theme_options[mt_rewrite_doctor]',
    ));


    //  =============================
    //  = CPT Services
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_rewrite_services]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_rewrite_services', array(
        'label'      => 'Rewrite Services CPT slug',
        'section'    => 'themename_rewrite',
        'settings'   => 'themename_theme_options[mt_rewrite_services]',
    ));


	//  =============================
    //  = CPT Portfolio
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_rewrite_portfolio]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_rewrite_portfolio', array(
        'label'      => 'Rewrite Portfolio CPT slug',
        'section'    => 'themename_rewrite',
        'settings'   => 'themename_theme_options[mt_rewrite_portfolio]',
    ));



	//  =============================
    //  = CPT Causes
    //  =============================
    $wp_customize->add_setting('themename_theme_options[mt_rewrite_causes]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_rewrite_causes', array(
        'label'      => 'Rewrite Causes CPT slug',
        'section'    => 'themename_rewrite',
        'settings'   => 'themename_theme_options[mt_rewrite_causes]',
    ));



	 //	==================================================
    //  =============================
    //  = ==== Rewrite CPT
    //  =============================

    $wp_customize->add_section('themename_rewrite_n', array(
        'title'    => __('Rewrite CPT Name', 'themename'),
        'priority' => 142,
    ));


	$wp_customize->add_setting('themename_theme_options[mt_rewrite_portfolio_name]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_rewrite_portfolio_name', array(
        'label'      => 'Rewrite Portfolio CPT Name',
        'section'    => 'themename_rewrite_n',
        'settings'   => 'themename_theme_options[mt_rewrite_portfolio_name]',
    ));

    $wp_customize->add_setting('themename_theme_options[mt_rewrite_causes_name]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_rewrite_causes_name', array(
        'label'      => 'Rewrite Causes CPT Name',
        'section'    => 'themename_rewrite_n',
        'settings'   => 'themename_theme_options[mt_rewrite_causes_name]',
    ));

     $wp_customize->add_setting('themename_theme_options[mt_rewrite_services_name]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_rewrite_services_name', array(
        'label'      => 'Rewrite Services CPT Name',
        'section'    => 'themename_rewrite_n',
        'settings'   => 'themename_theme_options[mt_rewrite_services_name]',
    ));

     $wp_customize->add_setting('themename_theme_options[mt_rewrite_doctor_name]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
	$wp_customize->add_control('mt_rewrite_doctor_name', array(
        'label'      => 'Rewrite Doctor CPT Name',
        'section'    => 'themename_rewrite_n',
        'settings'   => 'themename_theme_options[mt_rewrite_doctor_name]',
    ));




}

add_action('customize_register', 'themename_customize_register');

$mt_options = get_option("themename_theme_options");

if($mt_options['mt_responsive']=='responsive_no') {

	$col_2 = " col-xs-2 col-sm-2 ";
	$col_3 = " col-xs-3 col-sm-3 ";
	$col_4 = " col-xs-4 col-sm-4 ";
	$col_5 = " col-xs-5 col-sm-5 ";
	$col_6 = " col-xs-6 col-sm-6 ";
	$col_7 = " col-xs-7 col-sm-7 ";
	$col_8 = " col-xs-8 col-sm-8 ";
	$col_9 = " col-xs-9 col-sm-9 ";
	$col_10 = " col-xs-10 col-sm-10 ";

} else {

	$col_2 = "";
	$col_3 = "";
	$col_4 = "";
	$col_5 = "";
	$col_6 = "";
	$col_7 = "";
	$col_8 = "";
	$col_9 = "";
	$col_10 = "";

}


?>
