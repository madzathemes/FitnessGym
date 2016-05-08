<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'Installation'
      ),
      array(
        'id'          => 'blog',
        'title'       => 'Blog'
      ),
      array(
        'id'          => 'fonts',
        'title'       => 'Font style'
      ),
   
    ),
    
    'settings'        => array( 
    
    array(
        'id'          => 'font_size_p',
        'label'       => 'Default p, li, div Font size',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '13',
        'type'        => 'numeric_slider',
        'min_max_step'=> '12,64,1',
     ),
     
     array(
        'id'          => 'font_size_post',
        'label'       => 'Post Font size',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '15',
        'type'        => 'numeric_slider',
        'min_max_step'=> '12,64,1',
     ),
    
    array(
        'id'          => 'font_size_h1_post',
        'label'       => 'Post heading Font size',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '36',
        'type'        => 'numeric_slider',
        'min_max_step'=> '12,64,1',
     ),
      
    array(
        'id'          => 'font_size_h1',
        'label'       => 'H1 Font size',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '36',
        'type'        => 'numeric_slider',
        'min_max_step'=> '12,64,1',
     ),
     array(
        'id'          => 'font_size_h2',
        'label'       => 'H2 Font size',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '24',
        'type'        => 'numeric_slider',
        'min_max_step'=> '12,64,1',
     ),
     array(
        'id'          => 'font_size_h3',
        'label'       => 'H3 Font size',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '18',
        'type'        => 'numeric_slider',
        'min_max_step'=> '12,64,1',
     ),
     array(
        'id'          => 'font_size_h4',
        'label'       => 'H4 Font size',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '16',
        'type'        => 'numeric_slider',
        'min_max_step'=> '12,64,1',
     ),
     array(
        'id'          => 'font_size_h5',
        'label'       => 'H5 Font size',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '15',
        'type'        => 'numeric_slider',
        'min_max_step'=> '12,64,1',
     ),
     array(
        'id'          => 'font_size_h6',
        'label'       => 'H6 Font size',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '14',
        'type'        => 'numeric_slider',
        'min_max_step'=> '12,64,1',
     ),
     
     array(
        'id'          => 'font_color_p',
        'label'       => 'Default p, li, div Font color',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '#000',
        'type'        => 'colorpicker',
     ),
     array(
        'id'          => 'font_color_post',
        'label'       => 'Post Font color',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '#000',
        'type'        => 'colorpicker',
     ),
     array(
        'id'          => 'font_color_heading',
        'label'       => 'H1,H2,H3,H4,H5,H6 Font color',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '#000',
        'type'        => 'colorpicker',
     ),
     array(
        'id'          => 'font_color_link_post',
        'label'       => 'Post Heading Link Font color',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '#000',
        'type'        => 'colorpicker',
     ),
     array(
        'id'          => 'font_color_link',
        'label'       => 'Link Font color',
        'desc'        => '',
        'section'     => 'fonts',
        'std'         => '#000',
        'type'        => 'colorpicker',
     ),
    
      array(
        'id'          => 'help',
        'label'       => 'Need Help?',
        'desc'        => '<h1>Need Help?</h1> 
<ul>
<li>Check Our Support Forums <a target="_blank" href="http://madzathemes.com/">Click Here</a></li>

<li>Install Documentation You can found in <strong>Theme Package / How_to_install</strong> folder.</li>
</ul>

<h1>Installation Steps</h1> 
<ul>

<li><strong>1.</strong> Upload theme demo content. Go to <strong>Tools / Import</strong>. Demo Content/Dummy Data You can found in <strong>Theme Package / Demo_Content / demo_content.xml</strong>.</li>

<li><strong>2.</strong> Create Menu, goto <strong>Appearance / Menu / Theme Locations</strong> and select menu for header, footer and responsive / mobile device.</li>

<li><strong>3.</strong> Add website logo in <strong>Appearance / Customize / Logo</strong></li>

<strong>4.</strong> Create awesome website. :)</li>
</ul>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'id'          => 'mt_custom_html',
        'label'       => 'Tracking Code',
        'desc'        => 'Paste your tracking code here. This will be added into the footer template of your theme.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
 
       
      array(
        'id'          => 'blog_content_type',
        'label'       => 'Excerpt or Full Content',
        'std'         => 'full_content',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'full_content',
            'label'       => 'Full Content',
            'src'         => ''
          ),
          array(
            'value'       => 'exscerpt',
            'label'       => 'Exscerpt',
            'src'         => ''
          )
        ),
      ),
      
       array(
        'id'          => 'blog_content_lenght',
        'label'       => 'Excerpt Lenght',
        'desc'        => '',
        'section'     => 'blog',
        'std'         => '350',
        'type'        => 'numeric_slider',
        'min_max_step'=> '10,1000,10',
          ),
          
        array(
        'id'          => 'blog_meta_on',
        'label'       => 'Blog Meta Description',
        'std'         => 'on',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'label'       => 'On',
            'src'         => ''
          ),
          array(
            'value'       => 'off',
            'label'       => 'Off',
            'src'         => ''
          )
        ),
      ),

      
      array(
        'id'          => 'mt_cpt_rewrite_doctor',
        'label'       => 'Rewrite Doctor Custom Post Type Slug',
        'desc'        => 'Default: our-doctors',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'mt_cpt_rewrite_services',
        'label'       => 'Rewrite Service Custom Post Type Slug',
        'desc'        => 'Default: our-services',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'mt_cpt_rewrite_portfolio',
        'label'       => 'Rewrite Portfolio Custom Post Type Slug',
        'desc'        => 'Default: portfolio',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'login_logo',
        'label'       => 'Login Logo',
        'desc'        => 'Paste the full URL (include http://) of your custom logo here or you can insert the image through the button.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'mt_top_html',
        'label'       => 'Header Right HTML',
        'desc'        => 'Paste your code here. This will be added into the header right area.',
        'std'         => '<a href="#" class="mt_donation_button"><h2>Make an Appointment</h2></a>',
        'type'        => 'textarea-simple',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'right_area_search',
        'label'       => 'Right Menu Area',
        'desc'        => 'Select right option from menu area.',
        'std'         => 'html',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          #array(
          #  'value'       => 'html_search',
          #  'label'       => 'HTML & Search button',
          #  'src'         => ''
          #),
          array(
            'value'       => 'search',
            'label'       => 'Off',
            'src'         => ''
          ),
          array(
            'value'       => 'html',
            'label'       => 'On HTML area',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'mt_menu_html',
        'label'       => 'Menu Right HTML',
        'desc'        => 'Paste your code here. This will be added into the menu right area.',
        'std'         => '<p><i class="icon-envelope"></i> your@domain.com &nbsp;&nbsp;&nbsp;<i class="icon-phone"></i>  Call Us: <strong>+371 2 200 055 99</strong></p>',
        'type'        => 'textarea-simple',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'mt_homepage_slider_image',
        'label'       => 'Slider Media',
        'desc'        => '',
        'std'         => '',
        'type'        => 'slider',
        'section'     => 'home_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'mt_homepage_slider_height',
        'label'       => 'Slider Height (px)',
        'desc'        => '',
        'std'         => '350',
        'type'        => 'text',
        'section'     => 'home_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'home_slider_type',
        'label'       => 'Slider Type',
        'desc'        => '',
        'std'         => 'home_slider_shortcode',
        'type'        => 'select',
        'section'     => 'home_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'home_slider_flex',
            'label'       => 'Flex Slider (Responsive)',
            'src'         => ''
          ),
          array(
            'value'       => 'home_slider_shortcode',
            'label'       => 'Slider from Shortcode',
            'src'         => ''
          ),
          array(
            'value'       => 'home_slider_off',
            'label'       => 'Slider Off',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'home_slider_shortcode_code',
        'label'       => 'Slider Shortcode',
        'desc'        => 'Sample: [layerslider id="1"] or [rev_slider slider_one].',
        'std'         => '[layerslider id="4"]',
        'type'        => 'text',
        'section'     => 'home_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'homepage_content_area',
        'label'       => 'Content',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'home_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'homepage_frompage',
        'label'       => 'Show content from page',
        'desc'        => 'Choose which page you want to pull content from to fill this area.',
        'std'         => '6510',
        'type'        => 'page-select',
        'section'     => 'home_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'enable_footer',
        'label'       => 'Enable Footer',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'label'       => 'On',
            'src'         => ''
          ),
          array(
            'value'       => 'off',
            'label'       => 'Off',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'footer_column',
        'label'       => 'Footer Column',
        'desc'        => 'Select footer columns and insert some widgets. Go to Appearance/Widgets and insert some widgets in footer widget areas.',
        'std'         => '1_4',
        'type'        => 'select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1_2',
            'label'       => '1/2',
            'src'         => ''
          ),
          array(
            'value'       => '1_3',
            'label'       => '1/3',
            'src'         => ''
          ),
          array(
            'value'       => '1_4',
            'label'       => '1/4',
            'src'         => ''
          ),
          array(
            'value'       => '1_5',
            'label'       => '1/5',
            'src'         => ''
          ),
          array(
            'value'       => '2_4',
            'label'       => '2/4',
            'src'         => ''
          ),
          array(
            'value'       => '4_2',
            'label'       => '4/2',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'footer_buttom',
        'label'       => 'Enable Footer Bottom',
        'desc'        => '',
        'std'         => 'footer_buttom_on',
        'type'        => 'select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'footer_buttom_on',
            'label'       => 'On',
            'src'         => ''
          ),
          array(
            'value'       => 'footer_buttom_off',
            'label'       => 'Off',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'copyright',
        'label'       => 'Footer Bottom Copyright Text',
        'desc'        => '',
        'std'         => 'Copyright 2013. Powered by WordPress Theme. By M.Bitenieks',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      
      
      /* SEARCH LAYOUTS*/
      array(
        'id'          => 'search_sidebars',
        'label'       => 'Search Page Layouts',
        'desc'        => 'Select layout style for search page.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'search_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'sidebar_1',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'sidebar_2',
            'label'       => 'Left Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'sidebar_3',
            'label'       => 'Sidebar off (full width)',
            'src'         => ''
          ),
          array(
            'value'       => 'sidebar_4',
            'label'       => 'Left and Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'sidebar_5',
            'label'       => 'Two Left Sidebars',
            'src'         => ''
          ),
          array(
            'value'       => 'sidebar_6',
            'label'       => 'Two Right Sidebars',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'sidebar_first',
        'label'       => 'Search Page Sidebar Left or First',
        'desc'        => 'You can create new sidebars in Sidebars/Add Sidebar.',
        'std'         => '',
        'type'        => 'custom-post-type-select',
        'section'     => 'search_page',
        'rows'        => '',
        'post_type'   => 'mt_sidebar',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'sidebar_second',
        'label'       => 'Search Page Sidebar Right or Second',
        'desc'        => 'You can create new sidebars in Sidebars/Add Sidebar.',
        'std'         => '',
        'type'        => 'custom-post-type-select',
        'section'     => 'search_page',
        'rows'        => '',
        'post_type'   => 'mt_sidebar',
        'taxonomy'    => '',
        'class'       => ''
      ),
      /* CATEGORY LAYOUTS*/
      array(
        'id'          => 'category_sidebars',
        'label'       => 'Category Page Layouts',
        'desc'        => 'Select layout style for search page.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'search_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'sidebar_1',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'sidebar_2',
            'label'       => 'Left Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'sidebar_3',
            'label'       => 'Sidebar off (full width)',
            'src'         => ''
          ),
          array(
            'value'       => 'sidebar_4',
            'label'       => 'Left and Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'sidebar_5',
            'label'       => 'Two Left Sidebars',
            'src'         => ''
          ),
          array(
            'value'       => 'sidebar_6',
            'label'       => 'Two Right Sidebars',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'category_sidebar_first',
        'label'       => 'Category Page Sidebar Left or First',
        'desc'        => 'You can create new sidebars in Sidebars/Add Sidebar.',
        'std'         => '',
        'type'        => 'custom-post-type-select',
        'section'     => 'search_page',
        'rows'        => '',
        'post_type'   => 'mt_sidebar',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'category_sidebar_second',
        'label'       => 'Category Page Sidebar Right or Second',
        'desc'        => 'You can create new sidebars in Sidebars/Add Sidebar.',
        'std'         => '',
        'type'        => 'custom-post-type-select',
        'section'     => 'search_page',
        'rows'        => '',
        'post_type'   => 'mt_sidebar',
        'taxonomy'    => '',
        'class'       => ''
      ),
      
      
      
      
      
      
      
      
      
      
      array(
        'id'          => 'soc_facebook',
        'label'       => 'Facebook icon link',
        'desc'        => '',
        'std'         => '#',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_twitter',
        'label'       => 'Twitter icon link',
        'desc'        => '',
        'std'         => '#',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_vimeo',
        'label'       => 'Vimeo icon link',
        'desc'        => '',
        'std'         => '#',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_youtube',
        'label'       => 'Youtube icon link',
        'desc'        => '',
        'std'         => '#',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_linkedin',
        'label'       => 'LinkedIn icon link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_google',
        'label'       => 'Google Plus icon link',
        'desc'        => '',
        'std'         => '#',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_dribble',
        'label'       => 'Dribble icon link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_skype',
        'label'       => 'Skype icon link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_delicious',
        'label'       => 'Delicious icon link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_amazon',
        'label'       => 'Amazon icon link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_yahoo',
        'label'       => 'Yahoo icon link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_pinterest',
        'label'       => 'Pinterest icon link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'soc_rss',
        'label'       => 'Rss icon link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      
#      array(
#        'id'          => 'mt_style_theme',
#        'label'       => 'Theme Style',
#        'desc'        => 'Select Header Style.',
#        'std'         => 'style_1',
#        'type'        => 'select',
#        'section'     => 'style_options',
#        'rows'        => '',
#        'post_type'   => '',
#        'taxonomy'    => '',
#        'class'       => '',
#        'choices'     => array( 
#          array(
#            'value'       => 'style_1',
#            'label'       => 'Style 1',
#            'src'         => ''
#          ), 
#          array(
#            'value'       => 'style_2',
#            'label'       => 'Style 2',
#            'src'         => ''
#          ),         
#         ),
#      ),
      
      

      
      
      
      
      array(
        'id'          => 'mt_style_image',
        'label'       => 'Image Style',
        'desc'        => 'Select Image Style.',
        'std'         => 'style_1',
        'type'        => 'select',
        'section'     => 'style_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'style_1',
            'label'       => 'Style 1',
            'src'         => ''
          ), 
          array(
            'value'       => 'style_2',
            'label'       => 'Style 2',
            'src'         => ''
          ), 
          array(
            'value'       => 'style_3',
            'label'       => 'Style 3',
            'src'         => ''
          ),  
          array(
            'value'       => 'style_4',
            'label'       => 'Style 4',
            'src'         => ''
          ),           
         ),
      ),
      
      array(
        'id'          => 'mt_style_button',
        'label'       => 'Button Style',
        'desc'        => 'Select Button Style.',
        'std'         => 'style_1',
        'type'        => 'select',
        'section'     => 'style_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'style_1',
            'label'       => 'Style 1',
            'src'         => ''
          ), 
          array(
            'value'       => 'style_2',
            'label'       => 'Style 2',
            'src'         => ''
          ), 
          array(
            'value'       => 'style_3',
            'label'       => 'Style 3',
            'src'         => ''
          ),  
          array(
            'value'       => 'style_4',
            'label'       => 'Style 4',
            'src'         => ''
          ),           
         ),
      ),
      
      
      
#      array(
#        'id'          => 'mt_style_title',
#        'label'       => 'Page Title Background',
#        'desc'        => 'Select Page Title Background Style.',
#        'std'         => 'style_1',
#        'type'        => 'select',
#        'section'     => 'style_options',
#        'rows'        => '',
#        'post_type'   => '',
#        'taxonomy'    => '',
#        'class'       => '',
#        'choices'     => array( 
#          array(
#            'value'       => 'style_1',
#            'label'       => 'Dark',
#            'src'         => ''
#          ), 
#          array(
#            'value'       => 'style_2',
#            'label'       => 'Light',
#            'src'         => ''
#          )         
#         ),
#      ),
      
      array(
        'id'          => 'mt_colors_homepage',
        'label'       => 'Home Page Colors',
        'desc'        => 'Select Colors for Home Page.',
        'std'         => '#f55f0d',
        'type'        => 'colorpicker',
        'section'     => 'style_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'mt_layout_styler',
        'label'       => 'Home Page Layout Style',
        'desc'        => 'Select Layout Style for Home Page.',
        'std'         => 'full',
        'type'        => 'select',
        'section'     => 'style_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'free',
            'label'       => 'Boxed and Spaced Layout',
            'src'         => ''
          ), 
          array(
            'value'       => 'box',
            'label'       => 'Boxed Layout',
            'src'         => ''
          ), 
          array(
            'value'       => 'full',
            'label'       => 'Full Width Layout',
            'src'         => ''
          ),  
          array(
            'value'       => 'full_free',
            'label'       => 'Full Width and Spaced Layout',
            'src'         => ''
          ),           
         ),
      ),
      array(
        'id'          => 'mt_homepage_bg',
        'label'       => 'Home Page Background',
        'desc'        => '',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'style_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'mt_colors_default',
        'label'       => 'Default Page Colors',
        'desc'        => 'Select Colors for all default pages.',
        'std'         => '#f55f0d',
        'type'        => 'colorpicker',
        'section'     => 'style_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      
      array(
        'id'          => 'mt_layout_styler_default',
        'label'       => 'Default Page Layout Style',
        'desc'        => 'Select Layout Style for Home Page.',
        'std'         => 'full',
        'type'        => 'select',
        'section'     => 'style_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'free',
            'label'       => 'Boxed and Spaced Layout',
            'src'         => ''
          ), 
          array(
            'value'       => 'box',
            'label'       => 'Boxed Layout',
            'src'         => ''
          ), 
          array(
            'value'       => 'full',
            'label'       => 'Full Width',
            'src'         => ''
          ),  
          array(
            'value'       => 'full_free',
            'label'       => 'Full Width and Spaced Layout',
            'src'         => ''
          ),         
         ),
      ),
      array(
        'id'          => 'mt_defaultpage_bg',
        'label'       => 'Default Page Background',
        'desc'        => '',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'style_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'googlefont_name',
        'label'       => 'Google Font Name',
        'desc'        => 'Default: Open+Sans:300,400,600,700. 
Get all <a href="http://www.google.com/webfonts">Google fonts</a> here',
        'std'         => 'Open+Sans:300,400,600,700',
        'type'        => 'text',
        'section'     => 'style_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'googlefont_css',
        'label'       => 'Google Font Css',
        'desc'        => "Default: font-family: 'Open Sans', sans-serif;",
        'std'         => "font-family: 'Open Sans', sans-serif;",
        'type'        => 'text',
        'section'     => 'style_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}