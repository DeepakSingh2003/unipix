<?php
    /* All Functions for woocommerce
    -----------------------------------------*/
    /*-------------------------------------
    #. Theme supports for WooCommerce
    ---------------------------------------*/
    
    function unipix_add_woocommerce_support() {
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
    }
    add_action('after_setup_theme', 'unipix_add_woocommerce_support');


    /* Shop hide default page title */
    function unipix_wc_hide_page_title() {
        return false;
    }
    add_filter('woocommerce_show_page_title', 'unipix_wc_hide_page_title');

    
     /* Loop shop per page */
     if (!function_exists('unipix_wc_loop_shop_per_page')) {
        function unipix_wc_loop_shop_per_page() {
            global $unipix_option;
            $layout = !empty($unipix_option['wc_num_product']) ? $unipix_option['wc_num_product'] : 9;
            return absint($layout);;
        }
    }
    add_action('loop_shop_per_page', 'unipix_wc_loop_shop_per_page');

    // Change number or products per row
    if (!function_exists('unipix_loop_columns')) {
        function unipix_loop_columns() {
            global $unipix_option;
            $layout_col = !empty($unipix_option['wc_num_product_per_row']) ? $unipix_option['wc_num_product_per_row'] : 3;
            return absint($layout_col);;
        }
    }
    add_filter('loop_shop_columns', 'unipix_loop_columns');
    

    // Show and Hide Related Products 
    function unipix_related_products_show( $args ) {
        global $unipix_option;
        $related_product_show = $unipix_option['shop_releted_product'];
        if ( $related_product_show === 'hide' ) {
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
        }
    }
    add_action( 'wp', 'unipix_related_products_show' );

    /**
    * Change number of related products output
    */
    function unipix_related_products_args( $args ) {
        global $unipix_option;
        $args['posts_per_page'] = !empty($unipix_option['single_releted_products']) ? $unipix_option['single_releted_products'] : 3; // 3 related products
        $args['columns'] = !empty($unipix_option['single_releted_products']) ? $unipix_option['single_releted_products'] : 3; // arranged in 2 columns
        return $args;
    }
    add_filter( 'woocommerce_output_related_products_args', 'unipix_related_products_args', 20 );

    function after_shop_loop_item_title() {
        return false;
    }
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

    /* Breadcrumb Remove Action*/
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    
    /* woocommerce sidebar remove */
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

    /* Product ID Name*/
    function unipix_get_all_products_id_name() {
        $args = array(
            'posts_per_page' => -1,
            'post_type'      => array('product', 'product_variation'),
        );
        $products   = [];
        $Q_products = new WP_Query($args);
        $QP_product = $Q_products->posts;
        if (is_array($QP_product)) {
            foreach ($QP_product as $prod) {
                $products[$prod->ID] = get_the_title($prod->ID);
            }
        }
        return $products;
    }


    // Woocommerce checkout page

    add_filter('woocommerce_checkout_fields', 'unipix_override_checkout_fields');
    function unipix_override_checkout_fields($fields) {
        $fields['shipping']['shipping_first_name']['placeholder'] = esc_html__('First Name', 'unipix');
        $fields['shipping']['shipping_last_name']['placeholder']  = esc_html__('Last Name', 'unipix');
        $fields['billing']['billing_first_name']['placeholder']   = esc_html__('First Name', 'unipix');
        $fields['billing']['billing_last_name']['placeholder']    = esc_html__('Last Name', 'unipix');
        $fields['billing']['billing_company']['placeholder']      = esc_html__('Business Name', 'unipix');
        $fields['billing']['billing_company']['label']            = esc_html__('Business Name', 'unipix');
        $fields['shipping']['shipping_company']['placeholder']    = esc_html__('Company Name', 'unipix');
        $fields['billing']['billing_email']['placeholder']        = esc_html__('Email Address', 'unipix');
        $fields['billing']['billing_phone']['placeholder']        = esc_html__('Phone', 'unipix');
        $fields['billing']['billing_state']['placeholder']        = esc_html__('State', 'unipix');
        $fields['billing']['billing_city']['placeholder']         = esc_html__('City', 'unipix');
        $fields['billing']['billing_postcode']['placeholder']     = esc_html__('Post Code', 'unipix');
        return $fields;
    }

    add_filter('woocommerce_sale_flash', 'unipix_add_percentage_to_sale_badge', 20, 3);

    function unipix_add_percentage_to_sale_badge($html, $post, $product) {
        if ($product->is_type('variable')) {
            $percentages = array();
            // Get all variation prices
            $prices = $product->get_variation_prices();
            // Loop through variation prices
            foreach ($prices['price'] as $key => $price) {
                // Only on sale variations
                if ($prices['regular_price'][$key] !== $price) {
                    // Calculate and set in the array the percentage for each variation on sale
                    $percentages[] = round(100 - (floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100));
                }
            }
            // We keep the highest value
            $percentage = max($percentages) . '%';
        } elseif ($product->is_type('grouped')) {
            $percentages = array();
            // Get all variation prices
            $children_ids = $product->get_children();
            // Loop through variation prices
            foreach ($children_ids as $child_id) {
                $child_product = wc_get_product($child_id);
                $regular_price = (float) $child_product->get_regular_price();
                $sale_price    = (float) $child_product->get_sale_price();
                if ($sale_price != 0 || !empty($sale_price)) {
                    // Calculate and set in the array the percentage for each child on sale
                    $percentages[] = round(100 - ($sale_price / $regular_price * 100));
                }
            }
            // We keep the highest value
            $percentage = max($percentages) . '%';
        } else {
            $regular_price = (float) $product->get_regular_price();
            $sale_price    = (float) $product->get_sale_price();
            if ($sale_price != 0 || !empty($sale_price)) {
                $percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
            } else {
                return $html;
            }
        }

        return '<span class="onsale sale-rs">' . esc_html__('-', 'unipix') . $percentage . '</span>';
    }