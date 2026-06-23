<?php
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Reactheme_Portfolio_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rt-portfolio-grid';
	}		

	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'RT Event Grid', 'rtelements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve rsgallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-grid';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
        return [ 'pielements_category' ];
    }

	
	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {


		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'portfolio_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',				
				'options' => [
					'1' => 'Style 1',
					'2' => 'Style 2',
					'3' => 'Style 3',
					'4' => 'Style 4',
					'5' => 'Style 5'
				],											
			]
		);		
		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Per Page', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'default' => -1,
			]
		);
		$this->add_control(
			'portfolio_date',
			[
				'label'   => esc_html__( 'Event Type', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,		
				'default' => 'recent',		
				'options' => [
					'recent' => esc_html__( 'Recent Event', 'rtelements' ),	
					'upcoming' => esc_html__( 'Upcoming Event', 'rtelements' ),		
				],					
			]
		);
		$this->add_control(
			'portfolio_order',
			[
				'label'   => esc_html__( 'Event Order', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,		
				'default' => 'asc',		
				'options' => [
					'asc' => esc_html__( 'Ascending', 'rtelements' ),	
					'dsc' => esc_html__( 'Descending', 'rtelements' ),		
				],							
			]
		);
		$this->add_control(
			'title_word_count',
			[
					'label' => esc_html__('Title Word Limit', 'rtelements'),
					'type' => Controls_Manager::NUMBER,
				'lable_block' => true,
			]
		);
		$this->add_control(
			'button_text',
			[
					'label' => esc_html__('Button Text', 'rtelements'),
					'type' => Controls_Manager::TEXT,
				'lable_block' => true,
				'default' => esc_html__('Join Now', 'rtelements'),
				'condition' => [
					'portfolio_grid_style' => ['4', '5']
				]
			]
		);		  
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
					'name' => 'thumbnail',
					'default' => 'large',
					'exclude' => [
						'custom'
					]
			]
		);	
		$this->add_control(
			'portfolio_columns',
			[
				'label'   => esc_html__( 'Desktops > 1199px', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,				
				'options' => [
					'6' => esc_html__( '2 Column', 'rtelements' ),
					'4' => esc_html__( '3 Column', 'rtelements' ),
					'3' => esc_html__( '4 Column', 'rtelements' ),
					'2' => esc_html__( '6 Column', 'rtelements' ),
					'12' => esc_html__( '1 Column', 'rtelements' ),					
				],	
				'default' => '4'						
			]
		);
		$this->add_control(
			'col_md',
			[
				'label'   => esc_html__('Laptop > 991px', 'rtelements'),
				'type'    => Controls_Manager::SELECT,			
				'options' => [
					'6' => esc_html__( '2 Column', 'rtelements' ),
					'4' => esc_html__( '3 Column', 'rtelements' ),
					'3' => esc_html__( '4 Column', 'rtelements' ),
					'2' => esc_html__( '6 Column', 'rtelements' ),
					'12' => esc_html__( '1 Column', 'rtelements' ),	
				],
				'default' => 6,
			]
		);
		$this->add_control(
			'col_sm',
			[
				'label'   => esc_html__('Tablets > 767px', 'rtelements'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'6' => esc_html__( '2 Column', 'rtelements' ),
					'4' => esc_html__( '3 Column', 'rtelements' ),
					'3' => esc_html__( '4 Column', 'rtelements' ),
					'2' => esc_html__( '6 Column', 'rtelements' ),
					'12' => esc_html__( '1 Column', 'rtelements' ),	
				],
				'default' => 12,
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-eye',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
            'condition' => 
					['portfolio_grid_style' => ['1']
				],
			]
		); 
        $this->add_responsive_control(
			'image_spacing_custom',
			[
				'label' => esc_html__( 'Item Bottom Gap', 'rtelements' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],			
				'selectors' => [
					'{{WRAPPER}} .portfolio-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .portfolio-inner-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .grid-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);    
		$this->add_responsive_control(
			'item_middle_spacing',
			[
				'label' => esc_html__( 'Item Middle Gap', 'rtelements' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],		
				'selectors' => [
					'{{WRAPPER}} .grid-portfolio.row' => '--bs-gutter-x: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);    						
		$this->end_controls_section();

		$this->start_controls_section(
			'item_box_style',
			[
				'label' => esc_html__( 'Box', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'item_bgcolor',
            [
                'label' => esc_html__( 'Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .event_item' => 'background: {{VALUE}};',                              
                ],                
            ]
        );
			$this->add_control(
            'item_hover_bgcolor',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                                            
                    '{{WRAPPER}} .event_item:hover' => 'background: {{VALUE}};',    
                    '{{WRAPPER}} .event_item:hover::after' => 'background: {{VALUE}};',                                       
                ],  
					'condition' => 
						['portfolio_grid_style' => ['1','2','3']
					],            
            ]
        );
		  $this->add_control(
            'item_even_bgcolor',
            [
                'label' => esc_html__( 'Background (Even Number)', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .rt-portfolio-style4 .grid-item:nth-child(even) .event_item' => 'background: {{VALUE}};',                              
                ], 
					 'condition' => 
						['portfolio_grid_style' => '4'
					],               
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .event_item',
			]
		);
		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => __('Border Radius', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .event_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .event_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .event_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
        $this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Title', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .event-title' => 'color: {{VALUE}} !important;',     
                    '{{WRAPPER}} .event-title a' => 'color: {{VALUE}} !important;',                            
                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                                    
                    '{{WRAPPER}} .event-title:hover a' => 'color: {{VALUE}} !important;',   
                    '{{WRAPPER}} .single-event:hover .single-event-content .event-title' => 'color: {{VALUE}} !important;',                                     
                ],                
            ]            
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .event-title',                    
			]
		);		
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .event-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .event-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
      $this->end_controls_section();

		$this->start_controls_section(
			'label_name_style',
			[
				'label' => esc_html__( 'Name & Label', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => 
					['portfolio_grid_style' => '5'
				], 
			]
		);
      $this->add_control(
			'name_label_bg',
			[
				'label' => esc_html__( 'Background', 'rtelements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [                           
					'{{WRAPPER}} .info' => 'background: {{VALUE}};',                              
				],                
			]
      );
      $this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'Label Color', 'rtelements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [                           
					'{{WRAPPER}} .info p span' => 'color: {{VALUE}};',                              
				],                
			]
      );
      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),				
				'selector' => '{{WRAPPER}} .info p span',                    
			]
		);			

		$this->add_control(
			'name_heading',
			[
				'label' => esc_html__( 'Name Style', 'rtelements' ),
				'type' => Controls_Manager::HEADING,          
				'separator' => 'before'    
			]
      );
      $this->add_control(
			'name_color',
			[
				'label' => esc_html__( 'Color', 'rtelements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [                           
					'{{WRAPPER}} .info p' => 'color: {{VALUE}};',                              
				],                
			]
      );
      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),				
				'selector' => '{{WRAPPER}} .info p',                    
			]
		);
      $this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__( 'Image', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,				
				'condition' => 
					['portfolio_grid_style' => ['1','3']
				], 
			]
		);
		$this->add_responsive_control(
			'item_image_border_radius',
			[
				'label'      => __('Border Radius', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .rts__single--event--thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_image_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .rts__single--event--thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_image_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .rts__single--event--thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'event_meta_style',
			[
				'label' => esc_html__( 'Event Calender', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,				 				
				'condition' => [
					'portfolio_grid_style!' => '5'
				]
			]
		);
		$this->add_control(
            'date__style',
            [
                'label' => esc_html__( 'Date', 'rtelements' ),
                'type' => Controls_Manager::HEADING,         
            ]
        );
		$this->add_control(
            'date_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date span' => 'color: {{VALUE}};',                  
                    '{{WRAPPER}} .date svg path' => 'fill: {{VALUE}} !important;',                   
                ],                
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .date span',                    
			]
		);		
		$this->add_responsive_control(
			'date_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'date_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
            'location__style',
            [
                'label' => esc_html__( 'Location', 'rtelements' ),
                'type' => Controls_Manager::HEADING,         
            ]
        );
		$this->add_control(
            'location_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .location span' => 'color: {{VALUE}};',                   
                    '{{WRAPPER}} .location svg path' => 'fill: {{VALUE}} !important;',                   
                ],                
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'location_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .location',                    
			]
		);		
		$this->add_responsive_control(
			'location_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'location_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .location' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_control(
            'time__style',
            [
                'label' => esc_html__( 'Time', 'rtelements' ),
                'type' => Controls_Manager::HEADING,        
				'condition' => [
					'portfolio_grid_style' => ['2','3']
				] 
            ]
        );
		$this->add_control(
			'time_color',
			[
				'label' => esc_html__( 'Color', 'rtelements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .time span' => 'color: {{VALUE}};',                   
					'{{WRAPPER}} .time svg path' => 'fill: {{VALUE}} !important;',                   
				],  				
				'condition' => [
					'portfolio_grid_style' => ['2','3','4']
				]               
         ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'time_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .time',        				
				'condition' => [
					'portfolio_grid_style' => ['2','3','4']
				]              
			]
		);		
		$this->add_responsive_control(
			'time_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],  				
				'condition' => [
					'portfolio_grid_style' => ['2','3','4']
				]
			]
		);
		$this->add_responsive_control(
			'time_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],  				
				'condition' => [
					'portfolio_grid_style' => ['2','3','4']
				]
			]
		);
      $this->end_controls_section();

		$this->start_controls_section(
			'number_styles',
			[
				'label' => esc_html__( 'Number', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE, 				
				'condition' => [
					'portfolio_grid_style' => ['2']
				]
			]
		);
		$this->add_control(
            'number_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .count-number::before' => 'color: {{VALUE}};',                                 
                ],                
            ]
        );
		$this->add_control(
            'number_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-event:hover .count-number::before' => 'color: {{VALUE}};',                                 
                ],                
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .count-number::before',                    
			]
		);	
		$this->add_control(
            'separator_color',
            [
                'label' => esc_html__( 'Separator Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-event-section-content .single-event::before' => 'background: {{VALUE}};',                                 
                ],                
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
				'_section_style_button',
				[
					'label' => esc_html__( 'Button', 'rsaddon' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'portfolio_grid_style' => ['1','4','5'],
					],
				]
			);			
			$this->start_controls_tabs( '_tabs_button' );

			$this->start_controls_tab(
				'style_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'rsaddon' ),
				]
			); 
			$this->add_control(
				'btn_text_color',
				[
					'label' => esc_html__( 'Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button' => 'color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'btn__bg',
				[
					'label' => esc_html__( 'Background', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button' => 'background: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'btn_border_color',
				[
					'label' => esc_html__( 'Border Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button' => 'border-color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'btn_icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button span i' => 'color: {{VALUE}};',
					],
					'condition' => [
						'portfolio_grid_style' => ['4', '5']
					],
				]
			);
			$this->add_control(
				'btn_icon_bg',
				[
					'label' => esc_html__( 'Icon Background', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button span' => 'background: {{VALUE}};',
					],
					'condition' => [
						'portfolio_grid_style' => ['4', '5']
					],
				]
			);
		$this->end_controls_tab();

		$this->start_controls_tab(
				'style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'rsaddon' ),
				]
			); 
			$this->add_control(
				'btn_hover_text_color',
				[
					'label' => esc_html__( 'Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button:hover i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .rt-e-button:hover' => 'color: {{VALUE}} !important;',
					],
				]
			);

			$this->add_control(
				'btn_hover_bg',
				[
					'label' => esc_html__( 'Background', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button:hover' => 'background: {{VALUE}} !important;',
					],
					'condition' => [
						'portfolio_grid_style' => '1'
					],
				]
			);
			$this->add_control(
				'btn_hover_after_bg',
				[
					'label' => esc_html__( 'Background', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button::after' => 'background: {{VALUE}} !important;'
					],
					'condition' => [
						'portfolio_grid_style' => ['4', '5']
					],
				]
			);
			$this->add_control(
				'btn_hover_border_color',
				[
					'label' => esc_html__( 'Border Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button:hover' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'btn_icon_hover_color',
				[
					'label' => esc_html__( 'Icon Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button:hover span i' => 'color: {{VALUE}};',
					],
					'condition' => [
						'portfolio_grid_style' => ['4', '5']
					],
				]
			);
			$this->add_control(
				'btn_icon_hover_bg',
				[
					'label' => esc_html__( 'Icon Background', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .rt-e-button:hover span' => 'background: {{VALUE}};',
					],
					'condition' => [
						'portfolio_grid_style' => ['4', '5']
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();	

		$this->end_controls_section();

		$this->start_controls_section(
				'_section_filter_nav',
				[
					'label' => esc_html__( 'Filter Nav', 'rsaddon' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_filter' => 'filter_show',
					],
				]
			);        		
			$this->start_controls_tabs( 'filter_tab' );
			$this->start_controls_tab(
				'filter_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'rsaddon' ),
				]
			); 
			$this->add_control(
				'filter_normal_color',
				[
					'label' => esc_html__( 'Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .portfolio-filter button' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'filter_normal_bg_normal',
					'label' => esc_html__( 'Background', 'rsaddon' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .portfolio-filter button',
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'filter_normal_border',
					'selector' => '{{WRAPPER}} .portfolio-filter button',
				]
			);		
			$this->add_responsive_control(
				'filter_normal_radius',
				[
					'label' => esc_html__( 'Border Radius', 'rsaddon' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .portfolio-filter button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'filter_normal_padding',
				[
					'label' => esc_html__( 'Padding', 'rsaddon' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .portfolio-filter button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'filter_normal_margin',
				[
					'label' => esc_html__( 'Margin', 'rsaddon' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .portfolio-filter button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);				
		$this->end_controls_tab();

		$this->start_controls_tab(
				'filter_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'rsaddon' ),
				]
			); 
			$this->add_control(
				'filter_hover_color',
				[
					'label' => esc_html__( 'Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,		      
					'selectors' => [
						'{{WRAPPER}} .portfolio-filter button:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'filter_hover_bg_normal',
					'label' => esc_html__( 'Background', 'rsaddon' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .portfolio-filter button:hover',
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'filter_hover_border',
					'selector' => '{{WRAPPER}} .portfolio-filter button:hover',
				]
			);		
			$this->add_responsive_control(
				'filter_hover_radius',
				[
					'label' => esc_html__( 'Border Radius', 'rsaddon' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .portfolio-filter button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'filter_hover_padding',
				[
					'label' => esc_html__( 'Padding', 'rsaddon' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .portfolio-filter button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'filter_hover_margin',
				[
					'label' => esc_html__( 'Margin', 'rsaddon' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .portfolio-filter button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();	  
		$this->end_controls_section();
	}
	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	public function get_venue_data($event_id) {
		$venues    = [];
		$settings  = $this->get_settings_for_display();		
        //$event_id  = $this->get_event_id();
		$venue_ids = tec_get_venue_ids( $event_id );
		$target    = $settings['venue_website_link_target'] ?? '_self';

		foreach ( $venue_ids as $venue_id ) {
			$phone               = tribe_get_phone( $venue_id );
			$venues[ $venue_id ] = [
				'id'         => $venue_id,
				'name'       => tribe_get_venue( $venue_id ),
				'address'    => tribe_get_full_address( $venue_id ),
				'city'    => tribe_get_address( $venue_id ),
				'phone'      => $phone,
				'phone_link' => tribe_is_truthy( $settings['link_venue_phone'] ?? false ) ? $this->format_phone_link( $phone ) : false,
				'map_link'   => tribe_get_map_link_html( $venue_id ),
				'website'    => tribe_get_venue_website_link( $venue_id, null, $target ),
				'map'        => tribe_get_embedded_map( $venue_id, '100%', '100%' ),
			];
		}

		return $venues;
	}
	
	protected function render() {

	$settings = $this->get_settings_for_display();
		

	// Get the term ID or slug for the category name you want to filter by
	$category_name = 'tribe_events_cat'; // Replace with your category name
	$category = get_term_by('name', $category_name, 'tribe_events_cat');
	$portfolio_order = strtolower( $settings['portfolio_order'] ) === 'dsc' ? 'DESC' : 'ASC';
	if ( $settings['portfolio_date'] == 'upcoming' ) {
		$event_type = date( 'Y-m-d 00:00:00', strtotime( '+1 day', current_time( 'timestamp' ) ) );
	}else {
		$event_type = '';
	}	
	if ( is_plugin_active('the-events-calendar/the-events-calendar.php') ) {
	    $events = tribe_get_events( array( 
	        'posts_per_page' => $settings['per_page'], 
	        'post_type' => 'tribe_events',	     
	        'start_date'     => $event_type,
		    'orderby'   => 'date',
		    'order'     => $portfolio_order,
	    ) );

	    if ( ! empty( $events ) ) {	        
	    } else {}
	} else {}

	 ?>
	<div class="grid-portfolio row rt-portfolio-style<?php echo esc_attr($settings['portfolio_grid_style']); ?>">
	<?php
		$style = !empty($settings['portfolio_grid_style']) ? $settings['portfolio_grid_style'] : '1';

		// Fallback to style1 if the file doesn’t exist
		$style_file = plugin_dir_path(__FILE__) . "/style{$style}.php";

		if ( file_exists($style_file) ) {
			require_once $style_file;
		} else {
			require_once plugin_dir_path(__FILE__) . "/style1.php";
		}
	?>
	</div>

	<?php

	}
} ?>