<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function unipix_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'unipix_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function unipix_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}

add_action( 'wp_head', 'unipix_pingback_header' );
/**  kses_allowed_html */
function unipix_prefix_kses_allowed_html($tags, $context) {
  switch($context) {
    case 'unipix': 
      $tags = array( 
        'a' => array('href' => array()),
        'b' => array()
      );
      return $tags;
    default: 
      return $tags;
  }
}
add_filter( 'wp_kses_allowed_html', 'unipix_prefix_kses_allowed_html', 10, 2);

/*
Register Fonts theme google font
*/
function unipix_studio_fonts_url() {
    $font_url = '';    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'unipix' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Inter:400;500;600;700;800' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}


function unipix_studio_scripts() {
    wp_enqueue_style( 'studio-fonts', unipix_studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'unipix_studio_scripts' );

//site Icon
function unipix_site_icon() {
 if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {     
    global $unipix_option;
     
    if(!empty($unipix_option['rs_siteicon']['url']))
    {?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(($unipix_option['rs_siteicon']['url'])); ?>"> 
  <?php 
    }
  }
}
add_filter('wp_head', 'unipix_site_icon');

//excerpt for specific section
function unipix_wpex_get_excerpt( $args = array() ) {
  // Defaults
  $defaults = array(
    'post'            => '',
    'length'          => 48,
    'readmore'        => false,
    'readmore_text'   => esc_html__( 'read more', 'unipix' ),
    'readmore_after'  => '',
    'custom_excerpts' => true,
    'disable_more'    => false,
  );
  // Apply filters
  $defaults = apply_filters( 'unipix_wpex_get_excerpt_defaults', $defaults );
  // Parse args
  $args = wp_parse_args( $args, $defaults );
  // Apply filters to args
  $args = apply_filters( 'unipix_wpex_get_excerpt_args', $defaults );
  // Extract
  extract( $args );
  // Get global post data
  if ( ! $post ) {
    global $post;
  }

  $post_id = $post->ID;
  if ( $custom_excerpts && has_excerpt( $post_id ) ) {
    $output = $post->post_excerpt;
  } 
  else { 
    $readmore_link = '<a href="' . get_permalink( $post_id ) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';    
    if ( ! $disable_more && strpos( $post->post_content, '<!--more-->' ) ) {
      $output = apply_filters( 'the_content', get_the_content( $readmore_text . $readmore_after ) );
    }    
    else {     
      $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );      
      if ( $readmore ) {
        $output .= apply_filters( 'unipix_wpex_readmore_link', $readmore_link );
      }
    }
  }
  // Apply filters and echo
  return apply_filters( 'unipix_wpex_get_excerpt', $output );
}

//Demo content file include here
// Demo content file include here
function unipix_import_files() {

  $theme_dir = trailingslashit( get_template_directory() );
  $demo_dir  = $theme_dir . 'inc/demo-data/';

  return array(

      // ========= DEFAULT DEMOS (use same demo.xml + unipix-options.json) =========

      array(
          'import_file_name'         => 'Home One',
          'local_import_file'        => $demo_dir . 'demo.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/01.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/',
      ),

      array(
          'import_file_name'         => 'Home Two',
          'local_import_file'        => $demo_dir . 'demo.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/02.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/home-2',
      ),

      array(
          'import_file_name'         => 'Home Three',
          'local_import_file'        => $demo_dir . 'demo.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/03.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/home-three',
      ),

      array(
          'import_file_name'         => 'Home Four',
          'local_import_file'        => $demo_dir . 'demo.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/05.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/home-four',
      ),

      array(
          'import_file_name'         => 'Home Five',
          'local_import_file'        => $demo_dir . 'demo.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/04.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/home-five',
      ),

      array(
          'import_file_name'         => 'Home Six',
          'local_import_file'        => $demo_dir . 'demo.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/09.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/home-six',
      ),

      array(
          'import_file_name'         => 'Home Seven',
          'local_import_file'        => $demo_dir . 'demo.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/11.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/video-home',
      ),

      array(
          'import_file_name'         => 'Home Eight',
          'local_import_file'        => $demo_dir . 'demo.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/12.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/home-8/',
      ),

      // ========= RTL DEMOS (local XML, shared options) =========

      array(
          'import_file_name'         => 'Home RTL One',
          'categories'               => array( 'Demo RTL' ),
          'local_import_file'        => $demo_dir . 'rtl/unipix-content-1.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json', // or rtl/unipix-options.json if separate
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/06.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix-rtl/',
      ),

      array(
          'import_file_name'         => 'Home RTL Two',
          'categories'               => array( 'Demo RTL' ),
          'local_import_file'        => $demo_dir . 'rtl/unipix-content-2.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json', // or rtl/unipix-options.json
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/07.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix-rtl/home-2',
      ),

      // ========= LMS DEMO (local XML, root options) =========

      array(
          'import_file_name'         => 'LMS Demo',
          'categories'               => array( 'Demo LMS' ),
          'local_import_file'        => $demo_dir . 'lms/lms.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/08.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/lms',
      ),

      // ========= COLLEGE DEMO (has own JSON) =========

      array(
          'import_file_name'         => 'College Demo',
          'categories'               => array( 'Demo College' ),
          'local_import_file'        => $demo_dir . 'college/demo.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'college/unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/10.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/college/',
      ),

      // ========= KIDS DEMO (has own JSON) =========

      array(
          'import_file_name'         => 'Kids Demo',
          'categories'               => array( 'Demo Kids' ),
          'local_import_file'        => $demo_dir . 'kids/demo.xml',
          'local_import_redux'       => array(
              array(
                  'file_path'   => $demo_dir . 'kids/unipix-options.json',
                  'option_name' => 'unipix_option',
              ),
          ),
          'import_preview_image_url' => 'https://themewant.com/products/wordpress/landing/unipix/assets/images/demos/13.webp',
          'import_notice'            => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'unipix' ),
          'preview_url'              => 'https://themewant.com/products/wordpress/unipix/kids/',
      ),

  );
}
add_filter( 'pt-ocdi/import_files', 'unipix_import_files' );


function unipix_after_import_setup($selected_import) {
  // Assign menus to their locations.
	$main_menu     = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', array(
      'menu-1' => $main_menu->term_id, 
     
    )
  );

  if ( 'Home One' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home');
  }
  if ( 'Home Two' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home 2');
  }
  if ( 'Home Three' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home 3');
  }
  if ( 'Home Four' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home 4');
  }
  if ( 'Home Five' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home 5');
  } 
  if ( 'Home Six' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home 6');
  }  
  if ( 'Home Seven' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Video Home');
  } 
  if ( 'Home Eight' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home 8');
  }
  if ( 'Home RTL One' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home');
  } 
  if ( 'Home RTL Two' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home 2');
  } 
  if ( 'LMS Demo' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Lms');
  } 
  if ( 'College Demo' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home');
  }
  if ( 'Kids Demo' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home');
  }
    
  $blog_page_id  = get_page_by_title( 'Blog' );
  if ( isset( $front_page_id->ID ) ) {
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
  }
  if ( isset( $blog_page_id->ID ) ) {
    update_option( 'page_for_posts', $blog_page_id->ID );
  }
  
  //Import Revolution Slider
  if ( class_exists( 'RevSlider' ) ) {
    $slider_array = array(
      get_template_directory()."/inc/demo-data/sliders/slider-1.zip",                            
      get_template_directory()."/inc/demo-data/sliders/slider-2.zip", 
      get_template_directory()."/inc/demo-data/sliders/slider-3.zip",  
      get_template_directory()."/inc/demo-data/sliders/slider-4.zip",         
      get_template_directory()."/inc/demo-data/sliders/slider-5.zip",                
      get_template_directory()."/inc/demo-data/sliders/slider-3-1.zip",  
      get_template_directory()."/inc/demo-data/college/slider/school.zip",                            
    );
    $slider = new RevSlider();
    foreach($slider_array as $filepath){
      $slider->importSliderFromPost(true,true,$filepath);  
    }
  }
    
}
add_action( 'pt-ocdi/after_import', 'unipix_after_import_setup' );

//disable gutenbearg editor for widget
add_filter( 'use_widgets_block_editor', '__return_false' );

//disable elementor default style 
update_option('elementor_disable_color_schemes', 'yes');
update_option('elementor_disable_typography_schemes', 'yes');

//added elementor support for custom post type
function unipix_enable_elementor_for_custom_post_type() {
  add_post_type_support( 'teams', 'elementor' );
  add_post_type_support( 'rts-canvans', 'elementor' );
  add_post_type_support( 'rtelements_pro', 'elementor' );
  add_post_type_support( 'rt-department', 'elementor' );
  add_post_type_support( 'rt-program', 'elementor' );
  add_post_type_support( 'rt-faculty', 'elementor' );
  add_post_type_support( 'rt-notice', 'elementor' );
  add_post_type_support( 'rt-research', 'elementor' );
  add_post_type_support( 'tribe_events', 'elementor' );
}
add_action( 'init', 'unipix_enable_elementor_for_custom_post_type' );


function reactheme_plugin_update_check($transient) {
  // Ensure the transient data exists and is valid
  if (empty($transient->checked)) {
      return $transient;
  }

  $plugin_slug = 'rt-elements';
  $plugin_file = $plugin_slug . '/' . $plugin_slug . '.php';
  $update_url = 'https://themewant.com/products/plugins/unipix/version-check.json';

  // Make sure plugin is installed and we have a version to check against
  if (!isset($transient->checked[$plugin_file])) {
      return $transient;
  }

  $current_version = $transient->checked[$plugin_file];

  // Get remote update data
  $response = wp_remote_get($update_url, ['timeout' => 10]);

  if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
      return $transient;
  }

  $remote_data = json_decode(wp_remote_retrieve_body($response));

  // Ensure remote data is structured properly
  if (!isset($remote_data->new_version) || !isset($remote_data->download_url)) {
      return $transient;
  }

  // Compare versions and update transient
  if (version_compare($current_version, $remote_data->new_version, '<')) {
      $transient->response[$plugin_file] = (object) [
          'slug'        => $plugin_slug,
          'plugin'      => $plugin_file,
          'new_version' => $remote_data->new_version,
          'url'         => isset($remote_data->changelog) ? $remote_data->changelog : '',
          'package'     => $remote_data->download_url,
      ];
  }

  return $transient;
}
add_filter('pre_set_site_transient_update_plugins', 'reactheme_plugin_update_check');