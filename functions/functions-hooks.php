<?php 

/*-----------------------------------------------------------------------------------*/
/* Header init
/*-----------------------------------------------------------------------------------*/

function header_script() {
    
	if ( !is_admin() ) {
		 
		$mt_options = get_option("themename_theme_options");
		 
		if($mt_options['mt_responsive']!='responsive_no') {  
			
			wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/bootstrap/bootstrap.min.responsive.css'); 
			wp_enqueue_style('madza-style', get_stylesheet_uri()); 
			wp_enqueue_style('responsive-css', get_template_directory_uri().'/css/responsive.css');
		
		} else {
		
			wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/bootstrap/bootstrap.min.css');
			wp_enqueue_style('madza-style', get_stylesheet_uri()); 
			
		}
		
		wp_enqueue_script( 'jquery' , '1.0' , true);
		wp_enqueue_script('flexjs', get_template_directory_uri() . '/functions/plugins/flex-slider/jquery.flexslider-min.js', array('jquery'), '1.0');
		wp_enqueue_script('superfish', get_template_directory_uri() . '/functions/plugins/superfish/superfish.js', array('jquery'));
	    wp_enqueue_script('supersubs', get_template_directory_uri() . '/functions/plugins/superfish/supersubs.js', array('jquery'), '1.0' , true);
	 	wp_enqueue_script('superfishhover', get_template_directory_uri() . '/functions/plugins/superfish/hoverIntent.js', array('jquery'), '1.0' , true);
	 	wp_enqueue_script('isotope', get_template_directory_uri() . '/functions/js/jquery.isotope.min.js', array('jquery'), '1.0', true);
	    wp_enqueue_script('effect_directory', get_template_directory_uri() . '/functions/js/effects.js', array('jquery','superfish','supersubs','superfishhover'));
	    wp_enqueue_script('pretty_photo', get_template_directory_uri() . '/functions/plugins/prettyphoto/js/jquery.prettyPhoto.js', array('jquery','superfish','supersubs','superfishhover'), '1.0' , true);
	    wp_enqueue_script('easing', get_template_directory_uri() . '/functions/js/jquery.easing.1.3.js', array('jquery','superfish','supersubs','superfishhover'), '1.0' , true);
		wp_enqueue_script('modernizerss', get_template_directory_uri() . '/functions/js/modernizr.custom.js', array('jquery'), '1.0', true );
		#wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/functions/js/jquery-hover-effect.js', array('jquery'), '1.0');
		wp_enqueue_script('bootstrap-jsu', get_template_directory_uri() . '/functions/js/bootstrap.min.js', array('jquery'), '1.0');
		#wp_enqueue_script('waypoints', get_template_directory_uri() . '/functions/js/waypoints.min.js', array('jquery'), '1.0', true);

		wp_enqueue_script('cycle', get_template_directory_uri() . '/functions/js/cycle.js', array('jquery'), '1.0');
	
		$protocol = is_ssl() ? 'https' : 'http';
		
		wp_enqueue_style('madzatheme-fonts', "$protocol://fonts.googleapis.com/css?family=". $mt_options['font_name'] );
		wp_enqueue_style('fontawesome', get_template_directory_uri().'/functions/plugins/FortAwesome/css/font-awesome.min.css');
		
	} else { 
	
		$mt_options = get_option("themename_theme_options");
			
		if($mt_options['mt_responsive']!='responsive_no') {  
			
			wp_enqueue_style('responsive-css', get_template_directory_uri().'/css/responsive.css');
		
		}
		wp_enqueue_style('admin-css', get_template_directory_uri().'/css/admin.css');
		wp_enqueue_script('customadmin', get_template_directory_uri() . '/functions/js/jquery.customadmin.js', array('jquery'), '1.0'); 
		
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'madzatheme-fonts', "$protocol://fonts.googleapis.com/css?family=". $mt_options['font_name'] );
	
	}

} 

add_action('init', 'header_script');

function mason_script() {
    wp_enqueue_script( 'jquery-masonry' );
}
add_action( 'wp_enqueue_scripts', 'mason_script' );


/*-----------------------------------------------------------------------------------*/
/* Header Hook
/*-----------------------------------------------------------------------------------*/

function header_hooks() {
	
	global $post;

	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
	
	if ( is_singular() ) { wp_enqueue_script( "comment-reply" ); }  
	
	$favicon = get_option("themename_theme_options");		 
	 
	?><link rel="icon" href="<?php echo $favicon['mt_favicon']; ?>" type="image/x-icon" ><?php
	?><link rel="shortcut icon" href="<?php echo $favicon['mt_favicon'];  ?>" type="image/x-icon" ><?php
	?><link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" ><?php
	?><link rel="profile" href="http://gmpg.org/xfn/11" ><?php
	?><script type="text/javascript">jQuery(document).ready(function(){ jQuery("ul.sf-menu, div.sf-menu ul").supersubs({ minWidth:6, maxWidth:27, extraWidth:1 }).superfish({ speed: 'fast', delay: 100 }); });</script><?php

	get_template_part('style');  
	 
	$css = get_option("themename_theme_options");
	
	if($css['mt_css']!=""){ 
	
		?><style type="text/css"><?php echo $css['mt_css']; ?></style><?php
		
    }
    
    remove_action('wp_head', 'rsd_link');
	
	remove_action('wp_head', 'wlwmanifest_link');
        
}

add_action('wp_head', 'header_hooks');


/* --------------------------------------------------------------------------------------- Body Class */

add_filter('body_class','style_typer');

function style_typer($classesa) {

	global $post;	
	
		if(get_post_meta($post->ID, "mt_layout_styler_page", true)!="") {
			
			if(get_post_meta($post->ID, "mt_layout_styler_page", true)=="full") {
				$classesa[] = 'layout_style_full';
				return $classesa;
			} else if(get_post_meta($post->ID, "mt_layout_styler_page", true)=="box") {
				$classesa[] = 'layout_style_box';
				return $classesa;
			} else if(get_post_meta($post->ID, "mt_layout_styler_page", true)=="free") {
				$classesa[] = 'layout_style_free';
				return $classesa;
			} else {
				$classesa[] = 'layout_style_full';
				return $classesa;
			} 
			
		} else {
			
			if(get_option("layout_style")=="full") {
				$classesa[] = 'layout_style_full';
				return $classesa;
			} else if(get_option("layout_style")=="box") {
				$classesa[] = 'layout_style_box';
				return $classesa;
			} else if(get_option("layout_style")=="free") {
				$classesa[] = 'layout_style_free';
				return $classesa;
			} else {
				$classesa[] = 'layout_style_full';
				return $classesa;
			} 
		}
		
}


add_filter('body_class','mt_style_header');

function mt_style_header($mt_style_header) {

	global $post;	
	
	$mt_options = get_option("themename_theme_options");
		
	if(get_post_meta($post->ID, "mt_style_header", true)!="" and get_post_meta($post->ID, "mt_style_header", true)!="style_default") {
	
		if(get_post_meta($post->ID, "mt_style_header", true)=="style_1") {
			$mt_style_header[] = 'mt_style_header_1';
			return $mt_style_header;
		} else if(get_post_meta($post->ID, "mt_style_header", true)=="style_2") {
			$mt_style_header[] = 'mt_style_header_2';
			return $mt_style_header;
		} else if(get_post_meta($post->ID, "mt_style_header", true)=="style_3") {
			$mt_style_header[] = 'mt_style_header_3';
			return $mt_style_header;
		} else if(get_post_meta($post->ID, "mt_style_header", true)=="style_4") {
			$mt_style_header[] = 'mt_style_header_4';
			return $mt_style_header;
		} 
	
	} else {
		
		if($mt_options['mt_header_s']=="style_1") {
			$mt_style_header[] = 'mt_style_header_1';
			return $mt_style_header;
		} else if($mt_options['mt_header_s']=="style_2") {
			$mt_style_header[] = 'mt_style_header_2';
			return $mt_style_header;
		}  else if($mt_options['mt_header_s']=="style_4") {
			$mt_style_header[] = 'mt_style_header_4';
			return $mt_style_header;
		} else {
			$mt_style_header[] = 'mt_style_header_3';
			return $mt_style_header;
		}
		
	}
		
}

add_filter('body_class','mt_style_header');



function mt_menu_fixed($mt_menu_fixed) {

	global $post;	
	
	$mt_options = get_option("themename_theme_options");
		
	if(get_post_meta($post->ID, "mt_menu_fix", true)!="" and get_post_meta($post->ID, "mt_menu_fix", true)!="style_default") {
	
		if(get_post_meta($post->ID, "mt_menu_fix", true)=="yes") {
			$mt_menu_fixed[] = 'mt-fixed';
			return $mt_menu_fixed;
		} else if(get_post_meta($post->ID, "mt_menu_fix", true)=="no") {
			$mt_menu_fixed[] = 'mt-fixed-no';
			return $mt_menu_fixed;
		}  
		
		
	} else {
		
		if($mt_options['mt_menu_fix']=="1") {
			$mt_menu_fixed[] = 'mt-fixed';
			return $mt_menu_fixed;
		} else { 
			$mt_menu_fixed[] = 'mt-fixed-no'; 
			return $mt_menu_fixed;
		}
	}

}
add_filter('body_class','mt_menu_fixed');

/*-----------------------------------------------------------------------------------*/
/* Footer Hook
/*-----------------------------------------------------------------------------------*/

function jquery_plugins_footer() {

    if ( !is_admin() ) {  
    
    	?><script type="text/javascript">jQuery(document).ready(function(){jQuery("a[data-rel^='prettyPhoto']").prettyPhoto();});</script><?php
        
        echo ot_get_option('mt_custom_html');
       
    }
}
add_action('wp_footer', 'jquery_plugins_footer');
?>