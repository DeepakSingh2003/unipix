<?php
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class ReacTheme_Elementor_Pricing_Table_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve rsgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'rt-price-table';
    }     
    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Pricing Table', 'rtelements' );
    }
    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-price';
    }
    public function get_categories() {
        return [ 'pielements_category' ];
    }
    public function get_keywords() {
        return [ 'pricing', 'table', 'package', 'product', 'plan' ];
    }
	protected function register_controls() {

		$this->start_controls_section(
			'_section_header',
			[
				'label' => esc_html__( 'Header', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => esc_html__( 'Basic', 'rtelements' ),
            ]
        );
        $this->add_control(
			'select_icon',
			[
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'rt rt-icon-check',
					'library' => 'rt-icons',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => esc_html__( 'Pricing', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => esc_html__( 'Currency', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => esc_html__( 'None', 'rtelements' ),
                    'baht' => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'rtelements' ),
                    'bdt' => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'rtelements' ),
                    'dollar' => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'rtelements' ),
                    'euro' => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'rtelements' ),
                    'franc' => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'rtelements' ),
                    'guilder' => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'rtelements' ),
                    'krona' => 'kr ' . _x( 'Krona', 'Currency Symbol', 'rtelements' ),
                    'lira' => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'rtelements' ),
                    'peseta' => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'rtelements' ),
                    'peso' => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'rtelements' ),
                    'pound' => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'rtelements' ),
                    'real' => 'R$ ' . _x( 'Real', 'Currency Symbol', 'rtelements' ),
                    'ruble' => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'rtelements' ),
                    'rupee' => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'rtelements' ),
                    'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'rtelements' ),
                    'shekel' => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'rtelements' ),
                    'won' => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'rtelements' ),
                    'yen' => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'rtelements' ),
                    'custom' => esc_html__( 'Custom', 'rtelements' ),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => esc_html__( 'Custom Symbol', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__( 'Price', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => '11.19',
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => esc_html__( 'Period', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Per Month', 'rtelements' ),
            ]
        );

        $this->add_control(
            'price_des',
            [
                'label' => esc_html__( 'Description', 'rtelements' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Grow your Business by Professional Plan', 'rtelements' ),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'sec_button',
            [
                'label' => esc_html__( 'Button', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Select Plan', 'rtelements' ),
                'placeholder' => esc_html__( 'Type button text here', 'rtelements' ),
                'label_block' => false,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Link', 'rtelements' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'https://example.com/', 'rtelements' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_features',
            [
                'label' => esc_html__( 'Features', 'rtelements' ),
            ]
        );

        $this->add_control(
            'features_title',
            [
                'label' => esc_html__( 'Title', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Key Feature', 'rtelements' ),
            ]
        );
        $this->add_control(
            'html_feature_tag',
            [
                'label'   => esc_html__('Select HTML Tag', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => esc_html__('H1', 'rtelements'),
                    'h2' => esc_html__('H2', 'rtelements'),
                    'h3' => esc_html__('H3', 'rtelements'),
                    'h4' => esc_html__('H4', 'rtelements'),
                    'h5' => esc_html__('H5', 'rtelements'),
                    'h6' => esc_html__('H6', 'rtelements'),
                    'p' => esc_html__('P', 'rtelements'),
                    'span' => esc_html__('span', 'rtelements'),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Exciting Feature', 'rtelements' ),
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rt rt-check',
                    'library' => 'rt-icon',
                ],
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => esc_html__( 'Social media advertising', 'rtelements' ),
                        'icon' => 'rt rt-check',
                    ],
                    [
                        'text' => esc_html__( 'Report analytics', 'rtelements' ),
                        'icon' => 'rt rt-check',
                    ],
                    [
                        'text' => esc_html__( 'Keyword research', 'rtelements' ),
                        'icon' => 'rt rt-check',
                    ],
                    [
                        'text' => esc_html__( 'Content strategy', 'rtelements' ),
                        'icon' => 'rt rt-check',
                    ],
                    [
                        'text' => esc_html__( 'Premium consulting', 'rtelements' ),
                        'icon' => 'rt rt-check',
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );
        $this->end_controls_section();
    
        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__( 'Item', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_tabs_general' );

        $this->start_controls_tab(
            'general_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rtelements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__( 'Background', 'rtelements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rt-price-table',
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'general_border',
				'selector' => '{{WRAPPER}} .rt-price-table',
			]
		);
        $this->end_controls_tab();

        $this->start_controls_tab(
            'general_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rtelements' ),
            ]
        ); 

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover_color',
                'label' => esc_html__( 'Background', 'rtelements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rt-price-table:hover',
            ]
        );
        $this->add_control(
            'item_hover_bordercolor',
            [
                'label' => esc_html__( 'Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-price-table:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();   

        $this->start_controls_section(
            '_section_style_header',
            [
                'label' => esc_html__( 'Header', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );        

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .plan__header .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'head_title_typo',
                'label' => esc_html__( 'Typography', 'rtelements' ),
                'selector' => '{{WRAPPER}} .plan__header .title',
            ]
        );

        $this->add_control(
            'title_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .plan__header .title' => 'border-color: {{VALUE}};',
                ],
            ]
        );    

        $this->add_control(
            'header_icon_style',
            [
                'label' => esc_html__( 'Icon Style', 'rtelements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );   
        
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-pricing-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rt-pricing-icon svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Background', 'rtelements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rt-pricing-icon',
            ]
        );
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Size', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 55,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-pricing-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rt-pricing-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );  

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_pricing',
            [
                'label' => esc_html__( 'Pricing', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .price',
            ]
        );

        $this->add_control(
            '_heading_period',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Period', 'rtelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label' => esc_html__( 'Period Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .pre',
            ]
        );   
        $this->end_controls_section();

        

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__( 'Button', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'rtelements' ),
            ]
        );

         $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .purchase__plan' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .purchase__plan',
			]
		);

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .purchase__plan' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .purchase__plan',
            ]
        );                
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'rtelements' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-price-table:hover .purchase__plan' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_bgcolor',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .rt-price-table:hover .purchase__plan',
			]
		);

        $this->add_control(
            'button_hover_bordercolor',
            [
                'label' => esc_html__( 'Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-price-table:hover .purchase__plan' => 'border-color: {{VALUE}};',
                ],
            ]
        );        
        $this->end_controls_section(); 

        $this->start_controls_section(
            '_section_style_features',
            [
                'label' => esc_html__( 'Features', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'features_title_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_title_typography',
                'selector' => '{{WRAPPER}} .features_title',
            ]
        );
        
        $this->add_control(
            '_heading_features_list',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'List', 'rtelements' ),
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'features_list_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-pricing-features-list li' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_typography',
                'selector' => '{{WRAPPER}} .rt-pricing-features-list li',
            ]
        );

        $this->add_control(
            'features_list_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-pricing-features-list li i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rt-pricing-features-list li svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
      
        $this->add_responsive_control(
            'features_list_spacing',
            [
                'label' => esc_html__( 'Spacing', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rt-pricing-features-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        
        $this->end_controls_section();           
    }

    private static function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
    }

	protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'badge_text', 'class',
            [
                'rt-pricing-table-badge',                
            ]
        );

        if ( $settings['currency'] === 'custom' ) {
            $currency = $settings['currency_custom'];
        } else {
            $currency = self::get_currency_symbol( $settings['currency'] );
        }
        ?>
        <div class="rt-price-table">
            <div class="plan__header">
                <?php 
                if ( !empty( $settings['title'] ) ) : ?>
                    <div class="title">
                        <?php echo wp_kses_post( $settings['title'] ); ?>
                    </div>
                    <?php 
                endif; 
                if( !empty( $settings['price'] ) ) : ?>
                    <div class="plan__price">
                        <div class="price"><?php echo wp_kses_post( $currency ); ?><?php echo wp_kses_post( $settings['price'] ); 
                        if( !empty( $settings['period'] ) ) : ?> <span class="pre">/ <?php echo esc_html($settings['period']); ?></span><?php endif; ?></div>
                        <?php 
                        if( !empty( $settings['price_des'] ) ) : ?>
                            <span><?php echo wp_kses_post( $settings['price_des'] ); ?></span>
                            <?php 
                        endif; ?>
                    </div>
                    <?php 
                endif; 
                if( !empty( $settings['select_icon']['value'] ) ) : ?>
                    <div class="rt-pricing-icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['select_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                    <?php 
                endif; ?>
            </div>
            <?php 
            if( !empty( $settings['button_text'] ) ) : ?>
                <a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>"  class="purchase__plan"><?php echo wp_kses_post( $settings['button_text'] ); ?></a>
                <?php 
            endif; ?>
            <div class="plan__content">
                <?php 
                if ( $settings['features_title'] ) : ?>
                  <<?php echo esc_attr($settings['html_feature_tag']); ?> class="features_title"><?php echo wp_kses_post( $settings['features_title'] ); ?></<?php echo esc_attr($settings['html_feature_tag']); ?>>
                    <?php 
                endif; 
                if ( is_array( $settings['features_list'] ) ) : ?>
                    <ul class="rt-pricing-features-list">
                      <?php 
                      foreach ( $settings['features_list'] as $index => $feature ) : 
                        $name_key = $this->get_repeater_setting_key( 'text', 'features_list', $index );  
                        if ( $feature['icon'] || $feature['text'] ) : ?> 
                          <li class="<?php echo esc_attr( 'features-list' ); ?>">
                              <?php \Elementor\Icons_Manager::render_icon( $feature['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                              <span class="rt-pricing-table-feature-text"><?php echo wp_kses_post( $feature['text'] ); ?></span>
                          </li>
                            <?php 
                        endif; 
                    endforeach; ?>
                    </ul>
                    <?php 
                endif; ?>
            </div>
        </div>
        <?php
    }
}
