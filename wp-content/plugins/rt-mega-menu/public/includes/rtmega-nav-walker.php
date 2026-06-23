<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.
/**
 * RTMEGA Nav Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/

use Elementor\Plugin as Elementor;

class RTMEGA_Nav_Walker extends Walker_Nav_Menu {

  public $RTMEGA_menupos_left = '';
  public $RTMEGA_menupos_right = '';
  public $RTMEGA_menupos_top = '';
  public $RTMEGA_menuwidth = '';
  public $RTMEGA_menu_full_width = '';

  function start_lvl( &$output, $depth = 0, $args = array() ) {

        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1 ); // because it counts the first submenu as 0

        $RTMEGA_menupos_top = !empty($RTMEGA_menupos_top) ? $RTMEGA_menupos_top : '';
        $RTMEGA_menupos_left = !empty($RTMEGA_menupos_left) ? $RTMEGA_menupos_left : '0';
        $RTMEGA_menupos_right = !empty($RTMEGA_menupos_right) ? $RTMEGA_menupos_right : '';

        $style = '';

        $classes = array(
            'sub-menu default',
            ( $display_depth % 2 ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        // Build HTML for output.
        $output .= "\n$indent<ul class='" . $class_names . "' $style >\n";
  }


  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

    //Tempalte
    $styles = '';
    $RTMEGA_menu_full_width = '';
    $rtmega_menu_item_settings = get_post_meta( $item->ID, 'rtmega_menu_settings', true );
    
    if (isset($rtmega_menu_item_settings['css']) && $item->ID) {

        $css = $rtmega_menu_item_settings['css'];
    
        // Assign class properties based on menu item settings
        $this->RTMEGA_menupos_left = $css['left'] ?? '';
        $this->RTMEGA_menupos_right = $css['right'] ?? '';
        $this->RTMEGA_menupos_top = $css['top'] ?? '';
        $this->RTMEGA_menuwidth = $css['width'] ?? '';
    
        // Format styles and class attributes
        $styles = '';
        $styles .= !empty($css['left']) ? 'left:' . $css['left'] . ';' : '';
        $styles .= !empty($css['right']) ? 'right:' . $css['right'] . ';' : '';
        $styles .= !empty($css['top']) ? 'top:' . $css['top'] . ';' : '';
        $styles .= !empty($css['width']) ? 'width:' . $css['width'] . ';' : '';
    
    }
    
    
    


    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

    // Depth-dependent classes.
    $depth_classes = array(
      ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
      ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
      ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
      'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

    // Passed classes.
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    // If Enable MegaMenu
    if( isset( $rtmega_menu_item_settings['content']['rtmega_template'] ) && !empty( $rtmega_menu_item_settings['content']['rtmega_template'] ) ){
        $classes[] = 'menu-item-has-children rtmega_menu'.' has-'.$RTMEGA_menu_full_width;
    }

    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WordPress core filter; must be called by its core name.
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

    // Build HTML.
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

    // Link attributes.
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';


    $dropdown_icon = '';

    if( 
        !empty( $item->classes ) && 
        is_array( $item->classes ) && 
        in_array( 'menu-item-has-children', $item->classes ) ){
        if($depth > 0 ){
            $dropdown_icon = '<span class="submenu-parent-icon">'. $args->submenu_parent_icon .'</span>';
        }else{
            $dropdown_icon = '<span class="submenu-parent-icon">'. $args->submenu_parent_icon .'</span>';
        }

    }

    $vertical_icon = '';

    if(isset($args->menu_layout) && $args->menu_layout == 'vertical'){
        if( !empty( $item->classes ) && 
            is_array( $item->classes ) && 
            in_array( 'current-menu-item', $item->classes ) ){
            $vertical_icon = "<span class='vertical_menu_active_icon'>{$args->vertical_menu_active_icon}</span>";
        }
    }

    $icons = substr( $item->ficon,0,3);
    $icons = str_replace($icons, $icons." ", $item->ficon);

    // Custom Data
    // Menu item settings are already loaded into $rtmega_menu_item_settings above,
    // so we reuse that instead of querying the same post meta a second time.
    $icon = $builder_content = '';

    if( isset( $item->ficon ) && !empty( $item->ficon ) ){
        $icon_style = '';
        if( !empty( $item->ficoncolor ) ){
            $icon_style .= 'color:#'.$item->ficoncolor.';';
        }
        $icon = '<span class="icon-before"><i class="'.$icons.'" style="'.$icon_style.'"></i></span>';
    }


    
    
    if( isset( $rtmega_menu_item_settings['content']['rtmega_template'] ) && !empty( $rtmega_menu_item_settings['content']['rtmega_template'] ) ){
        $template_source = isset($rtmega_menu_item_settings['content']['template_source']) ? $rtmega_menu_item_settings['content']['template_source'] : 'elementor';
        if($template_source == 'elementor'){
            $builder_content = $this->getItembuilder_content( $rtmega_menu_item_settings['content']['rtmega_template'], $template_source );
        }else{
            $builder_content = $this->getItembuilder_content( $rtmega_menu_item_settings['content']['rtmega_template'], $template_source );
        }
        $dropdown_icon = isset($args->submenu_parent_icon) && !empty($args->submenu_parent_icon) ? '<span class="submenu-parent-icon">' . $args->submenu_parent_icon . '</span>' : '';
    }

    $menu_description = '';
    if(!empty($item->description)){
        $menu_description = '<span class="menu-desc">' . $item->description . '</span>';
    }

    // Build HTML output and pass through the proper filter.

    $pointer_hover_effect = isset($args->pointer_hover_effect) && !empty($args->pointer_hover_effect) ? '<span class="pointer-'.$args->pointer_hover_effect.'"></span>' : '';
    $vertical_menu_custom_icon = isset( $args->menu_arrow_vertical_custom ) && !empty($args->menu_arrow_vertical_custom) ? $args->menu_arrow_vertical_custom : '';

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
        $args->before,
        $attributes,
        $args->link_before,
        $menu_description,
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WordPress core filter; must be called by its core name.
        apply_filters( 'the_title', '<div class="menu-text">'.$vertical_menu_custom_icon.$icon.'<span>'.$item->title.'</span>'.$pointer_hover_effect.$dropdown_icon.$vertical_icon.'</div>', $item->ID ),
        $args->link_after,
        $args->after
    );


    if( !empty( $builder_content ) ){
        $item_output .= sprintf('<ul class="rtmegamenu-contents sub-menu submenu '.$RTMEGA_menu_full_width.'" style="%1s">%2s</ul>', $styles, $builder_content );
    }


    $extras = array(
        'dropdown_icon' => $dropdown_icon, 
        'vertical_icon' => $vertical_icon, 
        'menu_description'=> $menu_description,
        'builder_content'=> $builder_content,
        'styles_builder_content' => $styles,
        'classes_builder_content' => $RTMEGA_menu_full_width,
    );

   
    $item_output = apply_filters( 'rtmega_walker_output', $item_output, $item, $args, $attributes, $extras );
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WordPress core filter; must be called by its core name.
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

  }



  public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ){
       $args[0]->has_children =  !empty ( $children_elements[ $element->$id_field ] ) ;
    }
    parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }

  // Item Builder Content
  private function getItembuilder_content( $template_id, $template_source ){
    static $elementor = null;
    if($template_source == 'elementor'){
        $elementor = Elementor::instance();
        if( did_action( 'elementor/loaded' ) ){
            // Snapshot the current styles queue so we can diff after firing
            // Elementor's atomic-widget styles pipeline.
            $styles_before = wp_styles()->queue;

            // Register the template with Elementor's Atomic_Styles_Manager.
            // Atomic widgets (V4) deliver CSS via a separate pipeline that
            // get_builder_content_for_display() does not trigger on its own.
            // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Elementor core hook; must be called by its declared name.
            do_action( 'elementor/post/render', $template_id );

            // Render content with classic Post_CSS inlined.
            $content = $elementor->frontend->get_builder_content_for_display( $template_id, true );

            // Force Atomic_Styles_Manager to render and enqueue the atomic
            // CSS files for this template now (rather than waiting for a
            // hook that already fired on wp_enqueue_scripts with only the
            // host post id, or never fires on non-Elementor host pages).
            // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Elementor core hook; must be called by its declared name.
            do_action( 'elementor/frontend/after_enqueue_post_styles' );

            // Walker runs mid-body, so wp_head is gone and we can't rely on
            // WordPress to print late-enqueued styles. Print <link> tags
            // inline for any newly-enqueued handles — browsers accept
            // <link rel="stylesheet"> in the body.
            $new_handles = array_values( array_diff( wp_styles()->queue, $styles_before ) );
            $styles_html = '';
            if ( ! empty( $new_handles ) ) {
                ob_start();
                wp_print_styles( $new_handles );
                $styles_html = ob_get_clean();
            }

            return $styles_html . $content;
        }
    }else{
        $content_post = get_post( $template_id );
        if ( $content_post ) {
            // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WordPress core filter; must be called by its core name.
            return apply_filters( 'the_content', $content_post->post_content );
        }
        return '';
    }
    
  }
}